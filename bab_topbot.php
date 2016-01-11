<?php

Class better_Author_box_red {

	public static function init() {
		global $wp_version;
		// better Author Bio requires Wordpress 3.7 or grater
		if (version_compare($wp_version, "3.7", "<")) {
			return false;
		}
		self::addFilters();
		self::addActions();
		load_plugin_textdomain('better-author-bio-div', false, dirname(plugin_basename(__FILE__ )));
		return true;
	}

	public static function filterContactMethods($contactmethods) {
		//add
		$contactmethods['twitter'] = 'Twitter';
		$contactmethods['facebook'] = 'Facebook';
		$contactmethods['lnkin'] = 'LinkedIn';
		$contactmethods['gplus'] = 'Google+';
		// remove
		unset($contactmethods['yim']);
		unset($contactmethods['aim']);
		return $contactmethods;
	}



	public static function filterContent($content = '') {
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
			ob_start();
			?>
			<div id="better-author-bio-div">
				<div class="better-author-bio-div-info">
				        <?php if($bab_showautgra== 'y'){ ?>
					<?php echo get_avatar( get_the_author_meta('email'), '60' ); ?>
					<?php } ?>
					<h4><?php printf( esc_attr__( '%s %s'), $bab_showautintro, get_the_author() ); ?></h4>
					
					<?php if($bab_showauttxt== 'y'){ ?>
					<p class="better-author-bio-div-text"><?php echo esc_attr(sprintf(_n('%s %s %d %s', '%s %s %d %s', $author['posts'], $bab_auttxt1, $bab_auttxt2, 'better-author-bio-div'), get_the_author_meta('first_name').' '.get_the_author_meta('last_name'), $bab_auttxt1, $author['posts'], $bab_auttxt2 )); ?>.</p>
					<?php } else echo "<br />"; ?>
					<?php if($bab_showautbio== 'y'){ ?>
					<p class="better-author-bio-div-meta"><?php echo get_the_author_meta('description'); ?></p>
					<?php } else echo "<br />"; ?>
					<ul>
						<li class="first"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>' ), get_the_author() ); ?>
								</a></li>
						<li><a href="<?php echo get_the_author_meta('url'); ?>" title="<?php echo esc_attr(sprintf(__('Read %s&#8217;s blog', 'better-author-bio-div'), $author['name'])); ?>"><?php echo __("Blog"); ?></a></li>
						<?php if(!empty($author['twitter'])): ?>
						<li><a href="<?php echo $author['twitter']; ?>" title="<?php echo esc_attr(sprintf(__('Follow %s on Twitter', 'better-author-bio-div'), $author['name'])); ?>" rel="external">Twitter</a></li>
						<?php endif; ?>
						<?php if(!empty($author['facebook'])): ?>
						<li><a href="<?php echo $author['facebook']; ?>" title="<?php echo esc_attr(sprintf(__('Be %s&#8217;s friend on Facebook', 'better-author-bio-div'), $author['name'])); ?>" rel="external">Facebook</a></li><?php endif; ?>
                        <?php if(!empty($author['gplus'])): ?>
<li><a href="<?php echo $author['gplus']; ?>" rel="me" title="<?php echo esc_attr(sprintf(__('Add %s in your circle', 'better-author-bio-div'), $author['name'])); ?>" rel="external">Google+</a></li>
						<?php endif; ?>
                        <?php if(!empty($author['lknin'])): ?>
<li><a href="<?php echo $author['lnkin']; ?>"  title="<?php echo esc_attr(sprintf(__('Connect with %s', 'better-author-bio-div'), $author['name'])); ?>" rel="external">LinkedIn</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
			<?php $bab_loc = get_option('bab_loc');
				        $contend = $content;
				   

                                        if ($bab_loc == 'bottom') $content = $content . ob_get_clean();
                            		if ($bab_loc == 'top') $content = ob_get_clean() . $content;

					
			 
			
			
		}
                 
		return $content;
	}

	public static function pluginCss() {
		if(file_exists(self::getPluginDir() . '/better-author-bio-div.css')) {
			wp_register_style('better-author-bio-div', self::getPluginUrl().'/better-author-bio-div.css');
			wp_enqueue_style('better-author-bio-div');
		}
	}

	private static function getPluginDir() {
		return WP_PLUGIN_DIR .'/'. dirname(plugin_basename(__FILE__));
	}

	private static function getPluginUrl() {
		return WP_PLUGIN_URL .'/'. dirname(plugin_basename(__FILE__));
	}

	private static function addFilters() {

                                 

		add_filter('user_contactmethods', array('better_Author_box_red', 'filterContactMethods'));

		add_filter('the_content', array('better_Author_box_red', 'filterContent')); 
	}

	private static function addActions() {
		add_action('wp_print_styles', array('better_Author_box_red', 'pluginCss'));
	}


}

  if(!better_Author_box_red::init()) {
	echo 'better-author-bio-div plugin requires WordPress 3.7 or higher. Please upgrade!';
}


?>
