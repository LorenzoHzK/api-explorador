<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collectible;

class CollectibleController extends Controller
{
    public function show(string $id)
    {
        $collectible = Collectible::findOrFail($id);
        return response()->json($collectible, 201);
    }

    public function store(Request $request)
    {
        $collectible = Collectible::create([
            'name'=>$request->name,
            'value'=>$request->value,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'explorer_id'=>$request->explorer_id,
        ]);
        return response()->json($collectible, 201);
    }

    public function trade(Request $request)
    {
        $data = $request->validate([
            'explorer1_id' => 'required|int|exists:explorers,id',
            'collectible1_id.*' => 'required|int|exists:collectibles,id',
            'explorer2_id' => 'required|int|exists:explorers,id',
            'collectible2_id.*' => 'required|int|exists:collectibles,id'
        ]);

        $collectible1 = Collectible::whereIn('id', $data['collectible1_id'])
        ->where('explorer_id', $data['explorer1_id'])->get();

        $collectible2 = Collectible::whereIn('id', $data['collectible2_id'])
        ->where('explorer_id', $data['explorer2_id'])->get()
;
        if ($collectible1->isEmpty() || $collectible2->isEmpty()) {
            return response()->json('Error the itens don`t confer');
        }

        //fazendo a sominha dos itens que eles tem no array do trade

        $totalValueExplorer1 = 0;
        $totalValueExplorer2 = 0;

        foreach ($collectible1 as $item) {
            $totalValueExplorer1 += $item->value;
        }

        foreach ($collectible2 as $item) {
            $totalValueExplorer2 += $item->value;
        }

        if ($totalValueExplorer1 != $totalValueExplorer2) {
            return response()->json('The values not coincide');
        }
            foreach ($collectible1 as $item) {
                $item->update(['explorer_id'=> $data['explorer2_id']]);
            }

            foreach ($collectible2 as $item) {
                $item->update(['explorer_id'=> $data['explorer1_id']]);
            }

            return response()->json('Trade sucessful');
    }
}