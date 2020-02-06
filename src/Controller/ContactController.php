<?php

namespace src\Controller;

use src\Model\Article;
use src\Model\Bdd;
use src\Model\User;

class ContactController extends AbstractController
{
    private $mailer;
    private $transport;

    /**
     * ContactController constructor.
     * Transport class is used to communicate with a service in order to deliver a message.
     */
    public function __construct()
    {
        parent::__construct();
        $this->transport = (new \Swift_SmtpTransport('smtp.mailtrap.io', 465))
            ->setUsername('f2bbe8e05f570f')
            ->setPassword('eed9336554ee00');
        $this->mailer = new \Swift_Mailer($this->transport);

    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     *
     * Form twig render
     */
    public function showForm()
    {
        return $this->twig->render('Contact/form.html.twig', [
            'mail' => 'admin@admin.fr'
        ]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     *
     * Function used to send email using SwiftMailer
     */
    public function sendMail()
    {
        $mail = (new \Swift_Message($_POST['Object']))
            ->setFrom($_SESSION['USER']->getMail())
            ->setTo($_POST['author-email'])
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

        header('Location:/');
    }

    /**
     * @param $idArticle
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     *
     * Function used to get article ID in order to send a mail from an article
     */
    public function formId($idArticle)
    {
        $article = new Article();
        $article = $article->SqlGet(Bdd::GetInstance(), $idArticle);
        $user = $article->getUser();

        return $this->twig->render('Contact/form.html.twig', [
            'article' => $article,
            'mail' => $user->getMail()
        ]);
    }
}
