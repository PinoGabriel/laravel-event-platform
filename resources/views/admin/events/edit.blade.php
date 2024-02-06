@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Modifica Evento</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row">
            <form action="{{ route('admin.events.store') }}" method="POST">
                @csrf
                {{-- title description thumb price series sale_date type --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Event_name</label>
                    <input type="text" class="form-control @error('event_name') is-invalid @enderror" id="event_name"
                        name="event_name" value="{{ old('event_name') ?? $event->event_name }}">
                    @error('event_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                        name="date" value="{{ old('date') ?? $event->date }}">
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Available_tickets</label>
                    <input type="number" class="form-control" id="available_tickets" name="available_tickets"
                        value="{{ old('available_tickets') ?? $event->available_tickets }}">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Conferma Modifiche</button>
                </div>
            </form>
            <div class="text-center">
                <a href="{{ route('admin.events.index') }}" class="btn btn-warning">Torna alla sezione Progetti</a>
            </div>
        </div>
    </div>
@endsection
