<?php
namespace Controller;
use App\Session;
use App\Manager;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {
        if(isset($_POST["submit"])){

        $nickName = filter_input(INPUT_POST,"nickName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass1 = filter_input(INPUT_POST,"pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass2 = filter_input(INPUT_POST,"pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($nickName && $email && $pass1 && $pass2) {
            
            $userManager = new UserManager();

            if(!$userManager->findOneByEmail($email)){
               
                     //on vérifie que les 2 passwords correspondent
                     if($pass1 == $pass2){

                        //on hash le password (password_hash)
                        $passwordHash = password_hash($pass1, PASSWORD_DEFAULT);
                        // var_dump($passwordHash);
                        //on ajoute l'user en bdd (pas besoin d'id car autoincrement)
                        $userManager->add(["nickName" => $nickName, "email" =>$email, "password" => $passwordHash, "role"=>json_encode('ROLE_USER')]);

                     
                        Session::addFlash('success', 'Session créée!');

                        //on redirige vers le formulaire de login dans la foulée
                        $this->redirectTo('security', 'login');
                    } else {                                
                        
                     
                        Session::addFlash('error', 'Mot de passe invalide!');

                        $this->redirectTo('security', 'register');
                    }

                
            }
        }
        }
        return [
           
                "view" => VIEW_DIR."security/register.php", //Interaction avec la vue
                "metaDescription" => "register",
        ];

    }
    public function login(){
            
        $userManager = new UserManager();

        if(isset($_POST["submit"])){

            //on filtre les champs de saisie
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $user= $userManager->findOneByEmail($email);
            if($email && $password){
            //on recherche le mot de passe associé à l'adresse mail
                // $user = $userManager->findPassword($email);

                if($user){

                    //récupération du mot de passe de l'utilisateur
                    $hash = $user->getPassword();
                    //on recherche l'utilisateur rattaché à l'adresse mail
                    // $user = $userManager->findOneByEmail($email);

                    //on vérifie que les mots de passe concordent (password_verify)
                    if(password_verify($password, $hash)){

                        //on stocke l'user en Session (setUser dans App\Session)
                        Session::setUser($user);
                        $this->redirectTo('forum', 'listTopics');                    
                          
                              
                    } else {

                        
                        Session::addFlash('error', 'mot de passe ou email invalide');

                        $this->redirectTo('forum');

                    }
                } 
                else{
        
                Session::addFlash('error', 'mot de passe ou email invalide');
                $this->redirectTo('forum');
                }

            }
        }
        return [
                "view" => VIEW_DIR."security/login.php", 
        ];
    }
    public function logout () {}





}