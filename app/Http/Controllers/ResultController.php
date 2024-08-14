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
        // dd($criteriaWeights);

        // Step 2: Calculate Alternative Weights for each Criteria
        $alternativeWeights = $this->calculateAlternativeWeights($criteria, $alternatives);
        // dd($alternativeWeights);

        // Step 3: Calculate Final Scores for each Alternative
        $finalScores = $this->calculateFinalScores($criteriaWeights, $alternativeWeights, $alternatives);
        // dd($finalScores);

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
                    $tmpvalcrit = $comparison
                        ? $comparison->value
                        : CriteriaComparison::where('criteria_id_1', $criterion2->id)
                                ->where('criteria_id_2', $criterion1->id)
                                ->first()?->value ?? 0;
                    if ($tmpvalcrit != 0) {
                        $tmpvalcrit = 1 / $tmpvalcrit;
                    }
                    $matrix[$i][$j] = $tmpvalcrit;
                }
            }
        }

        // dd($matrix);

        // Normalize the matrix
        $normalizedMatrix = [];
        for ($j = 0; $j < $size; $j++) {
            $colSum = array_sum(array_column($matrix, $j));
            for ($i = 0; $i < $size; $i++) {
                $normalizedMatrix[$i][$j] = $matrix[$i][$j] / $colSum;
            }
        }

        // dd($normalizedMatrix);

        // Calculate weights (average of rows)
        $criteriaWeights = [];
        for ($i = 0; $i < $size; $i++) {
            $criteriaWeights[$i] = array_sum($normalizedMatrix[$i]) / $size;
        }

        $criteriaWeights = array_reverse($criteriaWeights);

        // dd($criteriaWeights);

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
                        $tmpvalalt = $comparison
                            ? $comparison->value
                            : AlternativeComparison::where('criteria_id', $criterion->id)
                                    ->where('alternative_id_1', $alternative2->id)
                                    ->where('alternative_id_2', $alternative1->id)
                                    ->first()?->value ?? 0;
                        if ($tmpvalalt != 0) {
                            $tmpvalalt = 1 / $tmpvalalt;
                        }
                        $matrix[$i][$j] = $tmpvalalt;
                    }
                }
            }

            // Normalize the matrix
            $normalizedMatrix = [];
            for ($j = 0; $j < $size; $j++) {
                $colSum = array_sum(array_column($matrix, $j));
                for ($i = 0; $i < $size; $i++) {
                    $normalizedMatrix[$i][$j] = $matrix[$i][$j] / $colSum;
                }
            }

            // Calculate weights (average of rows)
            $weights = [];
            for ($i = 0; $i < $size; $i++) {
                $weights[$i] = array_sum($normalizedMatrix[$i]) / $size;
            }

            // dd($weights);

            $alternativeWeights[$criterion->id] = array_reverse($weights);
        }

        return $alternativeWeights;
    }

    private function calculateFinalScores($criteriaWeights, $alternativeWeights, $alternatives)
    {
        $finalScores = [];
        // dd($criteriaWeights);
        // dd($alternativeWeights);
        // dd($alternatives);

        foreach ($alternatives as $i => $alternative) {
            $score = 0;

            foreach ($criteriaWeights as $j => $criteriaWeight) {
                $score += $criteriaWeight * $alternativeWeights[$j + 1][$i];
            }

            $finalScores[] = [
                'alternative' => $alternative->name,
                'score' => $score,
            ];
        }

        return $finalScores;
    }
}
