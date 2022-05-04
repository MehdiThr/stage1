
<div class="hero is-link is-fullheight">
					<div class="hero-body">
						<div class="container">
							<div class="columns is-centered">
								<div class="column is-5-tablet is-4-desktop is-3-widescreen">
                    				<form class="box" method="post" action="index.php">
                        				<div class="field has-text-centered">
										</div>
										<p class="is-pulled-right"> Email correspondant : <strong><?php echo $email; ?></strong></p>
											<div class="field">
												<label for="newPass" class="label">Nouveau mot de passe</label>
													<div class="control has-icons-left">
														<input type="password" name="newPass" id="newPass" class="input" required>
															<span class="icon is-small is-left">
															<i class="fa fa-lock"></i>
															</span>
													</div>
											</div>

													<div class="field">
														<label for="newPassTest" class="label">Confirmer nouveau mot de passe</label>
															<div class="control has-icons-left">
																<input type="password" name="newPassTest" id="newPassTest" class="input" required>
																	<span class="icon is-small is-left">
																		<i class="fa fa-lock"></i>
																	</span>
															</div>
													</div>
													<input type="hidden" name="newPassh" id="newPassh">
													<input type="hidden" name="newPassTesth" id="newPassTesth">
													<input type="hidden" name="cle" id="cle" value="<?php echo $cle ?>">
													<button class="button is-info is-outlined" id="confirmPass" type="SUBMIT" name="confirmPass" onclick="document.getElementById('newPassh').value=hex_sha512(document.getElementById('newPass').value); document.getElementById('newPass').value=' '; document.getElementById('newPassTesth').value=hex_sha512(document.getElementById('newPassTest').value); document.getElementById('newPassTest').value=' ';">
														Confirmer
													</button>
									</form>
								</div>
							</div>
						</div>
					</div>
</div>