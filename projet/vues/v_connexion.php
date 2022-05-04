<div class="hero is-dark is-fullheight">
					<div class="hero-body">
						<div class="container">
							<div class="columns is-centered">
								<div class="column is-5-tablet is-4-desktop is-3-widescreen">
                    				<form class="box" method="post" action="">
                        				<div class="field has-text-centered">
										</div>
                        					<div class="field">
                            					<label for="email" class="label">Email</label>
                            					<div class="control has-icons-left">
                                					<input type="text" name="email" id="email" class="input" required>
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
										<input type="hidden" name="hpass" id="hpass">
										<div class="field">
											<div class="control">
                            					<button class="button is-info is-outlined" id="deco" type="SUBMIT" name="valider" onclick="document.getElementById('hpass').value=hex_sha512(document.getElementById('password').value); document.getElementById('password').value=' ';">
													CONNEXION	
												</button>
											</div>
										</div>
										<a onclick="toggleElement('modalMdp');" id="changepass" name="changepass" class="button is-small is-primary is-inverted">
  											Mot de passe oublié
										</a>
									</form>
								</div>
							</div>
						</div>
					</div>
</div>


		<!-- Conteneur modal -->
		<div class="modal" id="modalMdp">
  			<div onclick="toggleElement('modalMdp');" class="modal-background"></div> 
  				<div class="modal-card">
    				<header class="modal-card-head">
      					<p class="modal-card-title">Modification du mot de passe</p>
      					<div class="field">
    						<label class="label"></label>
  						</div>
      					<!-- Bouton de fermeture -->
      					<a onclick="toggleElement('modalMdp');" title="Fermer la fenêtre">
        					<i class="fas fa-times btn_close"></i> <!-- Icône font awesome -->
      					</a>
    				</header>
 
    				<section class="modal-card-body">
						<form class="box" method="post" action="index.php">
							<div class="field">
								<label for="emailc" class="label">Email</label>
									<div class="control has-icons-left">
										<input type="email" name="emailc" id="emailc" class="input" required>
											<span class="icon is-small is-left">
												<i class="fas fa-id-badge"></i>
											</span>
									</div>
							</div>
								<footer class="modal-card-foot">
									<button class="button is-info is-outlined" id="confirmMail" type="SUBMIT" name="confirmMail">
													Confirmer
									</button>
											
      								<a onclick="toggleElement('modalMdp');" class="button is-primary">Fermer</a>
								</footer>
						</form>						