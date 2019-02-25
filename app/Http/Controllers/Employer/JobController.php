<?php

namespace App\Http\Controllers\Employer;

use DB;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Job;
use App\State;
use App\Group;
use App\UserAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\Educator\NewJobPost;
use App\Notifications\Educator\JobApproved;
use App\Notifications\Educator\JobRejected;


class JobController extends Controller
{
    public $data = [];

    public function jobRules()
    {
        return [
                "title"     => "required",
                //"deadline" => "required",
                "job_type_id" => "required",
                "state_id" => "required",
                "city_id"  => "required",
                "category_id" => "required",
                "grade_id" => "required",
                "pay_type" => "required",
                "pay_amount" => "required",
                "description" => "required",
                "education" => "required",
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['states'] = State::with('city')->get();
        $this->data['categories'] = Group::whereType('category')->whereParentId(0)->with('sub')->get();
        $this->data['grades'] = Group::whereType('grade')->whereParentId(0)->with('sub')->get();
        $this->data['jobtypes'] = Group::whereType('jobtype')->whereParentId(0)->get();
        return view('employer.job.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->jobRules());

        DB::beginTransaction();
        try
        {
            $job = new Job;
            $job->fill($request->toArray());
            $job->user_id = Auth::user()->id;

            $pay_amount = $classes = explode("-",$request->pay_amount);

            $job->pay_min = $pay_amount[0];

            if(isset($pay_amount[1])) $job->pay_max = $pay_amount[1];

            if(!empty($request->deadline)) $job->deadline = Carbon::parse($request->deadline);
            
            $job->save();

            DB::commit();

            $users = User::getUserWithRole('educator')->get();

            $job->load('state', 'city');

            foreach ($users as $user) {
                $user->notify(new NewJobPost($job));
            }

            session()->flash("success", "Your job listed has been successfully posted. "); //You will now be redirected back to your dashboard.
            return redirect()->route('dashboard');
        }
        catch(\Exception $ex)
        {
            echo $ex->getMessage();
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $this->data["job"] = $job;
        return view('employer.job.show', $this->data);
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
        //
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
        $userAction->load('sender');
       
        $this->notifications($request, $job, $userAction);

        if($request->status == "approved")
            $userAction->receiver->details->forceFill(["credit" => \DB::raw("credit - 1")])->save();


        return $userAction->toJson();
    }


    /**
     *   Notification handler
     */

    public function notifications($request, $job, $userAction)
    {
        switch ($request->status) {
            case 'approved':
                $userAction->sender->notify(new JobApproved($job));
                break;
            case 'rejected':
                $userAction->sender->notify(new JobRejected($job));
                break;
            case 'accepted':
                $userAction->sender->notify(new JobAccepted($job));
                break;
            default:
                # code...
                break;
        }
        /*if($request->status == "approved")
        {
          $userAction->sender->notify(new JobApproved($job));
        }
        else if($request->status == "rejected")
        {
          $userAction->sender->notify(new JobRejected($job));
        }
        else if($request->status == "accepted")
        {
          $userAction->sender->notify(new JobAccepted($job));
        }*/
    }
}
