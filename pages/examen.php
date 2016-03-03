<?php
 	session_start();
	require_once('../conexion.php');

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
										
								<!--Botón para guardar datos-->
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
