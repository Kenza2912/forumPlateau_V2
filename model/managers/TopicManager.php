<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.category_id = :id";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    public function listTopicsByUser($id){

        

        $sql = "SELECT * FROM ". $this->tableName." WHERE user_id = :id";
        
        return $this->getMultipleResults(
            DAO::select($sql, ["id"=>$id]),
            $this->className
        );
    }

   


    public function deleteTopicsByUser($userId) {
        // Supprimer les topics créés par l'utilisateur
        $sql = "DELETE FROM ".$this->tableName." WHERE user_id = :user_id";
        DAO::delete($sql, ['user_id' => $userId]);
    }

    public function anonymizeTopicsByUser($userId) {
        $sql = "UPDATE ".$this->tableName." SET user_id = NULL WHERE user_id = :userId";
       
        return DAO::update($sql, ['user_id' => $userId]);
    }


}