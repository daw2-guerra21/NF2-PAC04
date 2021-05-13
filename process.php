<?php

require("class.pdofactory.php");
require("class.Buscador.php");

// $errors = [];
// $data = [];

// if (empty($_POST['buscador'])) {
//     $errors['buscador'] = 'Text is required.';
// }



if( isset($_POST['buscador']) && !empty($_POST['buscador']) ){
    // echo $_POST['buscador'];

    $strDSN = "mysql:dbname=uf4;host=localhost;port=3306";
    $objPDO = PDOFactory::GetPDO($strDSN, "root", "root", array());
    $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $classBuscador = new Buscador($objPDO);
    $paraula = $_POST['buscador'];
    $resultados = [];
    $resultados = $classBuscador->getLastEntries2($paraula);

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($resultados);

    // $relleno = "";

    // foreach($resultados as $resultado){
    //     $relleno.= "<tr><td>" . $resultado . "</td></tr>";
    // }

    // echo $relleno;

}else{
    // $errors['buscador'] = 'Text is required.';
    echo "Se requiere texto";
}

// if (!empty($errors)) {
//     $data['success'] = false;
//     $data['errors'] = $errors;
// } else {
//     $data['success'] = true;
//     $data['message'] = 'Success!';
// }

// echo json_encode($data);

?>