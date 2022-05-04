<?php

// Ouverturde d'une connexion à la base de donnée cinephalsbourg
/*try
{
$bdd = new PDO('mysql:host=localhost;dbname=cinephalsbourg;charset=utf8', 'root', '');
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
$query=$bdd->prepare('SELECT * FROM membres');
$query->execute();
echo'<table class="table"><tr><td>Nom</td><td>Prénom</td><td>Email</td><td>Tel</td> ';
while($data=$query->fetch())
{
echo'<tr><td>'.$data['nom'].'</td><td>'.$data['prenom'].'</td><td>'.$data['email'].'</td><td>'.$data['tel'].'</td><td><a href="#modalModifier" class="button is-primary is-small">
<i class="fas fa-edit"></i>
</a></td></tr>';
}
echo'</table>'; */
?>
	<p class="is-pulled-right"> Connecté en tant que : <strong><?php echo $_SESSION['email']; ?></strong></p>
			<form action="controller/c_deconnexion.php">
			<input type="SUBMIT" style="position: absolute; top: 30; right: 0;" class="button is-success is-light" name="deco" VALUE="Déconnexion"></form>


			<table class="table table-striped table-advance table-hover">
				<thead>
					<tr class="tableau-entete">
         			 	<th><i class="fas fa-id-card"></i> Identifiant</th>
						<th><i class="fas fa-id-card"></i> Nom</th>
						<th><i class="fas fa-id-card"></i> Prenom</th>
           				<th><i class="fas fa-envelope-square"></i> Email</th>
            			<th><i class="fas fa-phone"></i> Tel</th>
            			<th> Type membre</th>
						<th></th>
					</tr>
				</thead>
				<tbody>


					<?php
					foreach ($tbMembres as $membre) {
					?>
						<tr>
							<td><?php echo $membre->idMembre; ?></td>
							<td><?php echo $membre->nom; ?></td>
               				<td><?php echo $membre->prenom; ?></td>
                			<td><?php echo $membre->email; ?></td>
                			<td><?php echo $membre->tel; ?></td>
                			<td><?php echo $membre->typeMembre; ?></td>
                			<td>
                  				<form method="post" action="index.php">
                    				<button type="submit" class="button is-primary is-small" name="demanderModifierUser" value="<?php echo $membre->idMembre; ?>"><i class="fas fa-edit"></i></button>
                  				</form>
                			</td>
							<td>
                  				<form method="post" action="index.php">
                    				<button type="submit" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));" class="button is-danger is-small" name="supprimerUser" value="<?php echo $membre->idMembre; ?>"><i class="fas fa-trash-alt"></i></button>
                  				</form>
                			</td>
              					

						</tr>
					<?php
					}
					?>
				</tbody>
			</table>

<!-- Bouton d'ouverture -->
<a onclick="toggleElement('modalAjouter');" class="button is-primary">
  <i class="fas fa-user-plus"></i>
</a>
<!-- Conteneur modal -->
<div class="modal" id="modalAjouter">
  <div onclick="toggleElement('modalAjouter');" class="modal-background"></div> 
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Ajout d'un utilisateur</p>
      <div class="field">
    <label class="label"></label>
  </div>
      <!-- Bouton de fermeture -->
      <a onclick="toggleElement('modalAjouter');" title="Fermer la fenêtre">
        <i class="fas fa-times btn_close"></i> <!-- Icône font awesome -->
      </a>
    </header>
 
    <section class="modal-card-body">
		<form class="box" method="post" action="index.php">
			<div class="field">
				<label for="nom" class="label">Nom</label>
				<div class="control has-icons-left">
					<input type="text" name="nom" id="nom" class="input" required>
						<span class="icon is-small is-left">
							<i class="fas fa-id-badge"></i>
						</span>
				</div>
			</div>

			<div class="field">
				<label for="prenom" class="label">Prenom</label>
					<div class="control has-icons-left">
						<input type="text" name="prenom" id="prenom" class="input" required>
							<span class="icon is-small is-left">
								<i class="fas fa-id-badge"></i>
							</span>
					</div>
			</div>

			<div class="field">
				<label for="email" class="label">Email</label>
					<div class="control has-icons-left">
						<input type="email" name="email" id="email" class="input" required>
							<span class="icon is-small is-left">
								<i class="fas fa-id-badge"></i>
							</span>
					</div>
			</div>					

			<div class="field">
				<label for="tel" class="label">Tel</label>
				<div class="control has-icons-left">
					<input type="text" name="tel" id="tel" class="input" required>
						<span class="icon is-small is-left">
							<i class="fas fa-id-badge"></i>
						</span>
				</div>
			</div>

			<div class="field">
				<label for="password" class="label">Mot de passe</label>
					<div class="control has-icons-left">
						<input type="password" name="pass" id="password" placeholder="********" class="input" required>
							<span class="icon is-small is-left">
								<i class="fa fa-lock"></i>
							</span>
					</div>
			</div>

			<div class="field">
				<label for="typeMembre" class="label">Type membre</label>
					<select name="typeMembre" id="typeMembre">
						<option value="admin">admin</option>
						<option value="projectionniste">projectionniste</option>
					</select>
			</div>
			<input type="hidden" name="hpass" id="hpass">
			<div class="field">
				<div class="control">
					<button class="button is-info is-outlined" onclick="document.getElementById('hpass').value=hex_sha512(document.getElementById('password').value); document.getElementById('password').value=' ';" type="SUBMIT" name="ajouterNouveauMembre">
							Ajouter	
					</button>
				</div>	
			</div>
		</form>	      
    </section>
 
    <footer class="modal-card-foot">
      <a onclick="toggleElement('modalAjouter');" class="button is-primary">Fermer</a>
    </footer>
  </div>
