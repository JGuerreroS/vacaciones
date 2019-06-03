<?php

    // Inicio de sesión
    function login($user,$pass){

        include '../core/conexion.php';

        $sql = "SELECT id_usuario, nombres, cedula, clave, id_rol FROM users WHERE cedula = '$user'";

        $result = pg_query($conn, $sql);
	
        $row = pg_fetch_assoc($result);
        
        $hash = $row['clave'];
        
        if(password_verify($pass, $hash)){

            session_start();
            
            $_SESSION['name'] = $row['nombres'];
            $_SESSION['usuario'] = $row['id_usuario'];
            $_SESSION['nivel'] = $row['id_rol'];

            pg_free_result($result);
            pg_close($conn);
            
            return true;
        
        }else{

            pg_free_result($result);
            pg_close($conn);

            return false;

        }

    }

    // Editar usuario
    function editUser($datos){

        include '../core/conexion.php';

        $sql = "UPDATE users SET nombres = '$datos[nombre]', id_estatus = $datos[estatus], id_rol = $datos[nivel] WHERE id_usuario = $datos[id_usuario]";

        $result = pg_query($conn, $sql);

        if(!$result){

            die('Error en la consulta');
            return 2;

        }else {

            pg_free_result($result);
            pg_close($conn);

            return 1;

        }

    }

    // Borrar usuario
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

    // ver más del usuario
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
                'id_estatus' => $row['id_estatus'],
                'id_usuario' => $row['id_usuario']
            );

        }

        pg_free_result($result);
        pg_close($conn);

        return json_encode($datos[0]);
    
    }

    // ver detalles de las vacaciones
    function zoomVacacion($id_vacacion){

        include '../core/conexion.php';

        $sql = "SELECT v.cedula, primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido, fecha_ingreso, periodo1, periodo2, fecha_desde, fecha_hasta, dias, dependencia, coordinacion, fecha_registro FROM reg_vacaciones v
        INNER JOIN personal p ON (v.cedula = p.cedula)
        INNER JOIN trabajador t ON (v.cedula = t.cedula)
        INNER JOIN dependencia d ON (v.id_dependencia = d.id_dependencia)
        LEFT JOIN coordinaciones c ON (v.id_coordinacion = c.id_coordinacion)
        WHERE id = $id_vacacion";

        $result = pg_query($conn, $sql);

        if(!$result){
            die('Fallo en la consulta');
        }

        $datos = array();

        while ($row = pg_fetch_array($result)){

            $datos[] = array(
                'cedula' => $row[0],
                'nombres' => $row[1],
                'fecha_ingreso' => $row[2],
                'periodo1' => $row[3],
                'periodo2' => $row[4],
                'fecha_desde' => $row[5],
                'fecha_hasta' => $row[6],
                'dias' => $row[7],
                'dependencia' => $row[8],
                'coordinacion' => $row[9],
                'fecha_registro' => $row[10]
            );

        }

        pg_free_result($result);
        pg_close($conn);

        return json_encode($datos[0]);
    
    }

    // mostrar lista de usuarios
    function verUsuarios(){

        include '../core/conexion.php';

        $sql = "SELECT id_usuario, cedula, nombres, rol, estatus FROM users u
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
                'rol' => $row['rol'],
                'estatus' => $row['estatus']
            );

        }

        pg_free_result($result);
        pg_close($conn);

        return json_encode($datos);

    }

    // Buscar funcionario en el sigefirrhh
    function buscarEnSigefirrhh($cedula){

        include '../core/sigefirrhh.php';

        $sql = "SELECT p.cedula, id_cargo, primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido AS nombres, estatus, fecha_ingreso FROM personal p
        INNER JOIN trabajador t ON (p.id_personal = t.id_personal)
        WHERE p.cedula = $cedula AND id_trabajador = (SELECT max(id_trabajador) FROM trabajador WHERE cedula = $cedula)";

        $result = pg_query($conexion,$sql);

        if(!$result){
            die('Consulta fallida');
        }

        $row = pg_fetch_array($result);

        pg_free_result($result);
        pg_close($conexion);

        return json_encode($row);

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

    // mostrar lista de vacaciones
    function mostrarVacaciones($cedula){

        include '../core/conexion.php';

        $sql = "SELECT periodo1||'-'||periodo2 AS periodo, fecha_desde, fecha_hasta, dias, dependencia, id_an_suspension FROM reg_vacaciones v
        INNER JOIN dependencia d ON (v.id_dependencia = d.id_dependencia)
        WHERE cedula = $cedula";

        $result = pg_query($conn, $sql);

        if(!$result){
            die('Fallo en la consulta');
        }

        $datos = array();

        $nro = 0;

        while ($row = pg_fetch_array($result)){ $nro++;

            if($row[5] == ''){
                $estatus = 'Disfrutadas';
            }else{
                $estatus = 'Suspendidas';
            }
            
            $datos[] = array(
                'nro' => $nro,
                'periodo' => $row[0],
                'desde' => $row[1],
                'hasta' => $row[2],
                'dias' => $row[3],
                'estatus' => $estatus
            );

        }

        pg_free_result($result);
        pg_close($conn);

        return json_encode($datos);

    }

    // mostrar lista de vacaciones
    function verVacaciones(){

        include '../core/conexion.php';

        $sql = "SELECT id, cedula, periodo1, periodo2 FROM reg_vacaciones ORDER BY id DESC LIMIT 5";

        $result = pg_query($conn, $sql);

        if(!$result){
            die('Fallo en la consulta');
        }

        $datos = array();

        $nro = 0;

        while ($row = pg_fetch_array($result)){ $nro++;
            
            $datos[] = array(
                'nro' => $nro,
                'id_vacaciones' => $row['id'],
                'cedula' => $row['cedula'],
                'periodo1' => $row['periodo1'],
                'periodo2' => $row['periodo2']
            );

        }

        pg_free_result($result);
        pg_close($conn);

        return json_encode($datos);

    }

    // Selects jerarquias
    function jerarquia(){

        include 'core/sigefirrhh.php';

        $sql = "SELECT id_cargo, descripcion_cargo FROM cargo ORDER BY descripcion_cargo";

        $result = pg_query($conexion, $sql);

        $html = "<option value=''>Jquia / Cargo...</option>";

        while ($row = pg_fetch_array($result)){

            $html.= "<option value='$row[0]'>".$row[1]."</option>";

        }

        pg_free_result($result);
        pg_close($conexion);

        return $html;
        
    }

    // Selects dependencias
    function dependencias(){

        include 'core/conexion.php';

        $sql = "SELECT id_dependencia, dependencia FROM dependencia ORDER BY dependencia";

        $result = pg_query($conn, $sql);

        $html = "<option value=''>Dependencia...</option>";

        while ($row = pg_fetch_array($result)){

            $html.= "<option value='$row[0]'>".$row[1]."</option>";

        }

        pg_free_result($result);
        pg_close($conn);

        return $html;
        
    }

    // Mostrar vacaciones disfrutadas
    function vacacionesDisfrutadas($cedula){

        include '../core/conexion.php';

        $sql = "SELECT cedula FROM reg_vacaciones WHERE cedula = $cedula";

        $result = pg_query($conn, $sql);

        $datos = array();

        while ($row = pg_fetch_array($result)){
            $datos[] = array(
                'civ' => $row[0]
            );
        }

        pg_free_result($result);
        pg_close($conn);

        return json_encode($datos);

    }