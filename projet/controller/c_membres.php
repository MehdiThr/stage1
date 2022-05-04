	<?php
	// si le paramètre action n'est pas positionné alors
	//		si aucun bouton "action" n'a été envoyé alors par défaut on affiche les genres
	//		sinon l'action est celle indiquée par le bouton


	
	if (isset($_POST['demanderModifierUser'])) {
		$idUserModif = $_POST['demanderModifierUser'];
    } else {
	   $idUserModif = false;
    }
	
	if (isset($_POST['ajouterNouveauMembre'])) {
	$email=$_POST['email'];
	$pass=$_POST['hpass'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$tel=$_POST['tel'];
	$cle=md5(microtime(true)*100000);
	$sel=md5(microtime(true)*100000);
	$selh=sha1($sel);
	$passwordh=hash("SHA512", $pass.$selh);
	$typeMembre=$_POST['typeMembre'];

	$membre = (object) array(
		"nom"=>$nom,
		"prenom"=>$prenom,
		"email"=>$email,
		"tel"=>$tel,
		"passwordh"=>$passwordh,
		"cle"=>$cle,
		"selh"=>$selh,
		"typeMembre"=>$typeMembre
	);

	$idMembreNotif = $db->ajouterMembre($membre);

}



if(isset($_POST['supprimerUser'])){
	

	$idUserSupr = $_POST['supprimerUser'];
	//récupérer l'adresse mail de l'utilisateur a supprimer
	$emailc = $db->getEmail($idUserSupr)->email;
	$supMembre = $db->supprimerMembre($idUserSupr);
	//envoyer le mail
	$_SESSION['body']= "Votre compte a bien été supprimé";
	require 'controller/c_sendmail.php';
	
	
} else {
	$idUserSupr = false;
}


if (isset($_POST['validerModifierUser'])) {

	$email=$_POST['email'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $tel=$_POST['tel'];
	$typeMembre=$_POST['typeMembre'];
	$idUserModif=$_POST['idUserModif'];

	$membre = (object) array(
		"nom"=>$nom,
		"prenom"=>$prenom,
		"email"=>$email,
		"tel"=>$tel,
		"idMembre"=>$idUserModif,
		"typeMembre"=>$typeMembre
	);
    $idUserModif = $db->modifierMembre($membre);

}
	/*if (!isset($_POST['cmdAction'])) {
		 $action = 'afficherMembres';
	}
	else {
		// par défaut
		$action = $_POST['cmdAction'];
	}
*/
	//$idMembreModif = -1;		// positionné si demande de modification
	//$notification = 'rien';	// pour notifier la mise à jour dans la vue

	// selon l'action demandée on réalise l'action 
	/*switch($action) {

		case 'ajouterNouveauMembre': {	
				$email=$_POST['email'];
				$pass=$_POST['hpass'];
				$nom=$_POST['nom'];
				$prenom=$_POST['prenom'];
				$tel=$_POST['tel'];
				$cle=md5(microtime(true)*100000);
				$sel=md5(microtime(true)*100000);
				$selh=sha1($sel);
				$passwordh=hash("SHA512", $pass.$sel);

				$membre = (object) array(
					"nom"=>$nom,
					"prenom"=>$prenom,
					"email"=>$email,
					"tel"=>$tel,
					"passwordh"=>$passwordh,
					"cle"=>$cle,
					"selh"=>$selh
				);

				$idMembreNotif = $db->ajouterMembre($membre);
			
		  break;
		}

		case 'demanderModifierUser': {
				$idMembreModif = $_POST['txtIdMembre']; 
				$email=$_POST['email'];
				$nom=$_POST['nom'];
				$prenom=$_POST['prenom'];
				$tel=$_POST['tel'];

				$idMembreModif = $db->modifierMembre($idMembre,$membre);
			break;
		}
			
		case 'validerModifierMembre': {
			//à faire
			$db->modifierMembre($_POST['txtIdMembre'], $_POST['txt']); 
			$idMembreNotif = $_POST['txtIdMembre']; // $idGenreNotif est l'idGenre du genre modifié
			$notification = 'Modifié';  // sert à afficher la modification réalisée dans la vue
			break;
		}

		case 'supprimerMembre': {
			$idMembre = $_POST['txtIdMembre'];
			$db-> supprimerMembre($idMembre);
			break;
		}
	}*/
		
	// l' affichage des membres se fait dans tous les cas	
	$tbMembresTemp  = $db->getLesMembres();
	$tbMembres = array();	
	foreach ($tbMembresTemp as $membre){
		$tbMembres += [$membre->idMembre => $membre];
	}	
	require 'vues/v_gestion_user.php';

	?>
