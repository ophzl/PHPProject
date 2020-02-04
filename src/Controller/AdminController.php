<?php


namespace src\Controller;


use src\Model\Bdd;
use src\Model\User;

class AdminController extends AbstractController
{

    public function ApproveUser($UID){

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