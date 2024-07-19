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

    public function update($id, $content){
        // var_dump($id);
        // var_dump($content); die;
        $sql = "UPDATE post
                SET content = :content
                WHERE id_post = :id";
                
        DAO::select($sql, [
            'content'=>$content,
            'id'=>$id,
        ]);
        
    }

    //    method to update the textcontent of a post
    //    public function update($postId, $content){

       
    //     $sql = "UPDATE ". $this->tableName . "p
    //             SET p.content = :content
    //             WHERE p.id_post = :id";
      
    //     $data =[
    //         'content' => $content,
    //         'id' => $postId
    //     ];
    //     // var_dump($data); die();
        
    //     DAO::update($sql, $data);


    // }
    public function listPostsByUser($id){
            
        

        $sql = "SELECT * FROM ". $this->tableName." WHERE user_id = :id";
        
        return $this->getMultipleResults(
            DAO::select($sql, ["id"=>$id]),
            $this->className
        );
    }

}