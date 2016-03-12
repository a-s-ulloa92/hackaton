<?php
 	session_start();
	require_once('conexion.php');

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

      <title>Crear Examen</title>

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
          </div>
      </div>


    <div id="wrapper">

        <!-- Navigation -->


		<!-- /.definicion de los objetos del formulario para base de datos -->
        <div id="page-wrapper">
<div class="alinear">
  <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Datos de asignaturas
                    </div>
                    <div class="panel-body">
          <form role="form" method = "POST" action = "preguntas.php">

            <!--Muestra pregunta-->
            <div class="form-group">
              <input class="form-control" id= "pregunta" name = "pregunta" type="text" placeholder="Pregunta">
                            </div>

            <!--Campos de respuestas-->


            <div class="form-group">
              <input class="form-control" id= "resp1" name = "resp1" type="text" placeholder="Respuesta 1">
                            </div>

            <div class="form-group">
              <input class="form-control" id= "resp2" name = "resp2" type="text" placeholder="Respuesta 2">
                            </div>

            <div class="form-group">
              <input class="form-control" id= "resp3" name = "resp3" type="text" placeholder="Respuesta 3">
                            </div>

            <div class="form-group">
              <input class="form-control" id= "resp4" name = "resp4" type="text" placeholder="Respuesta 4">
                            </div>





            <div class="col-lg-6">
            <!-- Guardar pregunta -->
              <input  class="btn btn-danger btn " id= "valida" name = "valida" type="submit" value="Guardar pregunta"  />
            </div>

            <div class="col-lg-6">
            <!-- Termina de registrar examen -->
              <input  class="btn btn-danger btn " id= "valida2" name = "valida2" type="submit" value="Terminar"  />
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
