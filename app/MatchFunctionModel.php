<?php

namespace PCU;

ini_set('max_execution_time', 0);

use PCU\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use PCU\CustomerModel;
use PCU\MasterModel;
use PCU\MatchModel;
use Illuminate\Support\Facades\DB;

class MatchFunctionModel extends Model
{
	public static function function_match($indice){
		// Obtengo el registro con el que se trabajará por medio del indice obtenido ($indice)
		$register = CustomerModel::where('id',$indice)->first();
		
		// Verifico si el registro obtenido ($indice) ya entro en match con algún registro maestro
		if(MatchModel::where('id_customer',$indice)->count() == 0){

			// Hago el registro del cliente en la tabla de registros maestros y obtendo el id con el que queda registrado
			$last_id_master = DB::table('master_tb')->insertGetId(
				    ['social_reason' => $register->social_reason, 'rfc' => $register->rfc]
				);
			// Hago el registro de su información como sucursal en la tabla de sucursales y obtengo el id con el que queda registrado.
			$last_id_branch = DB::table('branch_tb')->insertGetId(
				    ['id_master' => $last_id_master, 'code' => '', 'branch_description' => '', 'country' => $register->country, 'state' => $register->state, 'city' => $register->city, 'street' => $register->street, 'no_int' => $register->no_int, 'no_ext' => $register->no_ext, 'colony' => $register->colony, 'postal_code' => $register->postal_code, 'status_match' => 'match', 'id_unique_customer' => '']
				);
			// Hago el registro de los contactos de la sucursal registrada en la tabla de Contactos
			if($register->telephone != "" || $register->telephone != null){
				$last_id_telephone = DB::table('contact_tb')->insertGetId(
					    ['id_branch' => $last_id_branch, 'type' => 'phone', 'description' => $register->telephone, 'name_contact' => '']
					);
			}
			if($register->mobile != "" || $register->mobile != null){
				$last_id_mobile = DB::table('contact_tb')->insertGetId(
					    ['id_branch' => $last_id_branch, 'type' => 'phone', 'description' => $register->mobile, 'name_contact' => '']
					);
			}
			if($register->email_1 != "" || $register->email_1 != null){
				$last_id_email = DB::table('contact_tb')->insertGetId(
					    ['id_branch' => $last_id_branch, 'type' => 'email', 'description' => $register->email_1, 'name_contact' => '']
					);
			}

			// Se creo el maestro y ahora tengo que registrar el id del cliente con el id del maestro en la tabla de match
			// Lo hago de esta forma y no con la sucursal en esta función ya que el match se hace solo con la razón social y el rfc y son datos que estan contenidos en al tabla master_tb
			DB::table('match_tb')->insert([
			    ['id_master' => $last_id_master, 'id_customer' => $register->id]
			]);
			
			$branch = BranchModel::where('id',$last_id_branch)->first();
	        $master = MasterModel::where('id',$branch->id_master)->first();

	        $id_unique_customer = Controller::getIdUnique($master->social_reason, $branch->country, $branch->city, '');

	        // Se agrega el id de cliente único a la base.
	        DB::table('branch_tb')->where('id','=',$last_id_branch)->update(['id_unique_customer'=>$id_unique_customer]);
		}

		// Obtengo todos los registros que estén despues del registro que estamos procesando ($indice)
		$customers = CustomerModel::where('id','>',$indice)->where('rfc',$register->rfc)->get();

		foreach($customers as $customer){
			// Verifico que el cliente que estamos tomando para la comparación no haya entrado en match con otro registro maestro.
			if(DB::table('match_tb')->where('id_customer',$customer->id)->count() == 0){
				// Envío el registro que estamos procesando ($register) y el registro en el que nos encontramos del recorrido ($customer) a la función de match para verificar las coincidencias y obtener una ponderación.
				$result = self::encuentra_ponderacion($customer, $register);
				// Si el valor devuelto es match
				if($result[0] == "match"){
    				// Obtengo un nuevo registro maestro creado a partir de los dos registros procesados.
    				$resultmaster = self::encuentra_maestro($customer, $register);
    				// Hago update en el registro maestro para insertar la información del nuevo registro maestro creado.
    				DB::table('master_tb')->where('id','=',$last_id_master)->update(['social_reason'=>$resultmaster['social_reason'],'rfc'=>$resultmaster['rfc']]);
    				// Hago update en la sucursal para insertar la información del nuevo registro maestro creado.
    				DB::table('branch_tb')->where('id','=',$last_id_branch)->update(['country'=>$resultmaster['country'], 'state'=>$resultmaster['state'], 'city'=>$resultmaster['city'], 'street'=>$resultmaster['street'], 'no_int'=>$resultmaster['no_int'], 'no_ext'=>$resultmaster['no_ext'], 'colony'=>$resultmaster['colony'], 'postal_code'=>$resultmaster['postal_code']]);
    				// Hago update en los contactos para insertar la información del nuevo registro maestro creado.
    				if(isset($last_id_telephone)){
    					if($resultmaster['telephone'] != "" || $resultmaster['telephone'] != null){
    						DB::table('contact_tb')->where('id','=',$last_id_telephone)->update(['description'=>$resultmaster['telephone']]);
    					}
    				}else{
    					if($resultmaster['telephone'] != "" || $resultmaster['telephone'] != null){
	    					$last_id_telephone = DB::table('contact_tb')->insertGetId(
							    ['id_branch' => $last_id_branch, 'type' => 'phone', 'description' => $resultmaster['telephone'], 'name_contact' => '']
							);
	    				}
    				}
    				if(isset($last_id_mobile)){
    					if($resultmaster['mobile'] != "" || $resultmaster['mobile'] != null){
    						DB::table('contact_tb')->where('id','=',$last_id_mobile)->update(['description'=>$resultmaster['mobile']]);
    					}
    				}else{
    					if($resultmaster['mobile'] != "" || $resultmaster['mobile'] != null){
    						$last_id_mobile = DB::table('contact_tb')->insertGetId(
						    	['id_branch' => $last_id_branch, 'type' => 'mobile', 'description' => $resultmaster['mobile'], 'name_contact' => '']
							);
    					}
    				}
    				if(isset($last_id_email)){
    					if($resultmaster['email'] != "" || $resultmaster['email'] != null){
    						DB::table('contact_tb')->where('id','=',$last_id_email)->update(['description'=>$resultmaster['email']]);
    					}
    				}else{
    					if($resultmaster['email'] != "" || $resultmaster['email'] != null){
	    					$last_id_email = DB::table('contact_tb')->insertGetId(
							    ['id_branch' => $last_id_branch, 'type' => 'email', 'description' => $resultmaster['email'], 'name_contact' => '']
							);
	    				}
    				}
					// Hago el registro del cliente que entro en match en la tabla match
    				DB::table('match_tb')->insert([
					    ['id_master' => $last_id_master, 'id_customer' => $customer->id]
					]);
				}else if($result[0] == "review"){
    				DB::table('review_tb')->insert([
					    ['id_master' => $last_id_master, 'id_customer' => $customer->id]
					]);
					DB::table('branch_tb')->where('id','=',$last_id_branch)->update(['status_match'=>'review']);
				}
				$valorprueba = $valorprueba.$result[1]." | ";
			}

			// Aquí debe ir una función para crear el id de cliente único.
			/*
			 * El id se forma de 13 caracteres:
			 * 5 letras del nombre del cliente.
			 * 2 letras del código del país.
			 * 3 letras del código de ciudad.
			 * 3 letras del código de sucursal.
			*/

	        $branch = BranchModel::where('id',$last_id_branch)->first();
	        $master = MasterModel::where('id',$branch->id_master)->first();

	        $id_unique_customer = Controller::getIdUnique($master->social_reason, $branch->country, $branch->city, '');

	        // Se agrega el id de cliente único a la base.
	        DB::table('branch_tb')->where('id','=',$last_id_branch)->update(['id_unique_customer'=>$id_unique_customer]);   
		}

		return $indice." - ".$reg_match." - ".$valorprueba;
	}

