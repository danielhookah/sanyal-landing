<?php

namespace App\Controllers;

use App\Entities\TranslationKeyEntity;
use Exception;
use Interop\Container\Exception\ContainerException;
use PHPMailer\PHPMailer\PHPMailer;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\{Request, Response};

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     * @throws ContainerException
     */
    public function index(Request $request, Response $response)
    {
        $langs = ['en', 'ru'];
        $lang = $request->getAttribute('lang');
        if (empty($lang) || !in_array($lang, $langs)) {
            return $this->getView()->render($response->withStatus(404), '404.html.twig');
        }

        $translation = $this->container->em->getRepository(TranslationKeyEntity::class)
            ->getLanguageTranslated($lang);
        if (empty($translation)) {
            return $this->getView()->render($response->withStatus(500), '404.html.twig');
        }

        $data = [
            'translation' => $translation
        ];

        return $this->getView()->render($response, 'pages/index.twig', $data);


        // Mailer
        /*
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'daniel.pysarenko@gmail.com';                     // SMTP username
            $mail->Password   = '';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('from@example.com', 'Test Mail');
            $mail->addAddress('ddaniel2308@gmail.com', 'Joe User');     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Mail title';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        $mail->ClearAddresses();
        $mail->ClearAttachments();
        */
    }

}