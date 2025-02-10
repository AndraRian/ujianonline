<?php

namespace App\Http\Controllers;
use App\ResponseFormatter;
use Illuminate\Http\Request;

class GrupController extends Controller
{
    public function index()
    {
        $grups = \App\Models\Grup::get();

        return ResponseFormatter::success($grups->pluck('api_response'));
    } 

    public function show(int $id)
    {
        $grups = \App\Models\Grup::find($id);

        if (!$grups) {
            return ResponseFormatter::error('Grup not found', 404);
        }

        return ResponseFormatter::success($grups->api_response);
    } 

    public function store()
    {
        $validator = \Validator::make(request()->all(), [
            'grup' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $grups = \App\Models\Grup::create([
            'grup' => request()->grup,
        ]);

        return $this->show($grups->id, 'Grup Add successfully');
    }

    public function update(int $id)
    {
        $validator = \Validator::make(request()->all(), [
            'grup' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $grups = \App\Models\Grup::find($id);
        $grups->update([
            'grup' => request()->grup,
        ]);

        return $this->show($grups->id, 'Grup Updated successfully');
    }

    public function destroy(int $id)
    {
        $grups = \App\Models\Grup::find($id);
        $grups->delete();

        return ResponseFormatter::success($grups->api_response, 'Grup deleted successfully', 204);
    } 

}
