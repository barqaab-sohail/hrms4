<?php

namespace App\Models\Input;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class HrInputMonth extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['month', 'year','is_lock'];
}
