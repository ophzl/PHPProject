<?php

namespace src\Controller;

use src\Model\Article;
use src\Model\Bdd;
use src\Model\Category;
use src\Model\User;

class ApiController
{
    /*
     * Encode in JSON all articles from SQL
     */
    public function ArticleGet()
    {
        $article = new Article();
        $listArticle = $article->SqlGetAll(Bdd::GetInstance());
        return json_encode($listArticle);
    }

    /**
     * @return false|string
     * Add in SQL the article JSON passed in Post request
     */
    public function ArticlePost()
    {
        $article = new Article();
        $article->setTitre($_POST['Titre'])
            ->setDescription($_POST['Description'])
            ->setAuteur($_POST['Auteur'])
            ->setDateAjout($_POST['DateAjout']);
        $result = $article->SqlAdd(Bdd::getInstance());

        return json_encode($result);
    }

    /**
     * @param $idArticle
     * @param $json
     * @return false|string
     * Update Article corresponding to idArticle param, with JSON article content
     */
    public function ArticlePut($idArticle, $json)
    {
        $jsonData = json_decode($json);
        $articleSQL = new Article();
        $article = $articleSQL->SqlGet(BDD::getInstance(), $idArticle);
        if (isset($jsonData->Titre)) {
            $article->setTitre($jsonData->Titre);
        }
        if (isset($jsonData->Description)) {
            $article->setDescription($jsonData->Description);
        }
        if (isset($jsonData->Auteur)) {
            $article->setAuteur($jsonData->Auteur);
        }
        if (isset($jsonData->DateAjout)) {
            $article->setDateAjout($jsonData->DateAjout);
        }

        $result = $article->SqlUpdate(BDD::getInstance());

        return json_encode($result);

    }

    /**
     * @param $token
     * @return false|string
     * Return Five Last Article added in SQL if token is verified (verifToken)
     */
    public function ArticleFive($token)
    {
        $isvalid = $this->verifToken($token);
        if ($isvalid == true) {
            $query = Bdd::GetInstance()->prepare('SELECT * FROM articles ORDER BY Id DESC LIMIT 5');
            $query->execute();

            $arrayArticle = $query->fetchAll();

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

            return json_encode($listArticle);

        }
        return 'invalid Token';
    }

    /**
     * @param $token
     * @return bool
     * Verify if token param is corresponding to User_Token is SQL
     */
    private function verifToken($token){
        $sqlToken = Bdd::GetInstance()->prepare('SELECT user_token FROM users');
        $sqlToken->execute();
        $arrayToken = $sqlToken->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($arrayToken as $value){
            if ($value['user_token'] == $token){
                return true;
            }

        }
        return false;
    }
}


