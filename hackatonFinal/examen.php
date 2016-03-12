<?php
 	session_start();
	require_once('conexion.php');

	$conn = dbConnect();
	$conn->set_charset("utf8");
// CONTROL DE EVENTOS CLICK EN BOTON GUARDAR


 $_SESSION['idexamen'] = "";
 $_SESSION['contador'] = 0;


if(isset($_POST['valida'])){

	#No debe haber campos vacios
	if(!empty($_POST['clave']) && !empty($_POST['fecha1']) && !empty($_POST['fecha2'])){
		#Guarda los datos de los campos en variables
		$tclave = $_POST['clave'];
		$tfechaini = $_POST['fecha1'];
		$tfechafin = $_POST['fecha2'];
		$test = $_SESSION['id'];	#Guarda el id del profesor (variable de sesion)

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





//--------------------------------------------------
// CONTROL DE EVENTOS CLICK EN BOTON NUEVO
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Crear examen</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/overwrite.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                            <li role="presentation"><a href="crearExamen.html">CREAR EXAMEN</a></li>
                            <li role="presentation"><a href="examenes.html">EXAMENES</a></li>
                            <li role="presentation"><a href="ppal.html">SALIR</a></li>
                        </ul>
                    </div>
                    <div class="footer">
                        All right reserved 2015<br><hr>Design by.<a target="_blank" href="http://bootstraptaste.com/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">bootstraptaste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="wrapper">

        <!-- Navigation -->


		<!-- /.definicion de los objetos del formulario para base de datos -->
        <div id="page-wrapper">
            <div class="row">
                <!-- /.col-lg-12 type="number" -->

            </div>
            <!-- /.row -->
            <div class="alinear">
              <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Datos de asignaturas
                                </div>
                                <div class="panel-body">

                      <!--Campos de clave y fechas-->
                      <form role="form" method = "POST" action = "examen.php">

                        <div class="form-group">
                          <input class="form-control" id= "clave" name = "clave" type="text" placeholder="Clave">
                                        </div>



                                        <div class="form-group">
                          <input class="form-control" id= "fecha1" name = "fecha1" type="date" placeholder="Fecha de inicio">
                                        </div>

                                        <div class="form-group">
                          <input class="form-control" id= "fecha2" name = "fecha2" type="date" placeholder="Fecha de termino">
                                        </div>

                        <!--BotÃ³n para guardar datos-->
                        <div class="col-lg-6">
                          <input  class="btn btn-danger btn " id= "valida" name = "valida" type="submit" value="Guardar"  />
                        </div>

                                    </form>
                                 </div>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                          </div>

                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
		<!-- /.FIN DE definicion de los objetos del formulario para base de datos -->
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
