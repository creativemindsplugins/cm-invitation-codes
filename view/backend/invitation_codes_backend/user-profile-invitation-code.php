<?php
use com\cminds\registration\model\InvitationCode;
global $wp_roles;
$roles = $wp_roles->role_names;
if($userId != '' && $userId > 0) {
	$user = get_user_by('id', $userId);
	$profile_roles = array_values($user->roles);
} else {
	$profile_roles = array();
}
?>
<hr>
<h3>CM Registration Pro</h3>
<table class="form-table">
	<tbody>
		<tr class="cmreg-invitation-code">
			<th valign="top">Additional Roles</th>
			<td>
				<?php
				foreach($roles as $rolekey=>$roleval) {
					if($profile_roles[0] != $rolekey) {
						echo '<div style="margin-bottom:5px;">';
						if(in_array($rolekey, $profile_roles)) {
							echo '<input style="vertical-align:middle;" name="cmreg_additional_roles[]" type="checkbox" value="'.$rolekey.'" checked="checked">';
						} else {
							echo '<input style="vertical-align:middle;" name="cmreg_additional_roles[]" type="checkbox" value="'.$rolekey.'">';
						}
						echo $roleval;
						echo '</div>';
					}
				}
				?>
			</td>
		</tr>
	</tbody>
</table>
<hr>
<h3>CM Registration Invitation Code</h3>
<table class="form-table">
	<tbody>
		<tr class="cmreg-invitation-code">
			<th valign="top">Invitation Code</th>
			<td>
				<?php
				echo $content ?? '';
				?>
			</td>
		</tr>
	</tbody>
</table>