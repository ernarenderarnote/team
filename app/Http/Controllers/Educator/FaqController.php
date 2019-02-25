<?php

namespace App\Http\Controllers\Educator;

use App\FAQ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
	public $data = [];

    public function index()
    {
    	$this->data['faqs'] = FAQ::whereType('educator')->get();
    	return view('educator.faq', $this->data);
    }
}
