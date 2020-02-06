<?php


namespace src\Controller;


use src\Model\Bdd;
use src\Model\User;
use src\Model\Article;

class AdminController extends AbstractController
{

    /**
     * @param $UID
     * Change User_Valid in SQL to 1, redirect to Admin#ListUser
     */
    public function ApproveUser($UID)
    {
        self::roleNeed();
        $bdd = Bdd::GetInstance();
        $query = $bdd->prepare('SELECT user_Valid FROM users WHERE user_UId =:UID');
        $query->execute(['UID' => $UID]);
        $Valid = $query->fetch();

        if ($Valid['user_Valid'] != 1) {
            $query = $bdd->prepare('UPDATE users SET user_Valid = 1 WHERE user_UId =:UID');
            $query->execute(['UID' => $UID]);
            header('Location:/Admin/ListUser');
        }
    }

    /**
     * @param $UID
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * Return Twig Render that prints ChangeRole form
     * CRSF-proof
     */
    public function ChangeRolesForm($UID)
    {
        self::roleNeed();
        $user = (new User)->SqlGet(Bdd::GetInstance(), $UID);
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        return $this->twig->render('Admin/changeroles.html.twig', [
            'token' => $token,
            'user' => $user
        ]);
    }

    /**
     * Update Roles in SQL, erase old roles
     * CRSF-proof
     */
    public function ChangeRoles()
    {
        self::roleNeed();
        if($_POST && $_POST['crsf'] == $_SESSION['token']) {

            $listRoles = '';
            foreach ($_POST['role'] as $role) {
                $listRoles .= $role . ',';
            }
            $user = (new User)->SqlGet(Bdd::GetInstance(), $_POST['userUID']);
            $user->setRole($listRoles);
            $user->SqlUpdate(Bdd::GetInstance());
        }
        header('Location:/Admin/ListUser');

    }

    /**
     * @param $UID
     * Delete User in SQL
     */
    public function DeleteUser($UID)
    {
        self::roleNeed();
        $query = Bdd::GetInstance()->prepare('DELETE FROM users where user_UId=:UID');
        $query->execute(['UID' => $UID]);
        header('Location:/Admin/ListUser');
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * Return Twig Render that prints all Users
     */
    public function ListUser()
    {
        self::roleNeed();
        $listUser = (new User)->SqlGetAll(Bdd::GetInstance());
        return $this->twig->render(
            'Admin/list.html.twig', [
                'userList' => $listUser
            ]
        );
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * Return Twig Render that prints all waiting articles
     */
    public function ListArticlesWaiting()
    {
        self::roleNeed();
        $listArticles = (new Article)->SqlGetAllWaiting(Bdd::GetInstance());
        return $this->twig->render(
            'Admin/articleswaiting.html.twig', [
                'articleList' => $listArticles
            ]
        );
    }

    /**
     * @param $ArticleId
     * Change User_Valid in SQL to 1, redirect to Admin#ListArticlesWaiting
     */
    public function ApproveArticle($ArticleId)
    {
        self::roleNeed();
        $bdd = Bdd::GetInstance();
        $query = $bdd->prepare('SELECT article_Valid FROM articles WHERE Id =:id');
        $query->execute(['id' => $ArticleId]);
        $Valid = $query->fetch();

        if ($Valid['article_Valid'] != 1) {
            $query = $bdd->prepare('UPDATE articles SET article_Valid = 1 WHERE Id =:id');
            $query->execute(['id' => $ArticleId]);
            header('Location:/Admin/ListArticlesWaiting');
        }
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * Return Twig Render that prints form to change CSS file of the blog
     * CRSF-proof
     */
    public function ChangeTheme()
    {
        self::roleNeed();
        header('Content-Type: text/html');
        if ($_POST && $_POST['crsf'] == $_SESSION['token']) {
            file_put_contents('./css/projet.css', $_POST['css']);
            header('Location:/Admin/ChangeTheme');
        }


        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        $CSS = file_get_contents('./css/projet.css');

        return $this->twig->render('Admin/changecss.html.twig', [
            'css' => $CSS,
            'token' => $token
        ]);

    }


    /**
     * Verify that USER.Roles in SESSION is "Admin"
     */
    public static function roleNeed()
    {
        if (isset($_SESSION['USER'])) {
            if (!in_array('admin', $_SESSION['USER']->getRole())) {
                $_SESSION['errorlogin'] = "Manque le role : Admin";
                header('Location:/Contact');
            }
        } else {
            $_SESSION['errorlogin'] = "Veuillez vous identifier";
            header('Location:/Login');
        }
    }
}