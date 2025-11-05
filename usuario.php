<?php
class usuario {
private $conn;
private $usuario_id;
public $nome;
public $endereço;
public $telefone;
protected $email;
private $senhaHash;

public function __construct($conn, $nome, $endereço, $telefone, $email, $senha){
      $this->conn = $conn;
      $this->nome = trim($nome);
      $this->endereço = $endereço;
      $this->telefone  = $telefone;

    $email = strtolower(trim($email));
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        throw new Exception("E-mail inválido");
    }
$this->email = ($email);
$this->senhaHash = password_hash($senha, PASSWORD_DEFAULT);
}

    public function getId(){
        return $this->usuario_id;
    }

public function salvar (){
    $sql = "INSERT INTO  usuarios(nome, endereço, telefone, email, senha) VALUES (?,?,?,?,?)";
    $stmt = $this-> conn-> prepare ($sql);
    if ($stmt-> execute ([$this-> nome, $this-> endereço, $this-> telefone, $this-> email, $this-> senhaHash ])){

        $this-> usuario_id = $this-> conn-> lasatInsertId();
        return $this-> usuario_id;
    } else {
         throw new Exception("Erro ao cadastrar usuário.");

    }
  }
}
?>