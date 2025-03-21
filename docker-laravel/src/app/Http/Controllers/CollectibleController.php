<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collectible;

class CollectibleController extends Controller
{
    public function store(Request $request)
    {
        $collectible = Collectible::create([
            'name'=>$request->name,
            'value'=>$request->value,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'explorer_id'=>$request->explorer_id,
        ]);
    }

    public function show(string $id)
    {
        $collectible = Collectible::findOrFail($id);
        return response()->json($collectible, "ERRO");
    }



    public function trade(Request $request)
    {
        $data = $request->validate([
            'explorer1_id' => 'required|exists:explorers,id',
            'collectible1_id' => 'required|exists:collectibles,id',
            'explorer2_id' => 'required|exists:explorers,id',
            'collectible2_id' => 'required|exists:collectibles,id'
        ]);

        $collectible1 = Collectible::where('id', $data['collectible1_id'])->where('explorer_id', $data['explorer1_id'])->first();
        $collectible2 = Collectible::where('id', $data['collectible2_id'])->where('explorer_id', $data['explorer2_id'])->first();

        if (!$collectible1 || !$collectible2) return response()->json('ERRO');

        $collectible1->update(['explorer_id' => $data['explorer2_id']]);
        $collectible2->update(['explorer_id' => $data['explorer1_id']]);

        return response()->json('Trade sucessful');
    }
}