<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Question;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::latest()->with('author')->get();

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $channels = Channel::latest()->get();

        return view('questions.create', compact('channels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     * @internal param \Illuminate\Http\Request $request
     *
     */
    public function store()
    {
        $question = request()->validate([
            'title'      => 'required|min:4',
            'channel_id' => 'required|exists:channels,id',
            'body'       => 'required|min:4'
        ]);

        Question::create(array_merge($question, ['user_id' => auth()->id()]));

        return redirect('/questions');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Question $question
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function show(Question $question)
    {
        
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Question $question
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Question $question)
    {
        $this->authorize('update', $question);

        $channels = Channel::latest()->get();

        return view('questions.edit')->with([
            'question' => $question,
            'channels' => $channels
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Question $question
     *
     * @return \Illuminate\Http\Response
     * @internal param \Illuminate\Http\Request $request
     * @internal param int $id
     *
     */
    public function update(Question $question)
    {
        $this->authorize('update', $question);

        $data = request()->validate([
            'title'      => 'required|min:4',
            'channel_id' => 'required|exists:channels,id',
            'body'       => 'required|min:4'
        ]);

        $question->update($data);

        if (request()->expectsJson()) {
            return response(['status' => 'Question has been updated']);
        }

        return redirect('/questions/' . $question->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Question $question
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function destroy(Question $question)
    {
        $this->authorize('update', $question);

        $question->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Question deleted']);
        }

        return redirect('/questions');

    }
}
