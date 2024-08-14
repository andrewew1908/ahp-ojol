<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\CriteriaComparison;
use App\Models\AlternativeComparison;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $criteria = Criteria::all();
        $alternatives = Alternative::all();

        // Step 1: Calculate Criteria Weights
        $criteriaWeights = $this->calculateCriteriaWeights($criteria);

        // Step 2: Calculate Alternative Weights for each Criteria
        $alternativeWeights = $this->calculateAlternativeWeights($criteria, $alternatives);

        // Step 3: Calculate Final Scores for each Alternative
        $finalScores = $this->calculateFinalScores($criteriaWeights, $alternativeWeights, $alternatives);
        // dd($alternativeWeights);

        // Step 4: Sort Alternatives by Final Scores
        $rankedAlternatives = collect($finalScores)->sortByDesc('score')->values()->all();
        return view('results.index', compact('rankedAlternatives'));
    }

    private function calculateCriteriaWeights($criteria)
    {
        $size = $criteria->count();
        $matrix = [];

        // Fill the comparison matrix
        foreach ($criteria as $i => $criterion1) {
            $matrix[$i] = [];
            foreach ($criteria as $j => $criterion2) {
                if ($i == $j) {
                    $matrix[$i][$j] = 1;
                } else {
                    $comparison = CriteriaComparison::where('criteria_id_1', $criterion1->id)
                        ->where('criteria_id_2', $criterion2->id)
                        ->first();
                        $tmpvalcrit = $comparison ? $comparison->value : (CriteriaComparison::where('criteria_id_1', $criterion2->id)
                        ->where('criteria_id_2', $criterion1->id)
                        ->first()?->value ?? 0);
                        if($tmpvalcrit != 0) {
                            $tmpvalcrit = 1/$tmpvalcrit;
                        }
                    $matrix[$i][$j] = $tmpvalcrit;
                    // $matrix[$i][$j] = $comparison ? $comparison->value : ((1 / CriteriaComparison::where('criteria_id_1', $criterion2->id)
                    //     ->where('criteria_id_2', $criterion1->id)
                    //     ->first()?->value ?? 0));
                }
            }
        }

        // Normalize the matrix and calculate weights
        $criteriaWeights = [];
        for ($i = 0; $i < $size; $i++) {
            $criteriaWeights[$i] = array_sum(array_column($matrix, $i));
        }

        $criteriaWeights = array_map(function ($weight) use ($criteriaWeights) {
            return $weight / array_sum($criteriaWeights);
        }, $criteriaWeights);

        return $criteriaWeights;
    }

    private function calculateAlternativeWeights($criteria, $alternatives)
    {
        $alternativeWeights = [];
        foreach ($criteria as $criterion) {
            $size = $alternatives->count();
            $matrix = [];

            // Fill the comparison matrix
            foreach ($alternatives as $i => $alternative1) {
                $matrix[$i] = [];
                foreach ($alternatives as $j => $alternative2) {
                    if ($i == $j) {
                        $matrix[$i][$j] = 1;
                    } else {
                        $comparison = AlternativeComparison::where('criteria_id', $criterion->id)
                            ->where('alternative_id_1', $alternative1->id)
                            ->where('alternative_id_2', $alternative2->id)
                            ->first();
                            $tmpvalalt = $comparison ? $comparison->value : (AlternativeComparison::where('criteria_id', $criterion->id)
                            ->where('alternative_id_1', $alternative2->id)
                            ->where('alternative_id_2', $alternative1->id)
                            ->first()?->value ?? 0);
                            if($tmpvalalt != 0) {
                                $tmpvalalt = 1/$tmpvalalt;
                            }
                            $matrix[$i][$j] = $tmpvalalt;
                        // $matrix[$i][$j] = $comparison ? $comparison->value : (1 / AlternativeComparison::where('criteria_id', $criterion->id)
                        //     ->where('alternative_id_1', $alternative2->id)
                        //     ->where('alternative_id_2', $alternative1->id)
                        //     ->first()->value);
                    }
                }
            }

            // Normalize the matrix and calculate weights
            $weights = [];
            for ($i = 0; $i < $size; $i++) {
                $weights[$i] = array_sum(array_column($matrix, $i));
            }

            $weights = array_map(function ($weight) use ($weights) {
                return $weight / array_sum($weights);
            }, $weights);

            $alternativeWeights[$criterion->id] = $weights;
        }

        return $alternativeWeights;
    }

    private function calculateFinalScores($criteriaWeights, $alternativeWeights, $alternatives)
    {
        // dd($alternativeWeights);
        $finalScores = [];

        foreach ($alternatives as $i => $alternative) {
            $score = 0;

            foreach ($criteriaWeights as $j => $criteriaWeight) {
                $score += $criteriaWeight * $alternativeWeights[$j +1][$i];
            }
// dd($criteriaWeight);
            $finalScores[] = [
                'alternative' => $alternative->name,
                'score' => $score
            ];
        }

        return $finalScores;
    }
}

