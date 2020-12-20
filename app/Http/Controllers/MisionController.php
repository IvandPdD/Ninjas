<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mision;

class MisionController extends Controller
{
    public function realizarEncargo(Request $request){

    	$respuesta = "";

    	$datos = $request->getContent();
    	$datos = json_decode($datos);

    	if($datos){

    		$mision = new Mision();

    		$mision->cliente_id = $datos->cliente_id;
    		$mision->descripcion = $datos->descripcion;
    		$mision->ninjas_estimados = $datos->ninjas_estimados;
    		$mision->urgente = $datos->urgente;
    		$mision->estado = $datos->estado;
    		$mision->pago = $datos->pago;
    		$mision->fecha_finalizacion = $datos->fecha_finalizacion;

    		try{
    			$mision->save();

    			$respuesta = "OK";
    		}catch(\Exception $e){
    			$respuesta = $e->getMessage();
    		}

    	}else{
    		$respuesta = "Datos incorrectos";
    	}

    	return response($respuesta);
    }

    public function editarMision(Request $request, $id){

    	$respuesta = "";

    	$mision = Mision::find($id);

    	if($mision){

    		$datos = $request->getContent();
    		$datos = json_decode($datos);

    		if($datos){

    			if(isset($datos->estado)){
					$mision->descripcion = $datos->descripcion;
    			}
				if(isset($datos->ninjas_estimados)){
					$mision->ninjas_estimados = $datos->ninjas_estimados;
    			}
				if(isset($datos->urgente)){
					$mision->urgente = $datos->urgente;
    			}
				if(isset($datos->estado)){
					$mision->estado = $datos->estado;
    			}
				if(isset($datos->pago)){
					$mision->pago = $datos->pago;
    			}
				if(isset($datos->fecha_finalizacion)){
					$mision->fecha_finalizacion = $datos->fecha_finalizacion;
    			}
				
	    		try{
	    			$mision->save();

	    			$respuesta = "OK";
	    		}catch(\Exception $e){
	    			$respuesta = $e->getMessage();
	    		}

    		}else{
    			$respuesta = "Datos incorrectos";
    		}

    	}else{
    		$response = "No se ha encontrado el ninja";
    	}

    	return response($respuesta);
    }

    public function listaMisiones(){

    	$misiones = Mision::all();

    	$resultado = [];

    	foreach ($misiones as $mision) {
    		
    		$resultado[] = [
    			"id" => $mision->id,
    			"fecha_registro" => $mision->created_at,
    			"prioridad" => $mision->urgente,
    			"estado" => $mision->estado,
    			"codigo_cliente" => $mision->cliente_id
    		];
    	}

    	return response()->json($resultado);
    }

    public function verMision($id){

    	$mision = Mision::find($id);

    	if($mision){

    		$ninjasAsignados = [];

    		foreach ($mision->asignaciones as $asignacion) {
    			
    			$ninjasAsignados[] = [
    				"ninja_id" => $asignacion->ninja_id,
    				"ninja_nombre" => $asignacion->ninja->nombre
    			];
    		}

    		$datosMision = [
    			"id" => $mision->id,
    			"cliente_id" => $mision->cliente_id,
    			"descripcion" => $mision->descripcion,
    			"ninjas_estimados" => $mision->ninjas_estimados,
    			"urgente" => $mision->urgente,
    			"estado" => $mision->estado,
    			"pago" => $mision->pago,
    			"ninjas" => $ninjasAsignados
    		];

    		return response()->json($datosMision);
    	}

    	return response("Mision no encontrada");
    }

    public function filtroMision(){

    }
    
}
