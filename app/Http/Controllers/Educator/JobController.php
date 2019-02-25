<?php

 namespace App\Http\Controllers\Educator;

use DB;
use Auth;
use App\Job;
use App\Group;
use Carbon\Carbon;
use App\UserAction;
use Illuminate\Http\Request;
use App\Mail\EducatorAppliedForJob;
use App\Http\Controllers\Controller;
use App\Notifications\Employer\jobApproved;
use App\Notifications\Employer\jobRejected;
use App\Notifications\Employer\AppliedForJob;

class JobController extends Controller
{
    public $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
       $sort = "created_at";
       $orderBy = "desc";

      if(!$request->ajax()){
        $this->data['jobtypes'] =  Group::whereType('jobtype')->whereParentId(0)->get();
        $this->data['categories'] =  Group::whereType('category')->whereParentId(0)->get();
        $this->data['grades']   =  Group::whereType('grade')->whereParentId(0)->get();
      }
       

       // Get All Job filter with hide
       $jobs = JOB::query();

       $jobs->whereDoesntHave('userAction', function ($query) { $query->where('action', 'hide'); });
       $jobs->with(['state', 'city', 'jobType', 'category', 'grade', 'userAction' => function($q){
            $q->whereSenderId(auth()->id());
       }]);
       $jobs->orderBy($sort, $orderBy);

       // only new job
       if($request->has('type') && $request->type == "newjob")
            $jobs->whereDoesntHave('userActionJob', function ($query) {
                $query->where('action', 'view')->where("user_id", auth()->id());
            });

       // seach title
       if($request->has('s'))
            $jobs->where('title', "LIKE", "%{$request->s}%")
                ->orWhereHas('state', function($query) use($request){ 
                                                                      $query->where('name', "LIKE", "%{$request->s}%")
                                                                            ->orWhere("short_name", "LIKE", "%{$request->s}%");
                                                                    })
                ->orWhereHas('city', function($query) use($request){ $query->where('name', "LIKE", "%{$request->s}%");});


       //date range
       try{ if($request->has('range')) $jobs->where("created_at", ">=", Carbon::now()->subDay($request->range));}
       catch(\Exception $ex){ }

       //atleast salary
       if($request->has('atleast')) $jobs->where("pay_min", ">=", $request->atleast);

       //categories
       if($request->has('jobtypes')) $jobs->whereIn('job_type_id', $request->jobtypes);
       if($request->has('categories')) $jobs->whereIn('category_id', $request->categories);
       if($request->has('grades')) $jobs->whereIn('grade_id', $request->grades);

       if($request->has('state')) $jobs->whereStateId($request->state);
       if($request->has('created_at')) $jobs->where(DB::raw('date_format(`created_at`,"%Y-%m-%d")'), Carbon::parse($request->created_at)->format("Y-m-d"));
      

       //deadline
        $jobs->where(function($q){
            $q->whereNull('deadline')->orWhere("deadline", '>', date('Y-m-d'));
        });

       $this->data["jobs"]  = $jobs->paginate(10);

       if($request->has('type') && $request->type == "newjob"){
            $this->data["jobs"]->each(function($job){
                $job->userActionJob()->create(["action" => "view", "user_id" => auth()->id()]);
            });
       }

      if($request->ajax())
        return view('educator.job.list', $this->data);

      return view('educator.job.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apply(Job $job)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $this->data['job'] = $job;

        return view('educator.job.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $this->validate($request,["action" => "required"]);

        $where = [];

        $where[] = ["sender_id", Auth::user()->id ];
        $where[] = ["job_id", $job->id ];
        $where[] = ["receiver_id", $job->user_id];
        $where[] = ["action", "apply"];

        if(UserAction::Where($where)->count() == 0)
        {
            $job->userAction()
                ->attach( Auth::user()->id , [
                                            "action" => $request->action,
                                            "receiver_id" => $job->user_id ,
                                            "educator_id" => auth()->id() 
                                        ]);
                
            if($request->action == 'apply')
            {
                $job = $job->load('user');
                $employer = $job->user;

                $employer->notify(new AppliedForJob(Auth()->user(), $job));
               
            }
            return 'true';
        }
        else
        {
            return 'false';
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    /**
     *  Job status handler
     */

    public function jobStatusHandler(Request $request, Job $job, UserAction $userAction)
    {

        $this->validate($request, [ "status" => "required" ]);

        $userAction->status = $request->status;
        $userAction->save();

        $job = $job->load('user');
        $employer = $job->user;

        if($request->status == "approved")
        {
          $employer->notify(new jobApproved(Auth()->user(), $job));
        }
        else if($request->status == "rejected")
        {
          $employer->notify(new jobRejected(Auth()->user(), $job));
        }

       
        return $userAction->toJson();
    }

    /**
     *  Get jobs with status belongs to User.
     */
    public function jobWithStatus(Request  $request, $status)
    {
        
        $this->data["userActions"] = UserAction::offers(Auth::id())->whereAction("apply")->whereStatus($status)->with("job.state")->get();

        return view("educator.job.{$status}", $this->data);

    }
}

