<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'criteria';

    // Field yang bisa diisi secara massal
    protected $fillable = ['name'];

    // Relasi dengan CriteriaComparison (perbandingan criteria)
    public function comparisonsAsFirst()
    {
        return $this->hasMany(CriteriaComparison::class, 'criteria_id_1');
    }

    public function comparisonsAsSecond()
    {
        return $this->hasMany(CriteriaComparison::class, 'criteria_id_2');
    }

    // Relasi dengan AlternativeComparison (perbandingan alternatif)
    public function alternativeComparisons()
    {
        return $this->hasMany(AlternativeComparison::class, 'criteria_id');
    }
}
