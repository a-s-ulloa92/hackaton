<?php
 	session_start();
	require_once('conexion.php');

	$conn = dbConnect();
	$conn->set_charset("utf8");
// CONTROL DE EVENTOS CLICK EN BOTON GUARDAR


 $_SESSION['idexamen'] = "";
 $_SESSION['contador'] = 0;

echo '<script>alert("hOla1");</script>';
if(isset($_POST['subir'])){
echo '<script>alert("hOla");</script>';
	#No debe haber campos vacios
	if(!empty($_POST['clave']) && !empty($_POST['fecha1']) && !empty($_POST['fecha2'])){
		#Guarda los datos de los campos en variables
		$tclave = $_POST['clave'];
		$tfechaini = $_POST['fecha1'];
		$tfechafin = $_POST['fecha2'];
		$test = $_SESSION['id'];	#Guarda el id del profesor (variable de sesion)
    echo '<script>alert("hla");</script>';
		#Busca el examen con la clave dada. Si ya existe, da error; si no, lo incluye en la BD
		$cade = "select * from examen where clave = '".$tclave."'";
		$res = mysqli_query($conn, $cade);
		if ($res && $res->num_rows){
			echo '<script language = javascript>
				alert("Ya existe un examen con esa clave.")
				self.location = "examen.php"
				</script>';
		}
		else{

			#La fecha de inicio no debe ser despues de la de fin
			if ($tfechaini > $tfechafin){
				echo '<script language = javascript>
					alert("Fechas invalidas")
					self.location = "examen.php"
					</script>';
			}
			else{
				#Inserta los datos del examen en la BD
				$cade = "insert into examen(maestro_idmaestro,clave,fechaini, fechafin)
				values('".$test."','".$tclave."','".$tfechaini."','".$tfechafin."')";



				$res = mysqli_query($conn, $cade);
				//$nreg = $res->num_rows;  //Error

				if($res) {
					// el registro fue ingresado a la base de datos con exito

					$cade = "select last_insert_id() as id";
					$res = mysqli_query($conn, $cade);
					$row = ($res->fetch_array(MYSQLI_ASSOC));

					$_SESSION['idexamen'] = $row['id'];

					echo '<script language = javascript>
						alert("Examen registrado. Pasando a la sección de preguntas...")
						window.location.href = "preguntas.php";
						</script>';


				}
				else{
					echo '<script language = javascript>
						alert("Ocurrió un error y los datos no fueron registrados")
						self.location = "examen.php"
						</script>';
				}
			}
		}
	}
 }
?>
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
							<li role="presentation"><a href="crearExamen.php">CREAR EXAMEN</a></li>
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
              <form role="form" method = "POST" action = "examen.php">
            <form>
               <div class="form-group">
                 <p> Fecha de inicio</p>
                 <input class="form-control" id= "fecha1" name = "fecha1" type="date" placeholder="Fecha de inicio">
                 <br>
                 <br>
                 <p> Fecha de termino </p>
                 <input class="form-control" id= "fecha2" name = "fecha2" type="date" placeholder="Fecha de termino">
                 <br>
                 <br>
                 <input class="form-control" id= "clave" name = "clave" type="text" placeholder="Clave">
                 <br><br>
                 <input id="subir" name="subir" class="btn btn-info" role="button" type = "submit" value = "Generar clave" />

<style>
  .textbox {
    font-family: Arial, Helvetica, sans-serif;
    background: rgba(255, 255, 255, 0.44);
    color: #333;
    border: 1px solid #A4A4A4;
    padding: 4px 8px 4px 4px !important;
    line-height: 1;
    width: 150px;
    height:25px;
    margin-left: 400px;
  }
 .textbox:hover {
    border: 1px solid #3BFEA0;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
  }
 .textbox:focus {
    border: 1px solid #6EE5A1;
    outline: none;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    background: rgb(255, 255, 255); }

</style>
               </div>
            </form>
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
