<?php

class ClienteRepository{


    public static function getUserById($id){

        $db=DB::connect();
        $query="SELECT * FROM clientes WHERE ID_Cliente = $id";
        $result = $mysql-> query($q);

        if($result && $row = $result->fetch_assoc()){
            return new Cliente($row['Nombre'], $row['Email'], $row['ID_Cliente']);

        }

        return null;
    }
}