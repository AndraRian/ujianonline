<?php

namespace App\Http\Controllers;
use App\ResponseFormatter;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = \App\Models\Participant::get();

        return ResponseFormatter::success($participants->pluck('api_response'));
    } 

    public function show(int $id)
    {
        $participants = \App\Models\Participant::find($id);

        if (!$participants) {
            return ResponseFormatter::error('Participant not found', 404);
        }

        return ResponseFormatter::success($participants->api_response);
    } 

    public function store()
    {
        $validator = \Validator::make(request()->all(), [
            'grup_id' => 'required|exists:grups,id',
            'email' => 'required|email',
            'name' => 'required|string',
            'password' => 'required|string',
            'detail' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $grup = \App\Models\Grup::where('id', request()->grup_id)->firstOrFail();
        $participants = \App\Models\Participant::create([
            'grup_id' => $grup->id,
            'email' => request()->email,
            'name' => request()->name,
            'password' => request()->password,
            'detail' => request()->detail,
        ]);

        return $this->show($participants->id, 'Participant Add successfully');
    }

    public function update(int $id)
    {
        $validator = \Validator::make(request()->all(), [
            'email' => 'required|email',
            'name' => 'required|string',
            'password' => 'required|string',
            'detail' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $participants = \App\Models\Participant::find($id);
        $participants->update([
            'email' => request()->email,
            'name' => request()->name,
            'password' => request()->password,
            'detail' => request()->detail,
        ]);

        return $this->show($participants->id, 'Participant Updated successfully');
    }

    public function destroy(int $id)
    {
        $participants = \App\Models\Participant::find($id);
        $participants->delete();

        return ResponseFormatter::success($participants->api_response, 'Participant deleted successfully', 204);
    } 

}
