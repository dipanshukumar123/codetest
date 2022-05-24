<?php

namespace App\Http\Controllers\Admin\M3;

use App\Http\Controllers\Controller;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use View;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Package::whereModule(3);

            if ($request->query('onlyTrashed')) {
                $query->onlyTrashed();
            }

            if ($request->query('status') == '0') {
                $query->where('status', $request->query('status'));
            } else {
                $query->where('status', 1);
            }

            if ($request->query('sort')) {
                $query->orderBy('sort_order', $request->query('sort'));
            } else {
                $query->orderBy('sort_order', 'desc');
            }

            $items = $query->get();

            $data = [];
            foreach ($items as $key => $item) {
                $nestedData['id'] = $key + 1;
                $nestedData['package'] = (string)View::make('admin.m3.package.package-template', ['package' => $item])->render();
                $nestedData['options'] = (string)View::make('admin.m3.package.options-template', ['package' => $item])->render();;

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
            return View('admin.m3.package.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.m3.package.create');
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
            'description' => ['required', 'string'],
            'num_classes' => ['required', 'integer'],
            'price' => ['required', 'string'],
            'validity' => ['required', 'integer'],
            'validity_label' => ['required', 'string'],
            'app_visibility' => ['required', 'integer'],
            'sort_order' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        // store
        $package = new Package();
        if ($request->hasFile('image')) {
            $package->image = $request->file('image')->store('images');
            Image::make('storage/' . $package->image)->resize(1000, 500)->save('storage/' . $package->image);
        }
        $package->module = 2;
        $package->name = $request->name;
        $package->description = $request->description;
        $package->num_classes = $request->num_classes;
        $package->price = $request->price;
        $package->validity = $request->validity;
        $package->validity_label = $request->validity_label;
        $package->app_visibility = $request->app_visibility;
        $package->sort_order = $request->sort_order;
        $package->status = $request->status;
        $package->save();

        return redirect()->route('admin.m3.package.index')->with('status', 'Package added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return View('admin.m3.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'num_classes' => ['required', 'integer'],
            'price' => ['required', 'string'],
            'validity' => ['required', 'integer'],
            'validity_label' => ['required', 'string'],
            'app_visibility' => ['required', 'integer'],
            'sort_order' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        // update
        if ($request->hasFile('image')) {
            Storage::delete($package->image);
            $package->image = $request->file('image')->store('images');
            Image::make('storage/' . $package->image)->resize(1000, 500)->save('storage/' . $package->image);
        }
        $package->name = $request->name;
        $package->description = $request->description;
        $package->num_classes = $request->num_classes;
        $package->price = $request->price;
        $package->validity = $request->validity;
        $package->validity_label = $request->validity_label;
        $package->app_visibility = $request->app_visibility;
        $package->sort_order = $request->sort_order;
        $package->status = $request->status;
        $package->save();

        return redirect()->route('admin.m3.packages.index')->with('status', 'Package updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return back()->with('status', 'Package deleted successfully!');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        Package::withTrashed()->whereId($id)->restore();

        return back()->with('status', 'Package restored successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function destroyImage(Package $package)
    {
        Storage::delete($package->image);

        $package->image = null;
        $package->save();

        return back()->with('status', 'Image removed successfully!');
    }
}
