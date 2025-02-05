<?php

namespace App\Http\Controllers;
use App\ResponseFormatter;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function index()
    {
        $moduls = \App\Models\Modul::get();

        return ResponseFormatter::success($moduls->pluck('api_response'));
    } 

    public function show(int $id)
    {
        $moduls = \App\Models\Modul::find($id);

        if (!$moduls) {
            return ResponseFormatter::error('Modul not found', 404);
        }

        return ResponseFormatter::success($moduls->api_response);
    } 

    public function store()
    {
        $validator = \Validator::make(request()->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $moduls = \App\Models\Modul::create([
            'name' => request()->name,
            'description' => request()->description,
            'is_active' => request()->is_active,
        ]);

        return $this->show($moduls->id, 'Modul Add successfully');
    }

    public function update(int $id)
    {
        $validator = \Validator::make(request()->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $moduls = $moduls = \App\Models\Modul::find($id);
        $moduls->update([
            'name' => request()->name,
            'description' => request()->description,
            'is_active' => request()->is_active,
        ]);

        return $this->show($moduls->id, 'Modul Updated successfully');
    }

    public function destroy(int $id)
    {
        $moduls = \App\Models\Modul::find($id);
        $moduls->delete();

        return ResponseFormatter::success($moduls->api_response, 'Modul deleted successfully', 204);
    } 

}
