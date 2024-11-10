<?php
require_once __DIR__ . "/Nutricionista.php";

class Cardapio {
    
private $id;
private $nutricionista_id;
private $dataC;
private $periodo;
private $descricao;

public function __construct($id = null, $nutricionista_id = null, $dataC = null, $periodo = null, $descricao = null) {
    $this->id = $id;
    $this->nutricionista_id = $nutricionista_id;
    $this->dataC = $dataC;
    $this->periodo = $periodo;
    $this->descricao = $descricao;
}

public function getId() {
    return $this->id;
}

public function setId($id) {
    $this->id = $id;
}

public function getNutricionistaId() {
    return $this->nutricionista_id;
}

public function setNutricionistaId($nutricionista_id) {
    $this->nutricionista_id = $nutricionista_id;
}

public function getDataC() {
    return $this->dataC;
}

public function setDataC($dataC) {
    $this->dataC = $dataC;
}

public function getPeriodo() {
    return $this->periodo;
}

public function setPeriodo($periodo) {
    $this->periodo = $periodo;
}

public function getDescricao() {
    return $this->descricao;
}

public function setDescricao($descricao) {
    $this->descricao = $descricao;
}
}
?>