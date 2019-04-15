<?php

namespace WHOOLLIEFOOD\MODEL;

use \WHOOLLIEFOOD\DB\Sql;

class Board{

	private $idBoard;
    private $idCompany;
    private $qtPlaces;
    private $isActive;
	private $isDeleted;

    public function __construct(){

		$this->idCompany = $_SESSION['User']['idCompany'];

    }
    
	public private getIdBoard() {
		return $this->$idBoard;
	}

	public void setIdBoard($idBoard) {
		$this->idBoard = $idBoard;
	}

	public private getIdCompany() {
		return $this->idCompany;
	}

	public void setIdCompany($idCompany) {
		$this->idCompany = $idCompany;
	}

	public private getQtPlaces() {
		return $this->qtPlaces;
	}

	public void setQtPlaces($qtPlaces) {
		$this->qtPlaces = $qtPlaces;
	}

	public private getIsActive() {
		return $this->isActive;
	}

	public void setIsActive($isActive) {
		$this->isActive = $isActive;
	}

	public private getIsDeleted() {
		return $this->isDeleted;
	}

	public void setIsDeleted($isDeleted) {
		$this->isDeleted = $isDeleted;
	}



	public function listAll(){

		$sql = new Sql();

		return json_encode($sql->select("
			SELECT * 
			FROM tbBoards
			WHERE 
			isDeleted = :ISDELETED AND
			idCompany = :IDCOMPANY
			ORDER BY idBoard ASC", [
				":ISDELETED" => 0,
				":IDCOMPANY" => $this->getIdCompany()
			]));

	}

	public function createBoard(){

		$sql = new Sql();
		
		if($this->getQtdPlaces() != "" ){

           
			$sql->query("INSERT INTO tbBoards(idBoard, isActive,  idCompany, qtPlaces) 
						VALUES (:IDBOARDS, :ISACTIVE, :IDCOMPANY, :QTDPLACES)", [
					":IDBOARD"=>$this->getIdBoard(),
					":ISACTIVE"=>$this->getIsActive(),
					":IDCOMPANY"=>$this->getIdCompany(),
					":QTDPLACES"=>$this->getQtdPlaces()
				]);
		}

	}

	public function editBoard($id) {

		$sql = new Sql();
		
		if($this->getIdCompany() != "" && $this->getQtdPlaces() != ""){

			$sql->query("UPDATE tbBoard SET  
							isActive = :ISACTIVE, 
							idCompany = :IDCOMPANY,
							idBoardCategory = :QTDPLACES
						 WHERE
                         idBoard = :IDBOARD", [
				
					":ISACTIVE"=>$this->getIsActive(),
					":IDCOMPANY"=>$this->getIdCompany(),
					":QTDPLACES"=>$this->getQtdPlaces(),
					":IDBOARD"=>$id
				]);
		}

	}

	public function deleteBoard($idBoard){

        $sql = new Sql();

        return $sql->query("UPDATE tbBoards SET isDeleted = :ISDELETED
                WHERE idCompany = :IDCOMPANY AND idBoard = :IDBOARD", [
                ":ISDELETED"=>$this->getIsDeleted(),
                ":IDCOMPANY"=>$this->getIdCompany(),
                ":IDBOARD"=>$idBoard                       
            ]);
    
	} 
	
	public function setAllPropertiesById($idBoard) {

		$sql = new Sql();

        $res = $sql->select("SELECT * FROM tbBoards 
                WHERE idCompany = :IDCOMPANY AND 
				idBoard = :IDBOARD", [
                ":IDCOMPANY"=>$this->getIdCompany(),
                ":IDBOARD"=>$idBoard                       
			])[0];
		
		$this->setIdBoard($idBoard);
		$this->setIsActive($res['isActive']);
		$this->setQtdPlaces($res['qtdPlaces']);
		


	}

}

?>