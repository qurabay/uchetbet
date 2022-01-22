<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventDetail;
use Illuminate\Http\Request;

class EventDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $request->validate([
            'bank'   => 'required',
            'odds'   => 'required',
            'quotes' => 'required',
        ]);

        $create = EventDetail::create($request->all());

        return redirect()->back();
    }

    
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event.detail',[
            'event' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function changeStatus(EventDetail $eventDetail, Request $request)
    {
        if($eventDetail) {
            $eventDetail->update(['type' => $request->type]);
        }
        return redirect()->back();
    }
}
