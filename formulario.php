<?php
// echo json_encode(array(
//     'error' => false,
//     'campo' => 'exito'
// ));

//iset revisar si viene espacios o modificado
//empty revisar si viene vacio
//trim
//$usuario = trim(($_POST['usuarioN']));
// te puede dar error hasta por los ()

if ($_POST) {
    $usuario = "";
    $correo = "";
    $mensaje = "";

    if (isset($_POST['usuarioN'])) {
        $usuario = trim(($_POST['usuarioN']));
    }
    if (isset($_POST['correoN'])) {
        $correo = filter_var(trim(($_POST['correoN'])), FILTER_VALIDATE_EMAIL);
    }
    if (isset($_POST['mensajeN'])) {
        $mensaje = trim(($_POST['mensajeN']));
    }

    if (empty($usuario)) {
        echo json_encode(array(
            'error' => true,
            'campo' => 'usuario'
        ));
        return;
    }
    if (empty($correo)) {
        echo json_encode(array(
            'error' => true,
            'campo' => 'correo'
        ));
        return;
    }
    if (empty($mensaje)) {
        echo json_encode(array(
            'error' => true,
            'campo' => 'mensaje'
        ));
        return;
    }

    //cuerpo del mensaje
    $cuerpo = 'Usuario: ' . $usuario . '<br>';
    $cuerpo .= 'Email: ' . $correo . '<br>';
    $cuerpo .= 'Mensaje: ' . $mensaje . '<br>';

    //direccion
    $destinatario = 'italicdev@gmail.com';
    $asunto = 'Mensaje de mi sitio web';
    $headers = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=utf-8' . "\r\n" . 'From: ' . $correo . "\r\n";

    if (mail($destinatario, $asunto, $cuerpo, $headers)) {
        echo json_encode(array(
            'error' => false,
            'campo' => 'éxito'
        ));
    } else {
        echo json_encode(array(
            'error' => true,
            'campo' => 'mail'
        ));
    }
} else {
    echo json_encode(array(
        'error' => true,
        'campo' => 'post'
    ));
}
