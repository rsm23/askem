@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card mb-4 mt-5">
            <div class="card-body">
                <h2 class="card-title">Editing : {{ $question->title }}</h2>
                <form action="/questions/{{ $question->slug }}" method="post" class="mb-5">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-control" placeholder="Title" name="title" value="{{ old('title') ?: $question->title }}"
                                   id="title" required>
                        </div>
                        <div class="col">
                            <select class="form-control" name="channel_id" required>
                                <option>Choose a channel...</option>
                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') || $question->channel_id == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <editor body="{{ old('body') ?: $question->body }}" edit="true"></editor>

                    <button href="#" class="card-link btn btn-primary">Edit question</button>
                    <a href="/questions/{{ $question->slug }}" class="btn btn-primary">Cancel</a>
                </form>

                @include('partials.errors')
            </div>
        </div>
    </div>
@stop