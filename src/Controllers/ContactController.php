<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 5/2/2018
 * Time: 2:41 AM
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View22;
use App\Utility\Mail;


class ContactController extends Controller
{
//    const RECIEVER =
    /**
     * Show the index page
     */
    public function index(){
        $view = $this->renderer->render('contact.html', [
            'pageHeader' => 'Contact Us',
            'background' => 'about-banner'
        ]);
        $this->response->setContent($view);
        $this->response->send();
    }

    public function send(){
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $subject = strip_tags(trim($_POST["subject"]));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);

         $mail = new Mail();
         die();

        // Check that data was sent to the mailer.
        if ( empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        try{
            $this->sendMail($name, $email, $message, $subject);
            die('pihihoi');
        }catch (\Exception $exception){
            echo $exception->getMessage();
        }


    }

    protected function validateInput($inputField = array()){
        foreach ($inputField as $input){

        }
    }

    protected function sendMail($name, $email, $message, $contactSubject){
        $subject = 'New Contact Message On Eaglem Technologies';
        // Build the email content.
        $emailContent = "Name: $name\n";
        $emailContent .= "Subject: $contactSubject\n";
        $emailContent .= "Email: $email\n\n";
        $emailContent .= "Message:\n$message\n";

        // Build the email headers.
        $emailHeaders = "From: $name <$email>";

        if(!mail('osas006@yahoo.com', $subject, $emailContent,$emailHeaders)){
            throw new \Exception('message sending error');
        }
    }

}