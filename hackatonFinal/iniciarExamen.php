<?php
	require("datos_conexion.php");

	//if(isset($_POST['login'])){

		$nombreRegis = $_POST['nombre'];
		$claveRegis = $_POST['apass'];

		$conexion = mysqli_connect($bd_serv,$bd_usua,$bd_contra) or die("No se pudo autentificar con la Base de Datos. ");
		mysqli_select_db($conexion,$bd_nombre)  or die ("No se pudo conectar a la Base de Datos. ");

		$sentencia = "SELECT * FROM examen WHERE clave = '$claveRegis'";
		//$confirmar = mysqli_query($conexion,$sentencia);
		$resultado = $conexion->query($sentencia);

		if(mysqli_num_rows($resultado)>0){
			$sentencia = "INSERT INTO alumno (login, apass) VALUES ('$nombreRegis','$claveRegis')";
			$conexion->query($sentencia);

			echo '<script> window.location = "examen.php" </script>';
		}else{
			//echo "Datos incorrectos";
			echo '<script> alert ("No se encontro clave. ") </script>';
			echo'<script> window.location = "loginAlumno.html"</script>';
		}

?>
