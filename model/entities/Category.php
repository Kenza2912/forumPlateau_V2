<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Category extends Entity{

    private $id;
    private $nameCategory;
    private $affiche;

    // chaque entité aura le même constructeur grâce à la méthode hydrate (issue de App\Entity)
    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getNameCategory(){
        return $this->nameCategory;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setNameCategory($nameCategory){
        $this->nameCategory = $nameCategory;
        return $this;
    }

    /**
     * Get the value of affiche
     */ 
    public function getAffiche()
    {
        return $this->affiche;
    }

    /**
     * Set the value of affiche
     *
     * @return  self
     */ 
    public function setAffiche($affiche)
    {
        $this->affiche = $affiche;

        return $this;
    }
    public function __toString(){
        return $this->nameCategory;
    }

}