<?php 
function enviarArquivo($error, $size, $name, $tmp_name){
    if($error){
        echo "Falha ao enviar o arquivo. $error";
    }
    if($size > 2097152){
        die("Arquivo muito grande. Max: 2MB");
    }
    $pasta =  "upload/";
    $nomeDoArquivo = $name;
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    if($extensao != "jpg" && $extensao != "png"){
        die("Tipo de arquivo não aceito.");
    }
    $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
    $deu_certo = move_uploaded_file($tmp_name, $path);
    if($deu_certo){
        return $path;
    }
    else{
        return false;
    }
}
?>