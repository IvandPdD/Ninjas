<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ninja;

class NinjaController extends Controller
{
    public function altaNinja(Request $request){

    	$respuesta = "";

    	$datos = $request->getContent();
    	$datos = json_decode($datos);

    	if($datos){

    		$ninja = new Ninja();

    		$ninja->nombre = $datos->nombre;
    		$ninja->habilidades = $datos->habilidades;
    		$ninja->rango = $datos->rango;
    		$ninja->estado = $datos->estado;

    		try{
    			$ninja->save();

    			$respuesta = "OK";
    		}catch(\Exception $e){
    			$respuesta = $e->getMessage();
    		}

    	}else{
    		$respuesta = "Datos incorrectos";
    	}

    	return response($respuesta);
    }

    public function bajaNinja(Request $request, $id){

    	$respuesta = "";

    	$ninja = Ninja::find($id);

    	if($ninja){

    		$datos = $request->getContent();
    		$datos = json_decode($datos);

    		if($datos){

    			if(isset($datos->estado)){
					$ninja->estado = 'Retirado';
    			}
				
	    		try{
	    			$ninja->save();

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

    public function verNinja($id){

    	$ninja = Ninja::find($id);

    	if($ninja){

    		$misionesAsignadas = [];

    		foreach ($ninja->asignaciones as $asignacion) {
    			
    			$misionesAsignadas[] = [
    				"mision_id" => $asignacion->mision_id,
    				"fecha" => $asignacion->mision->created_at,
    				"estado" => $asignacion->mision->estado
    			];
    		}

    		$datosNinja = [
    			"id" => $ninja->id,
    			"habilidades" => $ninja->habilidades,
    			"rango" => $ninja->rango,
    			"estado" => $ninja->estado
    			"misionesAsignadas" => $misionesAsignadas
    		];

    		return response()->json($datosNinja);
    	}

    	return response("Ninja no encontrado");
    }

    public function listaNinjas(){

    	$ninjas = Ninja::all();

    	$resultado = [];

    	foreach ($ninjas as $ninja) {
    		
    		$resultado[] = [
    			"id" => $ninja->id,
    			"nombre" => $ninja->nombre,
    			"fecha_registro" => $ninja->created_at,
    			"rango" => $ninja->rango,
    			"estado" => $ninja->estado
    		];
    	}

    	return response()->json($resultado);
    }

    public function filtroNinja(Request $request){

    	$ninjaClass = Ninja::class;

    	if($request->request->get('nombre')){
    		$ninjaClass = $ninjaClass::where('nombre', 'like', '%' . $request->request->get('nombre') . '%');
    	}
    	if($request->request->get('estado')){
    		$ninjaClass = $ninjaClass::where('estado', $request->request->get('estado'));
    	}
    	
    	$ninjas = $ninjaClass->get();

    	$resultado = [];

    	foreach ($ninjas as $ninja) {

    		$resultado[] = [
    			"id" => $ninja->id,
    			"fecha_registro" => $ninja->created_at,
    			"nombre" => $ninja->nombre,
    			"estado" => $ninja->estado
    		];
    	}

    	return response()->json($resultado);
    }
}
