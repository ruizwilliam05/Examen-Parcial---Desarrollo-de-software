<!DOCTYPE html>
<html lang="en">
<head>

    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>TRABAJO DE DESARROLLO DE SOFTWARE</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <center>
                <h1>UNIVERSIDAD NACIONAL DE SAN ANTONIO ABAD DEL CUSCO</h1>
                <h2>ESCUELA PROFESIONAL DE INGENIERIA INFORMATICA Y DE SISTEMAS</h2>
            </center>
            <h3 class="pb-3 pt-5">Agregar Archivos</h3>
            <!-- Para Agregar CSV-->
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
                                <th>codigo</th>
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
            <div class="col-12 text p-2">
                <h3 class="pb-3">Resultados</h3>
                <!-- Resultados -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs pb-2">
                    
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#AI">Alumnos No Considerados en Tutoria</a>
                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#DT">Distribucion Balanceada</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-2">
                    <div class="tab-pane container active" id="AST">
                        <table class="table">
                            <thead>
                            <tr>
                                
                                 <!--<th>Estado</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $AlumnosSinTutor=$Mox->Diferencia($Arreglo_Matriculados,$Arreglo_Dis_Anterior);
                                #$Mox->Imprimir($Arreglo_Matriculados);
                                //$Mox->Imprimir($AlumnosSinTutor);

                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container fade" id="AI"> <!--Alumnos no considerados en tutoria-->
                    <a href=Archivos_Exportados/Alumnos_No_Considerados_Tutoria.csv>Descargar Lista CSV</a>
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
                    <div class="tab-pane container fade" id="DT"> <!--Distribucion balanceada-->
                    <a href=Archivos_Exportados/Distribucion-Balanceada.csv>Descargar Lista CSV</a>
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
                                $TablaDistribucionDocenteAlumno=$Mox->CrearDistribucion2022I($AlumnosConDistribucionActual);
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