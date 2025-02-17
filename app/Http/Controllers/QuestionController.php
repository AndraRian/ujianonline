<?php

namespace App\Http\Controllers;
use App\ResponseFormatter;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = \App\Models\Question::get();

        return ResponseFormatter::success($questions->pluck('api_response'));
    } 

    public function show(int $id)
    {
        $questions = \App\Models\Question::find($id);

        if (!$questions) {
            return ResponseFormatter::error('Question not found', 404);
        }

        return ResponseFormatter::success($questions->api_response);
    } 

    public function store()
    {
        $validator = \Validator::make(request()->all(), [
            'modul_id' => 'required|exists:moduls,id',
            'topik_id' => 'required|exists:topiks,id',
            'question' => 'required|string',
            'answer' => 'nullable|string',
            'timer' => 'nullable|numeric',
            'inline_answer' => 'nullable|string',
            'audio' => 'nullable|string',
            'audio_play' => 'required|string',
            'auto_next' => 'required|string',
            'type' => 'required|numeric',
            'difficulty' => 'required|numeric',
            'is_active' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $modul = \App\Models\Modul::where('id', request()->modul_id)->firstOrFail();
        $topik = \App\Models\Topik::where('id', request()->topik_id)->firstOrFail();
        $questions = \App\Models\Question::create([
            'modul_id' => $modul->id,
            'topik_id' => $topik->id,
            'question' => request()->question,
            'answer' => request()->answer,
            'answer' => request()->answer,
            'timer' => request()->timer,
            'inline_answer' => request()->inline_answer,
            'audio' => request()->audio,
            'audio_play' => request()->audio_play,
            'auto_next' => request()->auto_next,
            'type' => request()->type,
            'difficulty' => request()->difficulty,
            'is_active' => request()->is_active,
        ]);

        return $this->show($questions->id, 'Question Add successfully');
    }

    public function update(int $id)
    {
        $validator = \Validator::make(request()->all(), [
            'question' => 'required|string',
            'answer' => 'nullable|string',
            'timer' => 'nullable|numeric',
            'inline_answer' => 'nullable|string',
            'audio' => 'nullable|string',
            'audio_play' => 'required|string',
            'auto_next' => 'required|string',
            'type' => 'required|numeric',
            'difficulty' => 'required|numeric',
            'is_active' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $questions = \App\Models\Question::find($id);
        $questions->update([
            'question' => request()->question,
            'answer' => request()->answer,
            'answer' => request()->answer,
            'timer' => request()->timer,
            'inline_answer' => request()->inline_answer,
            'audio' => request()->audio,
            'audio_play' => request()->audio_play,
            'auto_next' => request()->auto_next,
            'type' => request()->type,
            'difficulty' => request()->difficulty,
            'is_active' => request()->is_active,
        ]);

        return $this->show($questions->id, 'Question Updated successfully');
    }

    public function destroy(int $id)
    {
        $questions = \App\Models\Question::find($id);
        $questions->delete();

        return ResponseFormatter::success($questions->api_response, 'Question deleted successfully', 204);
    } 

}
