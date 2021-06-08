<?php

namespace App\Http\Controllers\Art;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ad::with('user_uploaded')->get();
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
            'title' => 'required|unique:ads|string|max:255',
            'description' => 'required',
            'status' => 'in:active,inactive,aborted,accepted',
            'uploader' => 'required|integer'
        ]);

        return Ad::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ad::with(['user_uploaded', 'users_responded'])->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ad = Ad::find($id);

        $ad->update($request->all());

        return $ad;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Ad::destroy($id);
    }

    // show the responses of an ad
    public function show_responses($id) 
    {
        return Ad::find($id)->users_responded;
    }
}
