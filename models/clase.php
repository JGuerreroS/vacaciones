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

    // Borrar vacaciones
    function borrarVacaciones($id_vacaciones){

        include '../core/conexion.php';

        $sql = "DELETE FROM reg_vacaciones WHERE id_vacaciones = $id_vacaciones";

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

        $sql = "SELECT v.cedula, primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido AS nombres, fecha_ingreso, periodo1||'-'||periodo2 AS periodo, fecha_desde, fecha_hasta, dias, dependencia, coordinacion, fecha_registro, id_vacaciones FROM reg_vacaciones v
        INNER JOIN personal p ON (v.cedula = p.cedula)
        INNER JOIN trabajador t ON (v.cedula = t.cedula)
        INNER JOIN dependencias d ON (v.id_dependencia = d.id_dependencia)
        LEFT JOIN coordinaciones c ON (v.id_coordinacion = c.id_coordinacion)
        WHERE id_vacaciones = $id_vacacion";

        $result = pg_query($conn, $sql);

        if(!$result){
            die('Fallo en la consulta');
        }

        $datos = array();

        while ($row = pg_fetch_array($result)){

            $datos[] = array(
                'cedula' => $row[0],
                'nombres' => $row[1],
                'fecha_ingreso' => str_replace('-', '/', date('d-m-Y', strtotime($row[2]))),
                'periodo' => $row[3],
                'fecha_desde' => str_replace('-', '/', date('d-m-Y', strtotime($row[4]))),
                'fecha_hasta' => str_replace('-', '/', date('d-m-Y', strtotime($row[5]))),
                'dias' => $row[6],
                'dependencia' => $row[7],
                'coordinacion' => $row[8],
                'fecha_registro' => str_replace('-', '/', date('d-m-Y', strtotime($row[9]))),
                'id_vacaciones' => $row[10]
            );

        }

        pg_free_result($result);
        pg_close($conn);

        return json_encode($datos[0]);
    
    }

    // mostrar lista dependencias
    function verDependencias(){

        include '../core/conexion.php';

        $sql = "SELECT id_dependencia, dependencia FROM dependencias ORDER BY dependencia";

        $result = pg_query($conn, $sql);

        if(!$result){
            die('Fallo en la consulta');
        }

        $datos = array();

        $nro = 0;

        while ($row = pg_fetch_array($result)){ $nro++;
            
            $datos[] = array(
                'nro' => $nro,
                'id_dependencia' => $row['id_dependencia'],
                'dependencia' => $row['dependencia']
            );

        }

        pg_free_result($result);
        pg_close($conn);

        return json_encode($datos);

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

        $sql = "SELECT p.cedula, id_cargo, primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido AS nombres, estatus, fecha_ingreso, tp.id_tipo_personal, nombre FROM personal p
        INNER JOIN trabajador t ON (p.id_personal = t.id_personal)
	    INNER JOIN tipopersonal tp ON (t.id_tipo_personal = tp.id_tipo_personal)
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
    function contarAdmin(){
        include 'core/conexion.php';
        $sql = "SELECT count(id_usuario) FROM users WHERE id_estatus = 1 AND id_rol = 1";
        $result = pg_query($conn,$sql);
        $total= pg_fetch_array($result);
        pg_free_result($result);
        pg_close($conn);
        return $total[0];
    }

    // Vacaciones
    function contarAnalist(){
        include 'core/conexion.php';
        $sql = "SELECT count(id_usuario) FROM users WHERE id_estatus = 1 AND id_rol = 2";
        $result = pg_query($conn,$sql);
        $total= pg_fetch_array($result);
        pg_free_result($result);
        pg_close($conn);
        return $total[0];
    }

    // Vacaciones
    function graficaRegistros(){

        include '../../../core/conexion.php';

        $sql = "SELECT date_part('year',fecha_registro) AS fecha, COUNT(fecha_registro) FROM reg_vacaciones
        WHERE date_part('year',fecha_registro) > 2010
        GROUP BY fecha ORDER BY fecha";

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

    // Registrar usuarios
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

    // Registrar usuarios
    function registrarVacaciones($datos){

        session_start();
        
        include '../core/conexion.php';

        $periodo = explode("-", $datos['periodo']);

        $sql = "INSERT INTO reg_vacaciones (cedula, id_cargo, id_tipo_personal, estatus, jefe, id_dependencia, id_coordinacion, fecha_desde, fecha_hasta, periodo1, periodo2, dias, observacion, fecha_registro, usuario) VALUES ($datos[cedula], $datos[jquia], $datos[tipopersonal], '$datos[estatus]', $datos[jefe], $datos[dependencia], $datos[coordinacion], '$datos[fechaInicio]', '$datos[fechaFin]', $periodo[0], $periodo[1], $datos[dias], '$datos[observacion]', '$fecha', $_SESSION[usuario])";

        $result = pg_query($conn, $sql);

        if(!$result){

            return $sql;
            die('Error al registrar');

        }else{

            pg_free_result($result);
            pg_close($conn);

            return 2;

        }

    }

    // Mostrar lista de vacaciones en el módulo registro
    function mostrarVacaciones($cedula){

        include '../core/conexion.php';

        $sql = "SELECT id_vacaciones, periodo1||'-'||periodo2 AS periodo, fecha_desde, fecha_hasta, dias, id_an_suspension, cedula FROM reg_vacaciones WHERE cedula = $cedula";

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
                'id_vacaciones' => $row[0],
                'periodo' => $row[1],
                'desde' => str_replace('-', '/', date('d-m-Y', strtotime($row[2]))),
                'hasta' => str_replace('-', '/', date('d-m-Y', strtotime($row[3]))),
                'dias' => $row[4],
                'estatus' => $estatus,
                'cedula' => $row[6]
            );

        }

        pg_free_result($result);
        pg_close($conn);

        return json_encode($datos);

    }

    // Mostrar datos en el oficio de notificación de aprobación de vacaciones
    function oficioVacaciones($id_vac){

        include 'core/conexion.php';

        $sql = "SELECT c.cargo||' '||primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido AS nombres, dependencia,
        periodo1||'-'||periodo2 AS periodo, dias, (SELECT nombres||' '||apellidos AS director FROM director_rrhh WHERE estatus = 'A'), (SELECT cargo FROM director_rrhh WHERE estatus = 'A')
        FROM reg_vacaciones r
        INNER JOIN cargos c ON (r.id_cargo = c.id_cargo)
        INNER JOIN personal p ON (r.cedula = p.cedula)
        INNER JOIN dependencias d ON (r.id_dependencia = d.id_dependencia)
        WHERE id_vacaciones = $id_vac";

        $result = pg_query($conn,$sql);
        
        $row = pg_fetch_array($result);

        pg_free_result($result);
        pg_close($conn);

        return $row;

    }

    // mostrar lista de vacaciones en el módulo buscar
    function verVacaciones($parametro,$tipo){

        switch ($tipo){

            case 'cedula':

                include '../core/conexion.php';

                $sql = "SELECT id_vacaciones, v.cedula, primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido AS nombres, periodo1||'-'||periodo2 AS periodo, dependencia FROM
                reg_vacaciones v
                INNER JOIN personal p ON (v.cedula = p.cedula)
                INNER JOIN dependencias d ON (v.id_dependencia = d.id_dependencia)
                WHERE v.cedula = $parametro";

                $result = pg_query($conn, $sql);

                if(!$result){
                    die('Fallo en la consulta');
                }

                $datos = array();

                $nro = 0;

                while ($row = pg_fetch_array($result)){ $nro++;
                    
                    $datos[] = array(
                        'nro' => $nro,
                        'id_vacaciones' => $row['id_vacaciones'],
                        'cedula' => $row['cedula'],
                        'nombres' => $row['nombres'],
                        'periodo' => $row['periodo'],
                        'dependencia' => $row['dependencia']
                    );

                }

                pg_free_result($result);
                pg_close($conn);

                return json_encode($datos);

            break;

            case 'fecha_registro':

                include '../core/conexion.php';

                $sql = "SELECT id_vacaciones, v.cedula, primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido AS nombres, periodo1||'-'||periodo2 AS periodo, dependencia FROM
                reg_vacaciones v
                INNER JOIN personal p ON (v.cedula = p.cedula)
                INNER JOIN dependencias d ON (v.id_dependencia = d.id_dependencia)
                WHERE fecha_registro = '$parametro'";

                $result = pg_query($conn, $sql);

                if(!$result){
                    die('Fallo en la consulta');
                }

                $datos = array();

                $nro = 0;

                while ($row = pg_fetch_array($result)){ $nro++;
                    
                    $datos[] = array(
                        'nro' => $nro,
                        'id_vacaciones' => $row['id_vacaciones'],
                        'cedula' => $row['cedula'],
                        'nombres' => $row['nombres'],
                        'periodo' => $row['periodo'],
                        'dependencia' => $row['dependencia']
                    );

                }

                pg_free_result($result);
                pg_close($conn);

                return json_encode($datos);

            break;
            
        }

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

        $sql = "SELECT id_dependencia, dependencia FROM dependencias ORDER BY dependencia";

        $result = pg_query($conn, $sql);

        $html = "<option value=''>Dependencia...</option>";

        while ($row = pg_fetch_array($result)){

            $html.= "<option value='$row[0]'>".$row[1]."</option>";

        }

        pg_free_result($result);
        pg_close($conn);

        return $html;
        
    }

    // Selects dependencias
    function coordinaciones($id_dependencia){

        include '../core/conexion.php';

        $sql = "SELECT id_coordinacion, coordinacion FROM coordinaciones WHERE id_dependencia = $id_dependencia ORDER BY coordinacion";

        $result = pg_query($conn, $sql);

        $html = "<option value=''>Coordinación...</option>";

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