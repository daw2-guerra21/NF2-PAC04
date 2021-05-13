<?php

require("class.pdofactory.php");
require("class.Insertar.php");

if( isset($_POST['buscador']) && !empty($_POST['buscador']) ){

    $strDSN = "mysql:dbname=uf4;host=localhost;port=3306";
    $objPDO = PDOFactory::GetPDO($strDSN, "root", "root", array());
    $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $classBuscador = new Buscador($objPDO);
    $paraula = $_POST['buscador'];
    $resultados = [];
    $resultados = $classBuscador->getLastEntries2($paraula);

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($resultados);

}else{
    echo "Se requiere texto";
}

?>