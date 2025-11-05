<?php
class Pet{
private $conn;
private $usuario_id;
public $nome;
public $sexo;
public $porte;
public $raça;
public $foto;

public function __construct($conn, $nome, $sexo, $porte, $raça, $usuario_id, $foto =null){
    $this->conn = $conn;
    $this->nome = $nome;
    $this->sexo = $sexo;
    $this->porte = $porte;
    $this->raça = $raça;
    $this->usuario_id = $usuario_id;
    $this->foto = $foto;    
}
public function salvar(){
$sql = "INSERT INTO pets (nome,sexo,porte,raça,usuario_id,foto) VALUES(?,?,?,?,?,?)";
$stmt= $this-> conn-> prepare($sql);
if($stmt-> execute([$this-> nome,$this-> sexo,$this-> raça,$this-> usuario_id,$this-> foto  ])) 
{
$this-> usuario_id = $this-> conn-> lastInsertId();
return $this-> usuario_id;
}
else {
throw new Exception("erro ao salvar seu pet");
}
}
}

?>