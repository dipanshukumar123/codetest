<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use View;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $columns = [
                0 => 'created_at',
                1 => '',
                2 => '',
                3 => '',
                4 => '',
                5 => '',
                6 => '',
                7 => ''
            ];

            $totalData = User::whereType(3)->count();
            $totalFiltered = $totalData;

            $limit = $request->length;
            $start = $request->start;
            $order = $columns[$request['order'][0]['column']];
            $dir = $request['order'][0]['dir'];

            if (empty($request['search']['value'])) {
                $query = User::whereType(3);

                if ($request->query('onlyTrashed')) {
                    $query->onlyTrashed();
                }

                if ($request->query('status') == '0') {
                    $query->where('status', $request->query('status'));
                } else {
                    $query->where('status', 1);
                }

                if ($request->query('sort')) {
                    $query->orderBy($order, $request->query('sort'));
                } else {
                    $query->orderBy($order, 'desc');
                }

                $totalFiltered = $query->count();

                $items = $query
                    ->offset($start)
                    ->limit($limit)
                    ->get();
            } else {
                $search = $request['search']['value'];

                $query = User::whereType(3)
                    ->where(function ($query) use ($search) {
                        $query->where('first_name', 'LIKE', "%{$search}%")
                            ->orWhere('middle_name', 'LIKE', "%{$search}%")
                            ->orWhere('last_name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%")
                            ->orWhere('mobile', 'LIKE', "%{$search}%");
                    });

                if ($request->query('onlyTrashed')) {
                    $query->onlyTrashed();
                }

                if ($request->query('status') == '0') {
                    $query->where('status', $request->query('status'));
                } else {
                    $query->where('status', 1);
                }

                if ($request->query('sort')) {
                    $query->orderBy($order, $request->query('sort'));
                } else {
                    $query->orderBy($order, 'desc');
                }

                $items = $query
                    ->offset($start)
                    ->limit($limit)
                    ->get();

                $totalFiltered = $query->count();
            }

            $data = [];
            foreach ($items as $key => $item) {
                $nestedData['id'] = $key + 1;
                $nestedData['avatar_url'] = $item->avatar_url ? "<img src='{$item->avatar_url}' class='img-circle' width='40px' height='40px' alt=''>" : null;
                $nestedData['name'] = $item->full_name;
                $nestedData['email'] = $item->email;
                $nestedData['mobile'] = $item->mobile;
                $nestedData['status'] = $item->status == 1 ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                $nestedData['options'] = (string)View::make('admin.user.member.options-template', ['user' => $item])->render();

                $data[$key] = $nestedData;
            }

            $json_data = [
                'draw' => $request->query('draw'),
                'recordsTotal' => (integer)$totalData,
                'recordsFiltered' => (integer)$totalFiltered,
                'data' => $data
            ];

            return response()->json($json_data);
        } else {
            return View('admin.user.member.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.user.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'first_name' => ['required', 'string'],
            'middle_name' => ['nullable', 'string'],
            'last_name' => ['required', 'string'],
            'civil_id_number' => ['required', 'string'],
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $exists = User::whereType(3)->whereEmail($value)->exists();

                    if ($exists) {
                        $fail('Email is already exist');
                    }
                }
            ],
            'mobile' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $exists = User::whereType(3)->whereMobile($value)->exists();

                    if ($exists) {
                        $fail('Mobile is already exist');
                    }
                }
            ],
            'gender' => ['required', 'integer'],
            'password' => ['nullable', 'size:8'],
            'confirm_password' => ['nullable', 'same:password'],
            'status' => ['required', 'integer']
        ]);

        // store
        $user = new User();
        $user->type = 3;
        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('avatars');
            Image::make('storage/' . $user->avatar)->resize(1000, 1000)->save('storage/' . $user->avatar);
        }
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->civil_id_number = $request->civil_id_number;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.users.members.index')->with('status', 'Member added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return View('admin.user.member.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'first_name' => ['required', 'string'],
            'middle_name' => ['nullable', 'string'],
            'last_name' => ['required', 'string'],
            'civil_id_number' => ['required', 'string'],
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) use ($user) {
                    $exists = User::whereNotIn('id', [$user->id])->whereType(3)->whereEmail($value)->exists();

                    if ($exists) {
                        $fail('Email is already exist');
                    }
                }
            ],
            'mobile' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($user) {
                    $exists = User::whereType(3)->whereNotIn('id', [$user->id])->whereMobile($value)->exists();

                    if ($exists) {
                        $fail('Mobile is already exist');
                    }
                }
            ],
            'gender' => ['required', 'integer'],
            'password' => ['nullable', 'size:8'],
            'confirm_password' => ['nullable', 'same:password'],
            'status' => ['required', 'integer']
        ]);

        // update
        if ($request->hasFile('avatar')) {
            Storage::delete($user->avatar);
            $user->avatar = $request->file('avatar')->store('avatars');
            Image::make('storage/' . $user->avatar)->resize(1000, 1000)->save('storage/' . $user->avatar);
        }
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->civil_id_number = $request->civil_id_number;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.users.members.index')->with('status', 'Member updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('status', 'Member deleted successfully!');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        User::withTrashed()->whereId($id)->restore();

        return back()->with('status', 'Member restored successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function destroyAvatar(User $user)
    {
        Storage::delete($user->avatar);

        $user->avatar = null;
        $user->save();

        return back()->with('status', 'Avatar removed successfully!');
    }
}
