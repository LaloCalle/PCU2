<?php

namespace PCU\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PCU\BranchModel;
use PCU\MatchFunctionModel;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function notFound($value)
    {
        if(!$value){
            abort(404);
        }
    }

    public static function getIdUnique($social_reason, $country, $city, $branch_description)
    {
        // Obtengo las primeras 5 letras, eliminando espacios y caracteres especiales para al final tomar las primeras 5 letras.
        $social_reason_tokens = explode(' ',$social_reason);
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
        $code_country = substr($country, 0, 2);

        // Obtengo las 3 letras de la ciudad
        $code_city = substr($city, 0, 3);

        // Obtengo las 3 letras de la sucursal
        $code_branch_tokens = explode(' ',$branch_description);
        $count = count($code_branch_tokens);
        $code_branch = "";
        if($count == 1){
            $code_branch = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[0])), 0, 3);
        }else if($count == 2){
            $code_branch = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[0])), 0, 2);
            $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[1])), 0, 1);
        }else{
            $code_branch = substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[0])), 0, 1);
            $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[1])), 0, 1);
            $code_branch .= substr(str_replace([' ','  ','   ','    ','     '],'',MatchFunctionModel::sanear_string($code_branch_tokens[2])), 0, 1);
        }

        if(strlen($code_branch) < 3){
            $aleatory_string = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
            $code_branch .= $aleatory_string;

            $code_branch = substr($code_branch, 0, 3);
        }

        //Genero el id de cliente único
        $id_unique_customer = $code_name.$code_country.$code_city.$code_branch;
        $id_unique_customer = strtoupper($id_unique_customer);

        $controller = 0;
        while($controller == 0){
            $controller_id_count = BranchModel::where('id_unique_customer',$id_unique_customer)->count();
            if($controller_id_count <= 0){
                $controller = 1;
            }else{
                $aleatory_string = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);

                $code_branch = substr($code_branch, 0, -3).$aleatory_string;
                $id_unique_customer = $code_name.$code_country.$code_city.$code_branch;
                $id_unique_customer = strtoupper($id_unique_customer);
            }
        }

        return $id_unique_customer;
    }
}
