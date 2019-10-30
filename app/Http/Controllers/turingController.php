<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class turingController extends Controller
{
    public function maquina(Request $request){        
        // Transições
        $transicao = [];
        for ($i=1; $i <= sizeof($request->request) - 4; $i++) { 
            $flag = 'transicao'.$i;
            $flag = $request->$flag;
            $transicao[$i] = explode('-',$flag);
            $transicao[$i][0] = explode(',',$transicao[$i][0]);
            $transicao[$i][1] = explode(',',$transicao[$i][1]);
        }

        // Entrada
        $entrada = str_split($request->entrada);

        // Estado
        $estados = [];
        $estados += explode(',',$request->estados);
        $final = $request->finais;
        
        // Fita
        $fita = [];

        // dd($transicao, $estados, $entrada, $fita, $final);
        for ($i=1; $i <= sizeof($entrada); $i++) { 

            if($i == 1){
                // Coloca na fita quando $i == 0
                if($transicao[$i][0][1] == $entrada[$i-1]){
                    $fita[$i] = $transicao[$i][1][1];
                }
                // Pega o primeiro estado
                $flagEstado = $transicao[$i][1][0];
            } else {                
                foreach ($transicao as $key => $value) { 
                    // Testes
                    // if($i == 4 && $value[0][0] == $flagEstado){ 
                    //     dd($value, $flagEstado, $value[0][1], $entrada[$i-1]);
                    // }
                    if($value[0][0] == $flagEstado && $value[0][1] == $entrada[$i-1]){ 
                        
                        $fita[$i] = $value[1][1];
                        $flagEstado = $value[1][0];
                    }                     
                }
            }
        }
        dd($fita);
        return redirect("/")->with('success', $fita);
    }
}