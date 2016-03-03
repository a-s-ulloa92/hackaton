<?php
 	session_start();
	require_once('../conexion.php');

	$conn = dbConnect();
	$conn->set_charset("utf8");
	
	
	
	
//Para mostrar datos del examen seleccionado
 if(isset($_POST['valida'])){
	 #Agarra ID del examen
	 $varmod = $_POST['Examen'];
	 
	 #Selecciona datos del examen con el ID $varmod
	 $CAD = "select fechaIni, fechaFin, clave 
	 from examen where idExamen = '".$varmod."'";
		
	 $reg = mysqli_query($conn,$CAD);
	 $row = $reg->fetch_array(MYSQLI_BOTH);
	 
	 #Guarda en variables de sesion los datos del examen para mostrarlos al
	 #volver a cargar la página
	 $_SESSION['idexamen'] = $_POST['Examen'];
	 
	 $_SESSION['mclave'] = $row['clave'];
	 $_SESSION['mfechaini'] = $row['fechaIni'];
	 $_SESSION['mfechafin'] = $row['fechaFin']; 
}
	?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

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
          <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        
                      
                       
					 
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Examenes</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
			
			
			
			
			<form action="" method="post">
			
			<!--Seleccionar examen-->
			<div class="element-select" title="Examen">
				<label class="title"><span class="required"></span></label>
				<div class="item-cont"><div class="large">
					<span><select id= "Examen" name="Examen">
					<?php  
						$vartemp = $_SESSION['id'];
											
						$sql = "select idexamen, clave 
						from examen where maestro_idmaestro = '".$vartemp."'";
						if ($reg2 = mysqli_query($conn, $sql)) {
							while($row = mysqli_fetch_array($reg2)) 
							{ 
								$comboex .='<option value='.$row['idexamen'].'> '.$row['clave'].' </option>';
							}
							echo $comboex;
						}else {
							echo "No hay exámenes registrados.";
						
						}
					?>
					</select><i></i>
			<span class="icon-place"></span></span></div></div>
			</div>
			
			<div class="col-lg-6">
			<!-- Validar eleccion de examen -->
			<input  class="btn btn-danger btn " id= "valida" name = "valida" type="submit" value="Elegir examen"  />
			</div>	
			

						
			
			
			
			
			<!-- Alumnos -->
			 <div class="row">
                <div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php
							#Muestra la clave del examen
							$vartemp = $_SESSION['idexamen'];
											
							$sql = "select clave
									from examen where idexamen = '".$vartemp."'";
							
							$reg2 = mysqli_query($conn, $sql);
							$row = mysqli_fetch_array($reg2);
							
							echo $row['clave'];
							
							?>
							
                        </div>
                        <!-- Tabla mostrando las preguntas y respuestas del examen -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Pregunta</th>
                                            <th>Resp. 1</th>
                                            <th>Resp. 2</th>
                                            <th>Resp. 3</th>
											<th>Resp. 4</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$vartemp = $_SESSION['idexamen'];
											
											$sql = "select texto, r1, r2, r3, r4
											from preguntas where examen_idexamen = '".$vartemp."'
											order by nPregunta";
											
											if ($reg2 = mysqli_query($conn, $sql)) {
												
												while($row = mysqli_fetch_array($reg2)) { 
													echo "<tr>
													<td>$row[texto]</td>
													<td>$row[r1]</td>
													<td>$row[r2]</td>
													<td>$row[r3]</td>
													<td>$row[r4]</td></tr>";
												}
											}
										?>
										
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
			</form>
				
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
