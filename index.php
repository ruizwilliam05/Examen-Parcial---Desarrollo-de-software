<!DOCTYPE html>
<<<<<<< HEAD
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

=======
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Examen Matriculados</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <center>
                <h1>UNIVERSIDAD NACIONAL DE SAN ANTONIO ABAD DEL CUSCO</h1>
                <h2>ESCUELA PROFESIONAL DE INGENIERIA INFORMATICA Y DE SISTEMAS</h2>
            </center>
            <h3 class="pb-3 pt-5">Agregar Archivos</h3>
            <!-- Para Agregar CSV -->
            <div class="col-6 pb-3">
                <div class="mb-3">
                    <form action="index.php" method="post" enctype="multipart/form-data">
                        
                            <label for="formFile" class="form-label">Lista de Matriculados de este semestre (.csv)</label>
                            <input class="form-control mb-3" name="archivo" type="file" id="formFile">

                            <label for="formFile" class="form-label">Distribución de Tutorados del anterior semestre (.csv)</label>
                            <input class="form-control mb-3" name="archivo1" type="file" id="formFile">

                            <label for="formFile" class="form-label">Lista de Docentes activos de este semestre (.csv)</label>
                            <input class="form-control mb-3" name="archivo2" type="file" id="formFile">
                            

                            <input type="submit" class="btn btn-primary" value="Cargar Archivos">
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-3">

                <!-- Tab panes -->
                <div class="tab-content p-3">
                    <div class="tab-pane container" id="Alumno">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <!--<th>Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include 'Librerias.php';

                                    if (!isset($_FILES["archivo"])) {
                                        throw new Exception("Selecciona un archivo CSV válido.");
                                    }
                                    $file     = $_FILES["archivo"];
                                    $file1     = $_FILES["archivo1"];
                                    $file2     = $_FILES["archivo2"];
                                    
                                    $Mox=new Funciones();
                                    $Arreglo_Matriculados=$Mox->csv_Array($file);
                                    $Mox->Imprimir($Arreglo_Matriculados);
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container fade" id="Alumno">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <!--<th>Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (!isset($_FILES["archivo1"])) {
                                    throw new Exception("Selecciona un archivo CSV válido.");
                                }
                                $file     = $_FILES["archivo"];
                                $file1     = $_FILES["archivo1"];
                                $file2     = $_FILES["archivo2"];
                                
                                $Mox=new Funciones();
                                $Arreglo_Dis_Anterior=$Mox->csv_Array($file1);
                                #$Mox->Imprimir($Arreglo_Dis_Docentes);
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container fade" id="Alumno">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <!--<th>Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (!isset($_FILES["archivo1"])) {
                                    throw new Exception("Selecciona un archivo CSV válido.");
                                }
                                $file     = $_FILES["archivo"];
                                $file1     = $_FILES["archivo1"];
                                $file2     = $_FILES["archivo2"];
                                
                                $Mox=new Funciones();
                                #$Arreglo_Dis_Docentes=$Mox->csv_Array($file2);
                                $Arreglo_Dis_Anterior_AlumnoDocente=$Mox->csv_Array_Distribucion($file1);
                                #$Mox->Imprimir($Arreglo_Dis_Anterior);
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container fade" id="Alumno">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <!--<th>Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (!isset($_FILES["archivo2"])) {
                                    throw new Exception("Selecciona un archivo CSV válido.");
                                }
                                $file     = $_FILES["archivo"];
                                $file1     = $_FILES["archivo1"];
                                $file2     = $_FILES["archivo2"];
                                
                                $Mox=new Funciones();
                                $Arreglo_Dis_Docentes=$Mox->csv_Array($file2);
                                
                                #$Mox->Imprimir($Arreglo_Dis_Anterior);
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 text p-3">
                <h3 class="pb-3">Resultados</h3>
                <!-- Resultados -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs pb-3">
                    <li class="nav-item">
                        <a class="nav-link " data-bs-toggle="tab" href="#AST">Alumnos Sin Tutor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#AI">Alumnos No Matriculados 2022I</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#DT">Distribucion de Tutorados</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3">
                    <div class="tab-pane container active" id="AST">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                 <!--<th>Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $AlumnosSinTutor=$Mox->Diferencia($Arreglo_Matriculados,$Arreglo_Dis_Anterior);
                                #$Mox->Imprimir($Arreglo_Matriculados);
                                $Mox->Imprimir($AlumnosSinTutor);

                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container fade" id="AI">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                 <!--<th>Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                
                                $AlumnosSinMatricula=$Mox->Diferencia($Arreglo_Dis_Anterior,$Arreglo_Matriculados);
                                #$Mox->Imprimir($Arreglo_Dis_Anterior);
                                $Mox->Imprimir($AlumnosSinMatricula);
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container fade" id="DT">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Docente a Cargo</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                 <!--<th>Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                #$AlumnosSinMatricula=$Mox->Diferencia($Arreglo_Dis_Anterior,$Arreglo_Matriculados);
                                $AlumnosConDistribucionActual=$Mox->EliminarInactivos($Arreglo_Dis_Anterior_AlumnoDocente,$AlumnosSinMatricula);
                                #$Mox->Imprimir($Arreglo_Dis_Anterior_AlumnoDocente);
                        
                                #$Mox->Imprimir($AlumnosConDistribucionActual);

                                $ContarAlumnos=$Mox->SumarCantidad($AlumnosConDistribucionActual,$AlumnosSinTutor);
                                $ContarDocentes=$Mox->SumarCantidadDocente($AlumnosConDistribucionActual);
                                $CantidadBalanceada=intdiv($ContarAlumnos,$ContarDocentes);
                                $ResiduoDelBalanceo=$ContarAlumnos % $ContarDocentes;

                                #$DistribucionEnArrayMulti=$Mox->ArregloMulti($AlumnosConDistribucionActual);
                                
                                //Distribucion balanceada o equitativa de estudiantes
                                $TablaDistribucionDocenteAlumno=$Mox->CrearDistribucion2022I($AlumnosConDistribucionActual);
                                
                                $NuevaTabla=$Mox->NumeroTutoradosXDocente($TablaDistribucionDocenteAlumno);
                                $Mox->Balancear($TablaDistribucionDocenteAlumno,$AlumnosSinTutor);

                                
                                
                                
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
>>>>>>> 94e943c (Redisenio sin BD)
