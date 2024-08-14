<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriaComparison extends Model
{
    use HasFactory;

    protected $fillable = ['criteria_id_1', 'criteria_id_2', 'value'];

    public function criteria1()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id_1');
    }

    public function criteria2()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id_2');
    }
}
