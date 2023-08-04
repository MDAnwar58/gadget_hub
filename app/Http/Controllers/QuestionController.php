<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    function questionStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'item_id' => 'required',
            'question' => 'required',
        ]);

        $question = new Question();
        $question->user_id = $request->user_id;
        $question->item_id = $request->item_id;
        $question->question = $request->question;
        $question->save();

        $id = $request->item_id;
        return redirect()->route('items.show', $id)->with('success', 'Your question send successfully!');
    }
}
