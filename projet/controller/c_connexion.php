<?php

    if(isset($_POST['valider'])){
        $email = $_POST['email'];
        $passh= $_POST['hpass'];
        $membre=$db->testConnexion($email,$passh);
        if ($membre != null){
            $_SESSION['email'] = $email;
            $_SESSION['idMembre'] = $membre->idMembre;
            $_SESSION['nom'] = $membre->nom;
            $_SESSION['prenom'] = $membre->prenom;
            $_SESSION['typeMembre'] = $membre->typeMembre;
            $_SESSION['tel'] = $membre->tel;
            header("location:index.php");            
        } else {
            session_destroy();
        }
    }

    if(isset($_POST['confirmMail'])){

        $_SESSION['emailc']= $_POST['emailc'];
        $emailc=$_SESSION['emailc'];
        $cle=$db->getCle($emailc)->cle;
        $_SESSION['body']= "<a href='localhost/projet/index.php?cle=".$cle."'>Click Here</a>";
        require 'controller/c_sendmail.php';
    }


    if(isset($_GET['cle'])){
        $cle = $_GET['cle'];
        $emailVerif=$db->getEmailCle($cle);
        if($emailVerif != null) {
            $email=$emailVerif->email;
            require 'vues/v_passmodif.php';
        } else {
            echo 'Erreur, l\'email ne correspond pas';
        }
    } else {
        
        require 'vues/v_connexion.php';
    }
    

    if(isset($_POST['confirmPass'])){
        $newPassh = $_POST['newPassh'];
        $newPassTesth = $_POST['newPassTesth'];
        $cle = $_POST['cle'];
        if($newPassh == $newPassTesth){
            $sel=md5(microtime(true)*100000);
            $selh=sha1($sel);
            $newPassh=hash("SHA512", $newPassh.$selh);
            $clemodif= md5(microtime(true)*100000); 
            $db->modifpass($newPassh,$cle,$selh,$clemodif); 
            $test = $clemodif;
            var_dump($clemodif);
            var_dump($test);
            $emailTemp = $db->getEmailCle($test);

            if ($emailTemp != null){
                $emailc=$emailTemp->email;
                $_SESSION['body']= "Votre mot de passe a été changé avec succès";
                var_dump($emailc);
                require 'controller/c_sendmail.php'; 
            }
            require 'vues/v_connexion.php';
        } else {
            echo "Vous n'avez pas tapé deux fois le même mot de passe";
            require 'vues/v_passmodif.php';

        }
    }
    
    
?>

    

