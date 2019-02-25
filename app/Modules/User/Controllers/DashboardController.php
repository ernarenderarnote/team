<?php

namespace App\Modules\User\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	public $data = [];

    public function index()
    {
    	$this->data['educatorCount'] = User::getUserWithRole('educator')->count();
    	$this->data['employerCount'] = User::getUserWithRole('employer')->count();

    	return view('AdminLte::dashboard', $this->data);
    }
}
