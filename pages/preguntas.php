<?php
 	session_start();
	require_once('../conexion.php');

	$conn = dbConnect();
	$conn->set_charset("utf8");
// CONTROL DE EVENTOS CLICK EN BOTON GUARDAR
    $tnombre = "";
	$tdescripcion = "";//

	

if(isset($_POST['valida'])){

	if(!empty($_POST['pregunta']) && !empty($_POST['resp1'])){
		
		$_SESSION['contador'] += 1;
		
		
		$tresp1 = $_POST['resp1'];
		$tresp2 = $_POST['resp2'];
		$tresp3 = $_POST['resp3'];
		$tresp4 = $_POST['resp4'];
		$tpreg = $_POST['pregunta'];
		$temp = $_SESSION['idexamen'];
		$count = $_SESSION['contador'];
		
		
		//REVISAR registro de usuario
		$cade = "insert into preguntas(r1,r2, r3, r4, texto, examen_idexamen, npregunta)
		values('".$tresp1."','".$tresp2."','".$tresp3."','".$tresp4."','".$tpreg."','".$temp."','".$count."')";
		
		
		
		
		$res = mysqli_query($conn, $cade);
		//$nreg = $res->num_rows;  //Error
		
		if($res) {
			// el registro fue ingresado a la base de datos con exito
			echo '<script language = javascript>
				alert("el registro fue ingresado con exito")
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

    <title>Proyecto BD</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Base de datos</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
     
				<!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li> <a href="../index.php" <i class="fa fa-sign-out fa-fw" id="ids" name= "ids" ></i> Logout </a>
                      
						</li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
              
			  <!-- /.dropdown -->
            </ul>

        <!-- Navigation -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        
                        <li>
                            <a href="asignatura.php"><i class="fa fa-edit fa-fw"></i> Registra un libro</a>
                        </li>
						<li>
                            <a href="reportes.php"><i class="fa fa-edit fa-fw"></i> Lista de libros</a>
                        </li>
                        
                       
					 
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>		
		<!-- /.definicion de los objetos del formulario para base de datos -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Examen</h1>
                </div>
                <!-- /.col-lg-12 type="number" -->
				
            </div>
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Datos de asignaturas
                        </div>
                        <div class="panel-body">
							<form role="form" method = "POST" action = "preguntas.php">
								
								
								<div class="form-group">
									<input class="form-control" id= "pregunta" name = "pregunta" type="text" placeholder="Pregunta">
                                </div>
								
								
								
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
								<!-- Change this to a button or input when using this as a form -->
									<input  class="btn btn-danger btn " id= "valida" name = "valida" type="submit" value="Guardar pregunta"  />
								</div>					
								
								<div class="col-lg-6">
								<!-- Change this to a button or input when using this as a form -->
									<input  class="btn btn-danger btn " id= "valida2" name = "valida2" type="submit" value="Terminar"  />
								</div>	
								
								
								
                            </form>
                         </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
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
