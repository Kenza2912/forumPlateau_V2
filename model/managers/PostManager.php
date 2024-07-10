<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les posts par topic
    public function findPostsByTopic($topicId) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.topic_id = :topicId";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['topicId' => $topicId]), 
            $this->className
        );
    }

}