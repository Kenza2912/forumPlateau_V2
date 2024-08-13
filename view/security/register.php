

<!-- Formulaire pour s'inscrire  -->

<h1>S'inscrire</h1>



<form action="index.php?ctrl=security&action=register" method="POST" class="uk-form-stacked uk-margin-large-top">
    <div class="uk-margin">
        <label class="uk-form-label" for="nickName">Nom d'utilisateur</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="nickName" name="nickName" type="text" required>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="email">Email</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="email" name="email" type="email" required>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="pass1">Mot de passe</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="pass1" name="pass1" type="password" required>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="pass2">Confirmez le mot de passe</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="pass2" name="pass2" type="password" required>
        </div>
    </div>
    <div class="uk-margin">
        <button class="uk-button uk-button-primary" type="submit" name="submit">S'inscrire</button>
    </div>
</form>




