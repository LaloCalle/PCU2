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
use Illuminate\Routing\Route;

class MasterRecordController extends Controller
{
    private $quote=false, $quoteMsg, $quoteNum;

    public function __construct(){
        $this->middleware('auth');
        $this->beforeFilter('@find',['only'=>['show','edit','update','destroy']]);
    }

    public function find(Route $route){
        $this->branch = BranchModel::find($route->getParameter('master_record'));
        $this->notFound($this->branch);
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
        abort(400);
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
            $request->id_unique_customer = $this->getIdUnique($request->social_reason, $request->country, $request->city, $request->branch_description);

            $URL = "http://webservices.champ.aero/CHAMPTT_WS/websvc2.php?ACCTNBR=". urlencode($request->id_unique_customer) ."&ACCNAME=". urlencode($request->social_reason ." - ". $request->branch_description) ."&ADDRESS1=". urlencode($request->street .", ". $request->no_ext .", ". $request->no_int .", ". $request->colony) ."&ADDRESS2=&CITY=". urlencode($request->city) ."&STATE=". urlencode($request->state) ."&CNTRY=". urlencode($request->country) ."&PCODE=". urlencode($request->postal_code) ."&TELONE=". urlencode($request->phone) ."&MOBILE=". urlencode($request->mobile) ."&FAX=". urlencode($request->other) ."&EMAL=". urlencode($request->email) ."&vatnbr=". urlencode($request->rfc) ."&SNAME=&ACCTA=&ACCTB=&ACCTC=&ECONTACT=&ICONTACT=&DOCDISP=&BROKER=&BillAcct=&EFFDATE=&M_Txt=". urlencode(env('CHAMP_STATUS')) ."&frmSubm=Submit&scrnsel=2&actype=N&HSNM1=&HSNM2=&HSNM3=&HSNM4=";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $URL);
            $data = curl_exec($ch);
            curl_close($ch);

            if($data==false){
                $this->quoteMsg = "Error1"; // Web Service no disponible.
            }else{
                $lineDatos = $data;
                if (strlen($lineDatos) > 0 && strstr($lineDatos, "ERR") == false){
                    $quote = strstr($lineDatos,"OK! Successful");
                    $quote = substr($quote, 40, 13);

                    $this->quote=true;
                    $this->quoteMsg="Exito";
                    $this->quoteNum=$quote;
                    
                }else{
                    $this->quote=false;
                    $this->quoteMsg="Error2";
                    $this->quoteNum="";
                }
            }
            
            if($this->quoteMsg == "Exito"){
                $master = MasterModel::create([
                        'social_reason' => $request->social_reason,
                        'rfc' => $request->rfc,
                    ]);

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

                Session::flash('message-success',trans('strings.adduseralert'));

                return response()->json([
                    "mensaje" => "Customer Created",
                    "id_unique" => $request->id_unique_customer,
                    "mensajechamp" => $this->quoteMsg,
                    "numerochamp" => $this->quoteNum,
                ]);
            }else{
                return response()->json([
                    "mensaje" => "Error",
                    "id_unique" => "",
                    "mensajechamp" => $this->quoteMsg,
                    "numerochamp" => $this->quoteNum,
                ]);
            }
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
        $branch = $this->branch;
        $master = MasterModel::where('id',$branch->id_master)->first();

        foreach($contacts as $contact){
            if($contact->type == "email"){
                $contact->type = trans('strings.email');
            }else if($contact->type == "phone"){
                $contact->type = trans('strings.phone');
            }else if($contact->type == "mobile"){
                $contact->type = trans('strings.mobile');
            }else if($contact->type == "other"){
                $contact->type = trans('strings.other');
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
        // Aquí puedo hacer la validación de match y si los campos no entran en match entonces hará el add
        $status_match = MatchFunctionModel::function_match_update($request);

        if($status_match == "match"){
            return response()->json([
                "mensaje" => "Match",
                "alerta" => trans('strings.matchmasterrecord'),
            ]);
        }else{
            if(strlen($request->id_unique_customer) != 13){
                $request->id_unique_customer = $this->getIdUnique($request->social_reason, $request->country, $request->city, $request->branch_description);
            }

            $URL = "http://webservices.champ.aero/CHAMPTT_WS/websvc2.php?ACCTNBR=". urlencode($request->id_unique_customer) ."&ACCNAME=". urlencode($request->social_reason ." - ". $request->branch_description) ."&ADDRESS1=". urlencode($request->street .", ". $request->no_ext .", ". $request->no_int .", ". $request->colony) ."&ADDRESS2=&CITY=". urlencode($request->city) ."&STATE=". urlencode($request->state) ."&CNTRY=". urlencode($request->country) ."&PCODE=". urlencode($request->postal_code) ."&TELONE=". urlencode($request->phone) ."&MOBILE=". urlencode($request->mobile) ."&FAX=". urlencode($request->other) ."&EMAL=". urlencode($request->email) ."&vatnbr=". urlencode($request->rfc) ."&SNAME=&ACCTA=&ACCTB=&ACCTC=&ECONTACT=&ICONTACT=&DOCDISP=&BROKER=&BillAcct=&EFFDATE=&M_Txt=". urlencode(env('CHAMP_STATUS')) ."&frmSubm=Submit&scrnsel=2&actype=N&HSNM1=&HSNM2=&HSNM3=&HSNM4=";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $URL);
            $data = curl_exec($ch);
            curl_close($ch);

            if($data==false){
                $this->quoteMsg = "Error1"; // Web Service no disponible.
            }else{
                $lineDatos = $data;
                if (strlen($lineDatos) > 0 && strstr($lineDatos, "ERR") == false){
                    $quote = strstr($lineDatos,"OK! Successful");
                    $quote = substr($quote, 40, 13);

                    $this->quote=true;
                    $this->quoteMsg="Exito";
                    $this->quoteNum=$quote;
                    
                }else{
                    $this->quote=false;
                    $this->quoteMsg="Error2";
                    $this->quoteNum="";
                }
            }
            
            if($this->quoteMsg == "Exito"){
                DB::table('master_tb')->where('id',$request->id_master)->update(['social_reason'=>$request->social_reason,'rfc'=>$request->rfc]);

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
                    "mensaje" => "Complete",
                    "id_unique" => $request->id_unique_customer,
                    "mensajechamp" => $this->quoteMsg,
                    "numerochamp" => $this->quoteNum,
                ]);
            }else{
                return response()->json([
                    "mensaje" => "Error",
                    "id_unique" => "",
                    "mensajechamp" => $this->quoteMsg,
                    "numerochamp" => $this->quoteNum,
                ]);
            }
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
        abort(400);
    }
}
