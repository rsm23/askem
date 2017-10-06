<?php

namespace App\Http\Controllers;

use App\Question;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Fetch all relevant replies.
     *
     *
     * @param \App\Question $question
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Question $question)
    {
        return $question->replies()->paginate(10);
    }

    /**
     * Store the reply of a thread
     *
     * @param \App\Question $question
     *
     * @return mixed
     */
    public function store(Question $question)
    {
        $question->addReply([
            'body'    => request('body'),
            'user_id' => auth()->id()
        ])->load('owner');

        return redirect($question->path());
    }
}
