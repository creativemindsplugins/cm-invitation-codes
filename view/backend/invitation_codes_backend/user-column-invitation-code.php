<?php
$is_input = $is_input ?? true;
$code_string = '';

if(count($codes) > 0 ) {
	foreach($codes as $ckey=>$cval) {
		$code_string = $cval['code_string'];
		?>
		<a href="<?php echo esc_attr( admin_url(sprintf('post.php?action=edit&post=%d', $cval['code'])) ); ?>" style="margin-right:5px;">
			<?php echo esc_html( get_the_title($cval['code']) ); ?>
		</a>
		<?php
	}
} else {
	if (!empty($code)) {
		$code_string = $code->getCodeString();
		?>
		<a href="<?php echo esc_attr( $code->getEditUrl() ); ?>" style="margin-right:5px;">
			<?php echo esc_html( $code->getTitle() ); ?>
		</a>
		<?php
	}
}
?>
<div style="margin-top:10px;">
	<?php
	if ( $is_input ) {
		?>
        <input type="text" name="cmreg_invitation_code" value="<?php echo esc_attr( $code_string ); ?>" />
		<?php
	} else {
		echo esc_html( $code_string );
	} 
	?>
</div>