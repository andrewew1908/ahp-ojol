<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\CriteriaComparison;
use App\Models\AlternativeComparison;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil jumlah kriteria, alternatif, perbandingan kriteria, dan perbandingan alternatif
        $criteriaCount = Criteria::count();
        $alternativeCount = Alternative::count();
        $criteriaComparisonCount = CriteriaComparison::count();
        $alternativeComparisonCount = AlternativeComparison::count();

        return view('home', compact('criteriaCount', 'alternativeCount', 'criteriaComparisonCount', 'alternativeComparisonCount'));
    }
}

