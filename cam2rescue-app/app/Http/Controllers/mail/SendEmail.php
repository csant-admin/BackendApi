<?php

namespace App\Http\Controllers\mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class SendEmail extends Controller
{
    //
    protected $mail;
    public function __construct() {
        $this->mail = new PHPMailer(true);
    }

    public function send(Request $request) {
        $email_data = $request->validate([
            'FromName' => 'required|string|max:100',
            'FromEmail' => 'required|email',
            'Content' => 'required|string',
        ]);
        try {
            //Server settings
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER; 
            $this->mail->isSMTP(); 
            $this->mail->Host       = 'smtp.gmail.com';
            $this->mail->SMTPAuth   = true; 
            $this->mail->Username   = 'cam2rescue@gmail.com';
            $this->mail->Password   = 'lwjl hjsj mjvm youg'; 
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mail->Port       = 465;

            //Recepients
            $this->mail->setFrom('cam2rescue@gmail.com', 'Cam2Rescue');
            $this->mail->addAddress('cam2rescue@gmail.com', 'Cam2Rescue');
            $this->mail->addReplyTo($email_data['FromEmail']);

            // Content
            $this->mail->isHTML(false);
            $this->mail->Subject = $request->Subject ?? 'Cam2Rescue App';
            $this->mail->Body    = $email_data['Content'] ?? 'No Message';

            // $this->mail->send();
            $isSend =  ($this->mail->send()) ? true : false;
            return $isSend ? 'PHPMailer: Message has been sent' : 'Failed to SEND THE EMAIL';
        } catch(Exception $e) {
            return "PHPMailer Error: {$this->mail->ErrorInfo}";
        }

    }
}
