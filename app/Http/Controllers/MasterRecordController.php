<?php

namespace PCU\Http\Controllers;

use Illuminate\Http\Request;

use PCU\Http\Requests;
use PCU\Http\Requests\EditMasterRecordRequest;
use PCU\Http\Requests\CreateMasterRecordRequest;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createcustomer()
    {
        $countries = CountryCatalogueModel::orderBy('name')->lists('name','code');
        $cities = CityCatalogueModel::orderBy('name')->lists('name','code');

        return view('master-record.create', compact('countries','cities'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storecustomer(CreateMasterRecordRequest $request)
    {
        // Aquí puedo hacer la validación de match y si los campos no entran en match entonces hará el add
        $status_match = MatchFunctionModel::function_match_create($request);

        if($status_match == "match"){
            return response()->json([
                "mensaje" => "Match",
                "alerta" => trans('strings.matchmasterrecord'),
            ]);
        }else{
            $master = MasterModel::create([
                    'social_reason' => $request->social_reason,
                    'rfc' => $request->rfc,
                ]);

            $request->id_unique_customer = $this->getIdUnique($request->social_reason, $request->country, $request->city, $request->branch_description);

            $branch = BranchModel::create([
                    'id_master' => $master->id,
                    'id_unique_customer' => $request->id_unique_customer,
                    'branch_description' => $request->branch_description,
                    'country' => $request->country,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'colony' => $request->colony,
                    'state' => $request->state,
                    'street' => $request->street,
                    'no_ext' => $request->no_ext,
                    'no_int' => $request->no_int,
                    'status_match' => 'match',
                ]);

            ContactModel::create([
                    'id_branch' => $branch->id,
                    'type' => 'email',
                    'description' => $request->email,
                ]);
            ContactModel::create([
                    'id_branch' => $branch->id,
                    'type' => 'phone',
                    'description' => $request->phone,
                ]);
            ContactModel::create([
                    'id_branch' => $branch->id,
                    'type' => 'mobile',
                    'description' => $request->mobile,
                ]);
            ContactModel::create([
                    'id_branch' => $branch->id,
                    'type' => 'other',
                    'description' => $request->other,
                ]);

            return response()->json([
                "mensaje" => "Customer Created"
            ]);
        }
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
    public function update(EditMasterRecordRequest $request, $id)
    {
        // Aquí puedo hacer la validación de match y si los campos no entran en match entonces hará el add
        $status_match = MatchFunctionModel::function_match_update($request);

        if($status_match == "match"){
            return response()->json([
                "mensaje" => "Match",
                "alerta" => trans('strings.matchmasterrecord'),
            ]);
        }else{
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
                $request->id_unique_customer = $this->getIdUnique($request->social_reason, $request->country, $request->city, $request->branch_description);
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

            Session::flash('message-success',trans('strings.editregisteralert'));

            return response()->json([
                "mensaje" => "Complete"
            ]);
        }
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
