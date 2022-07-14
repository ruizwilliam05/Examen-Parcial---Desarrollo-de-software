<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SELECCIONAR ALUMNOS ELEGIBLES PARA HACER TUTORADOS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/cargando.css">
    <link rel="stylesheet" type="text/css" href="css/cssGenerales.css">
  </head>
  <body>
    <div class="cargando">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>
    <div class="container">
      <h6 class="text-center" style="color: garnet; font-size: 30px">
      UNIVERSIDAD NACIONAL DE SAN ANTONIO ABAD DEL CUSCO
  </h6>
      <h3 class="text-center" style="color: red; font-size: 30px">
        SELECCIONAR ALUMNOS ELEGIBLES Y NO ELEGIBLES PARA HACER TUTORIA
      </h3>
      <hr>
        <br><br>
      <div class="row">
          <div class="col-md-7">
          <form action="ImportarCSV2.php" method="POST" enctype="multipart/form-data">
              <div class="file-input text-center">
                    <input  type="file" name="dataAlumno2" id="file-input2" class="file-input__input"/>
                      <label class="file-input__label" for="file-input2">
                        <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
                        <span>Cargar Alumnos Matriculados 2022-I</span></label>
              </div>
              <div class="text-center mt-5">
                  <input type="submit" name="subir" class="btn-enviar" value="Subir CSV"/>
              </div> 
            </form>

            
          </div>
          <form action="ImportarCSV.php" method="POST" enctype="multipart/form-data">
              <div class="file-input text-center">
                  <input  type="file" name="dataAlumno" id="file-input" class="file-input__input"/>
                  <label class="file-input__label" for="file-input">
                    <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
                    <span>Cargar Alumnos 2021-II</span></label>
              </div>
              <div class="text-center mt-5">
                <input type="submit" name="subir" class="btn-enviar" value="Subir CSV"/>
              </div>
            </form>
            
      </div>

      <br><br>
      <div class="row">
      <div class="col-md-6">
        <?php
          header("Content-Type: text/html;charset=utf-8");
          include('conexion.php');
          $sqlalumnos_antiguos = ("SELECT * FROM alumnos_2021ii ");
          $queryData   = mysqli_query($con, $sqlalumnos_antiguos);
          $total_client = mysqli_num_rows($queryData);
        ?>

        <h6 class="text-center" style="color: red">
          LISTA DE ALUMNOS NUEVOS PARA TUTORIA <strong></strong>
        
          
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
               <th>Codigo</th>
              <th>Nombres</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $i = 1;
              $sql=$con->query("SELECT * FROM alumnos_2021ii a right JOIN alumnos_2022i b
              ON a.Codigo = b.Codigo WHERE a.codigo IS NULL");        
              while($row = $sql->fetch_array()){ ?>
                <tr>
                  <th scope="row"><?php echo $i++; ?></th>
                  <td><?php echo $row['Codigo']; ?></td>
                  <td><?php echo $row['Nombres']; ?></td>
                </tr>
                <?php 
              }
            ?>
            
          </tbody>
        </table>
        </h6>
      </div>


          <h6 class="text-center" style="color: red">
            LISTA DE ALUMNOS QUE NO HARAN TUTORIA EN 2022-I <strong></strong>
          <table width="600">
          <table class="table table-bordered table-striped" >
            <thead>
              <tr>
                <th>#</th>
                <th>Codigo</th>
                <th>Nombres</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $i = 1;
                $sql=$con->query("SELECT * FROM alumnos_2021ii a WHERE NOT EXISTS (SELECT 1 FROM alumnos_2022i b
                WHERE a.Codigo=b.Codigo)");        
                while($row = $sql->fetch_array()){ ?>
                  <tr>
                  <th scope="row"><?php echo $i++; ?></th>
                  <td><?php echo $row['Codigo']; ?></td>
                  <td><?php echo $row['Nombres']; ?></td>
                </tr>
              <?php 
              }?>
              </tbody>
            </table>
       
          
      </div>
      
    </div>
    </h6>
  </div>



<script src="js/jquery.min.js"></script>
<script src="'js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(window).load(function() {
            $(".cargando").fadeOut(1000);
        });      
});
</script>

</body>
</html>

