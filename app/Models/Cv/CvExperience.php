<?php

namespace App\Models\Cv;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CvExperience extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'cv_detail_id','cv_specialization_id', 'cv_discipline_id','cv_stage_id','year'
    ];
}
