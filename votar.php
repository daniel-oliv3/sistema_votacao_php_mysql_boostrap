<?php
session_start();
include_once("conexao.php");

//Verificar se esta vindo a variavel id pela URL
if(isset($_GET['id'])){
	if(isset($_COOKIE['voto_cont'])){
		$_SESSION['msg'] = "<div class='alert alert-danger'>Você já votou!</div>";
		header("Location: index.php");

	}else{
		setcookie('voto_cont', $_SERVER['REMOTE_ADDR'], time() + 10); //tempo para votar no mesmo produto	
		$result_produto = "UPDATE produtos SET qtd_voto=qtd_voto + 1 WHERE id='".$_GET['id']."'";

		$resultado_produto = mysqli_query($conn, $result_produto);

		if(mysqli_affected_rows($conn)){
			$_SESSION['msg'] = "<div class='alert alert-success'>Voto recebido com sucesso!</div>";
			header("Location: index.php");
		}else{
			$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao votar!</div>";
			header("Location: index.php");
		}
	}
}









?>