<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>INTEGRAL NUTRIFUX</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="img-fluid"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Inicio</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#qsomos">Quienes Somos</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#tratamiento">Tratamientos</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#contact">Contacto</a>
      </li>
    </ul>
  </div>
   <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="login.php">Iniciar Sesión</a>
    </li>
  </ul>
</nav>
<div class="content" id="content">
 
<!--Carrousel-->
<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/fnd-001.jpg" id="slider-img" class="img-fluid ">
    </div>
    <div class="carousel-item">
      <img src="images/fnd-002.jpg" id="slider-img" class="img-fluid " >
    </div>
    <div class="carousel-item">
      <img src="images/fnd-003.jpg" id="slider-img" class="img-fluid " >
    </div>
    <div class="carousel-item">
      <img src="images/fnd-004.jpg" id="slider-img" class="img-fluid " >
    </div>
    <div class="carousel-item">
      <img src="images/fnd-005.jpg" id="slider-img" class="img-fluid " >
    </div>
    <div class="carousel-item">
      <img src="images/fnd-006.jpg" id="slider-img" class="img-fluid " >
    </div>
    <div class="carousel-item">
      <img src="images/fnd-007.jpg" id="slider-img" class="img-fluid " >
    </div>
    <div class="carousel-item">
      <img src="images/fnd-008.jpg" id="slider-img" class="img-fluid " >
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

<!--Quienes Somos-->
<div id="qsomos">
  <div class="container">
    <div id="qsomos1">
      <div id="qsomos2">
      <h1>Quienes Somos</h1>
    <p><strong>Centro Integral Nutrifux</strong> Ofrece servicios como vacunoterapia, despigmentacion facial, despigmentacion corporal, masajes relajantes, entre otros. Los esteticistas se encuentran en constantes capacitaciones para ofrecer la experiencia deseada por nuestra clientela. <br>Todo miembro de nuestro equipo es respetuoso, inclusivo e inspirado en  ofrecer el estilo necesario.</p>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin: 0px;"><hr class="col-sm"><img src="images/separator.png" alt="separator" class="img-fluid"><hr class="col-sm"></div>
<!--Especiales-->
<div id="bodyss">
  <div id="Especiales">
    <div class="container">
      <div id="especont" class="col-sm-6">
      <center><h1>ESPECIALES <br> NUTRIFUX</h1></center><br>
        <div>

          <p>Manicura ....................................... $ 20,22</p><br>
          <p>Cabello .......................................... $ 28,08</p><br>
          <p>Corte .............................................. $ 31,16</p><br>
          <p>Reflejos ......................................... $ 44,93</p><br>
          <p>Pestañas Permanentes ................... $ 17,97</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin: 0px;"><hr class="col-sm"><img src="images/separator.png" alt="separator" class="img-fluid"><hr class="col-sm"></div>
<!--Tratamientos-->
<div id="tratamiento">
  <div class="container">
    <div style="text-align: left;padding: 50px 5px;">
      <h1>TRATAMIENTOS</h1><br>
      <div class="row">
        <div class="col-sm"><img src="images/img-001.jpg" alt="tratamiento" class="img-fluid" style="border-radius: 30px"></div>
        <div class="col-sm">
          <br><label for="title"><strong>Tratamientos Nutrifux</strong></label>
          <ul>
            <li><strong>Vacunoterapia</strong></li>
            <li><strong>Rediofrecuencia</strong></li>
            <li><strong>Despigmentacion Facial</strong></li>
            <li><strong>Despigmentacion Corporal</strong></li>
            <li><strong>Masajes Relajantes</strong></li>
            <li><strong>Dietas</strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Contacto-->
<div id="contact">
  <div class="container"> 
      <center style="color: white"><h1>CONTACTO</h1>
      <p>¿Necesitas mayores informaciones acerca de nuestros servicio?</p>
      </center><br>
     <center><div class="col-sm-8" style="padding: 10px 0;">
        <form method="POST" action="sendemail.php" >
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Nombre" required="required">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required="required">
              </div>
            </div>
          </div>

          <div class="form-group">
            <input type="text" name="subject" class="form-control" placeholder="Asunto" required="required">
          </div>

          <div class="form-group">
            <textarea name="message" id="message" class="form-control" rows="4" placeholder="Mensaje" required="required"></textarea>
          </div> 

          <div class="form-group">
            <button type="submit" class="btn btn-info" style="width: 100%">Enviar</button>
          </div>
        </form>
      </div></center>
  </div>
</div>

</div>
<footer style="background-color: black">
  
</footer>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/font_awesome.js"></script>
<script src="js/popper.min.js"></script>
  </body>
</html>