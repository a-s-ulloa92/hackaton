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
                      <textarea id="text" cols="45" rows="3"> </textarea>
                  </div>
              </div>
            </div>
        </div>
    <!-- /#wrapper -->
    <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.2.1/annyang.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//responsivevoice.org/responsivevoice/responsivevoice.js"></script>
    <script>
    responsiveVoice.setDefaultVoice("Spanish Female");
    annyang.setLanguage(`es-MX`);
    responsiveVoice.OnVoiceReady = function() {
      console.log("speech time?");

      pregunta = [
        "¿Cuánto es 2 mas 2?",
        "¿Cuál es la derivada de seno de theta?",
        "¿Quién fue el creador del lenguaje C?"
      ]
      respuesta = [
        {"2":false, "4":true, "1":false, "500":false},
        {"seno":false, "menos seno":false, "coseno":true, "menos coseno":false},
        {"Dennis Ritchie":true, "James Gosling":false, "Guido van Rossum":false, "Alan Turing":false}
      ]
      responsiveVoice.speak(pregunta[2]);
      var commands = {
        '*val': function(val){
          if(respuesta[2][val]){
            responsiveVoice.speak("Respuesta correcta");
          }else{
            responsiveVoice.speak("Respuesta incorrecta");
          }
        }
    };
      annyang.addCommands(commands);
      annyang.debug();
      annyang.start();
    }
    </script>
    <!-- jQuery -->


</body>

</html>
