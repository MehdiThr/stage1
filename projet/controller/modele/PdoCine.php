<?php

/**
 * Classe d'accès aux données. 
 * Utilise les services de la classe PDO
 * Les attributs sont tous statiques,
 * $monPdo de type PDO 
 * $monPdoCine qui contiendra l'unique instance de la classe
 */
class PdoCine {

    private static $monPdo;
    private static $monPdoCine = null;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct() {
// A) >>>>>>>>>>>>>>>   Connexion au serveur et à la base
        try {
// encodage
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'');
// Crée une instance (un objet) PDO qui représente une connexion à la base
            PdoCine::$monPdo = new PDO("mysql:dbname=cinephalsbourg;host=localhost", "root", "", $options);
// configure l'attribut ATTR_ERRMODE pour définir le mode de rapport d'erreurs 
// PDO::ERRMODE_EXCEPTION: émet une exception 
            PdoCine::$monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// configure l'attribut ATTR_DEFAULT_FETCH_MODE pour définir le mode de récupération par défaut 
// PDO::FETCH_OBJ: retourne un objet anonyme avec les noms de propriétés 
//     qui correspondent aux noms des colonnes retournés dans le jeu de résultats
            PdoCine::$monPdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) { // $e est un objet de la classe PDOException, il expose la description du problème
            die('<section id="main-content"><section class="wrapper"><div class = "erreur">Erreur de connexion à la base de données !<p>'
                    . $e->getmessage() . '</p></div></section></section>');
        }
    }

    /**
     * Destructeur, supprime l'instance de PDO  
     */
    public function _destruct() {
        PdoCine::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * Appel : $instancePdoCine = PdoCine::getPdoCine();
     * 
     * @return l'unique objet de la classe PdoCine
     */
    public static function getPdoCine() {
        if (PdoCine::$monPdoCine == null) {
            PdoCine::$monPdoCine = new PdoCine();
        }
        return PdoCine::$monPdoCine;
    }

//==============================================================================
//
//	METHODES POUR LA GESTION DES GENRES
//
//==============================================================================

    /**
     * Retourne tous les membres sous forme d'un tableau d'objets 
     * 
     * @return array le tableau d'objets  (Membre)
     */



    public function modifpass($password, $cle, $sel, $clemodif): void {
        //à faire
        try {
            $requete_prepare = PdoCine::$monPdo->prepare("UPDATE membres SET password=:passwordh,sel=:sel, cle=:clemodif WHERE cle=:cle");
            $requete_prepare->bindValue(':passwordh', $password ,PDO::PARAM_STR);
            $requete_prepare->bindValue(':cle',$cle ,PDO::PARAM_STR);
            $requete_prepare->bindValue(':sel',$sel,PDO::PARAM_STR);
            $requete_prepare->bindValue(':clemodif',$clemodif,PDO::PARAM_STR);
            $requete_prepare->execute();
        } catch (Exception $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
                    . $e->getmessage() . '</p></div>');
        }
    }

    public function getCle($email): ?object {
 

    try {
        $requete_prepare = PdoCine::$monPdo->prepare("SELECT cle"
                . " FROM membres"
                . " WHERE email=:email");
        $requete_prepare->bindParam(':email', $email, PDO::PARAM_STR);
        $requete_prepare->execute();
        $rescle = $requete_prepare->fetch();
        if ($rescle){

                return $rescle;

        } else {
            return null;
        }
    } catch (PDOException $e) {
        die('<div class = "erreur">Erreur dans la requête !<p>'
                . $e->getmessage() . '</p></div>');
    }
}

public function getEmail($idMembre): ?object {
 

    try {
        $requete_prepare = PdoCine::$monPdo->prepare("SELECT email"
                . " FROM membres"
                . " WHERE idMembre=:idMembre");
        $requete_prepare->bindParam(':idMembre', $idMembre, PDO::PARAM_INT);
        $requete_prepare->execute();
        $resemail = $requete_prepare->fetch();
  
        if ($resemail){

                return $resemail;

        } else {
            return null;
        }
    } catch (PDOException $e) {
        die('<div class = "erreur">Erreur dans la requête !<p>'
                . $e->getmessage() . '</p></div>');
    }
}

