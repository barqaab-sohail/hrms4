<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice\InvoiceRight;
use App\Models\Project\PrDetail;

class InvoiceController extends Controller
{
    public function create(){

    	$prDetailIds = InvoiceRight::where('hr_employee_id',Auth::user()->hrEmployee->id)->get()->pluck('pr_detail_id')->toArray();

         $projects = PrDetail::wherein('id',$prDetailIds)->get();

    	return view ('invoice.create', compact('projects',));
    }
}
