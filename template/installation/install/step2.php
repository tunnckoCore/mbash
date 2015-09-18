							
							<?php
								foreach($this->data as $e => $errs) {
									echo '<div class="hint"><h4>'.$errs['msg'].'</h4></div>';
								}
							
							?>
							
							<form action="step_1" method="post">
							<table>
									<tr>
										<td class="stage">MySQ2L Server: </td>
										<td class="stage"><input class="tbox" id="server" name="MB_SERVER" size="40" maxlength="100" type="text" /></td>
										<td class="stage"><div class="hint">
										The MySQL server you would like MartonBash to use. It can also include a port number. e.g. hostname:port or a path to a local socket e.g. ':/path/to/socket' for the localhost.
										</div></td>
									</tr>
									<tr>
										<td class="stage">MySQL Username: </td>
										<td class="stage"><input class="tbox" id="name" name="MB_USERNAME" size="40" maxlength="100" type="text" /></td>
										<td class="stage"><div class="hint">
										The username you wish MartonBash to use for connecting to your MySQL server
										</div></td>
									</tr>
									<tr>
										<td class="stage">MySQL Password: </td>
										<td class="stage"><input class="tbox" id="password" name="MB_PASSWORD" size="40" maxlength="100" type="password" /></td>
										<td class="stage"><div class="hint">
										The Password for the user you just entered
										</div></td>
									</tr>
									<tr>
										<td class="stage">MySQL Database</td>
										<td class="stage"><input class="tbox" size="40" id="db" name="MB_DATABASE" maxlength="100" type="text" /><br /></td>
										<td class="stage"><div class="hint">
										The MySQL database you wish MartonBash to reside in, sometimes referred to as a schema. If the user has database create permissions you can opt to create the database automatically if it doesn't already exist.
										</div></td>
									</tr>
									<tr>
						<td class="stage">Table prefix: </td>
						<td class="stage"><input class="tbox" size="40" id="db" name="MB_TABLE_PREFIX" maxlength="100" type="text" /><br />
						default:  <span class="boldtext">mb_</span></td>
										<td class="stage"><div class="hint">
										The prefix you wish MartonBash to use when creating the MartonBash tables. Useful for multiple installs of MartonBash in one database schema.</div></td>
									</tr>
							</table>
							<div class="navigation clearfix">
								
									<div class="right pr_30">
										<input type="submit" class="button" id="submit" name="finishStepTwo" value="Next (Step 2)" />
									</div>
								
							</div>
							</form>