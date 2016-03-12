<?php
 	session_start();
	require_once('../conexion.php');

	$conn = dbConnect();
	$conn->set_charset("utf8");
// CONTROL DE EVENTOS CLICK EN BOTON GUARDAR


#Parte que agrega una pregunta
if(isset($_POST['valida'])){

	#Se debe llenar el campo de pregunta y la primera respuesta
	if(!empty($_POST['pregunta']) && !empty($_POST['resp1'])){

		#Contador del numero de preguntas
		$_SESSION['contador'] += 1;

		#Agarra respuestas de los campos
		$tresp1 = $_POST['resp1'];
		$tresp2 = $_POST['resp2'];
		$tresp3 = $_POST['resp3'];
		$tresp4 = $_POST['resp4'];
		$tpreg = $_POST['pregunta'];
		$temp = $_SESSION['idexamen'];
		$count = $_SESSION['contador'];


		#Inserta pregunta en la base de datos
		$cade = "insert into preguntas(r1,r2, r3, r4, texto, examen_idexamen, npregunta)
		values('".$tresp1."','".$tresp2."','".$tresp3."','".$tresp4."','".$tpreg."','".$temp."','".$count."')";




		$res = mysqli_query($conn, $cade);
		//$nreg = $res->num_rows;  //Error

		if($res) {
			// el registro fue ingresado a la base de datos con exito
			echo '<script language = javascript>
				alert("Pregunta guardada")
				window.location.href = "preguntas.php";
				</script>';
		}
		else{
			echo '<script language = javascript>
				alert("Ocurrió un error y los datos no fueron registrados")
				self.location = "preguntas.php"
				</script>';
		}
	}

 }

 #Terminar examen
if(isset($_POST['valida2'])){
     echo '<script language = javascript>
	 var a = confirm("Seguro que desea terminar?");
	 if (a==true){
		window.location.href = "examen.php";

	 }
	 else{

	 }
	 </script>';
} 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Interfaz maestro</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href="css/overwrite.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  </head>
  <body>
	<div class="">
		<div class="row">
			<div class="col-md-2">
				<div class="menu">
					<div class="logo">
						<a href="perfil.html"><h1>MAESTROS</h1></a>
					</div>
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<ul class="nav nav-pills nav-stacked" >
							<li role="presentation"><a href="perfil.html">INICIO</a></li>
							<li role="presentation"><a href="examen.php">CREAR EXAMEN</a></li>
							<li role="presentation"><a href="examenes.html">EXAMENES</a></li>
							<li role="presentation"><a href="ppal.html">SALIR</a></li>
						</ul>
					</div>
					<div class="footer">
						All right reserved 2015<br><hr>Design by.<a target="_blank" href="http://bootstraptaste.com/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">bootstraptaste</a>
					</div>
				</div>
			</div>

      <section id="graphics">
        <div class="container">
        	<div class="center">
            <div class="container"></div>
            <form action="question">
              <li>Pregunta: </li><textarea name="myTextBox" cols="50" rows="5">Introduce la pregunta...</textarea>
            </form>
            <form>
              <li>Respuesta 1: </li><textarea name="a" cols="50" rows="5">Introduce respuesta...</textarea><br>
              <li>Respuesta 2: </li><textarea name="e" cols="50" rows="5">Introduce la respuesta...</textarea><br>
              <li>Respuesta 3: </li><textarea name="i" cols="50" rows="5">Introduce la respuesta...</textarea><br>
              <li>Respuesta 4: </li><textarea name="o" cols="50" rows="5">Introduce la respuesta...</textarea>
            </form>
            <button type="submit">Subir</button>
            <button type="submit">Terminar</button>
          </div>
				</div>
      </section>
		</div>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/fliplightbox.min.js"></script>
	<script type="text/javascript">$('#graphics').flipLightBox()</script>
  </body>
</html>
