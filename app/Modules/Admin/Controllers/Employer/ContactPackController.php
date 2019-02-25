<?php

namespace App\Modules\Admin\Controllers\Employer;

use App\ContactPack;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactPackController extends Controller
{
    public $data = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data["contactpacks"] = ContactPack::all();
        return view('Admin::employer.contactpack.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('Admin::employer.contactpack.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [ 
                "price" => "required|digits_between:1,6",
                "credit" => "required|digits_between:1,6",
                "offer_value"=>"required_with:offer_type",
                "offer_type"=>"required_with:offer_value",
            ]);

        $faq = new ContactPack;
        $faq->fill($request->toArray());
        $faq->save();

        return redirect()->route("admin.employer.contactpacks.index");
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
        $credit = ContactPack::find($id);
        if(!$credit)
            abort(404);

        $this->data['contactpack'] = $credit;
        return view("Admin::employer.contactpack.edit", $this->data);
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

        $credit = ContactPack::find($id);
        if(!$credit)
            abort(404);
        $this->validate($request,[ 
                "price" => "required|digits_between:1,6",
                "credit" => "required|digits_between:1,6",
                "offer_value"=>"required_with:offer_type",
                "offer_type"=>"required_with:offer_value",
            ]);
        $credit->fill($request->toArray());
        $credit->save();
        return redirect()->route('admin.employer.contactpacks.index');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $credit = ContactPack::find($id);
        if(!$credit)
            abort(404);

        $credit->delete();
        return back();
    }
}
