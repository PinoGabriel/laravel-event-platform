@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">

            @foreach ($events as $event)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ $event->event_name }}</div>
                        <div class="card-body">Data: {{ $event->date }}</div>
                        <div class="card-body">Posti disponibili: {{ $event->available_tickets }}</div>
                        @if (count($event->tags) > 0)
                            @foreach ($event->tags as $tag)
                                <div class="card-body">#{{ $tag->name }}</div>
                            @endforeach
                        @else
                            <div class="card-body">Nessun Tag #</div>
                        @endif
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-primary mx-2 mb-2">Show
                                details</a>
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-info mx-2 mb-2">Edit</a>
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST"
                                class="d-inline-block mx-2 mb-2">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endsection
