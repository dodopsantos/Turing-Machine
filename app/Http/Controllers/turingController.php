<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class turingController extends Controller
{
    public function maquina(Request $request){                
        // dd($request);
        // Transições
        $transicao = [];
        for ($i=1; $i <= sizeof($request->request) - 4; $i++) { 
            $flag = 'transicao'.$i;
            $flag = $request->$flag;
            $transicao[$i] = explode('-',$flag);
        }        
        // Entrada
        $entrada = str_split($request->entrada);

        // Estado
        $estados = $request->estados;        
        $final = $request->finais;
        
        // Fita
        $fita = [];

        dd($transicao, $estados, $entrada, $fita, $final);
        for ($i=1; $i <= sizeof($entrada); $i++) { 

            if ($transicao[$i]) {
                
            }
            // $fita[$i] = 
        }
        
        $result = 'micael';
        return redirect("/")->with('success', $result);
    }
}