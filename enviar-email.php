<?php
use C:\Users\SECT\Desktop\PHPMailer-master\PHPMailer-master;
use PHPMailer\PHPMailer\Exception;

require 'caminho/para/PHPMailer/Exception.php';
require 'caminho/para/PHPMailer/PHPMailer.php';
require 'caminho/para/PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifique se todos os campos foram preenchidos
    if (isset($_POST["rgDec"]) && isset($_POST["nmDec"]) && isset($_POST["telDec"]) && isset($_POST["emailDec"])) {

        // Dados do formulário
        $rgDec = $_POST["rgDec"];
        $nomeDec = $_POST["nmDec"];
        $telefoneDec = $_POST["telDec"];
        $emailDec = $_POST["emailDec"];

        // Configurações do servidor de e-mail
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'servidor_de_smtp';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'seu_email@example.com';
        $mail->Password = 'sua_senha';
        $mail->SMTPSecure = 'tls';

        // Remetente
        $mail->setFrom($emailDec);
        $mail->addReplyTo($emailDec);

        // Destinatário
        $mail->addAddress('seu_email@example.com');

        // Assunto do e-mail
        $mail->Subject = 'Formulário de Reanny Miranda';

        // Conteúdo do e-mail
        $mail->Body = "RG: " . $rgDec . "\n";
        $mail->Body .= "Nome completo: " . $nomeDec . "\n";
        $mail->Body .= "Telefone para contato: " . $telefoneDec . "\n";
        $mail->Body .= "E-mail: " . $emailDec . "\n";

        try {
            // Enviar o e-mail
            $mail->send();
            
            // Redirecionar para uma página de sucesso
            header("Location: dec-sucesso.html");
            exit();
        } catch (Exception $e) {
            // Redirecionar para uma página de erro, caso ocorra algum erro no envio do e-mail
            header("Location: dec-erro.html");
            exit();
        }
    } else {
        // Redirecionar para uma página de erro, caso algum campo não tenha sido preenchido
        header("Location: dec-erro.html");
        exit();
    }
}
?>
