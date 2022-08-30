<?php
class Funciones{
    function csv_Array($file){
        $tmp      = $file["tmp_name"];
        #$filename = $file["name"];
        $size     = $file["size"];
        if ($size < 0) {
            throw new Exception("Selecciona un archivo válido por favor.");
          }
          $fila = 0;
            #Vamos abrir los archivos 
            if (($gestor = fopen($tmp, "r")) !== FALSE) {
                while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                    //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
                    #Creamos un arreglo Bidimencional 
                    $val_doc=substr($datos[0], 0, 7);
                    if(strlen($datos[1])>1 and ($val_doc != "Docente" and strtolower($datos[0]) != "codigo" 
                    and strtolower($datos[1]) != "codigo"  and $datos[0]!="Nuevo Tutorado")){
                        if(strlen($datos[0])>=4){
                            $Arreglo[$fila][0]=$datos[0];
                            $Arreglo[$fila][1]=$datos[1];
                        }
                        else{
                            $Arreglo[$fila][0]=$datos[1];
                            $Arreglo[$fila][1]=$datos[2];
                            
                        }
                        $fila++;
                    }
                }
                fclose($gestor);
            }
            return $Arreglo;
    }
    function csv_Array_Distribucion($file){
        $tmp      = $file["tmp_name"];
        #$filename = $file["name"];
        $size     = $file["size"];
        if ($size < 0) {
            throw new Exception("Selecciona un archivo válido por favor.");
          }
          $fila = 0;
            #Vamos abrir los archivos 
            if (($gestor = fopen($tmp, "r")) !== FALSE) {
                while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                    //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
                    #Creamos un arreglo Bidimencional 
                    $val_doc=substr($datos[0], 0, 7);
                    if(strlen($datos[1])>1 and (strtolower($datos[0]) != "codigo" and strtolower($datos[1]) != "codigo"  and $datos[0]!="Nuevo Tutorado")){
                        if($val_doc == "Docente"){
                            $Arreglo[$fila][0]=$val_doc;
                            $Arreglo[$fila][1]=$datos[1];
                        }
                        else{
                            $Arreglo[$fila][0]=$datos[0];
                            $Arreglo[$fila][1]=$datos[1];
                        }
                        $fila++;
                    }
                    
                }
                fclose($gestor);
            }
            return $Arreglo;
    }
    function Imprimir($Array){
        if(!empty($Array)){
            $Pos=0;
            for($row = 0; $row < count($Array); $row++){
                $Pos++;
                echo '<tr><th>'.$Pos.'</th><th>'.$Array[$row][0].'</th><th>'.$Array[$row][1].'</th></tr>';
            }
        }

        //Generar archivo csv en carpeta Archivos Exportados
        $archivo = 'Archivos_Exportados/Alumnos_No_Considerados_Tutoria.csv';
        $fp = fopen($archivo, 'w');
        foreach ($Array as $campos) {
            fputcsv($fp, $campos);
        }
        fclose($fp);
        
    }

    function CrearDistribucion2022I($Array)
    {
        if(!empty($Array)){

            $Pos=0;

            for($row = 0; $row < count($Array); $row++){
                
                if($Array[$row][0]=='Docente')
                {

                    $DocenteACargo=$Array[$row][1];
                    $row=$row+1;
                }
                $AlumnoXDocente[$Pos][0]=$Pos+1;
                $AlumnoXDocente[$Pos][1]=$DocenteACargo;
                $AlumnoXDocente[$Pos][2]=$Array[$row][0];
                $AlumnoXDocente[$Pos][3]=$Array[$row][1];
                $Pos++;
            }
        }
        return $AlumnoXDocente;
        
    } 


    function Balancear($DistribucionDocenteAlumno,$AlumnosSinTutor)
    {
        //Balanceo
        if(!empty($DistribucionDocenteAlumno) && !empty($AlumnosSinTutor))
        {
            //Doncente actual
            $DocenteSiguiente=$DistribucionDocenteAlumno[0][1];
            $row2=0;
            $row3=0;
            for($row = 0; $row < 531; $row++)
            {
                
                $Distribucion2022I[$row2][1]=$DistribucionDocenteAlumno[$row][1]; //Doncente a cargo
                $Distribucion2022I[$row2][2]=$DistribucionDocenteAlumno[$row][2]; //Cpdigo
                $Distribucion2022I[$row2][3]=$DistribucionDocenteAlumno[$row][3]; //Nombre
                $row2+=1;

                $next=$row+1;
                $DocenteActual=$DistribucionDocenteAlumno[$row][1];
                if(count($DistribucionDocenteAlumno)!=$next)
                $DocenteSiguiente=$DistribucionDocenteAlumno[$next][1];
                
                
                if($DocenteActual!=$DocenteSiguiente && $row3!=count($AlumnosSinTutor))
                {
                    
                    $Distribucion2022I[$row2][1]=$DocenteActual; //Doncente a cargo
                    $Distribucion2022I[$row2][2]=$AlumnosSinTutor[$row3][0]; //Cpdigo
                    $Distribucion2022I[$row2][3]=$AlumnosSinTutor[$row3][1]; //Nombre
                    $row2+=1;
                    $row3+=1;
                }
            }
            
            #echo $DocenteSiguiente;
            
        }
        //Imprimir
        for($row = 0; $row < count($Distribucion2022I); $row++){
            $contador=$row+1;
            echo '<tr><th>'.$contador.'</th><th>'.$Distribucion2022I[$row][1].'</th><th>'.$Distribucion2022I[$row][2].'</th><th>'.$Distribucion2022I[$row][3].'</th></tr>';
        }



        //Generar lista balanceada
        $archivo = 'Archivos_Exportados/Distribucion-Balanceada.csv';
        $fp = fopen($archivo, 'w');
        #$fp = fopen('php://output');
        foreach ($Distribucion2022I as $campos) {
            fputcsv($fp, $campos);
        }
        fclose($fp);
        
        
    }

    function NumeroTutoradosXDocente($Array)
    {
        $Docente=$Array[0][1];
        $Cantidad=0;
        $Cont=0;
        for($row=0; $row<count($Array); $row++)
        {
            if($Array[$row][1]==$Docente) $Cantidad++;
            if($Array[$row][1]!=$Docente)
            {
                $TablaCantidad[$Cont][0]=$Docente;
                $TablaCantidad[$Cont][1]=$Cantidad;
                $Cont+=1;
                $Docente=$Array[$row][1];
                $Cantidad=1;
            }
            if($row==530) 
            {
                $TablaCantidad[$Cont][0]=$Docente;
                $TablaCantidad[$Cont][1]=$Cantidad;
            }
        }
        
        return $TablaCantidad;

    }

    function Diferencia($ArrA,$ArrB){
        $fila=0;
        $Arreglo=array();
        for($x = 0; $x < count($ArrA); $x++){
            $Existe=false;
            for($y = 0; $y < count($ArrB); $y++){
                if($ArrA[$x][0]==$ArrB[$y][0]){
                    $Existe=true;
                    break;
                }
            }
            if($Existe==false){
                $Arreglo[$fila][0]=$ArrA[$x][0];
                $Arreglo[$fila][1]=$ArrA[$x][1];
                $fila++;
            }
        }
        return $Arreglo;
    }
    function EliminarInactivos($ArrA,$ArrB){
        $fila=0;
        $Arreglo=array();
        for($x = 0; $x < count($ArrA); $x++){
            $Existe=false;
            for($y = 0; $y < count($ArrB); $y++){
                if($ArrA[$x][0]==$ArrB[$y][0] and $ArrA[$x][0]!="Docente"){
                    $Existe=true;
                    break;
                }
            }
            if($Existe==false){
                $Arreglo[$fila][0]=$ArrA[$x][0];
                $Arreglo[$fila][1]=$ArrA[$x][1];
                $fila++;
            }
        }
        return $Arreglo;
    }

    function SumarCantidad($ArrA,$ArrB){
        $Contador=0;
        for($x = 0; $x < count($ArrA); $x++){
          
            if($ArrA[$x][0]!="Docente"){
                $Contador=$Contador+1;
            }    
        }
        $Contador=$Contador+count($ArrB)-1;
        return $Contador;
    }
    function SumarCantidadDocente($ArrA){
        $Contador=0;
        for($x = 0; $x < count($ArrA); $x++){
          
            if($ArrA[$x][0]=="Docente"){
                $Contador=$Contador+1;
            }    
        }
        return $Contador;
    }
}
?>