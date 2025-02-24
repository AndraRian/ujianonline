<?php

namespace App\Http\Controllers;
use App\ResponseFormatter;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index()
    {
        $answers = \App\Models\Answer::get();

        return ResponseFormatter::success($answers->pluck('api_response'));
    } 

    public function show(int $id)
    {
        $answers = \App\Models\Answer::find($id);

        if (!$answers) {
            return ResponseFormatter::error('Answer not found', 404);
        }

        return ResponseFormatter::success($answers->api_response);
    } 

    public function store()
    {
        $validator = \Validator::make(request()->all(), [
            'question_id' => 'required|exists:questions,id',
            'detail' => 'required|string',
            'is_true' => 'required|in:true,false',
            'is_active' => 'required|in:true,false',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $question = \App\Models\Question::where('id', request()->question_id)->firstOrFail();
        $answers = \App\Models\Answer::create([
            'question_id' => $question->id,
            'detail' => request()->detail,
            'is_true' => request()->is_true,
            'is_active' => request()->is_active,
        ]);

        return $this->show($answers->id, 'Answer Add successfully');
    }

    public function update(int $id)
    {
        $validator = \Validator::make(request()->all(), [
            'detail' => 'required|string',
            'is_true' => 'required|in:true,false',
            'is_active' => 'required|in:true,false',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $answers = \App\Models\Answer::find($id);
        $answers->update([
            'detail' => request()->detail,
            'is_true' => request()->is_true,
            'is_active' => request()->is_active,
        ]);

        return $this->show($answers->id, 'Answer Updated successfully');
    }

    public function destroy(int $id)
    {
        $answers = \App\Models\Answer::find($id);

        if ($answers->is_active == true) {
            return ResponseFormatter::error(400, $answers->api_response, [
                'Answer Sedang Active!'
            ]);
        }

        $answers->delete();

        return ResponseFormatter::success($answers->api_response, 'Answer deleted successfully', 204);
    } 

}
