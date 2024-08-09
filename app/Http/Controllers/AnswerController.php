<?php
namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $validated = $request->validate([
            'content' => 'required',
        ]);

        $answer = new Answer([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        $question->answers()->save($answer);

        // Award points for answering
        $user = User::find(Auth::id());
        $user->points += 5;
        $user->save();

        return redirect()->route('questions.show', $question);
    }

    public function accept(Answer $answer)
    {
        // Check if the authenticated user is the owner of the question
        if (Auth::id() !== $answer->question->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to accept this answer.');
        }

        $answer->is_accepted = true;
        $answer->save();

        $answer->question->is_solved = true;
        $answer->question->save();

        // Award points for accepted answer
        $answerUser = User::find($answer->user_id);
        $answerUser->points += 15;
        $answerUser->save();

        return redirect()->route('questions.show', $answer->question);
    }
}