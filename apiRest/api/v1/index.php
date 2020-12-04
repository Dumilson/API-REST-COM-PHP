<?php

use FFI\Exception;

header('Content-Type:application/json charset=utf-8');
require_once 'classes/stoque.php';
class Rest{
    public static function open($requisicao){
        //Pegando a Url e transformando em array
        $url = explode('/',$requisicao['url']);
        //convertendo para maiscula o primeiro caractere da Url , que será a nossa classe
        $class = ucfirst($url[0]);
        //Retirando o primeiro elemento do Array (Neste caso a classe)
        array_shift($url);
        //Pegando o primeiro elemento do  array que será o metodo (Era o segundo ficou primeiro porque tiramos o primeiro elemento do array que era a nossa classe)
        $metodo = $url[0];
        //Retirando o primeiro elemento do Array (Neste caso o Método)
        array_shift($url);
         //vai armazenar todos os nossos parametros
        $parametros = array();
        $parametros = $url;
        try{
            //Verifica se a classe existe
            if(class_exists($class)){
                //Verifica se a o metod  existe nesta classe
                if(method_exists($class,$metodo)){
                    $retorno = call_user_func_array(array(new $class, $metodo),$parametros);
                    return json_encode(array('status'=>'sucesso', 'dados'=>$retorno));
                }else{
                    return json_encode(array('status' =>'erro','dados'=>'Metodo Inexistente'));
                }
            }else{
                return json_encode(array('status' =>'erro','dados'=>'Classe Inexistente'));
            }
        }catch(Exception $e){
            return json_encode(array('status' =>'erro','dados'=>$e->getMessage()));
        }
    }
} 
//Instanciando a Classe Rest
if(isset($_REQUEST)){
     echo Rest::open($_REQUEST);
 }