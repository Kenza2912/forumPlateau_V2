<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {

        $nickName = filter_input(INPUT_POST,"nickName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass1 = filter_input(INPUT_POST,"pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass2 = filter_input(INPUT_POST,"pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // if($nickName && $email && $pass1 && $pass2) {
        
        // }

    }
    public function login () {}
    public function logout () {}





}