<?php

namespace WHOOLLIEFOOD\MODEL;

use \WHOOLLIEFOOD\DB\Sql;

class ProductCategory{

    private $desName;

    public function setDesName($desName){
        $this->desName = $desName;
    }

    public function getDesName(){
        return $this->desName;
    }

    public function createProductCategory(){

        $sql = new Sql();

        if($this->getDesName() != ""){

            $sql->query("INSERT INTO tbProductsCategories(idCompany, desName) 
			VALUES (:DESNAME)", [
				":DESNAME"=>$this->getDesName(),
            ]);

        }
       
    }


    public function listAll(){

        $sql = new Sql();

        return json_encode($sql->select("SELECT * FROM tbProductsCategories"));

    }



}

?>