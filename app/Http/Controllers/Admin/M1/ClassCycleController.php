<?php

namespace App\Http\Controllers\Admin\M1;

use App\ClassCycle;
use App\Classes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;

class ClassCycleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Classes $class)
    {
        if ($request->ajax()) {

            $items = ClassCycle::whereClassId($class->id)->orderBy('position', 'ASC')->get();

            $data = [];
            foreach ($items as $key => $item) {
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $item['name'];
                $nestedData['position'] = $item['position'];
                $nestedData['status'] = $item->status == 1 ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                $nestedData['options'] = (string)View::make('admin.m1.class.cycle.options-template', ['cycle' => $item])->render();;

                $data[$key] = $nestedData;
            }

            $json_data = [
                'draw' => $request->query('draw'),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => $data
            ];

            return response()->json($json_data);
        } else {
            return View('admin.m1.class.cycle.index', compact('class'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ClassCycle $cycle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $class, ClassCycle $cycle)
    {
        $cycle->status = $request->status;
        $cycle->save();

        return redirect()->route('admin.m1.classes.cycles.index', $class)->with('status', 'Status updated successfully!');
    }

}
