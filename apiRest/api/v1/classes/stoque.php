<?php 
use PDO;

class Estoque{
    public function mostrar(){
       //Conexão com a BD
        $conn = new PDO("mysql:host=localhost;dbname=filial","root","");
        //Query String 
        $sql = "SELECT * FROM stoque ORDER BY id DESC";
        $sql = $conn->prepare($sql);
        $sql->execute();
        
        //Pegando os dados da Consulta 
        $res = array();
        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                $res[] = $row;
        }
        if(!$res){
          throw new Exception ("Nenhum Produto no estoque");
        }
        return $res;
    }
}