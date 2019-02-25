<?php

namespace App\Modules\Admin\Controllers;

use App\Additional;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportContactController extends Controller
{
    public $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $this->data["supports"] = Additional::whereType($type.'.support.contact')->first();
        return view('Admin::support.contact.index', $this->data);
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
        /*$this->validate($request,[ "values" => "required"]);

        $additional = new Additional;
        $additional = $type.'.support.contact';
        $additional->values = $request->values;
        $additional->save();

        return redirect()->route("Admin::support.contact.index", $type);*/
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
    public function edit($type, Additional $contact)
    {
        $this->data['additional'] = $contact;
        return view("Admin::support.contact.edit", $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($type, Request $request, Additional $contact)
    {
        
        $this->validate($request,[ "values" => "required"]);
        $contact->fill($request->toArray());
        $contact->save();
        return redirect()->route('admin.support.contact.index', $type);
       
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
