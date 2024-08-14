<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::all();
        return view('alternatives.index', compact('alternatives'));
    }

    public function create()
    {
        return view('alternatives.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'description' => 'nullable|string',
        ]);

        Alternative::create($request->all());

        return redirect()->route('alternatives.index');
    }

    public function edit($id)
    {
        $alternative = Alternative::find($id);
        return view('alternatives.edit', compact('alternative'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            // 'description' => 'nullable|string',
        ]);

        $alternative = Alternative::find($id);
        $alternative->update($request->all());

        return redirect()->route('alternatives.index');
    }

    public function destroy($id)
    {
        $alternative = Alternative::find($id);
        $alternative->delete();

        return redirect()->route('alternatives.index');
    }
}

