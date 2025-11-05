<?php
try{
$conn = new PDO ("mysql:host=localhost;dbname=pet2","root","");
$conn->setAttribute(PDO :: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e)  
{
      echo "Erro de conexão: " . $e -> getMessage();
      die();
}
?>