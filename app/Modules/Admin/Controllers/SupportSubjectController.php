<?php

namespace App\Modules\Admin\Controllers;

use App\SupportSubject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportSubjectController extends Controller
{
    public $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $this->data["subjects"] = SupportSubject::whereType($type)->get();
        return view('Admin::support.subject.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
       return view('Admin::support.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($type, Request $request)
    {
        $this->validate($request,[ "subject" => "required"]);

        $faq = new SupportSubject;
        $faq->fill($request->toArray());
        $faq->type = $type;
        $faq->save();

        return redirect()->route("admin.support.subject.index", $type);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type, $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($type, SupportSubject $subject)
    {
        $this->data['subject'] = $subject;
        return view("Admin::support.subject.edit", $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($type, Request $request, SupportSubject $subject)
    {
        
        $this->validate($request,[ "subject" => "required"]);
        $subject->fill($request->toArray());
        $subject->save();
        return redirect()->route('admin.support.subject.index', $type);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type, SupportSubject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.support.subject.index', $type);
    }
}
