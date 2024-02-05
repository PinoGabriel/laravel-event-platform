@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>{{ $event->event_name }}</h2>
        </div>
        <div class="row">
            <p>{{ $event->date }}</p>
        </div>
        <div class="row">
            <p>{{ $event->available_tickets }}</p>
            {{-- <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Modifica</a> --}}
            <a href="{{ route('admin.events.index') }}" class="btn btn-primary mt-3">Torna alla sezione Eventi</a>
        </div>
    </div>
@endsection
