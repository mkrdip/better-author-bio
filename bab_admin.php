<div class="wrap" style="width: 68%;">
	
	<?php    echo "<h1>" . __( 'Better Author Bio Settings', 'bab_trdom' ). "</h1>" . "<strong>by <a href='http://mkrdip.me' target='_blank' >Mrinal Roy</a></strong>"; ?>

	<?php 
		if ( !empty ($_POST['bab_hidden']) == 'Y' ) {
			//Form data sent
			$bab_loc = $_POST['bab_loc'];
			update_option('bab_loc', $bab_loc);
					update_option('bab_hidden', 1);
			$bab_auttxt1 = $_POST['bab_auttxt1'];
			update_option('bab_auttxt1', $bab_auttxt1);
			$bab_auttxt2 = $_POST['bab_auttxt2'];
			update_option('bab_auttxt2', $bab_auttxt2);
			$bab_showauttxt = $_POST['bab_showauttxt'];
			update_option('bab_showauttxt', $bab_showauttxt);
			$bab_showautbio = $_POST['bab_showautbio'];
			update_option('bab_showautbio', $bab_showautbio);
			$bab_showautintro = $_POST['bab_showautintro'];
			update_option('bab_showautintro', $bab_showautintro);
			$bab_showautgra = $_POST['bab_showautgra'];
			update_option('bab_showautgra', $bab_showautgra);
	?>
	<br /><br />
	
	<div class="updated">
		<p><strong><?php esc_html_e('Better Author Bio Settings Saved.'); ?></strong></p>
	</div>

		<?php
		} else {
			//Normal page display
			$bab_loc = get_option('bab_loc');
			$bab_auttxt1 = get_option('bab_auttxt1');
			$bab_auttxt2 = get_option('bab_auttxt2');
			$bab_showauttxt = get_option('bab_showauttxt');
			$bab_showautbio = get_option('bab_showautbio');
			$bab_showautintro = get_option('bab_showautintro');
			$bab_showautgra = get_option('bab_showautgra');
			
		}	
		?>


	<form name="bab_form" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="POST">
		<input type="hidden" name="bab_hidden" value="Y">

		<h3><?php esc_html_e('Show the Better Author Bio in:'); ?></h3>
		<input type="radio" name="bab_loc" value="top"<?php if ($bab_loc=='top') { echo ' checked="checked"'; } ?> />
		<?php esc_html_e('Top of the Post'); ?>
		<br />
		<input type="radio" name="bab_loc" value="bottom"<?php if ($bab_loc=='bottom') { echo ' checked="checked"'; } ?> /> <?php esc_html_e('Bottom of the Post'); ?>
		<br />
		<input type="radio" name="bab_loc" value="manual"<?php if ($bab_loc=='manual') { echo ' checked="checked"'; } ?> /> 
		<?php esc_html_e('Manual'); ?>

		<?php if($bab_loc=='manual'){

				echo "<br /><br /> Use <code>[author_bio]</code> shortcode anywhere in your post/page body to display the author bio or put <code>&lt;?php bab_manual(); ?&gt;</code> in the source code of your current theme where you want to show the author bio box. e.g: <code>single.php</code><br /><br />";
				}
		?>

		<h3><?php esc_html_e('Show Authors gravatar in Better Author Bio Box:'); ?></h3>
		<input type="radio" name="bab_showautgra" value="y"<?php if ($bab_showautgra=='y') { echo ' checked="checked"'; } ?> /> <?php esc_html_e('Yes'); ?>
		<input type="radio" name="bab_showautgra" value="n"<?php if ($bab_showautgra=='n') { echo ' checked="checked"'; } ?> /> <?php esc_html_e('No'); ?>
		<br />


		<?php echo "<h3>Write the text to show before Author Name:</h3>"; ?>
		<input type="text" name="bab_showautintro" value="<?php echo $bab_showautintro ; ?>"/> (then author name will displayed automatically e.g: About Jhon Doe).<br />

		<?php echo "<h3>Show Author's bio text in Better Auter Bio Box</h3>"; ?>
		<input type="radio" name="bab_showautbio" value="y"<?php if ($bab_showautbio=='y') { echo ' checked="checked"'; } ?>/> 
		<?php esc_html_e('Yes'); ?>
		<input type="radio" name="bab_showautbio" value="n"<?php if ($bab_showautbio=='n') { echo ' checked="checked"'; } ?> /> <?php esc_html_e('No'); ?>
		<br />


		<?php echo "<h3>Show Author's number of posts ?</h3>"; ?>
		<input type="radio" name="bab_showauttxt" value="y"<?php if ($bab_showauttxt=='y') { echo ' checked="checked"'; } ?> /> <?php esc_html_e('Yes'); ?>
		<input type="radio" name="bab_showauttxt" value="n"<?php if ($bab_showauttxt=='n') { echo ' checked="checked"'; } ?> /> <?php esc_html_e('No'); ?>
		<br />


		<h3><?php esc_html_e("Write the text to show Author's numer of Posts:"); ?></h3>
		<input type="text" name="bab_auttxt1" value="<?php echo $bab_auttxt1 ; ?>"/> (number of posts) <input type="text" name="bab_auttxt2" value="<?php echo $bab_auttxt2 ; ?>" /><br />
		
		<p class="submit">
			<input type="submit" name="Submit" class="button button-primary" value="Save Changes" />
		</p>
		
	</form>
	
</div>
