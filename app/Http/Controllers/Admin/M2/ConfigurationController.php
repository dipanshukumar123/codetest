<?php

namespace App\Http\Controllers\Admin\M2;

use App\Classes;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
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
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        $class = Classes::whereModule(2)->first();
        return View('admin.m2.configuration.edit', compact('setting', 'class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $validatedData = $request->validate([
            'duration' => ['required', 'integer'],
            'duration_label' => ['required', 'string'],
            'm2_num_classes_per_slot' => ['required', 'string'],
            'm2_individual_price' => ['required', 'string'],
            'm2_couple_price' => ['required', 'string'],
            'm2_coach_individual_price' => ['required', 'string'],
            'm2_coach_couple_price' => ['required', 'string']
        ]);

        // update
        $class = Classes::whereModule(2)->first();
        $class->duration = $request->duration;
        $class->duration_label = $request->duration_label;
        $class->save();

        $setting->m2_num_classes_per_slot = $request->m2_num_classes_per_slot;
        $setting->m2_individual_price = $request->m2_individual_price;
        $setting->m2_couple_price = $request->m2_couple_price;
        $setting->m2_coach_individual_price = $request->m2_coach_individual_price;
        $setting->m2_coach_couple_price = $request->m2_coach_couple_price;
        $setting->save();

        return back()->with('status', 'Configuration updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
