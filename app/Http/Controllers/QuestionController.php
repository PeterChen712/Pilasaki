<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;


class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('user', 'answers')->latest()->paginate(10);
        $topUsers = User::orderBy('points', 'desc')->take(5)->get();
        
        return view('diskusi', compact('questions', 'topUsers'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $validated['user_id'] = auth()->id();

        $question = Question::create($validated);

        return redirect()->route('questions.show', $question);
    }

    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }
}