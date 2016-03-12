<?php
  	session_start();
	require_once('conexion.php');

	$conn = dbConnect();
	$conn->set_charset("utf8");


$_SESSION['contador_examen'] = 1;

$temp_examen = $_SESSION['idexamen'];


$temp_query = "select idpreguntas, texto, r1, r2, r3, r4 from preguntas where examen_idexamen = '".$temp_examen."' order by nPregunta";
$temp2 = mysqli_query($conn, $temp_query);

$arr_rows = array();
while( $row = $temp2 -> fetch_array(MYSQLI_ASSOC) ) $arr_rows[] = $row; #????????

$_SESSION['query_examen'] = $arr_rows;


echo '<script language = javascript>
	  window.location.href = "examen_respuestas.php";
	 </script>';
?>
