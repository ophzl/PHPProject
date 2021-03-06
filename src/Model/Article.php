<?php
namespace src\Model;

class Article extends Contenu implements \JsonSerializable {
    private $Auteur;
    private $DateAjout;
    private $ImageRepository;
    private $ImageFileName;

    private $user;
    private $Category;
    private $Valid;

    /**
     * insert a new Article
     *
     * @param \PDO $bdd
     * @return array
     */
    public function SqlAdd(\PDO $bdd)
    {
        try {
            $cat=$this->getCategory();
            $user=$this->getUser();

            $requete = $bdd->prepare('INSERT INTO articles (Titre, Description, DateAjout, Auteur, ImageRepository, ImageFileName, article_Valid, articles_category_id, articles_users_id) VALUES(:Titre, :Description, :DateAjout, :Auteur, :ImageRepository, :ImageFileName, :Valid, :Category, :User)');
            $requete->execute([
                "Titre" => $this->getTitre(),
                "Description" => $this->getDescription(),
                "DateAjout" => $this->getDateAjout(),
                "Auteur" => $this->getAuteur(),
                "ImageRepository" => $this->getImageRepository(),
                "ImageFileName" => $this->getImageFileName(),
                "Valid" => $this->getValid(),
                "Category" => $cat->getCid(),
                "User" => $user->getUID()
            ]);
            return array("result" => true, "message" => $bdd->lastInsertId());
        } catch (\Exception $e) {
            return array("result" => false, "message" => $e->getMessage());
        }

    }

    /**
     * Select all article in the db
     * @param \PDO $bdd
     * @return array
     */
    public function SqlGetAll(\PDO $bdd)
    {
        $requete = $bdd->prepare('SELECT * FROM articles');
        $requete->execute();
        $arrayArticle = $requete->fetchAll();

        $listArticle = [];
        foreach ($arrayArticle as $articleSQL) {
            $article = new Article();
            $article->setId($articleSQL['Id']);
            $article->setTitre($articleSQL['Titre']);
            $article->setAuteur($articleSQL['Auteur']);
            $article->setDescription($articleSQL['Description']);
            $article->setDateAjout($articleSQL['DateAjout']);
            $article->setImageRepository($articleSQL['ImageRepository']);
            $article->setImageFileName($articleSQL['ImageFileName']);
            $article->setValid($articleSQL['article_Valid']);
            $article->setCategory((new Category)->SqlGet(Bdd::GetInstance(), $articleSQL['articles_category_id']));
            $article->setUser((new User)->SqlGet(Bdd::GetInstance(), $articleSQL['articles_users_id']));

            $listArticle[] = $article;
        }
        return $listArticle;
    }

    /**
     * Select all article in the db where article_Valid is null
     * @param \PDO $bdd
     * @return array
     */
    public function SqlGetAllWaiting(\PDO $bdd)
    {
        $requete = $bdd->prepare('SELECT * FROM articles where article_Valid IS NULL');
        $requete->execute();
        $arrayArticle = $requete->fetchAll();

        $listArticle = [];
        foreach ($arrayArticle as $articleSQL) {
            $article = new Article();
            $article->setId($articleSQL['Id']);
            $article->setTitre($articleSQL['Titre']);
            $article->setAuteur($articleSQL['Auteur']);
            $article->setDescription($articleSQL['Description']);
            $article->setDateAjout($articleSQL['DateAjout']);
            $article->setImageRepository($articleSQL['ImageRepository']);
            $article->setImageFileName($articleSQL['ImageFileName']);
            $article->setValid($articleSQL['article_Valid']);
            $article->setCategory((new Category)->SqlGet(Bdd::GetInstance(), $articleSQL['articles_category_id']));
            $article->setUser((new User)->SqlGet(Bdd::GetInstance(), $articleSQL['articles_users_id']));

            $listArticle[] = $article;
        }
        return $listArticle;
    }

    /**
     * Select all article in the db where article_Valid = 1
     * @param \PDO $bdd
     * @return array
     */
    public function SqlGetAllApproved(\PDO $bdd)
    {
        $requete = $bdd->prepare('SELECT * FROM articles where article_Valid = 1');
        $requete->execute();
        $arrayArticle = $requete->fetchAll();

        $listArticle = [];
        foreach ($arrayArticle as $articleSQL) {
            $article = new Article();
            $article->setId($articleSQL['Id']);
            $article->setTitre($articleSQL['Titre']);
            $article->setAuteur($articleSQL['Auteur']);
            $article->setDescription($articleSQL['Description']);
            $article->setDateAjout($articleSQL['DateAjout']);
            $article->setImageRepository($articleSQL['ImageRepository']);
            $article->setImageFileName($articleSQL['ImageFileName']);
            $article->setValid($articleSQL['article_Valid']);
            $article->setCategory((new Category)->SqlGet(Bdd::GetInstance(), $articleSQL['articles_category_id']));
            $article->setUser((new User)->SqlGet(Bdd::GetInstance(), $articleSQL['articles_users_id']));

            $listArticle[] = $article;
        }
        return $listArticle;
    }

