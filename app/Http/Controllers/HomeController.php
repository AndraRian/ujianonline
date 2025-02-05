<?php

namespace App\Http\Controllers;
use App\ResponseFormatter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getModul()
    {
        $moduls = \App\Models\Modul::whereNull('parent_id')->with(['childs'])->get();

        return ResponseFormatter::success($moduls->pluck('api_response'));
    } 

    public function store()
    {
        $validator = \Validator::make(request()->all(), $this->getValidation());

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $moduls = auth()->user()->moduls()->create([
            'parent_id' => request()->parent_id,
            'name' => request()->name,
            'slug' => \Str::slug(['name']),
            'description' => request()->description,
        ]);

        return $this->show($moduls->id);
    }
}
