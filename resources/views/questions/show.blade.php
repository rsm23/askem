@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4 mt-5">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{ $question->title }}
                        </h4>
                    </div>
                    <div class="card-body">
                        {!! parsedown($question->body) !!}
                    </div>
                    @can('update', $question)
                        <div class="card-footer row">
                            <a href="{{ $question->path() }}/edit" class="btn btn-primary border-light col">Edit</a>
                            <form action="{{ $question->path() }}" method="POST" class="form-horizontal col">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a href="{{ $question->path() }}"
                                   class="btn btn-warning border-light col del">Delete</a>
                                <button class="btn btn-danger border-light form-control sure" style="display: none;">
                                    Sure!
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>

                @foreach($question->replies as $reply)
                    <div class="card mb-2">
                        <div class="card-header">
                            <h5 class="card-title mb-2">{{ $reply->owner->name }}
                                <small class="text-muted">said : {{ $reply->created_at->diffForHumans() }}</small>
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! parsedown($reply->body) !!}</p>
                        </div>
                    </div>
                @endforeach

                @auth
                    <div class="card text-primary border-primary">
                        <div class="card-header mt-2">
                            <h5 class="card-title">Add a new reply</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ $question->path() }}/replies" method="post">
                                {{ csrf_field() }}
                                <textarea name="body" id="body" class="form-control mb-3"></textarea>
                                <button type="submit" class="btn btn-primary border-white">Submit</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
            <div class="col-md-4">
                <div class="card mb-4 mt-5">
                    <div class="card-body" style="background: {{ $question->channel->color }}">
                        <h2 class="card-title mb-2">Question Infos</h2>
                        <p class="card-text">{{ $question->author->name }} posted this question
                            {{ $question->created_at->diffForHumans() }} in {{ $question->channel->name }} and it
                            has {{ $question->replies_count }} {{ str_plural('reply', $question->replies_count) }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script>
        $(document).ready(function () {
            $(".del").click(function (e) {
                e.preventDefault();
                $(this).slideUp('slow', function () {
                    $(".sure").css('display', 'block')
                        .slideDown(1000);
                });

            });
        });
    </script>
@stop