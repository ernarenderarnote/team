<?php

namespace App\Modules\Admin\Controllers\Employer;

use App\Additional;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolController extends Controller
{
    public $data = [];

    public $type = "school";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data["schools"] = Additional::whereType($this->type)->get();
        return view('Admin::employer.school.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('Admin::employer.school.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[ "values" => "required"]);

        $faq = new Additional;
        $faq->fill($request->toArray());
        $faq->type = $this->type;
        $faq->save();

        return redirect()->route("admin.employer.school.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $school = Additional::find($id);
        if(!$school)
            abort(404);

        $this->data['school'] = $school;
        return view("Admin::employer.school.edit", $this->data);
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

        $school = Additional::find($id);
        if(!$school)
            abort(404);
        $this->validate($request,[ "values" => "required"]);
        $school->fill($request->toArray());
        $school->save();
        return redirect()->route('admin.employer.school.index');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = Additional::find($id);
        if(!$school)
            abort(404);

        $school->delete();
        return back();
    }
}
