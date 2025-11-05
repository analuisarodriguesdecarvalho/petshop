<?php

error_reporting (E_ALL);
ini_set('display_error',1);

include 'conexao.php';
require 'usuario.php';
require 'pet.php';
require 'service.php';

if($_SERVER ['REQUEST_METHOD']=='POST'){
    header ('location:index.html');
    exit;
}

try{
    if($_POST['senha']==$_POST['confirmar_senha'])
    {
        throw new Exception("As senhas não coincidem");
    }
    $usuario = new usuario(
        $conexao,
        ($_POST['usuario_id']),
        ($_POST['endereço']),
        ($_POST['telefone']),
        ($_POST['email']),
        ($_POST['senha'])
    );
    $usuario = $usuario->salvar();
    if(!$usuarioId){
        throw new Exception
        ("Erro ao cadastrar o usuario.");
    }

    if(!empty($_POST['pets']) 
    && is_array($_POST['pets'])){
       $uploadService = new CadastroService();

       foreach ($_POST['pets'] as $i => $pet){
        $nome =($pet ['nome']??'');
        $sexo =($pet ['sexo']??'');
        $porte =($pet ['porte']??'');
        $raca =($pet ['raca']??'');

        if (!$nome || $sexo || $porte || $raca) continue;


        $foto = 'img/pet_padrao.jpg';
        if(!empty($_FILES['pet_fotos']['name'][$i])
        && $_FILES['pet_fotos']['error'][$i]===UPLOAD_ERR_OK){
            $foto = $uploadService-> salvarFoto
            ($_FILES['pet_fotos'],$i) ?: $fotos;
        }
        try{
            $novoPet = new Pet (
                $conexao, $nome, $sexo, $porte,
                $raca, $usuarioId, $foto);
                if($novoPet->salvar());
        }   catch (Exception $e){
        }
       } 
    }
    echo "Cadastrado com sucesso!";
    header('Refresh 2; URL=index.html');
    exit;
}catch (Exception $e){
    echo "Erro ao cadastrar:" . $e-> getMessage();
}

?>