<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        $criteria = Criteria::all();
        return view('criteria.index', compact('criteria'));
    }

    public function create()
    {
        return view('criteria.create');
    }

    public function store(Request $request)
    {
        Criteria::create($request->all());
        return redirect()->route('criteria.index');
    }

    public function edit($id)
    {
        $criteria = Criteria::find($id);
        return view('criteria.edit', compact('criteria'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Temukan model Criteria berdasarkan ID
        $criteria = Criteria::find($id);

        if ($criteria) {
            // Update data berdasarkan input dari form
            $criteria->name = $validated['name'];
            $criteria->description = $validated['description'];
            $criteria->save(); // Simpan perubahan ke database

            return redirect()->back()->with('success', 'Criteria updated successfully!');
        }

        return redirect()->back()->with('error', 'Criteria not found.');
    }


    public function destroy($id)
    {
        $criteria = Criteria::find($id);
        $criteria->delete();
        return redirect()->route('criteria.index');
    }
}
