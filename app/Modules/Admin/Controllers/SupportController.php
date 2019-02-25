<?php

namespace App\Modules\Admin\Controllers;

use App\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $this->data["supports"] = Support::with('subject')->whereType($type)->get();
        return view('Admin::support.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
       return view('Admin::faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($type, Request $request)
    {
        //$this->validate($request,[ "question" => "required", "answer" => "required"]);

       /* $faq = new FAQ;
        $faq->fill($request->toArray());
        $faq->type = $type;
        $faq->save();

        return redirect()->route("admin.support.index", $type);*/
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
    public function edit($type, Support $support)
    {
        $this->data['support'] = $support;
        return view("Admin::support.reply", $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($type, Request $request, FAQ $faq)
    {
        
        /*$this->validate($request,[ "question" => "required", "answer" => "required"]);
        $faq->fill($request->toArray());
        $faq->save();
        return redirect()->route('admin.faq.index', $type);*/
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type, $id)
    {
        //
    }
}
