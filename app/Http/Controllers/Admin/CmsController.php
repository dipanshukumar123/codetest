<?php

namespace App\Http\Controllers\Admin;

use App\MasterCms;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CmsController extends Controller
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
     * @param  \App\MasterCms  $masterCms
     * @return \Illuminate\Http\Response
     */
    public function show(MasterCms $masterCms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MasterCms  $masterCms
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterCms $masterCms)
    {
        return View('admin.master.cms.edit', compact('masterCms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MasterCms  $masterCms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterCms $masterCms)
    {
        $validatedData = $request->validate([
            'content' => ['required', 'string']
        ]);

        // update
        $masterCms->content = $request->input('content');
        $masterCms->save();

        return back()->with('status', 'Content updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MasterCms  $masterCms
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterCms $masterCms)
    {
        //
    }
}
