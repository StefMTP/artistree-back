<?php

namespace App\Http\Controllers\Art;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PortfolioItem::all();
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
            'title' => 'required|string|max:255',
            'body' => 'required',
            'type' => 'required|string|max:255',
            'file_url' => 'file|max:5120',
            'user_id' => 'required|integer'
        ]);

        $portfolioItem = new PortfolioItem;

        if($request->file('file_url')){
            $name = time() . '_' . $request->file_url->getClientOriginalName();
            $filePath = $request->file('file_url')->storeAs('uploads', $name, 'public');
        } else {
            $filePath = 'default.jpg';
        }

        $portfolioItem->title = $request->title;
        $portfolioItem->body = $request->body;
        $portfolioItem->type = $request->type;
        $portfolioItem->file_url = '/storage/' . $filePath;
        $portfolioItem->user_id = $request->user_id;

        $portfolioItem->save();

        return $portfolioItem;
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return PortfolioItem::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PortfolioItem  $portfolioItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $portfolioItem = PortfolioItem::find($id);

        if($request->file('file_url')){
            $name = time() . '_' . $request->file_url->getClientOriginalName();
            $filePath = $request->file('file_url')->storeAs('uploads', $name, 'public');
            $portfolioItem->file_url = '/storage/' . $filePath;
        }

        $portfolioItem->title = $request->title;
        $portfolioItem->body = $request->body;
        $portfolioItem->type = $request->type;

        $portfolioItem->save();

        return $portfolioItem;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PortfolioItem  $portfolioItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return PortfolioItem::destroy($id);
    }
}
