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
      public function addCategory() {
        if (isset($_POST['submit'])) {
            $nameCategory = filter_input(INPUT_POST, 'nameCategory', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoryManager = new CategoryManager();
    
            if ($nameCategory) {
                if (isset($_FILES['affiche']) && $_FILES['affiche']['error'] == UPLOAD_ERR_OK) {
                    $affiche = $_FILES['affiche'];
    
                    // Vérification de la taille du fichier
                    $maxFileSize = 2 * 1024 * 1024; // 2 MB
                    if ($affiche['size'] > $maxFileSize) {
                        Session::addFlash("error", "Le fichier est trop volumineux. La taille maximale autorisée est de 2 Mo.");
                        return;
                    }
    
                    // Vérification du type MIME
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    $fileType = mime_content_type($affiche['tmp_name']);
                    if (!in_array($fileType, $allowedTypes)) {
                        Session::addFlash("error", "Seuls les fichiers JPG, PNG et GIF sont autorisés.");
                        return;
                    }
    
                    // Vérification de l'extension
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $fileExtension = strtolower(pathinfo($affiche['name'], PATHINFO_EXTENSION));
                    if (!in_array($fileExtension, $allowedExtensions)) {
                        Session::addFlash("error", "Extension de fichier non autorisée.");
                        return;
                    }
    
                    // Génération d'un nom de fichier unique
                    $imageName = uniqid() . '_' . basename($affiche['name']);
                    $uploadDir = './public/image/';
                    $uploadFile = $uploadDir . $imageName;
    
                    // Déplacement du fichier téléchargé
                    if (move_uploaded_file($affiche['tmp_name'], $uploadFile)) {
                        chmod($uploadFile, 0644); // Restreindre les permissions du fichier
                        $data = [
                            'nameCategory' => $nameCategory,
                            'affiche' => $imageName
                        ];
                        $categoryManager->add($data);
                        Session::addFlash("success", "La catégorie a été rajoutée avec succès.");
                        $this->redirectTo('forum/listCategories');
                    } else {
                        Session::addFlash("error", "Erreur lors du téléchargement de l'image.");
                    }
                } else {
                    Session::addFlash("error", "Veuillez sélectionner une image valide.");
                }
            } else {
                Session::addFlash("error", "Veuillez entrer un nom de catégorie valide.");
            }
        }
    
        $categories = $categoryManager->findAll(["nameCategory", "DESC"]);
    
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Ajouter une catégorie : ",
            "data" => [
                "categories" => $categories
            ]
        ];
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

         // récupère tous les topics d'une catégorie spécifique (par son id)
         $topics = $topicManager->findTopicsByCategory($id);
        //  var_dump($topicId);
        //  $topicId = $topic->getId();

         // récupère les catégories spécifique (par son id)
         $category = $categoryManager->findOneById($id);
         $categoryId = $category->getId();
        //  var_dump($categoryId);
 
        //  var_dump($creationDate);
         $userId = Session::getUser()->getId();

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
 
           
            'user_id' => $userId,
            'topic_id' => $topicId,
            

        ];

        //  on enregistrer ce produit nouvellement créé en session à l'aide de la fonction add dans Manager.php
        $postManager->add($dataContent);

        
         // Affiche un message de succès
         Session::addFlash("success", "Le topic a été rajouté avec succès.");
         // Redirige vers la liste des topics
         $this->redirectTo('forum/listTopics');


        }
        // Affiche un message de d'erreur
        Session::addFlash("error", "Le topic n'a pas été rajouté ");

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

    public function listPostsByTopic($id) {
        $postManager = new PostManager();
        $topicManager = new TopicManager();

        $posts = $postManager->findPostsByTopic($id);
        $topic = $topicManager->findOneById($id);

        return [
            "view" => VIEW_DIR."forum/detailTopic.php",
            "meta_description" => "Liste des posts par topic : ",
            "data" => [
               "posts" => $posts,
                "topic" => $topic
            ]
        ];
    }

     // méthode pour rajouter un post au topic 
    public function addPostByTopic($id){

        // Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) {
            // La fonction PHP filter_input() permet d'effectuer une validation ou un nettoyage de chaque donnée transmise par le formulaire en employant divers filtres. FILTER_SANITIZE_SPECIAL_CHARS permet d'afficher la chaîne en toute sécurité dans un contexte HTML sans exécuter de code malveillant inséré par un utilisateur.
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
        
          // Création de l'instance PostManager
          $postManager = new PostManager();
          $topicManager = new TopicManager();

          $posts = $postManager->findPostsByTopic($id);
          $topic = $topicManager->findOneById($id);

        // vérifier si chaque variable contient une valeur jugée positive par PHP
        // $topicId = $topicManager->add($data);
        $userId =Session::getUser()->getId();
        if($content){

            $data = [
            'content' => $content,
            'topic_id' => $id,
            'user_id' => $userId,
            // 'topic_id' => $topicId,
            

        ];

        //  on enregistrer ce produit nouvellement créé en session à l'aide de la fonction add dans Manager.php
        $postManager->add($data);
         // Affiche un message de succès
         Session::addFlash("success", "Le post a été rajouté avec succès.");
         // Redirige vers la liste des topics
         $this->redirectTo('forum', 'listCategories'); 


    }
    // Affiche un message de d'erreur
    Session::addFlash("error", "Le post n'a pas été rajouté ");


    // le controller communique avec la vue "listTopics" (view) pour lui envoyer la liste des topics (data)
    return [
        "view" => VIEW_DIR."forum/detailTopic.php",
        "meta_description" => "Ajouter un post : ",
        "data" => [
            "topic" => $topic,
            "posts" => $posts
           
        ]
    ];


    }
    }
    // Méthode pour supprimer un post
    public function deletePost($id) {
        $postManager = new PostManager();
       
        // Récupère le post à supprimer
        $posts = $postManager->findOneById($id);

        // Supprime le post
        $postManager->delete($id);
        Session::addFlash("success", "Le post a été supprimé avec succès.");

        $this->redirectTo("forum", 'listTopic');
        Session::addFlash("error", "Le post n'a pas été supprimé. ");
    }

    

    

     public function deleteTopic($id){

        $topicManager = new TopicManager();

        $topicManager->deletePostTopic($id);
        $topicManager->delete($id);

       
        Session::addFlash('error', "Le topic a été supprimé avec succès.");

        $this->redirectTo("forum", 'listTopic');
        Session::addFlash("error", "Le topic n'a pas été supprimé. ");
    }






    public function listTopicsAndPostsByUser($id){

        $topicManager = new TopicManager;
        $postManager = new PostManager;
        
        
        
        return [
            "view" => VIEW_DIR."forum/listTopicsAndPostsUser.php",
            "data" => [
                "topics" => $topicManager->listTopicsByUser($id),
                "posts" =>$postManager->listPostsByUser($id)
                
                ]
        ];
    }

    public function updatePostForm($postId){
            
       
        $postManager = new PostManager();

    
        $post = $postManager->findOneById($postId);

        
        return [

            "view" => VIEW_DIR."forum/updatePost.php",
            "meta_description" => "Modifier un post : ",
            "data" => [
                "post" => $post
            ]

        ];

    }
    public function updatePost($postId){

        
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       
        $postManager = new PostManager();
        
      
        $data = [
            'content' => $content,
            'id_post' => $postId
        ];

   
        $postManager->update($postId, $content);
        // var_dump($postManager);
      
        Session::addFlash('success', 'Le post a été modifié');

       
        $this->redirectTo('forum', 'listCategories'); 

    }


    public function userProfile($id){

       
        $topicManager = new TopicManager;
        $postManager = new PostManager;
        
        $topics = $topicManager->listTopicsByUser($id);
        $posts = $postManager->listPostsByUser($id);

        return [
            "view" => VIEW_DIR."forum/profile.php",
            "meta_description" => "Profil Utilisateur ",
            "data" => [
                "topics" => $topics,
                "posts" => $posts
            ]
        ];

    }

    public function deleteUserAndTopic($userID){
        
        $userManger = new UserManager;
        $topicManager = new TopicManager;
        $postManager = new PostManager;


        $topicManager->deletePostTopic($id);
        $topicManager->delete($id);
        $userManger->deleteUser($id);

        $this->redirectTo("forum", 'listTopic');

    }

   

    




   

    
}