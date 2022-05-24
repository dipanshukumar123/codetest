<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return View('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'short_name' => ['required', 'string'],
            'start_time' => ['required', 'string'],
            'end_time' => ['required', 'string'],
            'min_slot_duration' => ['required', 'integer'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string']
        ]);

        // update
        $setting->name = $request->name;
        $setting->short_name = $request->short_name;
        $setting->start_time = $request->start_time;
        $setting->end_time = $request->end_time;
        $setting->min_slot_duration = $request->min_slot_duration;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->save();

        return back()->with('status', 'Setting updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
