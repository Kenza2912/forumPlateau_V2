<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $meta_description ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.6/dist/css/uikit.min.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
        <title>FORUM</title>
    </head>
    <body>
        <div id="wrapper"> 
            <div id="mainpage">
                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
                <header>
                    <nav class="uk-margin">
                        <div class="uk-navbar-left">
                            <div id="nav-left">
                                <ul class="uk-subnav uk-subnav-pill uk-flex-center" uk-margin>
                                <li><a class="uk-button uk-button-default" href="/">Accueil</a></li>
                                <?php
                                if(App\Session::isAdmin()){
                                    ?>
                                    <li><a href="index.php?ctrl=admin&action=listUsers">Voir la liste des gens</a></li>
                                    
                                    <!-- <a href="index.php?ctrl=category&action=listCategories" class="nav-item">Categories</a> -->
                                <?php } ?>
                            
                            
                                    
                            <?php
                                // si l'utilisateur est connecté 
                                if(App\Session::getUser()){
                                    ?>
                                    
                                    <li><a class="uk-button uk-button-default" href="index.php?ctrl=forum&action=userProfile&id=<?= App\Session::getUser()->getId()?>"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()?></a></li>
                                    <li><a class="uk-button uk-button-default" href="index.php?ctrl=forum&action=findAllTopics">Catégorie</a></li>
                                    <li><a class="uk-button uk-button-default" href="index.php?ctrl=security&action=logout">Déconnexion</a></li>
                                    <?php
                                }
                                else{
                                    ?>
                                    <li><a class="uk-button uk-button-default" href="index.php?ctrl=security&action=login">Connexion</a></li>
                                    <li><a class="uk-button uk-button-default" href="index.php?ctrl=security&action=register">Inscription</a></li>
                                    <li><a class="uk-button uk-button-default" href="index.php?ctrl=forum&action=index">Liste des catégories</a></li>
                                <?php
                                }
                            ?>
                       
                                </ul>
                            </div>
                        </nav>
                </header>
                
                <main id="forum" class="uk-container uk-margin-large-top">
                    <?= $page ?>
                </main>
            </div>
            <footer  class="uk-background-secondary uk-light uk-padding uk-text-center">
                <p>&copy; <?= date_create("now")->format("Y") ?> - <a href="#">Règlement du forum</a> - <a href="#">Mentions légales</a></p>
            </footer>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                tinymce.init({
                    selector: '.post',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css: '//www.tiny.cloud/css/codepen.min.css'
                });
            })
        </script>
        <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.6/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.6/dist/js/uikit-icons.min.js"></script>
    </body>
</html>