	public static function encuentra_ponderacion($registro1, $registro2){
		// Verifico porcentaje de coincidencia en columna nombre.
/*
		$name1 = $registro1->social_reason;
		$name2 = $registro2->social_reason;
		if($name1 == "" || $name1 == null && $name2 == "" || $name2 == null){
			$porcentajename = 100;
		}else{
			$porcentajename = self::encuentra_porcentaje($name1, $name2, 0);
		}
*/

		// Verifico porcentaje de coincidencia en columna rfc.
		$rfc1 = $registro1->rfc;
		$rfc2 = $registro2->rfc;
		if($rfc1 == "" || $rfc1 == null && $rfc2 == "" || $rfc2 == null){
			$porcentajerfc = 100;
		}else{
			$porcentajerfc = self::encuentra_porcentaje($rfc1, $rfc2, 1);
		}

		/***** Función de ponderación *****/
		$puntajemaximo = 5;
		// porcentaje para cada elemento en decimales
//		$valorname = 0.20;
		$valorrfc = 1;

		// Obtenemos puntaje obtenido en cada elemento
/*
		if($porcentajename > 0){
			$porcentajename = (($porcentajename * $puntajemaximo) / 100) * $valorname;
		}
*/
		if($porcentajerfc > 0){
			$porcentajerfc = (($porcentajerfc * $puntajemaximo) / 100) * $valorrfc;
		}
		
		// Obtenemos el ponderaje total del registro maestro.
/*
		if($porcentajename == 1){
			$valortotal = 4;
		}else{
*/
			//$valortotal = $porcentajename + $porcentajerfc;
			$valortotal = $porcentajerfc;
/*
		}
*/
		/***** Fin función de ponderación *****/

		//verifica dentro de que rango se encuentra este registro y regreso el valor match, review o nomatch
		if($valortotal >= 4){
			$valor_match[0] = 'match';
		}else if($valortotal >= 1.5 && $valortotal < 4){
			$valor_match[0] = 'review';
		}else{
			$valor_match[0] = 'nomatch';
		}

		$valor_match[1] = /* $name2." -> ".$name1." = ".$porcentajename." - ".*/ $rfc2." -> ".$rfc1." = ".$porcentajerfc." => ".$valortotal;
		return $valor_match;
	}

