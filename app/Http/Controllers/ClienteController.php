<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cliente;

class ClienteController extends Controller
{
    public function altaCliente(Request $request){

    	$respuesta = "";

    	$datos = $request->getContent();
    	$datos = json_decode($datos);

    	if($datos){

    		$cliente = new Cliente();

    		$cliente->codigo_cliente = $datos->codigo_cliente;
    		$cliente->nombre = $datos->nombre;
    		$cliente->vip = $datos->vip;

    		try{
    			$cliente->save();

    			$respuesta = "OK";
    		}catch(\Exception $e){
    			$respuesta = $e->getMessage();
    		}

    	}else{
    		$respuesta = "Datos incorrectos";
    	}

    	return response($respuesta);
    }

    public function editarCliente(Request $request, $id){

    	$respuesta = "";

    	$cliente = Cliente::find($id);

    	if($cliente){

    		$datos = $request->getContent();
    		$datos = json_decode($datos);

    		if($datos){

    			if(isset($datos->codigo_cliente)){
					$cliente->codigo_cliente = $datos->codigo_cliente;
    			}
				if(isset($datos->vip)){
					$cliente->vip = $datos->vip;
    			}
				
	    		try{
	    			$cliente->save();

	    			$respuesta = "OK";
	    		}catch(\Exception $e){
	    			$respuesta = $e->getMessage();
	    		}

    		}else{
    			$respuesta = "Datos incorrectos";
    		}

    	}else{
    		$response = "No se ha encontrado el cliente";
    	}

    	return response($respuesta);
    }

    public function verCliente($id){

    	$cliente = Cliente::find($id);

    	if($cliente){

    		$misiones = [];

    		foreach ($cliente->misiones as $mision) {
    			
    			$misiones[] = [
    				"id" => $mision->id,
    				"fecha" => $mision->created_at,
    				"urgente" => $mision->urgente,
    				"estado" => $mision->estado,
    				"pago" => $mision->pago
    			];
    		}

    		$datosCliente = [
    			"id" => $cliente->id,
    			"codigo_cliente" => $cliente->codigo_cliente,
    			"nombre" => $cliente->nombre,
    			"vip" => $cliente->vip,
    			"misiones" => $misiones
    		];

    		return response()->json($datosCliente);
    	}

    	return response("Cliente no encontrado");
    }

    public function listaClientes(){

    	$clientes = Cliente::all();

    	$resultado = [];

    	foreach ($clientes as $cliente) {
    		
    		$resultado[] = [
    			"id" => $cliente->id,
    			"codigo_cliente" => $cliente->codigo_cliente,
    			"vip" => $cliente->vip,
    			"fecha_registro" => $cliente->created_at
    		];
    	}

    	return response()->json($resultado);
    }
}
