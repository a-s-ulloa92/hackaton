<?php
 	session_start();
	require_once('../conexion.php');

	$conn = dbConnect();
	$conn->set_charset("utf8");
// CONTROL DE EVENTOS CLICK EN BOTON GUARDAR
  
 
 
 
if(isset($_POST['valida'])){

		$tresp = $_POST['Respuesta'];
		$tpreg = $_SESSION['idpregunta'];
		$talumno = $_SESSION['idalumno'];
		
		
			//REVISAR registro de usuario
				
			
		$cade = "insert into preguntas_has_alumno(preguntas_idpreguntas,alumno_idalumno,opcion)
		values('".$tpreg."','".$talumno."','".$tresp."')";
			
				
				
		$res = mysqli_query($conn, $cade);
		
		//$nreg = $res->num_rows;  //Error

		if ($_SESSION['contador_examen'] >= count($_SESSION['query_examen'])){
				
				echo '<script language = javascript>
				alert("Examen terminado")
				window.location.href = "examen.php"
				</script>';
			}
		else{
			if($res) {
						// el registro fue ingresado a la base de datos con exito
				$_SESSION['contador_examen'] += 1;
				
				
			}
			else{
				echo '<script language = javascript>
					alert("Ocurrió un error")
					self.location = "examen.php"
					</script>';
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
                            Pregunta #<?php echo $_SESSION['contador_examen'] ?>
                        </div>
                        <div class="panel-body">
							<form role="form" method = "POST" action = "examen_respuestas.php">
								
								<?php 
								
								
								$temp = $_SESSION['query_examen'];
								$temp_cont = $_SESSION['contador_examen'] - 1;
								
								$_SESSION['idpregunta'] = $temp[$temp_cont]['idpreguntas'];
								
								
								
								echo $temp[$temp_cont]['texto'];
								echo "<br><br>>1) ";
								
								echo $temp[$temp_cont]['r1'];
								echo "<br>>2) ";
								
								echo $temp[$temp_cont]['r2'];
								echo "<br>>3) ";
								
								echo $temp[$temp_cont]['r3'];
								echo "<br>>4) ";
								
								echo $temp[$temp_cont]['r4'];
								echo "<br> ";
								
								?>
								
								
								<div class="item-cont"><div class="large">
									<span><select id= "Respuesta" name="Respuesta">
										<?php
									$comboresp ='<option value=1> a </option>';
									$comboresp .='<option value=2> b </option>';
									$comboresp .='<option value=3> c </option>';
									$comboresp .='<option value=4> d </option>';
								echo $comboresp;
								?>
								
								
									</select><i></i><span class="icon-place"></span></span></div></div>
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								<div class="col-lg-6">
								
								<!-- Change this to a button or input when using this as a form -->
									<input  class="btn btn-danger btn " id= "valida" name = "valida" type="submit" value="Siguiente"  />
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
