@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Questions</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="card-columns">
                    @foreach($questions as $question)
                        <div class="card">
                            <div class="card-body p-0 clickable-card">
                                <blockquote class="blockquote mb-0 card-body">
                                    <p style="color:{{ $question->channel->color }}">{{ $question->title }}</p>
                                    <footer class="blockquote-footer">
                                        <small style="color:{{ $question->channel->color }}">
                                            {{ $question->author->name }} in : <cite
                                                    title="{{ $question->channel->name }}">{{ $question->channel->name }}</cite>
                                        </small>
                                    </footer>
                                </blockquote>
                                <a href="/questions/{{ $question->slug }}" class="overlay-link"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
@endsection