<?php

namespace PCU\Http\Controllers;

use Illuminate\Http\Request;

use PCU\Http\Requests;
use PCU\Http\Controllers\Controller;
use PCU\CityCatalogueModel;
use PCU\PostalCodesMXModel;

class DynamicListsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function cities(Request $request, $code){
        if($request->ajax()){
            $cities = CityCatalogueModel::cities($code);
            return response()->json($cities);
        }
    }

    public function postalcodes(Request $request, $code){
        if($request->ajax()){
            $postalcodes = PostalCodesMXModel::postalcodes($code);
            return response()->json($postalcodes);
        }
    }

    public function state(Request $request, $code){
        if($request->ajax()){
            $state = PostalCodesMXModel::state($code);
            return response()->json($state);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(400);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(400);
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
        abort(400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(400);
    }
}
