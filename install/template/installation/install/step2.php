							<table>
									<tr>
						<td class="stage">Admin Username: </td>
						<td class="stage"><input class="tbox tboxfocus" id="server" name="MB_ADMIN_USERNAME" size="40" maxlength="100" type="text" /></td>
						<td class="stage"><div class="hint">
						The MySQL server you would like MartonBash to use. It can also include a port number. e.g. hostname:port or a path to a local socket e.g. ':/path/to/socket' for the localhost.
						</div></td>
									</tr>
									<tr>
						<td class="stage">Admin Display name: </td>
						<td class="stage"><input class="tbox" id="name" name="MB_ADMIN_DISPLAYNAME" size="40" maxlength="100" type="text" /></td>
						<td class="stage"><div class="hint">
						The username you wish MartonBash to use for connecting to your MySQL server
						</div></td>
									</tr>
									<tr>
						<td class="stage">Admin Password: </td>
					<td class="stage"><input class="tbox" id="password" name="MB_ADMIN_PASSWORD" size="40" maxlength="100" type="password" /></td>
						<td class="stage"><div class="hint">
						The Password for the user you just entered
						</div></td>
									</tr>
									<tr>
						<td class="stage">Confirm Password: </td>
						<td class="stage"><input class="tbox" size="40" id="db" name="MB_ADMIN_CONFIRM" maxlength="100" type="text" /><br /></td>
						<td class="stage"><div class="hint">
						The MySQL database you wish MartonBash to reside in, sometimes referred to as a schema. If the user has database create permissions you can opt to create the database automatically if it doesn't already exist.
						</div></td>
									</tr>
									<tr>
						<td class="stage">Admin Email: </td>
						<td class="stage"><input class="tbox" size="40" id="db" name="MB_ADMIN_EMAIL" maxlength="100" type="text" /></td>
						<td class="stage"><div class="hint">
						The prefix you wish MartonBash to use when creating the MartonBash tables. Useful for multiple installs of MartonBash in one database schema.</div></td>
									</tr>
							</table>
							<div class="navigation clearfix">
								<form action="step_1" method="post">
									<div class="left pl_30">
									<input type="submit" id="submit" class="button" name="finishStepOne" value="Prev (Step 1)"/>
									</div>
								</form>
								<form action="step_3" method="post">
									<div class="right pr_30">
									<input type="submit" id="submit" class="button" name="finishStepTwo" value="Next (Step 3)"/>
									</div>
								</form>
							</div>