<?php

namespace src\Controller;

use src\Model\Article;
use src\Model\Bdd;
use src\Model\User;

class ContactController extends AbstractController
{
    private $mailer;
    private $transport;

    public function __construct()
    {
        parent::__construct();
        $this->transport = (new \Swift_SmtpTransport('smtp.mailtrap.io', 465))
            ->setUsername('f2bbe8e05f570f')
            ->setPassword('eed9336554ee00');
        $this->mailer = new \Swift_Mailer($this->transport);

    }

    public function showForm()
    {
        return $this->twig->render('Contact/form.html.twig');
    }

    public function sendMail()
    {
        $mail = (new \Swift_Message($_POST['Object']))
            ->setFrom($_SESSION['USER']->getMail())
            ->setTo('SELECT email FROM * WHERE user_Name=$_POST["Auteur"]') // TODO: setTo email to author email
            ->setBody(
                $this->twig->render('Contact/mail.html.twig',
                    [
                        'message' => $_POST["Message"],
                        'user_email' => $_SESSION['USER']->getMail(),
                        'article' => $_POST['articleId']
                    ])
                , 'text/html'
            );

        $result = $this->mailer->send($mail);

        return $result;
    }

    public function formId($idArticle)
    {
        $article = new Article();
        $article = $article->SqlGet(Bdd::GetInstance(), $idArticle);

        return $this->twig->render('Contact/form.html.twig', [
            'article' => $article,
        ]);
    }
}