public function getEmailCle($cle): ?object {
 

    try {
        $requete_prepare = PdoCine::$monPdo->prepare("SELECT email"
                . " FROM membres"
                . " WHERE cle=:cle");
        $requete_prepare->bindParam(':cle', $cle, PDO::PARAM_STR);
        $requete_prepare->execute();
        $resultemail = $requete_prepare->fetch();
 
        if ($resultemail){

                return $resultemail;

        } else {
            return null;
        }
    
    } catch (PDOException $e) {
        die('<div class = "erreur">Erreur dans la requête !<p>'
                . $e->getmessage() . '</p></div>');
    }
}

    public function getLesMembres(): array {
        $requete = 'SELECT * 
						FROM membres
						ORDER BY nom';
        try {
            $resultat = PdoCine::$monPdo->query($requete);
            $tbResults = $resultat->fetchAll();
            return $tbResults;
        } catch (PDOException $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
                    . $e->getmessage() . '</p></div>');
        }
    }
    public function testConnexion($email, $passh): ?object {
        try {
            $requete_prepare = PdoCine::$monPdo->prepare("SELECT *"
                    . " FROM membres"
                    . " WHERE email=:email");
            $requete_prepare->bindParam(':email', $email, PDO::PARAM_STR);
            $requete_prepare->execute();
            $result = $requete_prepare->fetch();
       
            if ($result){
                $passwordh=hash("SHA512", $passh.($result->sel));
          
                if ($passwordh == $result->password){
                    return $result;
                } else {
                    return null;
                }

            } else {
                return null;
            }
        } catch (PDOException $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
                    . $e->getmessage() . '</p></div>');
        }
    }

    /**
     * Ajoute un nouveau membre avec l'objet donné en paramètre
     * 
     * @param object $membre : l'objet du membre à ajouter
     * @return int l'identifiant du membre crée
     */
    public function ajouterMembre(object $membre): int {
        //à faire
        try {
            $requete_prepare = PdoCine::$monPdo->prepare("INSERT INTO membres "
                    . "(nom, prenom, email, tel, password, sel, cle, typeMembre) "
                    . "VALUES (:nom, :prenom, :email, :tel, :passwordh, :selh, :cle, :typeMembre) ");
            $requete_prepare->bindParam(':nom', $membre->nom, PDO::PARAM_STR);
            $requete_prepare->bindParam(':prenom', $membre->prenom, PDO::PARAM_STR);
            $requete_prepare->bindParam(':email', $membre->email, PDO::PARAM_STR);
            $requete_prepare->bindParam(':tel', $membre->tel, PDO::PARAM_STR);
            $requete_prepare->bindParam(':passwordh', $membre->passwordh, PDO::PARAM_STR);
            $requete_prepare->bindParam(':selh', $membre->selh, PDO::PARAM_STR);
            $requete_prepare->bindParam(':cle', $membre->cle, PDO::PARAM_STR);
            $requete_prepare->bindParam(':typeMembre', $membre->typeMembre, PDO::PARAM_STR);
            $requete_prepare->execute();
// récupérer l'identifiant crée
            return PdoCine::$monPdo->lastInsertId();
        } catch (Exception $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
                    . $e->getmessage() . '</p></div>');
        }
    }

    /**
     * Modifie l'objet du membre donné en paramètre
     * 
     * @param int $idMembre : l'identifiant du membre à modifier  
     * @param object $membre : l'objet modifié
     */
    public function modifierMembre(object $membre): void {
        //à faire
        try {
            $requete_prepare = PdoCine::$monPdo->prepare('UPDATE membres set nom=:nom, prenom=:prenom,
            tel=:tel, email=:email, typeMembre=:typeMembre WHERE idMembre=:idMembre');
            $requete_prepare->bindValue(':nom', $membre->nom,PDO::PARAM_STR);
            $requete_prepare->bindValue(':prenom', $membre->prenom,PDO::PARAM_STR);
            $requete_prepare->bindValue(':email', $membre->email,PDO::PARAM_STR);
            $requete_prepare->bindValue(':tel', $membre->tel,PDO::PARAM_STR);
            $requete_prepare->bindValue(':idMembre', $membre->idMembre,PDO::PARAM_INT);
            $requete_prepare->bindValue(':typeMembre', $membre->typeMembre,PDO::PARAM_STR);
            $requete_prepare->execute();
        } catch (Exception $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
                    . $e->getmessage() . '</p></div>');
        }
    }

    /**
     * Supprime le membre donné en paramètre
     * 
     * @param int $idMembre :l'identifiant du membre à supprimer 
     */
    public function supprimerMembre($id): void {
        try {
            $requete_prepare = PdoCine::$monPdo->prepare("DELETE FROM membres "
                    . "WHERE idMembre = :idMembre");
            $requete_prepare->bindParam(':idMembre', $id, PDO::PARAM_INT);
            $requete_prepare->execute();
        } catch (Exception $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
                    . $e->getmessage() . '</p></div>');
        }
    }

    public function modifierpass(): void {
        try {
           
        } catch (Exception $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
                    . $e->getmessage() . '</p></div>');
        }
    }

}
