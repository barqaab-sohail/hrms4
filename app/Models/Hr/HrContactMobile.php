<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class HrContactMobile extends Model implements Auditable
{
    
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['hr_contact_id', 'mobile'];
}
