<?php
function password_modify()
{
    if (isset($_POST['passnew'], $_POST['passnewverif'])) {
        $_POST['passnew'] = htmlspecialchars(trim($_POST['passnew']));
        $_POST['passnewverif'] = htmlspecialchars(trim($_POST['passnewverif']));
        try {
            // On verifie si le mot de passe et celui de la verification sont identiques
            if ($_POST['passnew'] === $_POST['passnewverif']) {
                //On verifie si le mot de passe a 8 caracteres ou plus
                if (strlen($_POST['passnew']) >= 8) {
                    $utilisateur = new User();
                    $users = $utilisateur->getUsers();
                    foreach ($users as $user) {
                        if ($user['login'] === $_SESSION['loggued_on_user']) {
                            $passwd_hash = hash('whirlpool', $_POST['passnew']);
                            $user = array(
                                'login' => $_SESSION['loggued_on_user'],
                                'email' => $user['email'],
                                'password' => $passwd_hash);
                            $utilisateur->majUser($user);
                            //Si ca a fonctionne, on naffiche pas le formulaire
                            $message = "Votre mot de passe vient d'être correctement modifié.";
                        } else {
                            //Sinon, on dit que le pseudo n'existe pas
                            $message = 'Erreur lors de la modification de votre mot de passe.';
                        }
                    }
                } else {
                    //Sinon, on dit que le mot de passe nest pas assez long
                    $message = 'Le mot de passe que vous avez entré contient moins de 8 caractères.';
                }
            } else {
                //Sinon, on dit que les mots de passes ne sont pas identiques
                $message = 'Les mots de passe que vous avez entré ne sont pas identiques.';
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        return $message;
    }
}
?>