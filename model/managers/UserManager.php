<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

     //Retrouver un utilisateur grâce à son email

     public function findOneByEmail($email) {
        $sql = "SELECT * FROM ".$this->tableName." WHERE email = :email";

        // la requête renvoie un seul enregistrement --> getOneOrNullResult
        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );
     }

     //Retrouver le password grâce à l'email
     public function findPassword($email){

        $sql = "SELECT u.password FROM ".$this->tableName."u WHERE u.email = :email";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );
    }
    public function findOneByUser($user){

        $sql = "SELECT * FROM ".$this->tableName." WHERE nickName = :nickName";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['nickName' => $user], false), 
            $this->className
        );
    }

    public function deleteUser($id){
        $sql = "DELETE FROM user WHERE id_user = :id";

        DAO::delete($sql, ['id'=>$id]);
    }


}