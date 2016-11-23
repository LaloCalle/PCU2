<?php

namespace PCU\Http\Controllers;

use Illuminate\Http\Request;

use PCU\Http\Requests;
use PCU\Http\Controllers\Controller;

class DocumentController extends Controller
{
    private $quote=false, $quoteMsg, $quoteNum;

    public function getpreguide(Request $request){
        $URL = "http://webservices.champ.aero/CHAMPTT_WS/indexGET.php?
            inpRTCL=
            &inpORIG=
            &inpDEST=
            &inpTPCS=1&inpAWGT=1&inpDESC=&inpSHC1=&inpSHC2=&inpSHC3=&inpSHC4=&inpSHC5=&inpSHC6=&inpSHC7=&inpSHC8=&inpSHC9=&inpAGNM=". $request->id ."&inpAGAN=&inpCOMM=&inpDECV=&inpREMK=&inpSHNM=&inpSHAD=&inpSHCO=&inpSHST=&inpSHTL=&inpSHCI=&inpSHCN=&inpSHZP=&inpSHEM=&inpSHRF=&inpCNNM=&inpCNAD=&inpCNCO=&inpCNST=&inpCNTL=&inpCNCI=&inpCNCN=&inpCNZP=&inpQOTN=&inpCHCD=&inpUNWT=&inpCHGW=0&inpCURR=&inpMCC1=&inpMCA1=&inpMCC2=&inpMCA2=&inpMCC3=&inpMCA3=&inpMCC4=&inpMCA4=&inpMCC5=&inpMCA5=&frmSubm=submit";
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
        $URL = "http://webservices.champ.aero/CHAMPTT_WS/indexGET.php?inpRTCL=&inpORIG=&inpDEST=&inpTPCS=&inpAWGT=&inpDESC=&inpSHC1=&inpSHC2=&inpSHC3=&inpSHC4=&inpSHC5=&inpSHC6=&inpSHC7=&inpSHC8=&inpSHC9=&inpAGNM=". $request->id ."&inpAGAN=&inpCOMM=&inpDECV=&inpREMK=&inpSHNM=&inpSHAD=&inpSHCO=&inpSHST=&inpSHTL=&inpSHCI=&inpSHCN=&inpSHZP=&inpSHEM=&inpSHRF=&inpCNNM=&inpCNAD=&inpCNCO=&inpCNST=&inpCNTL=&inpCNCI=&inpCNCN=&inpCNZP=&inpQOTN=". $request->preguide ."&inpCHCD=&inpUNWT=&inpCHGW=0&inpCURR=&inpMCC1=&inpMCA1=&inpMCC2=&inpMCA2=&inpMCC3=&inpMCA3=&inpMCC4=&inpMCA4=&inpMCC5=&inpMCA5=&frmSubm=submit";
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
