<?php

namespace App\Http\Controllers\Employer;

use App\User;
use App\UserAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
class EducatorSearchController extends Controller
{

   public $data = [];

   public function index(Request $request)
   {
   		$where = [];
   		$detailWhere = [];

      $where[] = ["stepping", 3];

   		//if(!empty($request->s))
   		//	$where[] = ['title', 'like', '%'. $request->s .'%'];

   		if(!empty($request->salary))
   			$detailWhere[] = ['least_amount','>=', $request->salary ];

   		//if(!empty($request->state))
   		//	$detailWhere[] = ["state", '=', $request->state];

  		$this->data['educators'] = User::whereHas('roles', function($query){
            												$query->whereName('educator');
          									  	})
            										->whereHas('details', function($query) use($detailWhere){
            											$query->where($detailWhere);
          									  	})
            										->where($where)
            										->with('details.position', 'cart')
                                ->get();
   		
 
   		return view('employer.educator-quick-search', $this->data);
   }


  /**
   *   Educator View
   */
  public function educatorView(User $contact){

      // Determine if user has educator role 
      if(!$contact->hasRole('educator'))
        abort(404);

      $this->data["educator"] = $contact;

      $where = [];
      $where[] = ["user_id", auth()->user()->getUser()->id ];
      $where[] = ["receiver_id", $contact->id];
      //$where[] = ["status", "approved"];

      $this->data["isSendContact"] = UserAction::Where($where)->whereAction("contact")->count() > 0;
      return view("employer.educator-view", $this->data);

  }


  /**
   *   Request Contact details
   */

  public function requestContactDetails($id, Request $request)
  {
      //$this->validate($request,["action" => "required"]);

      $where = [];

      $where[] = ["user_id", auth()->user()->getUser()->id ];
      $where[] = ["receiver_id", $id];


      if($request->action == "apply" && UserAction::Where($where)->whereAction("apply")->count() == 0)
      {

        $userAction = new UserAction();
        $userAction->user_id = auth()->user()->getUser()->id;
        $userAction->action = "apply";
        $userAction->sender_id = auth()->id();
        $userAction->receiver_id = $id;
        $userAction->educator_id = $id;

        $userAction->save();    

        return 'true';
      }
      else if($request->action == "contact" && UserAction::Where($where)->whereAction("contact")->count() == 0)
      {

        $userAction = new UserAction();
        $userAction->user_id = auth()->user()->getUser()->id;
        $userAction->action = "contact";
        $userAction->sender_id = auth()->id();
        $userAction->receiver_id = $id;
        //$userAction->educator_id = $id;

        $userAction->save(); 

        return 'true';
      }
      else
      {
          return 'false';
      }
  }

  public function viewResume($id){
    $educator = User::find($id);
    $myFile = public_path("uploads/resume/{$educator->details->resume}");
    return response()->download($myFile);
  }
}
