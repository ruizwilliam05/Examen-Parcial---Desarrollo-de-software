<?php
class ClaseFunciones{
    
    # Imprimir Lista en la pantalla y tambien Exporta Alumnos no activos
    function ImprimirArray($Array){
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

    # Creamos un lista Estetica De Distribucion Docentes y alumnos, input: lista de distribucion anterior sin balancear
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

    # Funcion Balancear donde nos retorna la lista de Distribucion final
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
        }
        //Imprimir
        for($row = 0; $row < count($Distribucion2022I); $row++){
            $contador=$row+1;
            echo '<tr><th>'.$contador.'</th><th>'.$Distribucion2022I[$row][1].'</th><th>'.$Distribucion2022I[$row][2].'</th><th>'.$Distribucion2022I[$row][3].'</th></tr>';
        }

        //Generar lista balanceada
        $archivo = 'Archivos_Exportados/Distribucion-Balanceada.csv';
        $fp = fopen($archivo, 'w');
        foreach ($Distribucion2022I as $campos) {
            fputcsv($fp, $campos);
        }
        fclose($fp);  
    }

    # funcion donde entran dos listas y creamos y retornamos una lista de Array de (ArrA-ArrB)
    function DiferenciaListaA_ListaB($ArrA,$ArrB){
        $fila=0;
        $Arreglo=array();
        $Arreglo=$this->AgregarElemento($Arreglo,$ArrA,$ArrB,$fila,0);
        return $Arreglo;
    }
    # Funcion donde eliminamos los alumnos inactivos de la distribucion anterior, input: lista de distibucion anterior, lista de alumnos inactivos
    function EliminarInactivos($ArrA,$ArrB){
        $fila=0;
        $Arreglo=array();
        $Arreglo=$this->AgregarElemento($Arreglo,$ArrA,$ArrB,$fila,1);
        return $Arreglo;
    }

    function AgregarElemento($Arreglo,$ArrA,$ArrB,$fila,$Int){
        for($x = 0; $x < count($ArrA); $x++){
            $Existe=false;
            for($y = 0; $y < count($ArrB); $y++){
                if($Int==1){
                    if($ArrA[$x][0]==$ArrB[$y][0] and $ArrA[$x][0]!="Docente"){
                        $Existe=true;
                        break;
                    }
                }
                else{
                    if($ArrA[$x][0]==$ArrB[$y][0] and $Int==0){
                        $Existe=true;
                        break;
                    }
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
}
?>