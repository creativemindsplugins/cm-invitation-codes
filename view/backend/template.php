<div class="wrap">
    <h2><?php echo $title; ?></h2>
    <?php
    echo do_shortcode( '[cminds_free_activation id="cmreg"]' );
    ?>
	<div class="show_hide_pro_options" style="float:right; margin-bottom:10px;">
		<input onclick="jQuery('.onlyinpro').toggleClass('hide'); return false;" type="button" name="" value="Show/hide Pro options" class="button" />
	</div>
    <div id="cminds_settings_container">
        <?php echo $nav; ?>
        <?php echo $content; ?>
    </div>
</div>