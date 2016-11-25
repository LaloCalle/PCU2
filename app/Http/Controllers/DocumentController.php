<?php

namespace PCU\Http\Controllers;

use Illuminate\Http\Request;

use PCU\Http\Requests;
use PCU\Http\Controllers\Controller;
use PCU\MasterModel;
use PCU\BranchModel;
use PCU\ContactModel;

class DocumentController extends Controller
{
    private $quote=false, $quoteMsg, $quoteNum;

    public function getpreguide(Request $request){
        $branch = BranchModel::where('id_unique_customer',$request->id)->first();
        $contacts = ContactModel::where('id_branch',$branch->id)->get();
        $master = MasterModel::where('id',$branch->id_master)->first();

        $contact->email = "";
        $contact->phone = "";
        $contact->mobile = "";
        $contact->other = "";
        
        foreach($contacts as $contactproc){
            if($contactproc->type == "email"){
                $contact->email = $contactproc->description;
            }else if($contactproc->type == "phone"){
                $contact->phone = $contactproc->description;
            }else if($contactproc->type == "mobile"){
                $contact->mobile = $contactproc->description;
            }else if($contactproc->type == "other"){
                $contact->other = $contactproc->description;
            }
        }

        $URL = "http://webservices.champ.aero/CHAMPTT_WS/indexGET.php?inpORIG=MEX&inpDEST=GDL&inpSHC1=&inpSHC2=&inpSHC3=&inpSHC4=&inpSHC5=&inpSHC6=&inpSHC7=&inpSHC8=&inpSHC9=&inpDECV=&inpSHNM=". urlencode($master->social_reason ." - ". $branch->branch_description) ."&inpSHNE=". urlencode($branch->no_ext) ."&inpSHNI=". urlencode($branch->no_int) ."&inpSHAD=". urlencode($branch->street) ."&inpSHCI=". urlencode($branch->city) ."&inpSHCO=". urlencode($branch->colony) ."&inpSHST=". urlencode($branch->state) ."&inpSHZP=". urlencode($branch->postal_code) ."&inpSHCN=". urlencode($branch->country) ."&inpSHRF=". urlencode($master->rfc) ."&inpSHTL=". urlencode($contact->phone) ."&inpSHEM=". urlencode($contact->email) ."&inpCNNM=&inpCNNE=&inpCNNI=&inpCNAD=&inpCNCI=&inpCNCO=&inpCNST=&inpCNZP=&inpCNCN=&inpCNTL=&inpAGNM=&inpAGAN=&inpREMK=&inpTPCS=1&inpAWGT=1&inpRTCL=&inpCOMM=&inpDESC=&inpCHCD=&inpCURR=&inpUNWT=&inpQOTN=&inpCHGW=1&inpMCC1=&inpMCA1=&inpMCC2=&inpMCA2=&inpMCC3=&inpMCA3=&inpMCC4=&inpMCA4=&inpMCC5=&inpMCA5=". urlencode(env('CHAMP_DOC')) ."&inpSHACCNBR=". urlencode($request->id) ."&frmSubm=submit";
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
                //Busca Palabra QUOTE y extrae sub cadena
                $quote=substr($lineDatos,strpos($lineDatos,"QUOTE"),strlen($lineDatos) );
                $vars = explode("/", $quote);

                $this->quote=true;
                $this->quoteMsg="Exito";
                $this->quoteNum=$vars[1];
                
            }else{
                $this->quote=false;
                $this->quoteMsg="Error2";
                $this->quoteNum="";
            }
        }

        return response()->json([
            "mensaje" => "GETG",
            "mensajechamp" => $this->quoteMsg,
            "numerochamp" => $this->quoteNum,
        ]);
    }

    public function setpreguide(Request $request){
        $URL = "http://webservices.champ.aero/CHAMPTT_WS/indexGET.php?inpORIG=MEX&inpDEST=GDL&inpSHC1=&inpSHC2=&inpSHC3=&inpSHC4=&inpSHC5=&inpSHC6=&inpSHC7=&inpSHC8=&inpSHC9=&inpDECV=&inpSHNM=". urlencode($master->social_reason ." - ". $branch->branch_description) ."&inpSHNE=". urlencode($branch->no_ext) ."&inpSHNI=". urlencode($branch->no_int) ."&inpSHAD=". urlencode($branch->street) ."&inpSHCI=". urlencode($branch->city) ."&inpSHCO=". urlencode($branch->colony) ."&inpSHST=". urlencode($branch->state) ."&inpSHZP=". urlencode($branch->postal_code) ."&inpSHCN=". urlencode($branch->country) ."&inpSHRF=". urlencode($master->rfc) ."&inpSHTL=". urlencode($contact->phone) ."&inpSHEM=". urlencode($contact->email) ."&inpCNNM=&inpCNNE=&inpCNNI=&inpCNAD=&inpCNCI=&inpCNCO=&inpCNST=&inpCNZP=&inpCNCN=&inpCNTL=&inpAGNM=&inpAGAN=&inpREMK=&inpTPCS=1&inpAWGT=1&inpRTCL=&inpCOMM=&inpDESC=&inpCHCD=&inpCURR=&inpUNWT=&inpQOTN=". urlencode($request->preguide) ."&inpCHGW=1&inpMCC1=&inpMCA1=&inpMCC2=&inpMCA2=&inpMCC3=&inpMCA3=&inpMCC4=&inpMCA4=&inpMCC5=&inpMCA5=". urlencode(env('CHAMP_DOC')) ."&inpSHACCNBR=". urlencode($request->id) ."&frmSubm=submit";
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
                //Busca Palabra QUOTE y extrae sub cadena
                $quote=substr($lineDatos,strpos($lineDatos,"QUOTE"),strlen($lineDatos) );
                $vars = explode("/", $quote);

                $this->quote=true;
                $this->quoteMsg="Exito";
                $this->quoteNum=$vars[1];
                
            }else{
                $this->quote=false;
                $this->quoteMsg="Error2";
                $this->quoteNum="";
            }
        }

        return response()->json([
            "mensaje" => "SETG",
            "mensajechamp" => $this->quoteMsg,
            "numerochamp" => $this->quoteNum,
        ]);
    }

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