    /**
     * Select all article in the db where articles_users_id = user id
     * @param \PDO $bdd
     * @param $UID
     * @return array
     */
    public function SqlGetAllUser(\PDO $bdd, $UID){
        $requete = $bdd->prepare('SELECT * FROM articles where articles_users_id =:UID');
        $requete->execute(['UID' => $UID]);
        $arrayArticle = $requete->fetchAll();

        $listArticle = [];
        foreach ($arrayArticle as $articleSQL){
            $article = new Article();
            $article->setId($articleSQL['Id']);
            $article->setTitre($articleSQL['Titre']);
            $article->setAuteur($articleSQL['Auteur']);
            $article->setDescription($articleSQL['Description']);
            $article->setDateAjout($articleSQL['DateAjout']);
            $article->setImageRepository($articleSQL['ImageRepository']);
            $article->setImageFileName($articleSQL['ImageFileName']);
            $article->setValid($articleSQL['article_Valid']);
            $article->setCategory((new Category)->SqlGet(Bdd::GetInstance(), $articleSQL['articles_category_id']));
            $article->setUser((new User)->SqlGet(Bdd::GetInstance(), $articleSQL['articles_users_id']));

            $listArticle[] = $article;
        }
        return $listArticle;
    }

    /**
     * Select all articles in the db where Id = $idArticle
     *
     * @param \PDO $bdd
     * @param $idArticle
     * @return Article
     */
    public function SqlGet(\PDO $bdd,$idArticle){
        $requete = $bdd->prepare('SELECT * FROM articles where Id = :idArticle');
        $requete->execute([
            'idArticle' => $idArticle
        ]);

        $datas =  $requete->fetch();

        $article = new Article();
        $article->setId($datas['Id']);
        $article->setTitre($datas['Titre']);
        $article->setAuteur($datas['Auteur']);
        $article->setDescription($datas['Description']);
        $article->setDateAjout($datas['DateAjout']);
        $article->setImageRepository($datas['ImageRepository']);
        $article->setImageFileName($datas['ImageFileName']);
        $article->setValid($datas['article_Valid']);
        $article->setCategory((new Category)->SqlGet(Bdd::GetInstance(), $datas['articles_category_id']));
        $article->setUser((new User)->SqlGet(Bdd::GetInstance(), $datas['articles_users_id']));

        return $article;

    }

    /**
     *
     * @param \PDO $bdd
     * @param $SQL ->the sql request
     * @param $param -> all sql parameters
     * @return array
     */
    public function SqlGetBy(\PDO $bdd, $SQL, $param)
    {
        $query = $bdd->prepare($SQL);
        $query->execute([
            'param' => $param
        ]);
        $arrayArticle = $query->fetchAll();

        $listArticle = [];
        foreach ($arrayArticle as $articleSQL){
            $article = new Article();
            $article->setId($articleSQL['Id']);
            $article->setTitre($articleSQL['Titre']);
            $article->setAuteur($articleSQL['Auteur']);
            $article->setDescription($articleSQL['Description']);
            $article->setDateAjout($articleSQL['DateAjout']);
            $article->setImageRepository($articleSQL['ImageRepository']);
            $article->setImageFileName($articleSQL['ImageFileName']);
            $article->setValid($articleSQL['article_Valid']);
            $article->setCategory((new Category)->SqlGet(Bdd::GetInstance(), $articleSQL['articles_category_id']));
            $article->setUser((new User)->SqlGet(Bdd::GetInstance(), $articleSQL['articles_users_id']));

            $listArticle[] = $article;
        }
        return $listArticle;
    }

