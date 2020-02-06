<?php


namespace src\Model;


class Category
{
    private $cid;
    private $label;
    private $codeReference;

    public function SqlAdd(\PDO $bdd)
    {
        try {
            $requete = $bdd->prepare('INSERT INTO category (category_code_reference, category_label) VALUES(:code_reference, :label)');
            $requete->execute([
                "code_reference" => $this->getCodeReference(),
                "label" => $this->getLabel()
            ]);
            return array("result" => true, "message" => $bdd->lastInsertId());
        } catch (\Exception $e) {
            return array("result" => false, "message" => $e->getMessage());
        }

    }

    public function SqlGetAll(\PDO $bdd)
    {
        $requete = $bdd->prepare('SELECT * FROM category');
        $requete->execute();
        $arrayCategory = $requete->fetchAll();

        $listCategory = [];
        foreach ($arrayCategory as $categorySQL) {
            $category = new Category();
            $category->setCid($categorySQL['category_id']);
            $category->setLabel($categorySQL['category_label']);
            $category->setCodeReference($categorySQL['category_code_reference']);

            $listCategory[] = $category;
        }
        return $listCategory;
    }

    public function SqlGet(\PDO $bdd, $idCategory)
    {
        $requete = $bdd->prepare('SELECT * FROM category where category_id=:idCategory');
        $requete->execute([
            'idCategory' => $idCategory
        ]);

        $datas = $requete->fetch();

        $this->setCid($datas['category_id']);
        $this->setLabel($datas['category_label']);
        $this->setCodeReference($datas['category_code_reference']);

        return $this;

    }

    public function SqlUpdate(\PDO $bdd)
    {
        try {
            $requete = $bdd->prepare('UPDATE category set category_code_reference=:codeReference, category_label=:label WHERE category_id=:idCategory');
            $requete->execute([
                'codeReference' => $this->getCodeReference()
                , 'label' => $this->getLabel()
                , 'idCategory' => $this->getCid()
            ]);
            return array("0", "[OK] Update");
        } catch (\Exception $e) {
            return array("1", "[ERREUR] " . $e->getMessage());
        }
    }


    public function SqlDelete(\PDO $bdd, $idCategory)
    {
        try {
            $requete = $bdd->prepare('DELETE FROM category where category_id=:idCategory');
            $requete->execute([
                'idCategory' => $idCategory
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * @param mixed $cid
     */
    public function setCId($cid)
    {
        $this->cid = $cid;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getCodeReference()
    {
        return $this->codeReference;
    }

    /**
     * @param mixed $codeReference
     */
    public function setCodeReference($codeReference)
    {
        $this->codeReference = $codeReference;
    }


}