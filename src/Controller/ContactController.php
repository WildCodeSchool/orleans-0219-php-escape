<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 12/10/18
 * Time: 09:36
 */
namespace App\Controller;

use \Swift_SmtpTransport;
use \Swift_Mailer;
use \Swift_Message;

class ContactController extends AbstractController
{
    public function index()
    {
        $errors=[];
        $cleanPost=[];
        $mailSent="";
        $mailNotSent="";
        if (isset($_SESSION['mailSent']) && !empty($_SESSION['mailSent'])) {
            $mailSent=$_SESSION['mailSent'];
            unset($_SESSION['mailSent']);
        }
        if (isset($_SESSION['mailNotSent']) && !empty($_SESSION['mailNotSent'])) {
            $mailNotSent=$_SESSION['mailNotSent'];
            unset($_SESSION['mailNotSent']);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST as $key => $value) {
                $cleanPost[$key]=trim($value);
            }
            if ($_POST) {
                if (empty($cleanPost['lastName'])) {
                    $errors['lastName'] = 'Veuillez remplir le champ "Nom';
                }
                if (empty($cleanPost['firstName'])) {
                    $errors['firstName'] = 'Veuillez remplir le champ "Prénom"';
                }
                if (empty($cleanPost['email'])) {
                    $errors['email'] = 'Veuillez remplir le champ "E-mail"';
                }
                if (empty($cleanPost['message'])) {
                    $errors['message'] = 'Veuillez remplir le champ "Message"';
                }
                if (!preg_match("/^[a-zA-Z ]+$/", $cleanPost['lastName'])) {
                    $errors['lastName'] = 'Veuillez remplir le champ "Nom" avec des caractères valides';
                }
                if (!preg_match("/^[a-zA-Z ]+$/", $cleanPost['firstName'])) {
                    $errors['firstName'] = 'Veuillez remplir le champ "Prénom" avec des caractères valides';
                }
                if (!preg_match("(^[-\w\.]+@([-a-z0-9]+\.)+[a-z]{2,4}$)i", $cleanPost['email'])) {
                    $errors['email'] = 'Veuillez remplir le champ "E-mail" avec une adresse électronique valide';
                }
                if (strlen($cleanPost['lastName'])>30) {
                    $errors['lastName'] = 'Veuillez remplir le champ "Nom" avec 30 caractères maximum';
                }
                if (strlen($cleanPost['firstName'])>30) {
                    $errors['firstName'] = 'Veuillez remplir le champ "Prénom" avec 30 caractères maximum';
                }
                if (strlen($cleanPost['email'])>40) {
                    $errors['email'] = 'Veuillez remplir le champ "E-mail" avec 40 caractères maximum';
                }
                if (strlen($cleanPost['message'])>3000) {
                    $errors['message'] = 'Veuillez remplir le champ "Description" avec 3000 caractères maximum';
                }
                if (empty($errors)) {
                    try {
                        $transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
                            ->setUsername('escape.game.projet2@gmail.com')
                            ->setPassword('EscapeMail');
                        $mailer = new Swift_Mailer($transport);
                        $message = new Swift_Message();
                        $message->setSubject('Un message provenant de votre site Planète Mini Basket');
                        $message->setFrom([$cleanPost['email'] => 'sender name']);
                        $message->addTo('escape.game.projet2@gmail.com', 'recipient name');
                        $message->setBody("Nouveau message de ".$cleanPost['lastName']." ".$cleanPost['firstName']." 
                        ( ".$cleanPost['email']." ) : ".$cleanPost['message']);
                        $result = $mailer->send($message);
                        $_SESSION['mailSent'] = 'Message envoyé';
                    } catch (\Exception $e) {
                        $_SESSION['mailNotSent'] = $e->getMessage();
                    }
                    header('Location:/Contact/index');
                    exit();
                }
            }
        }
        return $this->twig->render('/Contact/index.html.twig', ['errors' => $errors, 'values' => $cleanPost,
            'mailSent' => $mailSent, 'mailNotSent' => $mailNotSent, 'active' => 'contact',
        ]);
    }
}
