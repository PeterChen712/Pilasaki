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
        // Validasi
        $request->validate([
            'content' => 'required|string',
        ]);

        // Buat jawaban
        $answer = new Answer([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'question_id' => $question->id,
        ]);

        $answer->save();

        return redirect()->back()->with('success', 'Jawaban berhasil ditambahkan');
    }

    public function accept(Answer $answer)
    {
        // Check if the authenticated user is the owner of the question
        if (Auth::id() !== $answer->question->user_id) {
            return redirect()->back()->with('error', 'Anda tidak berwenang untuk menerima jawaban ini.');
        }

        // Update the answer
        $answer->is_accepted = true;
        $answer->save();

        // Update the question status
        $question = $answer->question;
        $question->status = Question::STATUS_SELESAI;
        $question->save();

        // Award points for accepted answer
        $answerUser = User::find($answer->user_id);
        $answerUser->points += 15;
        $answerUser->save();

        return redirect()->route('diskusi.questions.show', $question)
                        ->with('success', 'Jawaban diterima sebagai solusi.');
    }
}
