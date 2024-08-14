<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\AlternativeComparison;
use Illuminate\Http\Request;

class AlternativeComparisonController extends Controller
{
    public function index()
    {
        $criteria = Criteria::all();
        $alternatives = Alternative::all();
        $comparisons = AlternativeComparison::all();

        return view('alternative_comparisons.index', compact('criteria', 'alternatives', 'comparisons'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'criteria_id' => 'required',
        //     'alternative_id_1' => 'required|different:alternative_id_2',
        //     'alternative_id_2' => 'required',
        //     'value' => 'required|numeric',
        // ]);
// dd($request);
        // Update or create comparison
        foreach ($request->comparisons as $key => $value) {
            # code...
            $val = $value['value'];
            if (strpos($val, '/') !== false) {
                // If the value contains a "/", evaluate it as a fraction
                $val = eval("return $val;");
            }
            $alt = explode('_', $key);
            $alt1 = $alt[0];
            $alt2 = $alt[1];
            AlternativeComparison::updateOrCreate(
                ['criteria_id' => $request->criteria_id, 'alternative_id_1' => $alt1, 'alternative_id_2' => $alt2],
                ['value' => $val]
            );
            // if($val != 0) {
            //     AlternativeComparison::updateOrCreate(
            //         ['criteria_id' => $request->criteria_id, 'alternative_id_1' => $alt1, 'alternative_id_2' => $alt2],
            //         ['value' => 1 / $val]
            //     );
            // }


        }

        // Save reverse comparison (reciprocal)
        // AlternativeComparison::updateOrCreate(
        //     ['criteria_id' => $request->criteria_id, 'alternative_id_1' => $request->alternative_id_2, 'alternative_id_2' => $request->alternative_id_1],
        //     ['value' => 1 / $request->value]
        // );

        return redirect()->route('alternative-comparisons.index');
    }
}
