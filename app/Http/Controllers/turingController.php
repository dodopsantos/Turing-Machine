<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class turingController extends Controller
{
    public function maquina(Request $request){
        // Alfabeto
        $alfabeto = explode(',',$request->alfabeto);

        // Entrada
        $entrada = str_split($request->entrada);

        // Estados
        $estados = explode(',',$request->estados);

        // final
        $final = $request->finais;
        
        // Validador da entrada
        foreach ($entrada as $chave => $valor) {
            $ok = 0;
            foreach ($alfabeto as $cha => $val) {
                if($valor == $val){
                    $ok = 1;
                }
            }
            if ($ok == 0){
                return redirect("/")->with('error', 'Verifique se a entrada corresponde ao alfabeto');
            }
        }

        // Transições
        $transicao = [];
        for ($i=1; $i <= sizeof($request->request) - 5; $i++) {
            $flag = 'transicao'.$i;
            $flag = $request->$flag;
            $transicao[$i] = explode('-',$flag);
            $transicao[$i][0] = explode(',',$transicao[$i][0]);
            $transicao[$i][1] = explode(',',$transicao[$i][1]);            
        }

        // Fita
        $fita = [];

        // Máquina rodando
        for ($i=1; $i <= sizeof($entrada); $i++) { 
            // Flag de erros
            $flagError = 1;
            if($i == 1){
                // Coloca na fita quando for a primeira interação                
                if($transicao[$i][0][1] == $entrada[$i-1]){
                    $fita[$i] = $transicao[$i][1][1];
                }
                // Pega o primeiro estado
                $flagEstado = $transicao[$i][1][0];

            } else {
                // Segunda em diante
                foreach ($transicao as $key => $value) {   
                    // Verifica se a transição corresponde ao estado e a entrada
                    if($value[0][0] == $flagEstado && $value[0][1] == $entrada[$i-1]){
                        // Substitui na fita
                        $fita[$i] = $value[1][1];
                        // Pega a próxima transição
                        $flagEstado = $value[1][0];

                        if($value[2] == 'L'){
                            // Volta uma casa da fita, caso encontre o LEFT
                            $i--;
                        }
                        // Ciclo é finalizado sem erro
                        $flagError = 0;
                    }
                }                
                if($flagError == 1){
                    // Se o ciclo não foir finalizado por algum motivo, redireciona para a view com uma mensagem de erro
                    return redirect("/")->with('error', 'Algo deu errado!');
                }
            }
        }
        // Sintetizando a mensagem
        $msg = '';
        foreach ($entrada as $y => $v) {
            $msg .= $v;
        }
        $mensagem = 'Entrada: '.$msg.' <----> Saida : ';
        foreach ($fita as $key => $value) {
            $mensagem .= $value;
        }        
        // Retorna a fita finalizada
        return redirect("/")->with('success', $mensagem);
    }
}