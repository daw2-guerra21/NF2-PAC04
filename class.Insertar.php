<?php

require("abstract.databoundobject.php");
date_default_timezone_set('Europe/Madrid');

class Buscador extends DataBoundObject{
    protected $Paraula;
    protected $Total;
    protected $LastVisit;

    protected function DefineTableName(){
        return("buscador");
    }

    protected function DefineRelationMap(){
        return(array(
            "id" => "ID",
            "paraula" => "Paraula",
            "total" => "Total",
            "lastvisit" => "LastVisit"
        ));
    }

    public function setNewEntry($word){
        $date = date('Y-m-d H:i:s');
        // echo $date;
        // echo $this->getID($word);
        $this->setParaula($word)->setTotal(1)->setLastVisit($date)->Save();
    }

    public function updateEntries($word){
        $str = $this->objPDO->prepare("SELECT total from buscador WHERE paraula='$word'");
        $str->execute();
        $listado = $str->fetch(PDO::FETCH_ASSOC);

        if(isset($listado['total'])){
            $total = $listado['total'] + 1;
            $str = $this->objPDO->prepare("UPDATE buscador SET total = $total WHERE paraula='$word'");
            $str->execute();
        }
    }

    public function updateTime($word){
        $str = $this->objPDO->prepare("SELECT lastvisit from buscador WHERE paraula='$word'");
        $str->execute();
        $listado = $str->fetch(PDO::FETCH_ASSOC);

        if(isset($listado['lastvisit'])){
            $dateUpdate = date('Y-m-d H:i:s');
            echo $dateUpdate;
            $str = $this->objPDO->prepare("UPDATE buscador SET lastvisit = '$dateUpdate' WHERE paraula='$word'");
            $str->execute();
        }
    }

    public function getLastEntries($word){
        $str = $this->objPDO->prepare("SELECT paraula FROM buscador WHERE paraula LIKE \"$word%\" ORDER BY 'total' LIMIT 5");
        $str->execute();

        if($str->rowCount() == 0){
            if(isset($word)){
                $this->setNewEntry($word);
            }
            exit;

        // }else if($str->rowCount() == 1){
        //     $listado = $str->fetch(PDO::FETCH_ASSOC);
        //     $paraula = $listado;
        //     $paraulaArray = array();

        //     if(isset($paraula['paraula'])){
        //         $paraulaArray[] = $paraula['paraula'];
        //         return $paraulaArray;
        //     }
        //     exit;

        }else{
            $this->updateEntries($word);
            $listado = $str->fetch(PDO::FETCH_ASSOC);

            $paraulaArray = [];
            
            if(isset($listado)){
                foreach($listado as $pal){
                    if(isset($pal['paraula'])){
                        $paraulaArray[] = $pal['paraula'];
                    }
                }
                return $paraulaArray;
            }
            exit;
        }
    }

    public function getLastEntries2($word){
        $str = $this->objPDO->prepare("SELECT paraula from buscador WHERE paraula LIKE \"$word%\" ORDER BY 'total' LIMIT 5");
        $str->execute();

        if($str->rowCount() == 0){
            if(isset($word)){
                $this->setNewEntry($word);
            }
            exit;
        } 
        
        if($str->rowCount() == 1){
            $this->updateEntries($word);
            $this->updateTime($word);
            $listado = $str->fetch(PDO::FETCH_ASSOC);
            $paraula = $listado;
            $paraulaArray = array();

            if(isset($paraula)){
                $paraulaArray[] = array('id' => $paraula['id'], 'paraula' => $paraula['paraula'], 'total' => $paraula['total'], 'lastvisit' => $paraula['lastvisit']);
                return $paraulaArray;
            }
            exit;

        }else{
            $this->updateEntries($word);
            $this->updateTime($word);
            $listado = $str->fetchAll(PDO::FETCH_ASSOC);

            $paraulaArray = array();
            
            if(isset($listado)){
                foreach($listado as $pal){
                    if(isset($pal['paraula'])){
                        $paraulaArray[] = array('id' => $pal['id'], 'paraula' => $pal['paraula'], 'total' => $pal['total'], 'lastvisit' => $pal['lastvisit']);
                    }
                }
                return $paraulaArray;
            }
            exit;
        }
    }
}

?>