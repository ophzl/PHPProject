<?php

namespace src\Controller;

use src\Model\Bdd;
use src\Model\User;

class UserController extends AbstractController
{

    public function loginForm()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        return $this->twig->render('User/login.html.twig', [
            'token' => $token
        ]);
    }

    public function loginCheck()
    {

        if($_POST && $_POST['crsf'] == $_SESSION['token']) {
            if (!filter_var(
                $_POST['Pass'],
                FILTER_VALIDATE_REGEXP,
                array(
                    "options" => array("regexp" => "/[a-zA-Z]{3,}/")
                )
            )) {
                $_SESSION['errorlogin'] = "Mot de passe trop court (3 caractères minimum)";
                header('Location:/Login');
                return;
            }

            if (!filter_var($_POST['Mail'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errorlogin'] = "Mail invalide";
                header('Location:/Login');
                return;
            }

            $bdd = Bdd::GetInstance();
            $password = $_POST['Pass'];

            $requete = $bdd->prepare("SELECT user_UId, user_Password FROM users WHERE user_Email =:Email");
            $requete->execute([
                'Email' => $_POST['Mail']]);
            $returnSQL = $requete->fetch();
            if (password_verify($password, $returnSQL['user_Password'])) {

                $user = new User();
                $user = $user->SqlGet(Bdd::GetInstance(), $returnSQL['user_UId']);


                $_SESSION['USER'] = $user;

                header('Location:/');
            } else {
                $_SESSION['errorlogin'] = "Erreur Authent.";
                header('Location:/Login');
            }
        }



    }

    public static function roleNeed($roleATester)
    {
        if (isset($_SESSION['USER'])) {
            if (!in_array($roleATester, $_SESSION['USER']->getRole())) {
                $_SESSION['errorlogin'] = "Manque le role : " . $roleATester;
                header('Location:/Contact');
            }
        } else {
            $_SESSION['errorlogin'] = "Veuillez vous identifier";
            header('Location:/Login');
        }
    }

    public function logout()
    {
        unset($_SESSION['USER']);
        unset($_SESSION['errorlogin']);
        header('Location:/');
    }


    public function RegisterForm()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        return $this->twig->render('User/register.html.twig', [
            'token' => $token
        ]);
    }

    public function RegisterCheck(){
        if($_POST && $_POST['crsf'] == $_SESSION['token']) {


            $bdd = Bdd::GetInstance();
            $password = password_hash($_POST['rPass'], PASSWORD_BCRYPT);

            $user = new User();
            $user->setName($_POST['rName'])
                ->setMail($_POST['rMail'])
                ->setPassword($password);

            $rSql = $user->SqlAdd($bdd);

            if($rSql['result']) {
                $user->setUID($rSql['message']);
                $_SESSION['USER'] = $user;
                header('Location:/');
            }
        }
    }

}