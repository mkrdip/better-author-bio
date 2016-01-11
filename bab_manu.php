<?php

 add_filter('user_contactmethods','hide_profile_fields',10,1);

    function hide_profile_fields( $contactmethods ) {
   $contactmethods['twitter'] = 'Twitter (URL)';
		$contactmethods['facebook'] = 'Facebook (URL)';
		$contactmethods['lnkin'] = 'LinkedIn (URL)';
		$contactmethods['gplus'] = 'Google+ (URL)';
		// remove
		unset($contactmethods['yim']);
		unset($contactmethods['aim']);
		return $contactmethods;
    }


function bab_gravatar( $email ) {
	
	$string = get_avatar( $email, '60' );
$patterns = array();
$patterns[0] = '/img/';
$replacements = array();
$replacements[0] = 'img style="background:#FFF;float:left;margin:0 10px 0 10px;padding:3px;border:1px solid #CCC;"';

return preg_replace($patterns, $replacements, $string);

}



function bab_manual(){

		
if( is_single() ) {
			$bab_showauttxt = get_option('bab_showauttxt');
			$bab_auttxt1 = get_option('bab_auttxt1');
			$bab_auttxt2 = get_option('bab_auttxt2');
			$bab_showautbio = get_option('bab_showautbio');
			$bab_showautintro = get_option('bab_showautintro');
			$bab_showautgra = get_option('bab_showautgra');
			$author = array();
			$author['name'] = get_the_author();
			$author['twitter'] = get_the_author_meta('twitter');
			$author['facebook'] = get_the_author_meta('facebook');
			$author['gplus'] = get_the_author_meta('gplus');
			$author['posts'] = (int)get_the_author_posts();
			$email = get_the_author_meta('email');
			ob_start();
			?>
			<div id="better-author-bio-div" style="background:#F7F7F7; margin:20px 0px 0px 0px; padding:10px 0; border:1px solid #E6E6E6; overflow:hidden; width:100%;" >
				<div class="better-author-bio-div-info">
				        <?php if($bab_showautgra== 'y'){ ?>
					<?php echo bab_gravatar( $email ); ?>
					<?php } ?>
					<h4 style"margin:0 0 4px 90px; padding:0;" ><?php printf( esc_attr__( '%s %s'), $bab_showautintro, get_the_author() ); ?></h4>
					
					<?php if($bab_showauttxt== 'y'){ ?>
					<p style="margin:0 0 0 90px; padding:0;" class="better-author-bio-div-text"><?php echo esc_attr(sprintf(__ngettext('%s %s %d %s', '%s %s %d %s', $author['posts'], $bab_auttxt1, $bab_auttxt2, 'better-author-bio-div'), get_the_author_firstname().' '.get_the_author_lastname(), $bab_auttxt1, $author['posts'], $bab_auttxt2 )); ?>.</p>
					<?php } else echo "<br />"; ?>
					<?php if($bab_showautbio== 'y'){ ?>
					<p style="margin:0 0 0 90px; padding:0;" class="better-author-bio-div-meta"><?php echo get_the_author_meta('description'); ?></p>
					<?php } else echo "<br />"; ?>
					<ul style="overflow:hidden; margin:0 0 0 90px; padding:0;" >
						<li style="list-style-type:none; float:left; margin:8px 6px 0 0; padding:0 0 0 6px; line-height:120%; border-left:1px solid #ccc;" class="first" ><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>' ), get_the_author() ); ?>
								</a></li>
						<li style="list-style-type:none; float:left; margin:8px 6px 0 0; padding:0 0 0 6px; line-height:120%; border-left:1px solid #ccc;" class="first" ><a href="<?php echo get_the_author_meta('url'); ?>" title="<?php echo esc_attr(sprintf(__('Read %s&#8217;s blog', 'better-author-bio-div'), $author['name'])); ?>"><?php echo __("Blog"); ?></a></li>
						<?php if(!empty($author['twitter'])): ?>
						<li style="list-style-type:none; float:left; margin:8px 6px 0 0; padding:0 0 0 6px; line-height:120%; border-left:1px solid #ccc;" class="first" ><a href="<?php echo $author['twitter']; ?>" title="<?php echo esc_attr(sprintf(__('Follow %s on Twitter', 'better-author-bio-div'), $author['name'])); ?>" rel="external">Twitter</a></li>
						<?php endif; ?>
						<?php if(!empty($author['facebook'])): ?>
						<li style="list-style-type:none; float:left; margin:8px 6px 0 0; padding:0 0 0 6px; line-height:120%; border-left:1px solid #ccc;" class="first" ><a href="<?php echo $author['facebook']; ?>" title="<?php echo esc_attr(sprintf(__('Be %s&#8217;s friend on Facebook', 'better-author-bio-div'), $author['name'])); ?>" rel="external">Facebook</a></li><?php endif; ?>
                        <?php if(!empty($author['gplus'])): ?>
<li style="list-style-type:none; float:left; margin:8px 6px 0 0; padding:0 0 0 6px; line-height:120%; border-left:1px solid #ccc;" class="first" ><a href="<?php echo $author['gplus']; ?>" rel="me" title="<?php echo esc_attr(sprintf(__('Add %s in your circle', 'better-author-bio-div'), $author['name'])); ?>" rel="external">Google+</a></li>
						<?php endif; ?>
                          <?php if(!empty($author['lknin'])): ?>
<li><a href="<?php echo $author['lnkin']; ?>"  title="<?php echo esc_attr(sprintf(__('Connect with %s', 'better-author-bio-div'), $author['name'])); ?>" rel="external">LinkedIn</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
<?php			


}
$bab_bio = ob_get_clean();
echo $bab_bio;
} 

function bab_shortcode(){
	$bab_ab = bab_manual();
	return $bab_ab;

add_shortcode('author_bio', 'bab_shortcode');
}

?>
