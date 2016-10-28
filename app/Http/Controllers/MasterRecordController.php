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
use PCU\MatchFunctionModel;
use Illuminate\Support\Facades\DB;
use Response;
use Session;

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
        $contacts = ContactModel::where('id_branch',$id)->get();
        $branch = BranchModel::where('id',$id)->first();
        $master = MasterModel::where('id',$branch->id_master)->first();

        $countries = CountryCatalogueModel::orderBy('name')->lists('name','code');
        $cities = CityCatalogueModel::where('country_code',$branch->country)->orderBy('name')->lists('name','code');

        $contador = 0;
        if($master->social_reason != null || $master->social_reason != ""){
          $contador++;
        }
        if($master->rfc != null || $master->rfc != ""){
          $contador++;
        }
        if($branch->country != null || $branch->country != ""){
          $contador++;
        }
        if($branch->city != null || $branch->city != ""){
          $contador++;
        }
        if($branch->state != null || $branch->state != ""){
          $contador++;
        }
        if($branch->postal_code != null || $branch->postal_code != ""){
          $contador++;
        }
        if($branch->colony != null || $branch->colony != ""){
          $contador++;
        }
        if($branch->street != null || $branch->street != ""){
          $contador++;
        }
        if($branch->no_ext != null || $branch->no_ext != ""){
          $contador++;
        }
        if($branch->no_int != null || $branch->no_int != ""){
          $contador++;
        }
        foreach($contacts as $contact){
            if($contact->type == 'email' && ($contact->description != null || $contact->description != "")){
              $contador++;
            }
            if($contact->type == 'phone' && ($contact->description != null || $contact->description != "")){
              $contador++;
            }
        }
        $porcentaje = ($contador*100)/12;
        $porcentaje = number_format($porcentaje,2);

        return view('master-record.edit',compact('master','branch','contacts','porcentaje','countries','cities'));
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
        DB::table('master_tb')->where('id',$request->id_master)->update(['social_reason'=>$request->social_reason,'rfc'=>$request->rfc]);

        // Aquí debe ir una función para crear el id de cliente único.
        /*
         * El id se forma de 13 caracteres:
         * 5 letras del nombre del cliente.
         * 2 letras del código del país.
         * 3 letras del código de ciudad.
         * 3 letras del código de sucursal.
        */

        if(strlen($request->id_unique_customer) != 13){
            // Obtengo las primeras 5 letras, eliminando espacios y caracteres especiales para al final tomar las primeras 5 letras.
            $social_reason_tokens = explode(' ',$request->social_reason);
            $count = count($social_reason_tokens);
            $code_name = "";
            if($count == 1){
                $code_name = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[0])), 0, 5);
            }else if($count == 2){
                $code_name = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[0])), 0, 4);
                $code_name .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[1])), 0, 1);
            }else if($count == 3){
                $code_name = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[0])), 0, 3);
                $code_name .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[1])), 0, 1);
                $code_name .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[2])), 0, 1);
            }else if($count == 4){
                $code_name = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[0])), 0, 2);
                $code_name .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[1])), 0, 1);
                $code_name .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[2])), 0, 1);
                $code_name .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[3])), 0, 1);
            }else if($count >= 5){
                $code_name = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[0])), 0, 1);
                $code_name .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[1])), 0, 1);
                $code_name .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[2])), 0, 1);
                $code_name .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[3])), 0, 1);
                $code_name .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($social_reason_tokens[4])), 0, 1);
            }

            if(strlen($code_name) < 5){
                $aleatory_string = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
                $code_name .= $aleatory_string;

                $code_name = substr($code_name, 0, 5);
            }

            // Obtengo las 2 letras del país
            $code_country = $request->country;

            // Obtengo las 3 letras de la ciudad
            $code_city = $request->city;

            // Obtengo las 3 letras de la sucursal
            $code_branch_tokens = explode(' ',$request->branch_description);
            $count = count($code_branch_tokens);
            $code_branch = "";
            if($count == 1){
                $code_branch = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[0])), 0, 5);
            }else if($count == 2){
                $code_branch = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[0])), 0, 4);
                $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[1])), 0, 1);
            }else if($count == 3){
                $code_branch = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[0])), 0, 3);
                $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[1])), 0, 1);
                $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[2])), 0, 1);
            }else if($count == 4){
                $code_branch = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[0])), 0, 2);
                $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[1])), 0, 1);
                $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[2])), 0, 1);
                $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[3])), 0, 1);
            }else if($count >= 5){
                $code_branch = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[0])), 0, 1);
                $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[1])), 0, 1);
                $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[2])), 0, 1);
                $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[3])), 0, 1);
                $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[4])), 0, 1);
            }

            if(strlen($code_branch) < 3){
                $aleatory_string = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
                $code_branch .= $aleatory_string;

                $code_branch = substr($code_branch, 0, 3);
            }

            //Genero el id de cliente único
            $id_unique_customer = $code_name.$code_country.$code_city.$code_branch;
            $request->id_unique_customer = strtoupper($id_unique_customer);
        }

        DB::table('branch_tb')->where('id',$request->id_branch)->update(['id_unique_customer'=>$request->id_unique_customer,'branch_description'=>$request->branch_description,'country'=>$request->country,'city'=>$request->city,'postal_code'=>$request->postal_code,'colony'=>$request->colony,'state'=>$request->state,'street'=>$request->street,'no_ext'=>$request->no_ext,'no_int'=>$request->no_int]);

        $count = DB::table('contact_tb')->where('id_branch',$request->id_branch)->where('type','email')->count();
        if($count == 1){
            DB::table('contact_tb')->where('id_branch',$request->id_branch)->where('type','email')->update(['description'=>$request->email]);
        }else{
            DB::table('contact_tb')->insert(
                    ['id_branch' => $request->id_branch, 'type' => 'email', 'description' => $request->email, 'name_contact' => '']
                );
        }
        $count = DB::table('contact_tb')->where('id_branch',$request->id_branch)->where('type','phone')->count();
        if($count == 1){
            DB::table('contact_tb')->where('id_branch',$request->id_branch)->where('type','phone')->update(['description'=>$request->phone]);
        }else{
            DB::table('contact_tb')->insert(
                    ['id_branch' => $request->id_branch, 'type' => 'phone', 'description' => $request->phone, 'name_contact' => '']
                );
        }
        $count = DB::table('contact_tb')->where('id_branch',$request->id_branch)->where('type','mobile')->count();
        if($count == 1){
            DB::table('contact_tb')->where('id_branch',$request->id_branch)->where('type','mobile')->update(['description'=>$request->mobile]);
        }else{
            DB::table('contact_tb')->insert(
                    ['id_branch' => $request->id_branch, 'type' => 'mobile', 'description' => $request->mobile, 'name_contact' => '']
                );
        }
        $count = DB::table('contact_tb')->where('id_branch',$request->id_branch)->where('type','other')->count();
        if($count == 1){
            DB::table('contact_tb')->where('id_branch',$request->id_branch)->where('type','other')->update(['description'=>$request->other]);
        }else{
            DB::table('contact_tb')->insert(
                    ['id_branch' => $request->id_branch, 'type' => 'other', 'description' => $request->other, 'name_contact' => '']
                );
        }

        Session::flash('message-success','Registro editado correctamente.');

        return response()->json([
            "mensaje" => "Complete"
        ]);
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
