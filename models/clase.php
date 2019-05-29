<?php

    // Vacaciones
    function editarUsuarios($datos){

        include '../core/conexion.php';

        $sql = "UPDATE e_usuarios SET nombres='$datos[nombre]', id_estatus=$datos[estatus], id_rol=$datos[nivel], id_dependencia=$datos[dependencia] WHERE id_usuario=$datos[id_usuario]";

        if(pg_query($conn, $sql)){

            return 1;

        }else {

            return 2;

        }

    }

    // Vacaciones
    function borrarUsuario($id_usuario){

        include '../core/conexion.php';

        $sql = "DELETE FROM users WHERE id_usuario = $id_usuario";

        $result = pg_query($conn, $sql);

        if (!$result){

            die ('Error en la consulta');

            return 1;

        } else {

            pg_free_result($result);
            pg_close($conn);

            return 2;

        }
    
    }

    // Vacaciones
    function zoomUsuario($usuario){

        include '../core/conexion.php';

        $sql = "SELECT cedula, nombres, id_rol, id_estatus, fecha, id_usuario FROM users WHERE id_usuario = $usuario";

        $result = pg_query($conn, $sql);

        if(!$result){
            die('Fallo en la consulta');
        }

        $datos = array();

        while ($row = pg_fetch_array($result)){

            $datos[] = array(
                'cedula' => $row['cedula'],
                'nombres' => $row['nombres'],
                'id_rol' => $row['id_rol'],
                'fecha' => $row['fecha'],
                'id_estatus' => $row['id_estatus']
           
            );

        }

        pg_free_result($result);
        pg_close($conn);

        return json_encode($datos[0]);
    
    }

    // Vacaciones
    function verUsuarios(){

        include '../core/conexion.php';

        $sql = "SELECT id_usuario, cedula, nombres, descripcion, estatus FROM users u
        INNER JOIN roles r ON (u.id_rol = r.id_rol)
        INNER JOIN estatus e ON (u.id_estatus = e.id_estatus)";

        $result = pg_query($conn, $sql);

        if(!$result){
            die('Fallo en la consulta');
        }

        $datos = array();

        $nro = 0;

        while ($row = pg_fetch_array($result)){ $nro++;
            
            $datos[] = array(
                'nro' => $nro,
                'id_usuario' => $row['id_usuario'],
                'cedula' => $row['cedula'],
                'nombres' => $row['nombres'],
                'rol' => $row['descripcion'],
                'estatus' => $row['estatus']
            );

        }

        pg_free_result($result);
        pg_close($conn);

        return json_encode($datos);

    }

    // Vacaciones
    function buscarEnSigefirrhh($cedula){

        include '../core/sigefirrhh.php';

        $sql = "SELECT p.id_personal, primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido AS nombres, descripcion_cargo, c.id_cargo FROM personal p INNER JOIN trabajador t ON (p.id_personal = t.id_personal) INNER JOIN cargo c ON (t.id_cargo = c.id_cargo) WHERE p.cedula=$cedula and estatus='A'";

        $result = pg_query($conexion2,$sql);

        if(!$result){
            die('Consulta fallida');
        }

        $datos = array();

        while($row = pg_fetch_array($result)){

            $datos[] = array(
                'id_personal' => $row['id_personal'],
                'nombres' => $row['nombres']
            );

        }

        pg_free_result($result);
        pg_close($conexion2);

        return json_encode($datos[0]);

    }

    // Vacaciones
    function contarUsuarios(){
        include 'core/conexion.php';
        $sql = "SELECT id_usuario FROM e_usuarios";
        $result = pg_query($conn,$sql);
        $nro= pg_num_rows($result);
        pg_free_result($result);
        pg_close($conn);
        return $nro;
    }

    // Vacaciones
    function contarCentros(){
        include 'core/conexion.php';
        $sql = "SELECT id_dependencia FROM a_dependencias";
        $result = pg_query($conn,$sql);
        $nro= pg_num_rows($result);
        pg_free_result($result);
        pg_close($conn);
        return $nro;
    }

    // Vacaciones
    function graficaSolicitudes(){

        include '../../../core/conexion.php';

        $sql = "SELECT fecha_solicitud, COUNT(id) FROM d_solicitud WHERE estatus = 1 GROUP BY fecha_solicitud ORDER BY fecha_solicitud";

        $res = pg_query($conn,$sql);

        $valX = array(); // Fecha
        $valY = array(); // ID

        while($row = pg_fetch_array($res)){
            $valX[] = $row[0]; //Fecha
            $valY[] = $row[1]; // Id
        }

        pg_free_result($res);
        pg_close($conn);

        $datosX = json_encode($valX);
        $datosY = json_encode($valY);

        return array($datosX, $datosY);

    }

    // Vacaciones
    function graficaExperticias(){

        include '../../../core/conexion.php';

        $sql = "SELECT fecha_revision, COUNT(id) FROM d_experticias GROUP BY fecha_revision ORDER BY fecha_revision";

        $res = pg_query($conn,$sql);

        $valX = array(); // Fecha
        $valY = array(); // ID

        while($row = pg_fetch_array($res)){
            $valX[] = $row[0]; //Fecha
            $valY[] = $row[1]; // Id
        }

        pg_free_result($res);
        pg_close($conn);

        $datosX = json_encode($valX);
        $datosY = json_encode($valY);

        return array($datosX, $datosY);

    }

    // Vacaciones
    function contarExpertos(){
        
        include 'core/conexion.php';
        $sql = "SELECT id_funcionario FROM c_revisores";
        $result = pg_query($conn,$sql);
        $nro= pg_num_rows($result);
        pg_free_result($result);
        pg_close($conn);
        return $nro;
        
    }

    // Verificar usuario
    function checkUser($civ){

        include '../core/conexion.php';

        $sql = "SELECT * FROM users WHERE cedula = '$civ'";

        $result = pg_query($conn, $sql);

        $total = pg_num_rows($result);

        pg_free_result($result);
        pg_close($conn);

        return $total;

    }

    // Vacaciones
    function registroUsuario($datos){

        session_start();
        
        include '../core/conexion.php';

        $passHash = password_hash($datos['clave'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (id_rol, cedula, nombres, registrado_por, fecha, clave, id_estatus) VALUES ($datos[privilegio], '$datos[civ]', '$datos[nombres]', $_SESSION[usuario], '$fecha','$passHash', 1)";

        $result = pg_query($conn, $sql);

        if(!$result){

            die('Error al tratar de registrar');

        }else{

            pg_free_result($result);
            pg_close($conn);

            return 2;

        }

    }