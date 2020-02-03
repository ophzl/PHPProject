<?php


namespace src\Model;


class User
{
    private $Name;
    private $Mail;
    private $Password;

    private $Valid;
    private $Role;
    private $UID;





    public function SqlAdd(\PDO $bdd) {
        try{
            $requete = $bdd->prepare('INSERT INTO users (user_Name, user_Email, user_Password) VALUES(:Name, :Email, :Password)');
            $requete->execute([
                "Name" => $this->getName(),
                "Email" => $this->getMail(),
                "password" => $this->getPassword()
            ]);
            return array("result"=>true,"message"=>$bdd->lastInsertId());
        }catch (\Exception $e){
            return array("result"=>false,"message"=>$e->getMessage());
        }
    }

    public function SqlGet(\PDO $bdd, $UID){
        $requete = $bdd->prepare('SELECT * FROM users where user_UId = :id');
        $requete->execute([
            'id' => $UID
        ]);

        $datas =  $requete->fetch();

        $user = new User();
        $user->setUID($datas['user_UId']);
        $user->setName($datas['user_Name']);
        $user->setRole($datas['user_Role']);
        $user->setMail($datas['user_Email']);
        $user->setPassword($datas['user_Password']);
        $user->setValid($datas['user_Valid']);

        return $user;
    }

    public function SqlGetAll(\PDO $bdd){
        $requete = $bdd->prepare('SELECT * FROM users');
        $requete->execute();
        $arrayUser = $requete->fetchAll();

        $listUser = [];
        foreach ($arrayUser as $datas){
            $user = new User();
            $user->setUID($datas['user_UId']);
            $user->setName($datas['user_Name']);
            $user->setRole($datas['user_Role']);
            $user->setMail($datas['user_Email']);
            $user->setPassword($datas['user_Password']);
            $user->setValid($datas['user_Valid']);

            $listUser[] = $user;
        }
        return $listUser;
    }

    public function SqlUpdate(\PDO $bdd, $UID){

    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param mixed $Name
     * @return User
     */
    public function setName($Name)
    {
        $this->Name = $Name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->Mail;
    }

    /**
     * @param mixed $Mail
     * @return User
     */
    public function setMail($Mail)
    {
        $this->Mail = $Mail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param mixed $Password
     * @return User
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->Role;
    }

    /**
     * @param mixed $Role
     * @return User
     */
    public function setRole($Role)
    {
        $this->Role = $Role;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUID()
    {
        return $this->UID;
    }

    /**
     * @param mixed $UID
     * @return User
     */
    public function setUID($UID)
    {
        $this->UID = $UID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->Valid;
    }

    /**
     * @param mixed $Valid
     * @return User
     */
    public function setValid($Valid)
    {
        $this->Valid = $Valid;
        return $this;
    }
}