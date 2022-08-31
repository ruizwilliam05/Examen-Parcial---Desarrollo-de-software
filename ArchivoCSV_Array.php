<?php
class ClaseCSV_Array{
    function ConvertirArchivo_CSV_a_ListaArray($file,$Int){
        $tmp      = $file["tmp_name"];
        $size     = $file["size"];
        if ($size < 0) {
            throw new Exception("Selecciona un archivo válido por favor.");
        }
        $fila = 0;

        #Vamos abrir los archivos
        if (($gestor = fopen($tmp, "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                #Creamos un arreglo Bidimencional 
                $DatoInicial=substr($datos[0], 0, 7);
                if($Int==0){
                    if(strlen($datos[1])>1 and ($DatoInicial != "Docente" and strtolower($datos[0]) != "codigo" 
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
                else{
                    if(strlen($datos[1])>1 and (strtolower($datos[0]) != "codigo" and strtolower($datos[1]) != "codigo"  and $datos[0]!="Nuevo Tutorado") and $Int==1){
                        if($DatoInicial == "Docente"){
                            $Arreglo[$fila][0]=$DatoInicial;
                            $Arreglo[$fila][1]=$datos[1];
                        }
                        else{
                            $Arreglo[$fila][0]=$datos[0];
                            $Arreglo[$fila][1]=$datos[1];
                        }
                        $fila++;
                    } 
                }
            }
            fclose($gestor);
        }
        return $Arreglo;
    }
}
?>