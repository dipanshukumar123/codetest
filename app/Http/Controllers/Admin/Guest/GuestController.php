<?php

namespace App\Http\Controllers\Admin\Guest;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use View;

class GuestController extends Controller
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

            $totalData = User::whereType(4)->count();
            $totalFiltered = $totalData;

            $limit = $request->length;
            $start = $request->start;
            $order = $columns[$request['order'][0]['column']];
            $dir = $request['order'][0]['dir'];

            if (empty($request['search']['value'])) {
                $query = User::whereType(4);

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

                $query = User::whereType(4)
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
                $nestedData['name'] = $item->full_name;
                $nestedData['email'] = $item->email;
                $nestedData['mobile'] = $item->mobile;
                $nestedData['status'] = $item->status == 1 ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                $nestedData['options'] = (string)View::make('admin.user.guest.options-template', ['user' => $item])->render();

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
            return View('admin.user.guest.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return View('admin.user.guest.edit', compact('user'));
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
            'first_name' => ['required', 'string'],
            'middle_name' => ['nullable', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'mobile' => ['required', 'string'],
            'gender' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        // update
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.users.guests.index')->with('status', 'Guest updated successfully!');
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

        return back()->with('status', 'Guest deleted successfully!');
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

        return back()->with('status', 'Guest restored successfully!');
    }
}