</div>





<!--Conteneur modal pour modifier membre -->
<?php 
if ($idUserModif){
  $isActive=" is-active";
} else {
  $isActive="";
}
?>
<div class="modal<?php echo $isActive; ?>" id="modalModifier">
  <a onclick="toggleElement('modalModifier');"><div class="modal-background"></div></a>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Modifier utilisateur</p>
      <div class="field">
  <label class="label"></label>
</div>
      <!-- Bouton de fermeture -->
      <a onclick="toggleElement('modalModifier');" title="Fermer la fenêtre">
        <i class="fas fa-times btn_close"></i> 
      </a>
    </header>
 
    <section class="modal-card-body">
	<form class="box" method="post" action="index.php">
		<input type="hidden" name="idUserModif" value="<?php echo $idUserModif; ?>">
      <div class="field">
        <label for="nom" class="label">Nom</label>
        <div class="control">
       	 <input type="text" name="nom" id="nom"  required class="input" value="<?php echo $tbMembres[$idUserModif]->nom; ?>">
        </div>
      </div>
      <div class="field">
        <label for="prenom" class="label">Prénom</label>
        <div class="control">
          <input type="text" name="prenom" id="prenom" class="input" required value="<?php echo $tbMembres[$idUserModif]->prenom; ?>">
        </div>
      </div>
      <div class="field">
        <label for="email" class="label">Email</label>
        <div class="control">
          <input type="text" name="email" id="email" class="input" required value="<?php echo $tbMembres[$idUserModif]->email; ?>">
        </div>
      </div>
      <div class="field">
        <label for="tel" class="label">Tel</label>
        <div class="control">
          <input type="text" name="tel" id="tel" class="input" required value="<?php echo $tbMembres[$idUserModif]->tel; ?>">
        </div>
      </div>
	  <div class="field">
				<label for="typeMembre" class="label">Type membre</label>
					<select name="typeMembre" id="typeMembre">
						<option value="admin">admin</option>
						<option value="projectionniste">projectionniste</option>
					</select>
		</div>

      <div class="field">
	    	<div class="control">
  	    	  <button class="button is-info is-outlined" onclick="toggleElement('modalModifier');" type="SUBMIT" name="validerModifierUser">Modifier</button>
        	</div>
      </div>
	</form>
    </section>
 
    <footer class="modal-card-foot">
      <a onclick="toggleElement('modalModifier');" class="button is-primary">Fermer</a>
    </footer>
  </div>
</div> 

<!--
<?php 
if ($idUserSupr){
  $isActive=" is-active";
} else {
  $isActive="";
}
?>
<div class="modal<?php echo $isActive; ?>" id="modalSupprimer">
  <a onclick="toggleElement('modalSupprimer');"><div class="modal-background"></div></a>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Supprimer utilisateur</p>
      <div class="field">
  <label class="label"></label>
</div>
       Bouton de fermeture
      <a onclick="toggleElement('modalSupprimer');" title="Fermer la fenêtre">
        <i class="fas fa-times btn_close"></i> 
      </a>
    </header>

	<section class="modal-card-body">
	</section> 