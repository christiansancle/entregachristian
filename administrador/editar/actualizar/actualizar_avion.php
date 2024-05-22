<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["id"]) && !empty($_POST["id"])){
        include '../../../conexion.php';
        
        $id = $_POST["id"];
        $modelo = $_POST["modelo"];
        $aerolinea_id = $_POST["aerolinea_id"];
        $capacidad_pasajeros = $_POST["capacidad_pasajeros"];
        $ano_fabricacion = $_POST["ano_fabricacion"];
        
        $sql = "UPDATE avion SET modelo=?, aerolinea_id=?, capacidad_pasajeros=?, ano_fabricacion=? WHERE id=?";
        
        if($stmt = $conexion->prepare($sql)){
            $stmt->bind_param("siiii", $param_modelo, $param_aerolinea_id, $param_capacidad_pasajeros, $param_ano_fabricacion, $param_id);
            $param_modelo = $modelo;
            $param_aerolinea_id = $aerolinea_id;
            $param_capacidad_pasajeros = $capacidad_pasajeros;
            $param_ano_fabricacion = $ano_fabricacion;
            $param_id = $id;
            
            if($stmt->execute()){
                header("location: ../../aviones.php");
                exit();
            } else{
                echo "Oops! Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
            }
        }
        
        $stmt->close();
        
        $conexion->close();
    } else{
        header("location: error.php");
        exit();
    }
}
?>
