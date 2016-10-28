<?php

namespace PCU\Http\Controllers;

ini_set('max_execution_time', 3600);

use Illuminate\Http\Request;

use PCU\Http\Requests;
use PCU\Http\Controllers\Controller;
use PCU\CustomerModel;
use Maatwebsite\Excel\Facades\Excel;
use PCU\MatchFunctionModel;

class ExtractMatchController extends Controller
{
    public function import()
    {
        // Import de la base EDX
        Excel::load('storage/app/edx.csv', function($reader) {
            foreach ($reader->get() as $book) {
                $i = 0;
                foreach ($book as $key => $value) {
                    if($value == null){
                        $value = "";
                    }
                    $nuevo_arreglo[$i] = $value;
                    $i++;
                }

                if( ($nuevo_arreglo[2] == "" || strlen($nuevo_arreglo[2]) < 2) &&  ($nuevo_arreglo[1] == "" || strlen($nuevo_arreglo[1]) < 2) && ($nuevo_arreglo[10] == "" || strlen($nuevo_arreglo[10]) < 2)){
                    // No hago nada
                }else{
                    CustomerModel::create([
                        'customer_no_ac' => '',
                        'social_reason' => $nuevo_arreglo[2],
                        'short_name' => '',
                        'bl' => '',
                        'cass_iata_nr' => '',
                        'master_name' => '',
                        'creation_date' => '',
                        'ee' => '',
                        'short_name_2' => '',
                        'short_name_3' => '',
                        'short_name_4' => '',
                        'additional_information' => '',
                        'country' => $nuevo_arreglo[9],
                        'state' => $nuevo_arreglo[7],
                        'city' => $nuevo_arreglo[8],
                        'street' => $nuevo_arreglo[5],
                        'no_int' => $nuevo_arreglo[4],
                        'no_ext' => $nuevo_arreglo[3],
                        'colony' => $nuevo_arreglo[6],
                        'postal_code' => $nuevo_arreglo[10],
                        'atention_of' => '',
                        'contact_1' => '',
                        'telephone' => '',
                        'mobile' => '',
                        'fax' => '',
                        'email_1' => $nuevo_arreglo[11],
                        'email_2' => '',
                        'bill_to_account' => '',
                        'bill_add_ref' => '',
                        'bill_sit' => '',
                        'bill_media' => '',
                        'cur_cod' => '',
                        'lng' => '',
                        'comm' => '',
                        'inct_comm' => '',
                        'pdd' => '',
                        'gl_reference' => '',
                        'rfc' => MatchFunctionModel::sanear_string($nuevo_arreglo[1]),
                        'alternate_1' => '',
                        'alternate_2' => '',
                        'alternate_3' => '',
                        'broker' => '',
                        'address_2' => '',
                        'export_contact' => '',
                        'import_contact' => '',
                        'folio' => '',
                        'serie' => '',
                        'total' => '',
                        'uuid' => '',
                        'date' => '',
                        'tim_date' => '',
                        'update_date' => '',
                        'file_name' => '',
                        'font' => 'EDX',
                    ]);
                }
            }
        });

        // Import de la base Participants
        Excel::load('storage/app/participant.csv', function($reader) {
            foreach ($reader->get() as $book) {
                $i = 0;
                foreach ($book as $key => $value) {
                    if($value == null){
                        $value = "";
                    }
                    $nuevo_arreglo[$i] = $value;
                    $i++;
                }

                if( ($nuevo_arreglo[2] == "" || strlen($nuevo_arreglo[2]) < 2) &&  ($nuevo_arreglo[13] == "" || strlen($nuevo_arreglo[13]) < 2) && ($nuevo_arreglo[33] == "" || strlen($nuevo_arreglo[33]) < 2)){
                    // No hago nada
                }else{
                    CustomerModel::create([
                        'customer_no' => $nuevo_arreglo[0],
                        'social_reason' => $nuevo_arreglo[2],
                        'short_name' => $nuevo_arreglo[3],
                        'bl' => $nuevo_arreglo[4],
                        'cass_iata_nr' => $nuevo_arreglo[5],
                        'master_name' => $nuevo_arreglo[6],
                        'creation_date' => $nuevo_arreglo[7],
                        'ee' => $nuevo_arreglo[8],
                        'short_name_2' => $nuevo_arreglo[9],
                        'short_name_3' => $nuevo_arreglo[10],
                        'short_name_4' => $nuevo_arreglo[11],
                        'additional_information' => $nuevo_arreglo[12],
                        'country' => $nuevo_arreglo[15],
                        'state' => $nuevo_arreglo[16],
                        'city' => $nuevo_arreglo[17],
                        'street' => $nuevo_arreglo[13],
                        'no_int' => '',
                        'no_ext' => '',
                        'colony' => '',
                        'postal_code' => $nuevo_arreglo[14],
                        'atention_of' => $nuevo_arreglo[18],
                        'contact_1' => $nuevo_arreglo[19],
                        'telephone' => $nuevo_arreglo[20],
                        'mobile' => '',
                        'fax' => '',
                        'email_1' => $nuevo_arreglo[21],
                        'email_2' => $nuevo_arreglo[22],
                        'bill_to_account' => $nuevo_arreglo[23],
                        'bill_add_ref' => $nuevo_arreglo[24],
                        'bill_sit' => $nuevo_arreglo[25],
                        'bill_media' => $nuevo_arreglo[26],
                        'cur_cod' => $nuevo_arreglo[27],
                        'lng' => $nuevo_arreglo[28],
                        'comm' => $nuevo_arreglo[29],
                        'inct_comm' => $nuevo_arreglo[30],
                        'pdd' => $nuevo_arreglo[31],
                        'gl_reference' => $nuevo_arreglo[32],
                        'rfc' => MatchFunctionModel::sanear_string($nuevo_arreglo[33]),
                        'alternate_1' => '',
                        'alternate_2' => '',
                        'alternate_3' => '',
                        'broker' => '',
                        'address_2' => '',
                        'export_contact' => '',
                        'import_contact' => '',
                        'folio' => '',
                        'serie' => '',
                        'total' => '',
                        'uuid' => '',
                        'date' => '',
                        'tim_date' => '',
                        'update_date' => '',
                        'file_name' => '',
                        'font' => 'Participant',
                    ]);
                }
            }
        });

        // Import de la base CList
        Excel::load('storage/app/clist.csv', function($reader) {
            foreach ($reader->get() as $book) {
                $i = 0;
                foreach ($book as $key => $value) {
                    if($value == null){
                        $value = "";
                    }
                    $nuevo_arreglo[$i] = $value;
                    $i++;
                }

                if( ($nuevo_arreglo[1] == "" || strlen($nuevo_arreglo[1]) < 2) &&  ($nuevo_arreglo[6] == "" || strlen($nuevo_arreglo[6]) < 2) && ($nuevo_arreglo[20] == "" || strlen($nuevo_arreglo[20]) < 2)){
                    // No hago nada
                }else{
                    CustomerModel::create([
                        'customer_no' => $nuevo_arreglo[0],
                        'social_reason' => $nuevo_arreglo[1],
                        'short_name' => $nuevo_arreglo[2],
                        'bl' => '',
                        'cass_iata_nr' => '',
                        'master_name' => '',
                        'creation_date' => '',
                        'ee' => '',
                        'short_name_2' => '',
                        'short_name_3' => '',
                        'short_name_4' => '',
                        'additional_information' => '',
                        'country' => $nuevo_arreglo[9],
                        'state' => $nuevo_arreglo[7],
                        'city' => $nuevo_arreglo[8],
                        'street' => $nuevo_arreglo[6],
                        'no_int' => '',
                        'no_ext' => '',
                        'colony' => $nuevo_arreglo[13],
                        'postal_code' => $nuevo_arreglo[10],
                        'atention_of' => '',
                        'contact_1' => '',
                        'telephone' => $nuevo_arreglo[16],
                        'mobile' => $nuevo_arreglo[17],
                        'fax' => $nuevo_arreglo[18],
                        'email_1' => $nuevo_arreglo[19],
                        'email_2' => '',
                        'bill_to_account' => $nuevo_arreglo[12],
                        'bill_add_ref' => '',
                        'bill_sit' => '',
                        'bill_media' => '',
                        'cur_cod' => '',
                        'lng' => '',
                        'comm' => '',
                        'inct_comm' => '',
                        'pdd' => '',
                        'gl_reference' => '',
                        'rfc' => $nuevo_arreglo[20],
                        'alternate_1' => $nuevo_arreglo[3],
                        'alternate_2' => $nuevo_arreglo[4],
                        'alternate_3' => $nuevo_arreglo[5],
                        'broker' => $nuevo_arreglo[11],
                        'address_2' => $nuevo_arreglo[13],
                        'export_contact' => $nuevo_arreglo[14],
                        'import_contact' => $nuevo_arreglo[15],
                        'folio' => '',
                        'serie' => '',
                        'total' => '',
                        'uuid' => '',
                        'date' => '',
                        'tim_date' => '',
                        'update_date' => '',
                        'file_name' => '',
                        'font' => 'CList',
                    ]);
                }
            }
        });

        $num_customers = CustomerModel::count();
        
        return response()->json([
                "totalRegistros" => $num_customers
            ]);
    }

    public function match(Request $request)
    {
        $resultado = MatchFunctionModel::function_match($request->indice);
        return response()->json([
                "mensaje" => "Match: ".$request->indice,
                "resultado" => $resultado,
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
