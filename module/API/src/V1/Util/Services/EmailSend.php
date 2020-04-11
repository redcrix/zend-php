<?php

namespace API\V1\Util\Services;

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Serviço de envio de e-mails
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, Useful
 * @version 1.0.0
 */
class EmailSend {

    private $config;

    public function __construct($config = []) {
        $this->config = $config;
    }

    /**
     * Envia e-mails utilizando uma conta SMTP
     * @param stdClass $email
     * @return string
     */
    public function send($email) {
        set_time_limit(0);
        $mail = new PHPMailer();
        $mail->Timeout = 3600;
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP();
        $mail->SMTPDebug = 2;
        $mail->SMTPAuth = $this->config['SMTP']['auth'];
        $mail->SMTPSecure = $this->config['SMTP']['tipo'];
        
        $mail->Host = $this->config['SMTP']['host'];
        
        #A porta 587 deverá estar aberta em seu servidor
        $mail->Port = $this->config['SMTP']['port']; 
        $mail->Username = $this->config['SMTP']['username'];
        $mail->Password = $this->config['SMTP']['password'];

        $mail->SetFrom($this->config['SMTP']['email'], $this->config['SMTP']['nome']);
        $mail->Subject = $email->titulo;
        $mail->IsHTML(true);
        $mail->Body = $email->mensagem;
        $mail->AddAddress($email->destino);

        if (!$mail->Send()) {
            $error = date('d-m-Y h:i:s') . '-> Mail error: ' . $mail->ErrorInfo . "\n";
            \file_put_contents($this->config['SMTP']['logdir'] . 'log-email.txt', $error, \FILE_APPEND);
            return $error;
        } else {
            return 'Mensagem enviada!';
        }
    }

}
