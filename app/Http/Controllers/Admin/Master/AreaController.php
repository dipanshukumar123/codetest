<?php

namespace App\Http\Controllers\Admin\Master;

use App\Area;
use App\Governorate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AreaController extends Controller
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
            ];

            $totalData = Area::with('governorate')->where("status",1)->count();
            $totalFiltered = $totalData;

            $limit = $request->length;
            $start = $request->start;
            $order = $columns[$request['order'][0]['column']];
            $dir = $request['order'][0]['dir'];
            if (empty($request['search']['value'])) {
                $query = Area::with('governorate')->where("status",1);

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

                $query = Area::where("status",1)
                    ->where(function ($query) use ($search) {
                        $query->where('title', 'LIKE', "%{$search}%");
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
                $nestedData['governorate'] = $item->governorate->title;
                $nestedData['title'] = $item->title;
                $nestedData['status'] = $item->status == 1 ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                $nestedData['options'] = (string)View::make('admin.areas.option', ['area' => $item])->render();

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
            return View('admin.areas.index');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates = Governorate::latest()->get();
        return View('admin.areas.create',compact('governorates'));
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
            'governorate_id' => ['required', 'string'],
            'title' => ['required', 'string'],
            'status' => ['required', 'integer']
        ]);

        // update
        $areas = new Area();
        $areas->governorate_id = $request->governorate_id;
        $areas->title = $request->title;
        $areas->status = $request->status;
        $areas->save();

        return redirect()->route('admin.areas.index')->with('status', 'Area added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        $governorates = Governorate::latest()->get();
        return View('admin.areas.edit',compact('governorates','area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'governorate_id' => ['required', 'string'],
            'title' => ['required', 'string'],
            'status' => ['required', 'integer']
        ]);

        // update
        $areas = Area::find($id);
        $areas->governorate_id = $request->governorate_id;
        $areas->title = $request->title;
        $areas->status = $request->status;
        $areas->save();


        return redirect()->route('admin.areas.index')->with('status', 'Area updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $areas = Area::where('id',$id)->first();
        $areas->delete();

        return redirect()->back()->with('status', 'Area Deleted successfully!');
    }
}
