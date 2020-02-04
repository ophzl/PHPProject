<?php


namespace src\Controller;


use src\Model\Bdd;
use src\Model\User;
use src\Model\Article;

class AdminController extends AbstractController
{

    public function ApproveUser($UID)
    {
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

    public function ChangeRolesForm($UID) {
        $user = (new User)->SqlGet(Bdd::GetInstance(), $UID);
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        return $this->twig->render('Admin/changeroles.html.twig', [
            'token' => $token,
            'user' => $user
        ]);
    }

    public function ChangeRoles() {
        $listRoles = '';
        foreach ($_POST['role'] as $role){
            $listRoles .= $role.',';
        }
        $user = (new User)->SqlGet(Bdd::GetInstance(), $_POST['userUID']);
        $user->setRole($listRoles);
        $user->SqlUpdate(Bdd::GetInstance());
        header('Location:/Admin/ListUser');

    }

    public function DeleteUser($UID)
    {

    }

    public function ListUser()
    {
        $listUser = (new User)->SqlGetAll(Bdd::GetInstance());
        return $this->twig->render(
            'Admin/list.html.twig', [
                'userList' => $listUser
            ]
        );
    }

    public function ListArticles()
    {
        $listArticles = (new Article)->SqlGetAll(Bdd::GetInstance());
        return $this->twig->render(
            'Admin/articles.html.twig', [
                'articleList' => $listArticles
            ]
        );
    }

    public function ApproveArticle($ArticleId)
    {
        $bdd = Bdd::GetInstance();
        $query = $bdd->prepare('SELECT article_Valid FROM articles WHERE articleId =:id');
        $query->execute(['ArcicleId' => $ArticleId]);
        $Valid = $query->fetch();

        if ($Valid['article_Valid'] != 1) {
            $query = $bdd->prepare('UPDATE article_Valid SET article_Valid = 1 WHERE articleId =:id');
            $query->execute(['ArticleId' => $ArticleId]);
            header('Location:/Admin/ListArticles');
        }
    }

}