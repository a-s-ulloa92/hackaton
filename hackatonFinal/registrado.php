
<?php
	require("datos_conexion.php");
	$usuarioRegis = $_SESSION['usuario'];
	$contRegis = $_SESSION['contrasena'];
	$nombreRegis = $_SESSION['nombre'];

	$conexion = mysqli_connect($bd_serv,$bd_usua,$bd_contra) or die("No se pudo autentificar con la Base de Datos. ");
	mysqli_select_db($conexion,$bd_nombre)  or die ("No se pudo conectar a la Base de Datos. ");

	$confirmar = "SELECT * FROM maestro WHERE login = '$usuarioRegis'";
	$resultado = $conexion->query($confirmar);
	if(mysqli_num_rows($resultado) == 0){ // ddoble o un igual

		$sentencia = "INSERT INTO maestro (login, mpass) VALUES ('$usuarioRegis','$contRegis')";
		if(!mysqli_query($conexion,$sentencia)){
			die (" Error. No se pudo guardar el Registro. ");
		}else{
			echo "Registro guardado exitosamente. "; //Aqui iria el link
			echo '<script> window.location = "perfil.html" </script>';
		}
	}else{
		echo '<script> alert ("Usuario existente. ") </script>';
		echo '<script> window.location = "registrar.html" </script>';
	}


?>
