<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Explorer;

class ExplorerController extends Controller
{

    public function index()
    {
        $explorer = Explorer::all();
        return response()->json($explorer);
    }

    public function store(Request $request)
    {
        $explorer = Explorer::create([
            'name'=>$request->name,
            'age'=>$request->age,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
        ]);
    }

    public function show(string $id)
    {
        $explorer = Explorer::findOrFail($id);
        return response()->json($explorer, 201);
    }


    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'latitude'=>'sometimes|string',
            'longitude'=>'sometimes|string',
        ]);

        $explorer = Explorer::findOrFail($id);
        $explorer->update ($validated);
        return with ('Success');
    }


    public function history(){
    }
}
