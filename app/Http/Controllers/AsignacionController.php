<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Asignacion;
use App\Models\Mision;

class AsignacionController extends Controller
{
     public function asignarNinja(Request $request){

		$respuesta = "";

    	$datos = $request->getContent();
    	$datos = json_decode($datos);

		if($datos){

			$asignacion = new Asignacion();

			$asignacion->ninja_id = $datos->ninja_id;
			$asignacion->mision_id = $datos->mision_id;

    		$mision = Mision::find($asignacion->mision_id);

			$mision->estado = 'En Curso';

			try{
				$asignacion->save();
				$mision->save();
				$respuesta = "OK";
			}catch(\Exception $e){
				$respuesta = $e->getMessage();
			}
		}else{
			$respuesta = "Datos Incorrectos.";
		}
		return response($respuesta);
    }
}
