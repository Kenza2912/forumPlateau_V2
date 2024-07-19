<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;

    class adminController extends AbstractController implements ControllerInterface{

        public function index(){

        }

        //vue depuis le layout réservée aux Admin
        public function listUsers(){

            $this->restrictTo("ROLE_ADMIN");

            $userManager = new UserManager();
            
            $users =  $userManager->findAll(['dateRegistration', 'DESC']);

            return [
                "metaDescription" => "Users List",
                "view" => VIEW_DIR."security/Users.php",
                "data" => [
                    "users" => $users
                ]
            ];
        }

    
    }