<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Paginator;
use Session;
use Input;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use View;
use Mail;
use Exception;

use App\User;


class UserController extends Controller
{	
	private $data = [];


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');

	}

   
    /* DAshboard index */

    public function index($type)
    {
    	$this->roles = $this->getUserRole();

    	$this->resolvedUserListWithRole($type);
        return view('backend.'.$type.'.list', $this->data);
        
    }


    /**  College  **/
    public function resolvedUserListWithRole($role)
    {
    	
    	$where = [];

    	$this->data['students'] = User::getUserWithRole($role)->where($where)->get();
    }


    public function edit($id)
    {
        $this->data['student'] = $this->getStudentById($id);
        return view('backend.student.edit', $this->data);
    }



    public function getUserById($id)
    {
        return User::find($id);
    }

}
