<?php
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

/**
 * Description of PhpmailerUtil
 *
 * @author Abílio José G Ferreira
 */
class phpmailerUtil {

    public $mail;
    private $enviado;
    public $msg;

    function __construct() {
        // Inicia a classe PHPMailer
        $confEmail = new ConfigEmailClass();
        $this->mail = new PHPMailer(true);
        // Define os dados do servidor e tipo de conexão
        // Define que a mensagem será SMTP
        $this->mail->IsSMTP();
        // Ativar a depuração SMTP  0 = off (para uso em produção) * 1 = mensagens de cliente * 2 = cliente e servidor de mensagens
        $this->mail->SMTPDebug = $confEmail->getSMTPDebug();
        // Peça saída de depuração HTML-friendly
        $this->mail->Debugoutput = $confEmail->getDebugoutput();
        $this->mail->Host = $confEmail->getHost(); // Endereço do servidor SMTP   srv124.prodns.com.br  mail.coopnes.com
        $this->mail->Port = $confEmail->getPort(); // Definir o número da porta SMTP - provável que seja 25, 465 ou 587
        $this->mail->SMTPAuth = $confEmail->getSMTPAuth(); // Usa autenticação SMTP? (opcional)
        $this->mail->SMTPSecure = $confEmail->getSMTPSecure(); /* Protocolo da conexão */
        $this->mail->Username = $confEmail->getUsername(); // Usuário do servidor SMTP
        $this->mail->Password = $confEmail->getPassword(); // Senha do servidor SMTP
    }

    public function I_Remetente_Destinatários($address, $name, $opDestinatários, $Email, $Nome) {
        $confEmail = new ConfigEmailClass();
        if ($Email == null)
            $Email = $confEmail->getEmailDefault();
        if ($Nome == null)
            $Nome = $confEmail->getNomeDefault();
// Define os destinatário(s)
        if ($opDestinatários == 0) {
// Define o remetente
            $this->mail->setFrom($address, $name);
            $this->mail->AddAddress($Email, $Nome);
//$this->mail->AddAddress('');
//$this->mail->AddCC('', ''); // Copia
//$this->mail->AddBCC('', ''); // Cópia Oculta
        }
        if ($opDestinatários >= 1) {
// Define o remetente
            $this->mail->setFrom($Email, $Nome);
            $this->mail->AddAddress($address, $name);
//$this->mail->AddAddress('');
//$this->mail->AddCC('', ''); // Copia;
//$this->mail->AddBCC('', ''); // Cópia Oculta
        }
    }

    public function IIConfigMsg($isHTML) {
        // Define os dados técnicos da Mensagem
        $this->mail->IsHTML($isHTML); // Define que o e-mail será enviado como HTML
        $this->mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional) UTF-8 ou iso-8859-1
        $this->mail->setLanguage("br");
    }

    public function IIIDefineMensagem($assunto, $ITexto) {
        // Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $this->mail->Subject = $assunto; // Assunto da mensagem
        $this->mail->Body = $ITexto;
        $this->mail->AltBody = $ITexto . " \r\n ";
// Define os anexos (opcional)
//$this->mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
    }

    public function IVEnviar() {
// Envia o e-mail
        $this->enviado = $this->mail->send();
// Limpa os destinatários e os anexos
        $this->mail->ClearAllRecipients();
        $this->mail->ClearAttachments();
// Exibe uma mensagem de resultado
        if ($this->enviado) {
            return true;
        } else {
            $this->msg = "<b>Informações do erro:</b> <br />" . $this->mail->ErrorInfo;
            return FALSE;
        }
    }

}
