<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\PostManager;
use Model\Managers\TopicManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["nameCategory", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function listTopicsByCategory($id) {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

      // méthode pour rajouter une catégorie à ma base de données
      public function addCategory(){

        // Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) { 

        // La fonction PHP filter_input() permet d'effectuer une validation ou un nettoyage de chaque donnée transmise par le formulaire en employant divers filtres. FILTER_SANITIZE_SPECIAL_CHARS permet d'afficher la chaîne en toute sécurité dans un contexte HTML sans exécuter de code malveillant inséré par un utilisateur.
        $nameCategory = filter_input(INPUT_POST, 'nameCategory', FILTER_SANITIZE_SPECIAL_CHARS);

        // Création de l'instance de CategoryManager
        $categoryManager = new CategoryManager();

        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["nameCategory", "DESC"]);

        // vérifier si chaque variable contient une valeur jugée positive par PHP
        if($nameCategory){

            // on construit pour chaque valeur un tableau associatif $data : 
            $data = [
                'nameCategory' => $nameCategory
            ];

            //  on enregistrer ce produit nouvellement créé en session à l'aide de la fonction add dans Manager.php
            $categoryManager->add($data);

            // Affiche un message de succès
            Session::addFlash("success", "La catégorie a été rajoutée avec succès.");
            // Redirige vers la liste des topics
            $this->redirectTo('forum/listTopics');
        }
        // Affiche un message de d'erreur
        Session::addFlash("error", "La catégorie n'a pas été rajoutée ");

      
        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Ajouter une catégorie : ",
            "data" => [
                "categories" => $categories
            ]
        ];
    }
    }

    // méthode pour rajouter un topic à la base de données
    public function addTopicByCategory($id){
        // Vérifie si le formulaire a été soumis
        
        if (isset($_POST['submit'])) {
            // La fonction PHP filter_input() permet d'effectuer une validation ou un nettoyage de chaque donnée transmise par le formulaire en employant divers filtres. FILTER_SANITIZE_SPECIAL_CHARS permet d'afficher la chaîne en toute sécurité dans un contexte HTML sans exécuter de code malveillant inséré par un utilisateur.
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content',FILTER_SANITIZE_SPECIAL_CHARS);

         // Création de l'instance de CategoryManager TopicManger PostManager
         $categoryManager = new CategoryManager();
         $topicManager = new TopicManager();
         $postManager = new PostManager();

        //  Pour vérifier
        //  var_dump($title);

         // récupérer tous les topics d'une catégorie spécifique (par son id)
         $topics = $topicManager->findTopicsByCategory($id);
         var_dump($topicId);
        //  $topicId = $topic->getId();

         // récupérer les catégories spécifique (par son id)
         $category = $categoryManager->findOneById($id);
         $categoryId = $category->getId();
         var_dump($categoryId);
 
         var_dump($creationDate);
         $userId =1;

        // vérifier si chaque variable contient une valeur jugée positive par PHP
        if($title){

            // on construit pour chaque valeur un tableau associatif $data : 
                $data = [
                    'title' => $title,
                    'user_id' => $userId,
                    'category_id' => $categoryId,
     
                    // 'closed' => 0

                ];

        //  on enregistrer ce produit nouvellement créé en session à l'aide de la fonction add dans Manager.php
        
        $topicId = $topicManager->add($data);

        $dataContent = [
            'content' => $content,
 
           
            // 'user_id' => $userId,
            'topic_id' => $topicId,
            

        ];

        //  on enregistrer ce produit nouvellement créé en session à l'aide de la fonction add dans Manager.php
        $postManager->add($dataContent);

        
         // Affiche un message de succès
         Session::addFlash("success", "Le topic a été rajoutée avec succès.");
         // Redirige vers la liste des topics
         $this->redirectTo('forum/listTopics');


        }
        // Affiche un message de d'erreur
        Session::addFlash("error", "Le topic n'a pas été rajoutée ");

        // le controller communique avec la vue "listTopics" (view) pour lui envoyer la liste des topics (data)
        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Ajouter un topic : ",
            "data" => [
                "topics" => $topics,
               
            ]
        ];

        }

    }

    
}