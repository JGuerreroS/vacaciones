<?php

// Inicio de sesión
function login($user, $pass){

    include '../core/conexion.php';

    $sql = "SELECT id_usuario, nombres, cedula, clave, id_rol, iniciales FROM users WHERE cedula = '$user' AND id_estatus=1";

    $result = pg_query($conn, $sql);

    $row = pg_fetch_assoc($result);

    $hash = $row['clave'];

    if (password_verify($pass, $hash)) {

        session_start();

        $_SESSION['name'] = $row['nombres'];
        $_SESSION['usuario'] = $row['id_usuario'];
        $_SESSION['nivel'] = $row['id_rol'];
        $_SESSION['iniciales'] = $row['iniciales'];

        pg_free_result($result);
        pg_close($conn);

        return true;
    } else {

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

    if (!$result) {

        die('Error en la consulta');
        return 2;
    } else {

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

    if (!$result) {

        die('Error en la consulta');

        return 1;
    } else {

        pg_free_result($result);
        pg_close($conn);

        return 2;
    }
}

// Borrar vacaciones
function borrarVacaciones($id_vacaciones, $id_motivo){

    session_start();

    if ($_SESSION['nivel'] == 1) {

        include '../core/conexion.php';

        $sql1 = "DELETE FROM reg_vacaciones WHERE id_vacaciones = $id_vacaciones";
        $sql2 = "UPDATE eliminadas SET motivo = $id_motivo, fecha_eliminado = '$fecha' WHERE motivo = 4";

        $result1 = pg_query($conn, $sql1);
        $result2 = pg_query($conn, $sql2);

        if (!$result1) {

            die('No se pudo eliminar el registro');

            return 1;

            if (!$result2) {

                die('No se pudo actualizar el registro');

                return 1;
            }
        } else {

            pg_free_result($result1);
            pg_free_result($result2);
            pg_close($conn);

            return 2;
        }

    }else{

        return 3;

    }

}

// ver más del usuario
function zoomUsuario($usuario){

    include '../core/conexion.php';

    $sql = "SELECT cedula, nombres, id_rol, id_estatus, fecha, id_usuario FROM users WHERE id_usuario = $usuario";

    $result = pg_query($conn, $sql);

    if (!$result) {
        die('Fallo en la consulta');
    }

    $datos = array();

    while ($row = pg_fetch_array($result)) {

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

// ver detalles de las vacaciones en la vista de buscar
function zoomVacacion($id_vacacion){

    include '../core/conexion.php';

    $sql = "SELECT v.cedula, primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido AS nombres, fecha_ingreso, periodo1||'-'||periodo2 AS periodo, fecha_desde, fecha_hasta, dias, dependencia, coordinacion, fecha_registro, id_vacaciones FROM reg_vacaciones v
        INNER JOIN personal p ON (v.cedula = p.cedula)
        INNER JOIN trabajador t ON (v.cedula = t.cedula)
        INNER JOIN dependencias d ON (v.id_dependencia = d.id_dependencia)
        LEFT JOIN coordinaciones c ON (v.id_coordinacion = c.id_coordinacion)
        WHERE id_vacaciones = $id_vacacion";

    $result = pg_query($conn, $sql);

    if (!$result) {
        die('Fallo en la consulta');
    }

    $datos = array();

    while ($row = pg_fetch_array($result)) {

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

// Suspender vacaciones
function suspenderVac($id_vacacion,$motivo){

    include '../core/conexion.php';

    $sql = "UPDATE reg_vacaciones SET estatus = 'S', observacion = '$motivo' WHERE id_vacaciones = $id_vacacion";

    $result = pg_query($conn, $sql);

    if (!$result) {
        die('Fallo en la consulta');
    }

    pg_free_result($result);
    pg_close($conn);

    return true;

}

// ver detalles de las vacaciones en la vista de registrar
function zoomVacacion2($id_vacacion){

    include '../core/conexion.php';

    $sql = "SELECT v.cedula, primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido AS nombres, fecha_ingreso, periodo1||'-'||periodo2 AS periodo, fecha_desde, fecha_hasta, dias, dependencia, coordinacion, fecha_registro, id_vacaciones FROM reg_vacaciones v
        INNER JOIN personal p ON (v.cedula = p.cedula)
        INNER JOIN trabajador t ON (v.cedula = t.cedula)
        INNER JOIN dependencias d ON (v.id_dependencia = d.id_dependencia)
        LEFT JOIN coordinaciones c ON (v.id_coordinacion = c.id_coordinacion)
        WHERE id_vacaciones = $id_vacacion";

    $result = pg_query($conn, $sql);

    if (!$result) {
        die('Fallo en la consulta');
    }

    $datos = array();

    while ($row = pg_fetch_array($result)) {

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

    if (!$result) {
        die('Fallo en la consulta');
    }

    $datos = array();

    $nro = 0;

    while ($row = pg_fetch_array($result)) {
        $nro++;

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

    if (!$result) {
        die('Fallo en la consulta');
    }

    $datos = array();

    $nro = 0;

    while ($row = pg_fetch_array($result)) {
        $nro++;

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

// mostrar lista de usuarios
function estisticasUsuarios(){

    include '../core/conexion.php';

    $sql = "SELECT nombres, COUNT(usuario) FROM reg_vacaciones v
    INNER JOIN users u ON (v.usuario = u.id_usuario)
    WHERE usuario > 40 GROUP BY nombres ORDER BY count DESC;";

    $result = pg_query($conn, $sql);

    if (!$result) {
        die('Fallo en la consulta');
    }

    $datos = array();

    $nro = 0;

    while ($row = pg_fetch_array($result)) {
        $nro++;

        $datos[] = array(
            'nro' => $nro,
            'nombres' => $row['nombres'],
            'estatus' => $row['count']
        );
    }

    pg_free_result($result);
    pg_close($conn);

    return json_encode($datos);
}

// Buscar funcionario en el sigefirrhh
function buscarEnSigefirrhh($cedula){

    include '../core/sigefirrhh.php';

    $sql = "SELECT DISTINCT p.cedula, id_cargo, primer_nombre||' '||primer_apellido AS nombres, estatus, fecha_ingreso, tp.id_tipo_personal, nombre FROM personal p
    INNER JOIN trabajador t ON (p.id_personal = t.id_personal)
    INNER JOIN tipopersonal tp ON (t.id_tipo_personal = tp.id_tipo_personal)
    WHERE p.cedula = $cedula AND estatus = 'A'";

    $result = pg_query($conexion, $sql);

    $count = pg_num_rows($result);

    if (!$result) {
        die('Consulta fallida');
    }

    if($count == 0){
        return json_encode(1);
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
    $result = pg_query($conn, $sql);
    $total = pg_fetch_array($result);
    pg_free_result($result);
    pg_close($conn);
    return $total[0];
}

// Vacaciones
function contarAnalist(){
    include 'core/conexion.php';
    $sql = "SELECT count(id_usuario) FROM users WHERE id_estatus = 1 AND id_rol = 2";
    $result = pg_query($conn, $sql);
    $total = pg_fetch_array($result);
    pg_free_result($result);
    pg_close($conn);
    return $total[0];
}

// Vacaciones
function graficaRegistros(){

    include '../../../core/conexion.php';

    // Linea 1
    $sql1 = "SELECT date_part('month',fecha_registro) AS fecha, COUNT(fecha_registro) FROM reg_vacaciones
    WHERE date_part('year',fecha_registro) = 2019 GROUP BY fecha ORDER BY fecha";

    $res1 = pg_query($conn, $sql1);

    $valX1 = array(); // Fecha
    $valY1 = array(); // ID

    while ($row = pg_fetch_array($res1)){
        switch ($row[0]) {
            case '1':
                $mes = "Enero";
                break;
            case '2':
                $mes = "Febrero";
                break;
            case '3':
                $mes = "Marzo";
                break;
            case '4':
                $mes = "Abril";
                break;
            case '5':
                $mes = "Mayo";
                break;
            case '6':
                $mes = "Junio";
                break;
            case '7':
                $mes = "Julio";
                break;
            case '8':
                $mes = "Agosto";
                break;
            case '9':
                $mes = "Septiembre";
                break;
            case '10':
                $mes = "Octubre";
                break;
            case '11':
                $mes = "Noviembre";
                break;
            case '12':
                $mes = "Diciembre";
                break;
            
        }
        $valX1[] = $mes; //Fecha
        $valY1[] = $row[1]; // Total
    }

    $datosX1 = json_encode($valX1);
    $datosY1 = json_encode($valY1);

    // Linea 2
    $sql2 = "SELECT date_part('month',fecha_registro) AS fecha, COUNT(fecha_registro) FROM reg_vacaciones
    WHERE date_part('year',fecha_registro) = 2019 AND estatus = 'S' GROUP BY fecha ORDER BY fecha";

    $res2 = pg_query($conn, $sql2);

    $valX2 = array(); // Fecha
    $valY2 = array(); // ID

    while ($row = pg_fetch_array($res2)){
        switch ($row[0]) {
            case '1':
                $mes = "Enero";
                break;
            case '2':
                $mes = "Febrero";
                break;
            case '3':
                $mes = "Marzo";
                break;
            case '4':
                $mes = "Abril";
                break;
            case '5':
                $mes = "Mayo";
                break;
            case '6':
                $mes = "Junio";
                break;
            case '7':
                $mes = "Julio";
                break;
            case '8':
                $mes = "Agosto";
                break;
            case '9':
                $mes = "Septiembre";
                break;
            case '10':
                $mes = "Octubre";
                break;
            case '11':
                $mes = "Noviembre";
                break;
            case '12':
                $mes = "Diciembre";
                break;
        }
        $valX2[] = $mes; //Fecha
        $valY2[] = $row[1]; // Total
    }

    $datosX2 = json_encode($valX2);
    $datosY2 = json_encode($valY2);

    pg_free_result($res1);
    pg_free_result($res2);
    pg_close($conn);

    return array($datosX1, $datosY1, $datosX2, $datosY2);

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

    $sql = "INSERT INTO users (id_rol, cedula, nombres, registrado_por, fecha, clave, id_estatus, iniciales) VALUES ($datos[privilegio], '$datos[civ]', '$datos[nombres]', $_SESSION[usuario], '$fecha','$passHash', 1, '$datos[iniciales]')";

    $result = pg_query($conn, $sql);

    if (!$result) {

        die('Error al tratar de registrar');
        
    } else {

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

    $codigo = codigo(10);

    $sql = "INSERT INTO reg_vacaciones (cedula, id_cargo, id_tipo_personal, estatus, jefe, id_dependencia, id_coordinacion, fecha_desde, fecha_hasta, periodo1, periodo2, dias, observacion, fecha_registro, usuario, codigo) VALUES ($datos[cedula], $datos[jquia], $datos[tipopersonal], '$datos[estatus]', $datos[jefe], $datos[dependencia], $datos[coordinacion], '$datos[fechaInicio]', '$datos[fechaFin]', $periodo[0], $periodo[1], $datos[dias], '$datos[observacion]', '$fecha', $_SESSION[usuario], $codigo)";

    $result = pg_query($conn, $sql);

    if (!$result) {

        return $sql;
        die('Error al registrar');
    } else {

        pg_free_result($result);
        pg_close($conn);

        return 2;
    }

}

function codigo($length){
    $key = "";
    $pattern = "1234567890ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    $max = strlen($pattern)-1;
    for ($i=0; $i < $length; $i++){ 
        $key .= $pattern{mt_rand(0,$max)};
        return $key;
    }
}

// Mostrar lista de vacaciones en el módulo registro
function mostrarVacaciones($cedula){

    include '../core/conexion.php';

    $sql = "SELECT id_vacaciones, periodo1||'-'||periodo2 AS periodo, fecha_desde, fecha_hasta, dias, estatus, cedula FROM reg_vacaciones WHERE cedula = $cedula";

    $result = pg_query($conn, $sql);

    if (!$result) {
        die('Fallo en la consulta');
    }

    $datos = array();

    $nro = 0;

    while ($row = pg_fetch_array($result)) {
        $nro++;

        if ($row[5] == 'A') {
            $estatus = 'Disfrutadas';
        } else {
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

    $sql = "SELECT c.cargo||'. '||primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido||'. C.I.V-'||r.cedula AS nombres, dependencia, periodo1||'-'||periodo2 AS periodo, dias, (SELECT nombres||' '||apellidos AS director FROM director_rrhh WHERE estatus = 'A'), (SELECT cargo FROM director_rrhh WHERE estatus = 'A'), (SELECT iniciales FROM director_rrhh WHERE estatus = 'A') AS iniciales_rrhh, (SELECT iniciales FROM director_cpnb WHERE estatus = 'A') AS iniciales_cpnb, fecha_desde, fecha_hasta
    FROM reg_vacaciones r
    INNER JOIN cargos c ON (r.id_cargo = c.id_cargo)
    INNER JOIN personal p ON (r.cedula = p.cedula)
    INNER JOIN dependencias d ON (r.id_dependencia = d.id_dependencia)
    WHERE id_vacaciones = $id_vac";

    $result = pg_query($conn, $sql);

    $row = pg_fetch_array($result);

    pg_free_result($result);
    pg_close($conn);

    return $row;
}

function oficioVacaciones2($dependencia, $date)
{

    include 'core/conexion.php';

    $sql = "SELECT c.cargo||'. '||primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido||'. C.I.V-'||r.cedula AS nombres, dependencia, periodo1||'-'||periodo2 AS periodo, dias, (SELECT nombres||' '||apellidos AS director FROM director_rrhh WHERE estatus = 'A'), (SELECT cargo FROM director_rrhh WHERE estatus = 'A'), (SELECT iniciales FROM director_rrhh WHERE estatus = 'A') AS iniciales_rrhh, (SELECT iniciales FROM director_cpnb WHERE estatus = 'A') AS iniciales_cpnb, fecha_desde, fecha_hasta
    FROM reg_vacaciones r
    INNER JOIN cargos c ON (r.id_cargo = c.id_cargo)
    INNER JOIN personal p ON (r.cedula = p.cedula)
    INNER JOIN dependencias d ON (r.id_dependencia = d.id_dependencia)
    WHERE r.id_dependencia = $dependencia AND fecha_registro = '$date'";

    $result = pg_query($conn, $sql);

    if (!$result) {

        die('Consulta fallida');
    }

    return $result;
    
}

// mostrar lista de vacaciones en el módulo buscar
function verVacaciones($parametro, $tipo)
{

    switch ($tipo) {

        case 'cedula':

            include '../core/conexion.php';

            $sql = "SELECT id_vacaciones, v.cedula, primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido AS nombres, periodo1||'-'||periodo2 AS periodo, dependencia FROM
                reg_vacaciones v
                INNER JOIN personal p ON (v.cedula = p.cedula)
                INNER JOIN dependencias d ON (v.id_dependencia = d.id_dependencia)
                WHERE v.cedula = $parametro";

            $result = pg_query($conn, $sql);

            if (!$result) {
                die('Fallo en la consulta');
            }

            $datos = array();

            $nro = 0;

            while ($row = pg_fetch_array($result)) {
                $nro++;

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

            if (!$result) {
                die('Fallo en la consulta');
            }

            $datos = array();

            $nro = 0;

            while ($row = pg_fetch_array($result)) {
                $nro++;

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

        case 'dependencia_fecha':

            include '../core/conexion.php';

            $divide = explode('/', $parametro);

            $sql = "SELECT id_vacaciones, v.cedula, primer_nombre||' '||segundo_nombre||' '||primer_apellido||' '||segundo_apellido AS nombres, periodo1||'-'||periodo2 AS periodo, dependencia FROM reg_vacaciones v
                INNER JOIN personal p ON (v.cedula = p.cedula)
                INNER JOIN dependencias d ON (v.id_dependencia = d.id_dependencia)
                WHERE v.id_dependencia = $divide[0] AND fecha_registro = '$divide[1]'";

            $result = pg_query($conn, $sql);

            if (!$result) {
                die('Fallo en la consulta');
            }

            $datos = array();

            $nro = 0;

            while ($row = pg_fetch_array($result)) {
                $nro++;

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
function jerarquia()
{

    include 'core/sigefirrhh.php';

    $sql = "SELECT id_cargo, descripcion_cargo FROM cargo ORDER BY descripcion_cargo";

    $result = pg_query($conexion, $sql);

    $html = "<option value=''>Jquia / Cargo...</option>";

    while ($row = pg_fetch_array($result)) {

        $html .= "<option value='$row[0]'>" . $row[1] . "</option>";
    }

    pg_free_result($result);
    pg_close($conexion);

    return $html;
}

// Selects dependencias
function dependencias()
{

    include 'core/conexion.php';

    $sql = "SELECT id_dependencia, dependencia FROM dependencias ORDER BY dependencia";

    $result = pg_query($conn, $sql);

    $html = "<option value=''>Dependencia...</option>";

    while ($row = pg_fetch_array($result)) {

        $html .= "<option value='$row[0]'>" . $row[1] . "</option>";
    }

    pg_free_result($result);
    pg_close($conn);

    return $html;
}

// Selects dependencias
function coordinaciones($id_dependencia)
{

    include '../core/conexion.php';

    $sql = "SELECT id_coordinacion, coordinacion FROM coordinaciones WHERE id_dependencia = $id_dependencia ORDER BY coordinacion";

    $result = pg_query($conn, $sql);

    $html = "<option value=''>Coordinación...</option>";

    while ($row = pg_fetch_array($result)) {

        $html .= "<option value='$row[0]'>" . $row[1] . "</option>";
    }

    pg_free_result($result);
    pg_close($conn);

    return $html;
}

// Mostrar vacaciones disfrutadas
function vacacionesDisfrutadas($cedula)
{

    include '../core/conexion.php';

    $sql = "SELECT cedula FROM reg_vacaciones WHERE cedula = $cedula";

    $result = pg_query($conn, $sql);

    $datos = array();

    while ($row = pg_fetch_array($result)) {
        $datos[] = array(
            'civ' => $row[0]
        );
    }

    pg_free_result($result);
    pg_close($conn);

    return json_encode($datos);
}
