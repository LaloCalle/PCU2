<?php

namespace PCU\Http\Controllers;

use Illuminate\Http\Request;

use PCU\Http\Requests;
use PCU\Http\Controllers\Controller;
use PCU\MasterModel;
use PCU\BranchModel;
use Illuminate\Support\Facades\DB;
use Response;
use Session;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $masters = BranchModel::select('branch_tb.id_unique_customer','branch_tb.id','master_tb.social_reason','master_tb.rfc','branch_tb.branch_description')
        ->name($request->get('name'))
        ->rfc($request->get('rfc'))
        ->contact($request->get('contact'))
        ->country($request->get('country'))
        ->city($request->get('city'))
        ->state($request->get('state'))
        ->postalcode($request->get('postalcode'))
        ->colony($request->get('colony'))
        ->street($request->get('street'))
        ->noext($request->get('noext'))
        ->noint($request->get('noint'))
        ->whereRaw('LENGTH(id_unique_customer) = 13')
        ->orderby('master_tb.social_reason')
        ->groupBy('branch_tb.id')
        ->paginate(25);

        $view = view('index',compact('masters'));
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['table-result']);
        }else return $view;
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
