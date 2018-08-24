<?php

namespace App\Http\Controllers\Api;

use App\Entry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Entry as EntryResource;

class EntryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $entries = Entry::all();
        return EntryResource::collection($entries);
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
        $entry = new Entry;
        $entry->title = $request->input('title');
        $entry->distribution = $request->input('distribution');
        $entry->image = $request->input('image');
        $entry->author = $request->input('author');

        if($entry->save()){
            return new EntryResource($entry);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        //
        dump($entry);
        exit;
        $nentry = Entry::findOrFail($entry->id);
        return new EntryResource($entry);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        //
        $entry = Entry::findOrFail($request->id);

        $entry->title = $request->input('title');
        $entry->distribution = $request->input('distribution');
        $entry->image = $request->input('image');
        $entry->author = $request->input('author');

        if($entry->save()){
            return new EntryResource($entry);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        //
        $nentry = Entry::findOrFail($entry->id);

        if($nentry->delete()){
            return new EntryResource($nentry);
        }
    }
}
