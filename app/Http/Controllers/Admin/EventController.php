<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{

    public function validation($data)
    {
        $validated = Validator::make(
            $data,
            [
                "event_name" => "required|min:3|max:50",
                "date" => "",
                "available_tickets" => "max:80",
            ],
            [
                'event_name.required' => "Il nome dell'evento necessario",
                'event_name.min' => "Il nome dell'evento deve essere minimo di 3 caratteri",
                'event_name.max' => "Il nome dell'evento deve essere massimo di 50 caratteri",
                'available_tickets.max' => "il numero di ticket può avere massimo 80 caratteri",

            ]
        )->validate();

        return $validated;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        $tags = Tag::all();

        return view('admin.events.index', compact('events', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('admin.events.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $dati_validati = $this->validation($data);

        $new_event = new Event();

        $new_event->fill($dati_validati);
        $new_event->save();

        if ($request->filled('tags')) {
            $tags = array_filter($request->tags, 'is_numeric');
            $new_event->tags()->attach($tags);
        }

        return redirect()->route("admin.events.show", $new_event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $tags = Tag::all();

        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view("admin.events.edit", compact("event", "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->all();
        $dati_validati = $this->validation($data);
        $event->update($dati_validati);

        if ($request->filled("tags")) {
            $dati_validati["tags"] = array_filter($dati_validati["tags"]) ? $dati_validati["tags"] : [];  //Livecoding con Luca
            $event->tags()->sync($dati_validati["tags"]);
        }

        return redirect()->route("admin.events.show", $event->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route("admin.events.index");
    }
}
