<?php

namespace App\Http\Controllers\Admin\Master;

use App\Governorate;
use App\Http\Controllers\Controller;
//use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;

class GovernorateController extends Controller
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
            ];

            $totalData = Governorate::where("status","=","1")->count();
            $totalFiltered = $totalData;

            $limit = $request->length;
            $start = $request->start;
            $order = $columns[$request['order'][0]['column']];
            $dir = $request['order'][0]['dir'];
            if (empty($request['search']['value'])) {
                $query = Governorate::where("status","=","1");

//                if ($request->query('onlyTrashed')) {
//                    $query->onlyTrashed();
//                }

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

                $query = Governorate::where("status","=","1")
                    ->where(function ($query) use ($search) {
                        $query->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('status','LIKE', "%{$search}%");
                    });

//                if ($request->query('onlyTrashed')) {
//                    $query->onlyTrashed();
//                }

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
                $nestedData['governorate_id'] = $item->governorate_id;
                $nestedData['title'] = $item->title;
                $nestedData['status'] = $item->status == 1 ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                $nestedData['options'] = (string)View::make('admin.governorates.option', ['governorate' => $item])->render();

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
            return View('admin.governorates.all');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.governorates.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'status' => ['required', 'integer']
        ]);

        // update
        $governorates = new Governorate();
        $governorates->title = $request->title;
        $governorates->status = $request->status;
        $governorates->save();

        return redirect()->route('admin.governorates.index')->with('status', 'Governorate added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Governorate  $governorate
     * @return \Illuminate\Http\Response
     */
    public function show(Governorate $governorate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Governorate  $governorate
     * @return \Illuminate\Http\Response
     */
    public function edit(Governorate $governorate)
    {
        return View('admin.governorates.edit', compact('governorate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Governorate  $governorate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => ['required', 'string'],
            'status' => ['required', 'integer']
        ]);

        // update
        $governorate = Governorate::find($id);
        $governorate->title = $request->title;
        $governorate->status = $request->status;
        $governorate->save();


        return redirect()->route('admin.governorates.index')->with('status', 'Governorate updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Governorate  $governorate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $governorate = Governorate::where('id',$id)->first();
        $governorate->delete();

        return redirect()->back()->with('status', 'Governorate Deleted successfully!');
    }
}
