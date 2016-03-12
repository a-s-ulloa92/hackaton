<?php
	require("datos_conexion.php");

	//if(isset($_POST['login'])){

		$usuarioRegis = $_POST['user'];
		$contRegis = $_POST['mpass'];
		$_SESSION['id'] = $_POST['login'];

		$conexion = mysqli_connect($bd_serv,$bd_usua,$bd_contra) or die("No se pudo autentificar con la Base de Datos. ");
		mysqli_select_db($conexion,$bd_nombre)  or die ("No se pudo conectar a la Base de Datos. ");

		$sentencia = "SELECT idmaestro FROM maestro WHERE login = '$usuarioRegis' AND  mpass = '$contRegis'";
		//$confirmar = mysqli_query($conexion,$sentencia);
		$resultado = mysqli_query($conexion, $sentencia);
		$row = $resultado -> fetch_array(MYSQLI_ASSOC);



		if(mysqli_num_rows($resultado)>0){
			//echo "Bienvenido";
			echo '<script> window.location = "perfil.html" </script>';
		}else{
			//echo "Datos incorrectos";
			echo '<script> alert ("Usuario o contraseña incorrectos. ") </script>';
			echo'<script> window.location = "loginMaestro.html"</script>';
		}

?>
