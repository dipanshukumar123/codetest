<?php

namespace App\Http\Controllers\Admin\M3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use View;
use App\Classes;

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
            $query = Classes::whereModule(3);

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
                $nestedData['class'] = (string)View::make('admin.m3.class.class-template', ['class' => $item])->render();
                $nestedData['options'] = (string)View::make('admin.m3.class.options-template', ['class' => $item])->render();;

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
            return View('admin.m3.class.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.m3.class.create');
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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'name' => ['required', 'string'],
            'num_seats' => ['required', 'integer'],
            'seat_price' => ['required', 'string'],
            'floor_price' => ['required', 'string'],
            'duration' => ['required', 'integer'],
            'duration_label' => ['required', 'string'],
            'app_visibility' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        // store
        $class = new Classes();
        if ($request->hasFile('image')) {
            $class->image = $request->file('image')->store('images');
            Image::make('storage/' . $class->image)->resize(1000, 1000)->save('storage/' . $class->image);
        }
        $class->module = 3;
        $class->name = $request->name;
        $class->num_seats = $request->num_seats;
        $class->seat_price = $request->seat_price;
        $class->floor_price = $request->floor_price;
        $class->duration = $request->duration;
        $class->duration_label = $request->duration_label;
        $class->app_visibility = $request->app_visibility;
        $class->status = $request->status;
        $class->save();

        return redirect()->route('admin.m3.classes.index')->with('status', 'Class added successfully!');
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
        return View('admin.m3.class.edit', compact('class'));
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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'name' => ['required', 'string'],
            'num_seats' => ['required', 'integer'],
            'seat_price' => ['required', 'string'],
            'floor_price' => ['required', 'string'],
            'duration' => ['required', 'integer'],
            'duration_label' => ['required', 'string'],
            'app_visibility' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        // update
        if ($request->hasFile('image')) {
            Storage::delete($class->image);
            $class->image = $request->file('image')->store('images');
            Image::make('storage/' . $class->image)->resize(1000, 1000)->save('storage/' . $class->image);
        }
        $class->name = $request->name;
        $class->num_seats = $request->num_seats;
        $class->seat_price = $request->seat_price;
        $class->floor_price = $request->floor_price;
        $class->duration = $request->duration;
        $class->duration_label = $request->duration_label;
        $class->app_visibility = $request->app_visibility;
        $class->status = $request->status;
        $class->save();

        return redirect()->route('admin.m3.classes.index')->with('status', 'Class updated successfully!');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Classes $class
     * @return \Illuminate\Http\Response
     */
    public function destroyImage(Classes $class)
    {
        Storage::delete($class->image);

        $class->image = null;
        $class->save();

        return back()->with('status', 'Image removed successfully!');
    }
}
