<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativeComparison extends Model
{
    use HasFactory;

    protected $fillable = ['criteria_id', 'alternative_id_1', 'alternative_id_2', 'value'];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id');
    }

    public function alternative1()
    {
        return $this->belongsTo(Alternative::class, 'alternative_id_1');
    }

    public function alternative2()
    {
        return $this->belongsTo(Alternative::class, 'alternative_id_2');
    }
}