	public static function encuentra_porcentaje($string1, $string2, $p_completa){
		// Elimino acentos o caracteres especiales de las cadenas.
		$cadena1 = self::sanear_string($string1);
		$cadena2 = self::sanear_string($string2);
		if($cadena1 == "" || $cadena2 == ""){
			// Obtengo el porcentaje de coincidencias entre las dos cadenas.
			$porcentaje = 0;
			// Le doy formato a dos decimales al porcentaje obtenido.
			$porcentaje = number_format($porcentaje, 2, '.', ',');
		}else{
			// Tokenizo las cadenas y tomo como separador el espacio.
			$tokcadena1 = explode(' ',$cadena1);
			$ttokens1 = count($tokcadena1);
			$tokcadena2 = explode(' ',$cadena2);
			$ttokens2 = count($tokcadena2);

			// Verifico si las cadenas son del mismo tamaño en numero de palabras.
			if(count($tokcadena1) == count($tokcadena2)){
				$uper = 0;
				// Verifico si la cadena 1 tiene palabras en solo mayusculas
				foreach ($tokcadena1 as $texto) {
					if(ctype_upper($texto)){
						$uper = 1;
					}
				}
				// Si la cadena 1 no tiene palabras en solo mayusculas la declaro como la principal, sino declaro a la segunda cadena.
				if($uper == 0){
					$cadenag = $cadena1;
					$cadenac = $tokcadena2;
				}else{
					$cadenag = $cadena2;
					$cadenac = $tokcadena1;
				}
			// Si la cadena 1 es mas grnade que la 2, la declaro como la cadena principal.
			}else if(count($tokcadena1) > count($tokcadena2)){
				$cadenag = $cadena1;
				$cadenac = $tokcadena2;
			// Si la cadena 2 es mas grnade que la 1, la declaro como la cadena principal.
			}else{
				$cadenag = $cadena2;
				$cadenac = $tokcadena1;
			}

			// Inicializo un contador de coincidencias
			$contadorCoincid = 0;
			// Verifico si existe cada palabra de la cadena secundaria dentro de la cadena principal.
			foreach ($cadenac as $param) {
				if($p_completa == 0){
					$param = '/'.$param.'/i';
				}else{
					$param = '/\b'.$param.'\b/i';
				}
				$coincid = preg_match($param, $cadenag, $coincidencias);
				// Si existe coincidencia, sumo 1 al contador de coincidencias
				if($coincid){
					$contadorCoincid += 1;
				}
			}

			if($contadorCoincid == 0){
				// Obtengo el porcentaje de coincidencias entre las dos cadenas.
				$porcentaje = 0;	
			}else{
				// Obtengo el porcentaje de coincidencias entre las dos cadenas.
				$porcentaje = ($contadorCoincid * 100) / (($ttokens1 + $ttokens2) / 2);	
			}
			// Le doy formato a dos decimales al porcentaje obtenido.
			$porcentaje = number_format($porcentaje, 2, '.', ',');
		}

		// Regreso el porcentaje obtenido
		return $porcentaje;
	}

