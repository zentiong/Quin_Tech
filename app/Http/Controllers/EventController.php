<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 
use View;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();

        // load the view and pass the employees
        return View::make('events.index')
            ->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $rules = array(
            'date'=> 'required',
            'starting_time'=> 'required',
            'ending_time'=> 'required',
            'title' => 'required',
            'venue' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/create')
                ->withErrors($validator);
        } else {
            // store
            $event = new Event;
            $event->date = Input::get('date');
            $event->starting_time = Input::get('starting_time');
            $event->ending_time = Input::get('ending_time');
            $event->title = Input::get('title');
            $event->venue = Input::get('venue');
            $event->save();

            // redirect
            Session::flash('message', 'Event Created!');
            return Redirect::to('events');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        return View::make('events.show')
            ->with('event', $event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $event = Event::find($id);

        // show the edit form and pass the user
        return View::make('events.edit')
            ->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $rules = array(
            'date'=> 'required',
            'starting_time'=> 'required',
            'starting_time'=> 'required',
            'title' => 'required',
            'venue' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('events/'.$id.'/create')
                ->withErrors($validator);
        } else {
            // store
            $event = Event::find($id);
            $event->date = Input::get('date');
            $event->starting_time = Input::get('starting_time');
            $event->ending_time = Input::get('ending_time');
            $event->title = Input::get('title');
            $event->venue = Input::get('venue');
            $event->save();

            // redirect
            Session::flash('message', 'Successfully Updated Event!');
            return Redirect::to('events');
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        // redirect
        Session::flash('message', 'Deleted Event!');
        return Redirect::to('events');
    }
}
