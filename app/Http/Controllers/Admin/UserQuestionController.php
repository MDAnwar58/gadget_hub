<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class UserQuestionController extends Controller
{
    function index()
    {
        $questions = Question::orderBy('created_at', 'DESC')->get();
        return view('admin.question.index', compact('questions'));
    }

    function show($id)
    {
        $question = Question::findOrFail(intval($id));
        if($question->is_read == 0)
        {
            $question->is_read = 1;
            $question->save();
        }
        $answers = Answer::where('question_id', $question->id)->orderBy('created_at', 'DESC')->get();
        return view('admin.question.show', compact('question', 'answers'));
    }

    function answer(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'item_id' => 'required',
            'question_id' => 'required',
            'answer' => 'required',
        ]);

        $answer = new Answer();
        $answer->user_id = $request->user_id;
        $answer->item_id = $request->item_id;
        $answer->question_id = $request->question_id;
        $answer->answer = $request->answer;
        $answer->save();

        $id = $request->question_id;
        return redirect()->route('user.question.show', $id)->with('successMsg', 'Answer Added successfully!');
    }

    function answerDestory($id)
    {
        $answer = Answer::findOrFail(intval($id));
        $id = $answer->question_id;
        $answer->delete();

        return redirect()->route('user.question.show', $id)->with('successMsg', 'Your Answer Deleted Successfully!');
    }

    function destory($id)
    {
        $question = Question::findOrFail(intval($id));
        $question_id = $question->id;
        $answers = Answer::where('question_id', $question_id)->get();
        if ($answers->count()>0) {
            foreach ($answers as $answer) {
                $answer->delete();
            }
            $question->delete();
        }else{
            $question->delete();
        }

        return redirect()->back()->with('successMsg', 'Your Question Deleted Successfully!');
    }
}
