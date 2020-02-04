<?php


namespace src\Controller;


use src\Model\Bdd;
use src\Model\User;

class AdminController extends AbstractController
{

    public function ApproveUser($UID){
        $bdd = Bdd::GetInstance();
        $query = $bdd->prepare('SELECT user_Valid FROM users WHERE user_UId =:UID');
        $query->execute(['UID' => $UID]);
        $Valid = $query->fetch();

        if($Valid['user_Valid'] != 1) {
            $query = $bdd->prepare('UPDATE users SET user_Valid = 1 WHERE user_UId =:UID');
            $query->execute(['UID' => $UID]);
            header('Location:/Admin/ListUser');
        }
    }

    public function ChangeRolesForm($UID) {

    }

    public function ChangeRoles($UID) {

    }

    public function DeleteUser($UID) {

    }

    public function ListUser(){
        $listUser = (new User)->SqlGetAll(Bdd::GetInstance());
        return $this->twig->render(
            'Admin/list.html.twig', [
                'userList' => $listUser
            ]
        );
    }

}