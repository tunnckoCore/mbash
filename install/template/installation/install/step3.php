							<table>
									<tr>
						<td class="stage">Website Directory: </td>
						<td class="stage"><input class="tbox tboxfocus" id="server" name="MB_WEBSITE_DIR" size="40" maxlength="100" type="text" /></td>
						<td class="stage"><div class="hint">
						The MySQL server you would like MartonBash to use. It can also include a port number. e.g. hostname:port or a path to a local socket e.g. ':/path/to/socket' for the localhost.
						</div></td>
									</tr>
									<tr>
						<td class="stage">Security Key: </td>
						<td class="stage"><input class="tbox" size="40" id="db" name="MB_HASH_SECURITY_KEY" size="250" maxlength="250" type="text" /><br /></td>
						<td class="stage"><div class="hint">
						The prefix you wish MartonBash to use when creating the MartonBash tables. Useful for multiple installs of MartonBash in one database schema.</div></td>
									</tr>
									<tr>
						<td class="stage">Articles Per Page: </td>
					<td class="stage"><input class="tbox" id="password" name="MB_NEWS_PER_PAGE" size="40" maxlength="40" type="password" /></td>
						<td class="stage"><div class="hint">
						The Password for the user you just entered
						</div></td>
									</tr>
									
							</table>
							<div class="navigation clearfix">
								<form action="step_2" method="post">
									<div class="left pl_30">
									<input type="submit" id="submit" class="button" name="finishStepTwo" value="Prev (Step 2)"/>
									</div>
								</form>
								<form action="<?php echo '../steps/insertTables';?>" method="post">
									<div class="right pr_30">
									<input type="submit" id="submit" class="button" name="installation" value="Install"/>
									</div>
								</form>
							</div>
							