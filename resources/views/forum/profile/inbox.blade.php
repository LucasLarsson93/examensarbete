@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inbox</h1>
    <div class="row">
        <div class="col-md-12">
            @if($messages->isEmpty())
            <p>You have no messages.</p>
            @else
            <ul class="list-group">
                @foreach($messages as $message)
                <li class="list-group-item">
                    <h5>{{ $message->subject }}</h5>
                    <p>{{ Str::limit($message->body, 100) }}</p>
                    <small>From: {{ $message->sender->name }} | {{ $message->created_at->diffForHumans() }}</small>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
            @if($messages->isEmpty())
                <p>You have no messages.</p>
            @else
                <ul class="list-group">
                    @foreach($messages as $message)
                        <li class="list-group-item">
                            <h5>{{ $message->subject }}</h5>
                            <p>{{ Str::limit($message->body, 100) }}</p>
                            <small>From: {{ $message->sender->name }} | {{ $message->created_at->diffForHumans() }}</small>
                            <a href="{{ route('messages.show', $message->id) }}" class="btn btn-primary btn-sm float-right">Read More</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection