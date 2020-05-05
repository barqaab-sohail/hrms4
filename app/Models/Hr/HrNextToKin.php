<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class HrNextToKin extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['name','relation','mobile','address','hr_employee_id'];

    protected $table = 'hr_next_to_kins';
}
