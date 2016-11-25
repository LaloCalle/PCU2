<?php

namespace PCU\Http\Controllers;

use Illuminate\Http\Request;

use PCU\Http\Requests;
use PCU\Http\Requests\CreateBranchRequest;
use PCU\Http\Requests\EditMasterRecordRequest;
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

class PossibleMatchController extends Controller
{
    private $quote=false, $quoteMsg, $quoteNum;

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
        $this->beforeFilter('@find',['only'=>['show','edit','update','destroy']]);
        $this->beforeFilter('@findLink',['only'=>['link']]);
    }

    public function find(Route $route){
        $this->branch = BranchModel::find($route->getParameter('possible_match'));
        $this->notFound($this->branch);
    }

    public function findLink(Route $route){
        $this->master = MasterModel::find($route->getParameter('id'));
        $this->notFound($this->master);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $masters = BranchModel::select('branch_tb.id_unique_customer','branch_tb.id','master_tb.social_reason','master_tb.rfc','branch_tb.branch_description','branch_tb.status_match')
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
        ->noint($request->get('noint'));
        if(isset($request->orderbystatus)){
            if($request->orderbystatus != ""){
                $masters = $masters->where('branch_tb.status_match',$request->orderbystatus);
            }
        }
        $masters = $masters->orderby('master_tb.social_reason')
        ->groupBy('branch_tb.id')
        ->paginate(25);

        $view = view('possible-match.index',compact('masters'));
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
        abort(400);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBranchRequest $request)
    {
        // Aquí puedo hacer la validación de match y si los campos no entran en match entonces hará el add
        $status_match = MatchFunctionModel::function_match_create_branch($request);

        if($status_match == "match"){
            return response()->json([
                "mensaje" => "Match",
                "alerta" => trans('strings.matchmasterrecord'),
            ]);
        }else{
            $request->id_unique_customer = $this->getIdUnique($request->social_reason, $request->country, $request->city, $request->branch_description);

            $branch = BranchModel::create([
                    'id_master' => $request->id_master,
                    'branch_description' => $request->branch_description,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'street' => $request->street,
                    'no_int' => $request->no_int,
                    'no_ext' => $request->no_ext,
                    'colony' => $request->colony,
                    'postal_code' => $request->postal_code,
                    'status_match' => 'match',
                    'id_unique_customer' => $request->id_unique_customer,
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
                "mensaje" => "Link",
                "id_unique" => $request->id_unique_customer,
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
        $branch = $this->branch;
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

        $matches = DB::table('customer_tb')
            ->whereExists(function ($query) use ($master) {
                    $query->select(DB::raw(1))
                          ->from('match_tb')
                          ->whereRaw('match_tb.id_customer = customer_tb.id')
                          ->whereRaw('match_tb.id_master = '. $master->id);
                })
            ->get();

        $reviews = DB::table('customer_tb')
            ->whereExists(function ($query) use ($master) {
                    $query->select(DB::raw(1))
                          ->from('review_tb')
                          ->whereRaw('review_tb.id_customer = customer_tb.id')
                          ->whereRaw('review_tb.id_master = '. $master->id);
                })
            ->get();

        return view('possible-match.details',compact('master','branch','contacts','matches','reviews'));
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
        $branch = $this->branch;
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

        return view('possible-match.edit',compact('master','branch','contacts','porcentaje','countries','cities'));
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
                $mensaje = trans('strings.notwebservice');
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
                    $mensaje = trans('strings.customerexistchamp');
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
                    "alerta" => trans('strings.customereditid'),
                ]);
            }else{
                return response()->json([
                    "mensaje" => "Error",
                    "id_unique" => "",
                    "mensajechamp" => $this->quoteMsg,
                    "numerochamp" => $this->quoteNum,
                    "alerta" => $mensaje,
                ]);
            }
        }
    }

    public function link($id)
    {
        $master = $this->master;
        $branches = BranchModel::where('id_master',$id)->orderby('branch_description')->get();

        $countries = CountryCatalogueModel::orderBy('name')->lists('name','code');
        $cities = CityCatalogueModel::orderBy('name')->lists('name','code');

        return view('possible-match.link',compact('master','branches','countries','cities'));
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
