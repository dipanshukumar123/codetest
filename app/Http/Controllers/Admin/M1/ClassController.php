<?php

namespace App\Http\Controllers\Admin\M1;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use View;
use App\Classes;
use App\Setting;
use App\ClassCycle;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Classes::withCount(['classCycles' => function (Builder $query) {
                    $query->whereStatus(1);
                }])
                ->whereModule(1);

            if ($request->query('onlyTrashed')) {
                $query->onlyTrashed();
            }

            if ($request->query('status') == '0') {
                $query->where('status', $request->query('status'));
            } else {
                $query->where('status', 1);
            }

            if ($request->query('sort')) {
                $query->orderBy('created_at', $request->query('sort'));
            } else {
                $query->orderBy('created_at', 'desc');
            }

            $items = $query->get();

            $data = [];
            foreach ($items as $key => $item) {
                $nestedData['id'] = $key + 1;
                $nestedData['class'] = (string)View::make('admin.m1.class.class-template', ['class' => $item])->render();
                $nestedData['options'] = (string)View::make('admin.m1.class.options-template', ['class' => $item])->render();;

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
            return View('admin.m1.class.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.m1.class.create');
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
            'name' => ['required', 'string'],
            'seat_price' => ['required', 'string'],
            'floor_price' => ['required', 'string'],
            'duration' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    $setting = Setting::find(1);

                    if ($value % $setting->min_slot_duration != 0) {
                        $fail('Please enter a multiple of ' . $setting->min_slot_duration);
                    }
                }
            ],
            'duration_label' => ['required', 'string'],
            'app_visibility' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        // store
        $class = new Classes();
        $class->module = 1;
        $class->name = $request->name;
        $class->seat_price = $request->seat_price;
        $class->floor_price = $request->floor_price;
        $class->duration = $request->duration;
        $class->duration_label = $request->duration_label;
        $class->app_visibility = $request->app_visibility;
        $class->status = $request->status;
        $class->save();

        $setting = Setting::find(1);
        for ($i = 1; $i <= $setting->m1_num_seats; $i++) {
            $class_cycle = new ClassCycle();
            $class_cycle->name = 'Cycle ' . $i;
            $class_cycle->position = $i;
            $class_cycle->status = 1;
            $class->classCycles()->save($class_cycle);
        }

        return redirect()->route('admin.m1.classes.index')->with('status', 'Class added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Classes $class
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Classes $class
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        return View('admin.m1.class.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Classes $class
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $class)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'seat_price' => ['required', 'string'],
            'floor_price' => ['required', 'string'],
            'duration' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    $setting = Setting::find(1);

                    if ($value % $setting->min_slot_duration != 0) {
                        $fail('Please enter a multiple of ' . $setting->min_slot_duration);
                    }
                }
            ],
            'duration_label' => ['required', 'string'],
            'app_visibility' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        // update
        $class->name = $request->name;
        $class->seat_price = $request->seat_price;
        $class->floor_price = $request->floor_price;
        $class->duration = $request->duration;
        $class->duration_label = $request->duration_label;
        $class->app_visibility = $request->app_visibility;
        $class->status = $request->status;
        $class->save();

        return redirect()->route('admin.m1.classes.index')->with('status', 'Class updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Classes $class
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {
        $class->delete();

        return back()->with('status', 'Class deleted successfully!');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param \App\Classes $class
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        Classes::withTrashed()->whereId($id)->restore();

        return back()->with('status', 'Class restored successfully!');
    }
}
