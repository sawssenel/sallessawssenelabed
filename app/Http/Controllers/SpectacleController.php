<?php

namespace App\Http\Controllers;

use App\Models\spectacle;
use Illuminate\Http\Request;

class SpectacleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spectacle = Spectacle::all();
          return $spectacle;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $spectacle = new Spectacle([
            'piece' => $request->input('piece'),
            'salle' => $request->input('salle'),
            'date spectacle' => $request->input('date spectacle')
            ]);
            $spectacle->save();
            return response()->json(($spectacle), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $spectacle = Spectacle::find($id);
        return response()->json($spectacle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $spectacle = Spectacle::find($id);
        $spectacle->update($request->all());
        return response()->json($spectacle, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $spectacle = Spectacle::find($id);
        $spectacle->delete();
        return response()->json('Spectacle  supprimée !');

    }
}