    /**
     * @param \PDO $bdd
     * @param $SQL
     * @param $param
     * @return array
     */
    public function SqlGetByLike(\PDO $bdd, $SQL, $param)
    {
        $query = $bdd->prepare($SQL);
        $query->execute([
            'param' => "%$param%"
        ]);
        $arrayArticle = $query->fetchAll();

        $listArticle = [];
        foreach ($arrayArticle as $articleSQL){
            $article = new Article();
            $article->setId($articleSQL['Id']);
            $article->setTitre($articleSQL['Titre']);
            $article->setAuteur($articleSQL['Auteur']);
            $article->setDescription($articleSQL['Description']);
            $article->setDateAjout($articleSQL['DateAjout']);
            $article->setImageRepository($articleSQL['ImageRepository']);
            $article->setImageFileName($articleSQL['ImageFileName']);
            $article->setValid($articleSQL['article_Valid']);
            $article->setCategory((new Category)->SqlGet(Bdd::GetInstance(), $articleSQL['articles_category_id']));
            $article->setUser((new User)->SqlGet(Bdd::GetInstance(), $articleSQL['articles_users_id']));

            $listArticle[] = $article;
        }
        return $listArticle;
    }

    /**
     * update one article in the db
     * @param \PDO $bdd
     * @return array
     */
    public function SqlUpdate(\PDO $bdd)
    {
        try {
            $cat=$this->getCategory();
            $user=$this->getUser();

            $requete = $bdd->prepare('UPDATE articles set Titre=:Titre, Description=:Description, DateAjout=:DateAjout, Auteur=:Auteur, ImageRepository=:ImageRepository, ImageFileName=:ImageFileName, article_Valid=:Valid, articles_category_id=:category_id , articles_users_id=:users_id WHERE id=:IDARTICLE');
            $requete->execute([
                'Titre' => $this->getTitre(),
                'Description' => $this->getDescription(),
                'DateAjout' => $this->getDateAjout(),
                'Auteur' => $this->getAuteur(),
                'ImageRepository' => $this->getImageRepository(),
                'ImageFileName' => $this->getImageFileName(),
                'Valid' => $this->getValid(),
                'IDARTICLE' => $this->getId(),
                "category_id" => $cat->getCid(),
                "users_id" => $user->getUID()
            ]);
            return array("0", "[OK] Update");
        } catch (\Exception $e) {
            return array("1", "[ERREUR] " . $e->getMessage());
        }
    }

    /**
     * delete one article in the db
     * @param \PDO $bdd
     * @param $idArticle
     * @return bool
     */
    public function SqlDelete(\PDO $bdd, $idArticle)
    {
        try {
            $requete = $bdd->prepare('DELETE FROM articles where Id = :idArticle');
            $requete->execute([
                'idArticle' => $idArticle
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * empty artcle table
     * @param \PDO $bdd
     * @return bool
     */
    public function SqlTruncate(\PDO $bdd)
    {
        try {
            $requete = $bdd->prepare('TRUNCATE TABLE articles');
            $requete->execute();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * encode an article in json
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        $cat=$this->getCategory();
        $user=$this->getUser();
        return [
            'Id' => $this->getId(),
             'Titre' => $this->getTitre(),
             'Description' => $this->getDescription(),
             'DateAjout' => $this->getDateAjout(),
             'ImageRepository' => $this->getImageRepository(),
             'ImageFileName' => $this->getImageFileName(),
             'Auteur' => $this->getAuteur(),
            'Valid' => $this->getValid(),
            'Category' => $cat->getCid(),
            'User' => $user->getUID()
        ];
    }

    /**
     * return n word in a string
     * @param $nb
     * @return string
     */
    public function firstXwords($nb)
    {
        $phrase = $this->getDescription();
        $arrayWord = str_word_count($phrase,1);
        $str = implode(" ",array_slice($arrayWord,0,$nb));
        $str .= ' ...';
        return $str;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->Auteur;
    }

    /**
     * @param mixed $Auteur
     * @return Article
     */
    public function setAuteur($Auteur)
    {
        $this->Auteur = $Auteur;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateAjout()
    {
        return $this->DateAjout;
    }

    /**
     * @param mixed $DateAjout
     * @return Article
     */
    public function setDateAjout($DateAjout)
    {
        $this->DateAjout = $DateAjout;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageRepository()
    {
        return $this->ImageRepository;
    }

    /**
     * @param mixed $ImageRepository
     * @return Article
     */
    public function setImageRepository($ImageRepository)
    {
        $this->ImageRepository = $ImageRepository;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageFileName()
    {
        return $this->ImageFileName;
    }

    /**
     * @param mixed $ImageFileName
     * @return Article
     */
    public function setImageFileName($ImageFileName)
    {
        $this->ImageFileName = $ImageFileName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->Category;
    }

    /**
     * @param mixed $Category
     * @return Article
     */
    public function setCategory($Category)
    {
        $this->Category = $Category;
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
     * @return Article
     */
    public function setValid($Valid)
    {
        $this->Valid = $Valid;
        return $this;
    }
}