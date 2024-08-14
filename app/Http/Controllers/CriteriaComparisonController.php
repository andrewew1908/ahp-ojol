<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\CriteriaComparison;
use Illuminate\Http\Request;

class CriteriaComparisonController extends Controller
{
    public function index()
    {
        // Ambil semua kriteria
        $criteria = Criteria::all();

        // Ambil semua perbandingan kriteria
        $comparisons = CriteriaComparison::all()->keyBy(function($item) {
            return $item->criteria_id_1 . '_' . $item->criteria_id_2;
        });

        return view('criteria_comparisons.index', compact('criteria', 'comparisons'));
    }

    public function store(Request $request)
    {
        // Validasi input
        // $request->validate([
        //     'comparisons.*.criteria_id_1' => 'required|exists:criteria,id',
        //     'comparisons.*.criteria_id_2' => 'required|exists:criteria,id',
        //     'comparisons.*.value' => 'required|numeric'
        // ]);
// dd($request);
        // Hapus semua perbandingan yang ada sebelum menyimpan yang baru
        CriteriaComparison::truncate();
        // foreach ($request->comparisons as $key => $value) {
        //     # code...
        //     $val = $value->value ?? 0;
        //     $alt = explode('_', $key);
        //     $alt1 = $alt[0];
        //     $alt2 = $alt[1];
        //     AlternativeComparison::updateOrCreate(
        //         ['criteria_id' => $request->criteria_id, 'alternative_id_1' => $alt1, 'alternative_id_2' => $alt2],
        //         ['value' => $val]
        //     );


        // }
        // Proses setiap perbandingan dari input
        foreach ($request->input('comparisons') as $key => $value) {
            // dd($comparison);
            $val = $value['value'];
            if (strpos($val, '/') !== false) {
                // If the value contains a "/", evaluate it as a fraction
                $val = eval("return $val;");
            }
            // dd($val);
            $crt = explode('_', $key);
            $crt1 = $crt[0];
            $crt2 = $crt[1];
            CriteriaComparison::updateOrCreate(
                [
                    'criteria_id_1' => $crt1,
                    'criteria_id_2' => $crt2
                ],
                ['value' => $val]
            );

            // if($val != 0) {
            //     // Simpan perbandingan balik (reciprocal)
            //     CriteriaComparison::updateOrCreate(
            //         [
            //             'criteria_id_1' => $crt1,
            //             'criteria_id_2' => $crt2
            //         ],
            //         ['value' => 1 / $val]
            //     );
            // }
            // CriteriaComparison::updateOrCreate(
            //     [
            //         'criteria_id_1' => $comparison['criteria_id_1'],
            //         'criteria_id_2' => $comparison['criteria_id_2']
            //     ],
            //     ['value' => $comparison['value']]
            // );

            // // Simpan perbandingan balik (reciprocal)
            // CriteriaComparison::updateOrCreate(
            //     [
            //         'criteria_id_1' => $comparison['criteria_id_2'],
            //         'criteria_id_2' => $comparison['criteria_id_1']
            //     ],
            //     ['value' => 1 / $comparison['value']]
            // );
        }

        return redirect()->route('criteria_comparisons.index')->with('success', 'Perbandingan kriteria berhasil disimpan!');
    }
}
