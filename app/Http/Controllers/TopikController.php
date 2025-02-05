<?php

namespace App\Http\Controllers;
use App\ResponseFormatter;
use Illuminate\Http\Request;

class TopikController extends Controller
{
    public function index()
    {
        $topiks = \App\Models\Topik::get();

        return ResponseFormatter::success($topiks->pluck('api_response'));
    } 

    public function show(int $id)
    {
        $topiks = \App\Models\Topik::find($id);

        if (!$topiks) {
            return ResponseFormatter::error('Topik not found', 404);
        }

        return ResponseFormatter::success($topiks->api_response);
    } 

    public function store()
    {
        $validator = \Validator::make(request()->all(), [
            'modul_id' => 'required|exists:moduls,id',
            'name' => 'required|string',
            'detail' => 'nullable|string',
            'is_active' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $modul = \App\Models\Modul::where('id', request()->modul_id)->firstOrFail();
        $topiks = \App\Models\Topik::create([
            'modul_id' => $modul->id,
            'name' => request()->name,
            'detail' => request()->detail,
            'is_active' => request()->is_active,
        ]);

        return $this->show($topiks->id, 'Topik Add successfully');
    }

    public function update(int $id)
    {
        $validator = \Validator::make(request()->all(), [
            'name' => 'required|string',
            'detail' => 'nullable|string',
            'is_active' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $topiks = $topiks = \App\Models\Topik::find($id);
        $topiks->update([
            'name' => request()->name,
            'detail' => request()->detail,
            'is_active' => request()->is_active,
        ]);

        return $this->show($topiks->id, 'Topik Updated successfully');
    }

    public function destroy(int $id)
    {
        $topiks = \App\Models\Topik::find($id);
        $topiks->delete();

        return ResponseFormatter::success($topiks->api_response, 'Topik deleted successfully', 204);
    } 

}