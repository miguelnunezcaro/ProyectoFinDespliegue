<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $apellido;
    public $token;

    public function __construct($email, $nombre, $apellido, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        // Crear el objeto email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c9bb1c528af23b';
        $mail->Password = '220980efbb1ddf';

        $mail->setFrom('appgym@gmail.com');
        $mail->addAddress('appgym@gmail.com', 'AppGym.com');
        $mail->Subject = 'Confirma tu cuenta';

        // SET HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p><img src="https://t4.ftcdn.net/jpg/03/50/81/89/360_F_350818949_lJTfzSTDr79e9Kn55PUVZjN19ct20uGc.jpg"></p>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . ' ' . $this->apellido . '</strong> has creado tu cuenta en AppGym solo
        debes confirmarla pinchando en el siguiente enlace</p>';
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmarCuenta?token=" . $this->token . "'>Confirmar 
        Cuenta</a> </p> ";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje.</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    }

    public function enviarInstrucciones() {
        // Crear el objeto email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c9bb1c528af23b';
        $mail->Password = '220980efbb1ddf';

        $mail->setFrom('appgym@gmail.com');
        $mail->addAddress('appgym@gmail.com', 'AppGym.com');
        $mail->Subject = 'Reestablece tu contraseña';

        // SET HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<p><img src="https://t4.ftcdn.net/jpg/03/50/81/89/360_F_350818949_lJTfzSTDr79e9Kn55PUVZjN19ct20uGc.jpg"></p>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . ' ' . $this->apellido . '</strong> has solicitado reestablecer 
        tu contraseña en AppGym, sigue el siguiente enlace para hacerlo</p>';
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Reestablecer 
        Contraseña</a> </p> ";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje.</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    }
}