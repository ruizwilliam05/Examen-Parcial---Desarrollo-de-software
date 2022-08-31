<!DOCTYPE html>
<html lang="en">

<head><!-- librerias a utilizar... -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Examen Matriculados</title>
</head>

<body><!-- Main -->
    <div class="container">
        <div class="row">
            <center>
                <h1>UNIVERSIDAD NACIONAL DE SAN ANTONIO ABAD DEL CUSCO</h1>
                <h2>ESCUELA PROFESIONAL DE INGENIERIA INFORMATICA Y DE SISTEMAS</h2>
            </center>
            <h3 class="pb-3 pt-5">Agregar Archivos</h3>

            <!-- Interfaz para gregar archivos CSV -->
            <div class="col-6 pb-3">
                <div class="mb-3">
                    <form action="index.php" method="post" enctype="multipart/form-data">
                        
                            <label for="formFile" class="form-label">Lista de Matriculados de este semestre (.csv)</label>
                            <input class="form-control mb-3" name="ListaDeMatriculadosActual" type="file" id="formFile">

                            <label for="formFile" class="form-label">Distribución de Tutorados del anterior semestre (.csv)</label>
                            <input class="form-control mb-3" name="ListaDeDistribucionAnterior" type="file" id="formFile">

                            <label for="formFile" class="form-label">Lista de Docentes activos de este semestre (.csv)</label>
                            <input class="form-control mb-3" name="ListaDeDocentes" type="file" id="formFile">

                            <input type="submit" class="btn btn-primary" value="Cargar Archivos">
                    </form>
                </div>
            </div>
        </div>
        <!--Operaciones y Creacion de tablas-->
        <div class="row">
            <div class="col-12 p-3">
                <div class="tab-content p-3">
                    <!--Operacion De Conversion de Lista de Matriculados de Este Semestre-->
                    <div class="tab-pane container" id="Alumno">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>codigo</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include 'Librerias.php';
                                    include 'ArchivoCSV_Array.php';

                                    if (!isset($_FILES["ListaDeMatriculadosActual"])) {
                                        throw new Exception("Selecciona un archivo CSV válido.");
                                    }
                                    $file     = $_FILES["ListaDeMatriculadosActual"];
                                    $file1     = $_FILES["ListaDeDistribucionAnterior"];
                                    $file2     = $_FILES["ListaDeDocentes"];
                                    
                                    $Instancia=new ClaseCSV_Array();
                                    $ListaDeAlumnosMatriculados_EnArray=$Instancia->ConvertirArchivo_CSV_a_ListaArray($file,0);
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!--Operacion De Conversion de Lista de Distribucion del Anterior Semestre-->
                    <div class="tab-pane container fade" id="Alumno">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (!isset($_FILES["ListaDeDistribucionAnterior"])) {
                                    throw new Exception("Selecciona un archivo CSV válido.");
                                }
                                $file     = $_FILES["ListaDeMatriculadosActual"];
                                $file1     = $_FILES["ListaDeDistribucionAnterior"];
                                $file2     = $_FILES["ListaDeDocentes"];
                                
                                $Instancia=new ClaseCSV_Array();
                                $ListaDeDistribucionAnterior_EnArray=$Instancia->ConvertirArchivo_CSV_a_ListaArray($file1,0);
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!--Operacion De Conversion de Lista de Distribucion del Anterior Semestre_Forma Diferente-->
                    <div class="tab-pane container fade" id="Alumno">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (!isset($_FILES["ListaDeDistribucionAnterior"])) {
                                    throw new Exception("Selecciona un archivo CSV válido.");
                                }
                                $file     = $_FILES["ListaDeMatriculadosActual"];
                                $file1     = $_FILES["ListaDeDistribucionAnterior"];
                                $file2     = $_FILES["ListaDeDocentes"];
                                $Instancia=new ClaseCSV_Array();
                                $ListaDeDistribucionAnterior_EnArray_AlumnoDocente=$Instancia->ConvertirArchivo_CSV_a_ListaArray($file1,1);
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!--Operacion De Conversion de Lista de Docentes de este semestre-->
                    <div class="tab-pane container fade" id="Alumno">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (!isset($_FILES["ListaDeDocentes"])) {
                                    throw new Exception("Selecciona un archivo CSV válido.");
                                }
                                $file     = $_FILES["ListaDeMatriculadosActual"];
                                $file1     = $_FILES["ListaDeDistribucionAnterior"];
                                $file2     = $_FILES["ListaDeDocentes"];
                                $Instancia=new ClaseCSV_Array();
                                $ListaDeDocentes_EnArray=$Instancia->ConvertirArchivo_CSV_a_ListaArray($file2,0);
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!--Parte donde se Muestran los resultados y se importan en archivos CSV los resultados-->
            <div class="col-12 text p-2">
                <h3 class="pb-3">Resultados</h3>
                <ul class="nav nav-tabs pb-2"><!-- Interfaz, nombre de los resultados-->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#AlumnosInactivos">Alumnos No Considerados en Tutoria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#DistribucionTutorados">Distribucion Balanceada</a>
                    </li>
                </ul>
                <div class="tab-content p-2"><!--Operaciones a realizar, Alumnos sin tutor, Alumnos no considerados y Distribucion Balanceada-->
                    <div class="tab-pane container active" id="AlumnosSinTutor">
                        <table class="table"><!--Esta Tabla no se muestra, en nuestra interfaz de resultado, pero si utilizamos el resultado que se obtiene en el balanceo-->
                            <tbody>
                            <?php
                                $InstanciaI=new ClaseFunciones();
                                $ListaDeAlumnosSinTutor=$InstanciaI->DiferenciaListaA_ListaB($ListaDeAlumnosMatriculados_EnArray,$ListaDeDistribucionAnterior_EnArray);
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane container fade" id="AlumnosInactivos"> <!--Tabla de Alumnos no considerados en tutoria-->
                    <a href=Archivos_Exportados/Alumnos_No_Considerados_Tutoria.csv>Descargar Alumnos Inactivos CSV</a>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php  
                                $ListaDeAlumnosNoActivos_NoMatriculados=$InstanciaI->DiferenciaListaA_ListaB($ListaDeDistribucionAnterior_EnArray,$ListaDeAlumnosMatriculados_EnArray);
                                $InstanciaI->ImprimirArray($ListaDeAlumnosNoActivos_NoMatriculados);# Se muestra los alumnos no considerados en la tutoria
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane container fade" id="DistribucionTutorados"> <!--Tabla de Distribucion balanceada Docentes a Cargo y sus tutorados-->
                    <a href=Archivos_Exportados/Distribucion-Balanceada.csv>Descargar Distribucion Balanceada CSV</a>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Docente a Cargo</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                # esta listas es la Distribucion anterior pero quitamos los alumnos inactivos de esa distribucion para su Proximo balanceo
                                $ListaDeDistribucionActual_SinBalancear=$InstanciaI->EliminarInactivos($ListaDeDistribucionAnterior_EnArray_AlumnoDocente,$ListaDeAlumnosNoActivos_NoMatriculados);
                                # Esta lista es mas apoyo a la estetica, para su mejor presentacion de la Distribucion de Tutorados
                                $ListaDeDistribucionActual_SinBalancear_Estetico=$InstanciaI->CrearDistribucion2022I($ListaDeDistribucionActual_SinBalancear);
                                # En esta Instancia realizamos el correcto Balanceo e incorporando los alumnos sin tutor.
                                $InstanciaI->Balancear($ListaDeDistribucionActual_SinBalancear_Estetico,$ListaDeAlumnosSinTutor);# se muestra la tabla de Distribucion Balanceada
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