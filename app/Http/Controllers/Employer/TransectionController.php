<?php

namespace App\Http\Controllers\Employer;

use App\Transection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransectionController extends Controller
{
    public $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $md = \DB::raw("DATE_FORMAT(`created_at`, '%Y-%m') as md");


        $range = [];
        if($request->has("range") && $request->get("range") == "3m")
        {
            $range[] = [\DB::raw("DATE_FORMAT(`created_at`, '%Y-%m')"), '>', \DB::raw("DATE_FORMAT(NOW() - interval 3 month, '%Y-%m')")];
        }
        else if( $request->has("date"))
        {
            $range[] = [\DB::raw("DATE_FORMAT(`created_at`, '%Y-%m-%d')"), '>', $request->get("date")];
        }
        else
        {
          $range[] = [\DB::raw("DATE_FORMAT(`created_at`, '%Y-%m')"), '=',  \DB::raw("DATE_FORMAT(NOW(), '%Y-%m')")];
        }

        $this->data["mds"] = Transection::whereUserId(auth()->user()->getUser()->id)
                                            ->select("*", $md)
                                            ->where($range)
                                            ->get()
                                            ->groupBy("md");

        return view('employer.transection.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