	public static function encuentra_maestro($registro1, $registro2){
		// match en columna nombre.
		$name1 = $registro1->social_reason;
		$name2 = $registro2->social_reason;
		$registromaestro['social_reason'] = self::encuentra_cadena($name1, $name2);

		// match en columna address.
		$address1 = $registro1->country." ".$registro1->state." ".$registro1->city." ".$registro1->street." ".$registro1->no_int." ".$registro1->no_ext." ".$registro1->colony." ".$registro1->postal_code;
		$address2 = $registro2->country." ".$registro2->state." ".$registro2->city." ".$registro2->street." ".$registro2->no_int." ".$registro2->no_ext." ".$registro2->colony." ".$registro2->postal_code;
		$address = self::encuentra_cadena($address1, $address2);
		if($address == $address1){
			$registromaestro['country'] = $registro1->country;
			$registromaestro['state'] = $registro1->state;
			$registromaestro['city'] = $registro1->city;
			$registromaestro['street'] = $registro1->street;
			$registromaestro['no_int'] = $registro1->no_int;
			$registromaestro['no_ext'] = $registro1->no_ext;
			$registromaestro['colony'] = $registro1->colony;
			$registromaestro['postal_code'] = $registro1->postal_code;
		}else{
			$registromaestro['country'] = $registro2->country;
			$registromaestro['state'] = $registro2->state;
			$registromaestro['city'] = $registro2->city;
			$registromaestro['street'] = $registro2->street;
			$registromaestro['no_int'] = $registro2->no_int;
			$registromaestro['no_ext'] = $registro2->no_ext;
			$registromaestro['colony'] = $registro2->colony;
			$registromaestro['postal_code'] = $registro2->postal_code;
		}

		// match en columna rfc.
		$rfc1 = $registro1->rfc;
		$rfc2 = $registro2->rfc;
		$registromaestro['rfc'] = self::encuentra_cadena($rfc1, $rfc2);

		// match en columna telephone.
		$telephone1 = $registro1->telephone;
		$telephone2 = $registro2->telephone;
		$registromaestro['telephone'] = self::encuentra_cadena($telephone1, $telephone2);

		// match en columna mobile.
		$mobile1 = $registro1->mobile;
		$mobile2 = $registro2->mobile;
		$registromaestro['mobile'] = self::encuentra_cadena($mobile1, $mobile2);

		// match en columna email.
		$email1 = $registro1->email;
		$email2 = $registro2->email;
		$registromaestro['email'] = self::encuentra_cadena($email1, $email2);

		// Regreso el registro maestro
		return $registromaestro;
	}

	public static function encuentra_cadena($cadena1, $cadena2){
		$string1 = self::sanear_string($cadena1);
		$string2 = self::sanear_string($cadena2);
		
		$tokcadena1 = explode(' ',$string1);
		$tokcadena2 = explode(' ',$string2);

		if(count($tokcadena1) == count($tokcadena2)){
			$uper = 0;
			foreach ($tokcadena1 as $texto) {
				if(ctype_upper($texto)){
					$uper = 1;
				}
			}
			if($uper == 0){
				$cadenaoriginal = $cadena1;
			}else{
				$cadenaoriginal = $cadena2;
			}
		}else if(count($tokcadena1) > count($tokcadena2)){
			$cadenaoriginal = $cadena1;
		}else{
			$cadenaoriginal = $cadena2;
		}
		return $cadenaoriginal;
	}

	// Función para eliminar las diferencias por caracteres especiales y acentos.
	public static function sanear_string($string){
	    $string = trim($string);
	    $string = str_replace(
	        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
	        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
	        $string
	    );
	    $string = str_replace(
	        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
	        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
	        $string
	    );
	    $string = str_replace(
	        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
	        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
	        $string
	    );
	    $string = str_replace(
	        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
	        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
	        $string
	    );
	    $string = str_replace(
	        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
	        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
	        $string
	    );
	    $string = str_replace(
	        array('ñ', 'Ñ', 'ç', 'Ç'),
	        array('n', 'N', 'c', 'C'),
	        $string
	    );
	    $string = str_replace(
	        array("\\", "¨", "º", "-", "~",
	             "#", "@", "|", "!", "\"",
	             "·", "$", "%", "&", "/",
	             "(", ")", "?", "'", "¡",
	             "¿", "[", "^", "<code>", "]",
	             "+", "}", "{", "¨", "´",
	             ">", "< ", ";", ",", ":",
	             ".", "*", "  ", "   ", "    "),
	        '',
	        $string
	    );
	    return $string;
	}
}
