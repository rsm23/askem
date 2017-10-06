@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mb-4 mt-5">
            <div class="card-body">
                <h2 class="card-title">Post a new question</h2>
                <h6 class="card-subtitle mb-4 text-muted">Briefly and explanatory</h6>
                <form action="/questions" method="post" class="mb-5">
                    {{ csrf_field() }}
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-control" placeholder="Title" name="title" value="{{ old('title') }}"
                                   id="title" required>
                        </div>
                        <div class="col">
                            <select class="form-control" name="channel_id" required>
                                <option>Choose a channel...</option>
                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="body" id="body" cols="30" rows="10" class="form-control"
                                  placeholder="What is your question?" required>{{ old('body') }}</textarea>
                    </div>

                    <button href="#" class="card-link btn btn-primary">Post question</button>
                </form>

                @include('partials.errors')
            </div>
        </div>
    </div>
@stop