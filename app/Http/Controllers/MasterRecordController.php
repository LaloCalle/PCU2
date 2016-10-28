<?php

namespace PCU\Http\Controllers;

use Illuminate\Http\Request;

use PCU\Http\Requests;
use PCU\Http\Controllers\Controller;
use PCU\MasterModel;
use PCU\BranchModel;
use PCU\ContactModel;
use PCU\CountryCatalogueModel;
use PCU\CityCatalogueModel;

class MasterRecordController extends Controller
{
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
        $contacts = ContactModel::where('id_branch',$id)->get();
        $branch = BranchModel::where('id',$id)->first();
        $master = MasterModel::where('id',$branch->id_master)->first();

        foreach($contacts as $contact){
            if($contact->type == "email"){
                $contact->type = "E-mail";
            }else if($contact->type == "phone"){
                $contact->type = "Teléfono";
            }else if($contact->type == "mobile"){
                $contact->type = "Móvil";
            }else if($contact->type == "other"){
                $contact->type = "Otro";
            }
        }

        $country_name_count = CountryCatalogueModel::where('code',$branch->country)->count();
        if($country_name_count > 0){
            $country_name = CountryCatalogueModel::where('code',$branch->country)->first();
            $branch->country = $country_name->name;
        }
        $city_name_count = CityCatalogueModel::where('code',$branch->city)->count();
        if($city_name_count > 0){
            $city_name = CityCatalogueModel::where('code',$branch->city)->first();
            $branch->city = $city_name->name;
        }

        return view('master-record.view',compact('master','branch','contacts'));
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
