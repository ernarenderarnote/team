<?php

namespace App\Http\Controllers\Employer;

use App\FAQ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
	public $data = [];

    public function index()
    {
    	$this->data['faqs'] = FAQ::whereType('employer')->get();
    	return view('employer.faq', $this->data);
    }
}
