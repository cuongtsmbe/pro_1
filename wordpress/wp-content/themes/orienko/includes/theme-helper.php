<?php
// All Orienko theme helper functions in here

function orienko_get_effect_list(){
	return array(
		esc_html__( 'None', 'orienko' ) 	=> '',
		esc_html__( 'Bounce In', 'orienko' ) 	=> 'bounceIn',
		esc_html__( 'Bounce In Down', 'orienko' ) 	=> 'bounceInDown',
		esc_html__( 'Bounce In Left', 'orienko' ) 	=> 'bounceInLeft',
		esc_html__( 'Bounce In Right', 'orienko' ) 	=> 'bounceInRight',
		esc_html__( 'Bounce In Up', 'orienko' ) 	=> 'bounceInUp',
		esc_html__( 'Fade In', 'orienko' ) 	=> 'fadeIn',
		esc_html__( 'Fade In Down', 'orienko' ) 	=> 'fadeInDown',
		esc_html__( 'Fade In Left', 'orienko' ) 	=> 'fadeInLeft',
		esc_html__( 'Fade In Right', 'orienko' ) 	=> 'fadeInRight',
		esc_html__( 'Fade In Up', 'orienko' ) 	=> 'fadeInUp',
		esc_html__( 'Flip In X', 'orienko' ) 	=> 'flipInX',
		esc_html__( 'Flip In Y', 'orienko' ) 	=> 'flipInY',
		esc_html__( 'Light Speed In', 'orienko' ) 	=> 'lightSpeedIn',
		esc_html__( 'Rotate In', 'orienko' ) 	=> 'rotateIn',
		esc_html__( 'Rotate In Down Left', 'orienko' ) 	=> 'rotateInDownLeft',
		esc_html__( 'Rotate In Down Right', 'orienko' ) 	=> 'rotateInDownRight',
		esc_html__( 'Rotate In Up Left', 'orienko' ) 	=> 'rotateInUpLeft',
		esc_html__( 'Rotate In Up Right', 'orienko' ) 	=> 'rotateInUpRight',
		esc_html__( 'Slide In Down', 'orienko' ) 	=> 'slideInDown',
		esc_html__( 'Slide In Left', 'orienko' ) 	=> 'slideInLeft',
		esc_html__( 'Slide In Right', 'orienko' ) 	=> 'slideInRight',
		esc_html__( 'Roll In', 'orienko' ) 	=> 'rollIn',
	);
}

function orienko_woocommerce_query($type,$post_per_page=-1,$cat='', $keyword = null, $ids = null){
	$args = orienko_woocommerce_query_args($type,$post_per_page,$cat, $keyword, $ids);
	return new WP_Query($args);
}
function orienko_vc_custom_css_class( $param_value, $prefix = '' ) {
	$css_class = preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $param_value ) ? $prefix . preg_replace( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $param_value ) : '';
	return $css_class;
}
function orienko_woocommerce_query_args($type,$post_per_page=-1,$cat='', $keyword = null, $ids = null){
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $post_per_page,
        'post_status' => 'publish',
		'date_query' => array(
			array(
			   'before' => date('Y-m-d H:i:s', current_time( 'timestamp' ))
			)
		 ),
		 'post_parent' => 0,
		 'tax_query' => array()
    );
    switch ($type) {
        case 'best_selling':
            $args['meta_key']='total_sales';
            $args['orderby']='meta_value_num';
            $args['ignore_sticky_posts']   = 1;
            $args['meta_query'] = array();
            break;
        case 'featured_product':
            $args['ignore_sticky_posts'] = 1;
            $args['meta_query'] = array();
            $args['tax_query'][] = array(
				'taxonomy'         => 'product_visibility',
				'terms'            => 'featured',
				'field'            => 'name',
				'operator'         => 'IN',
				'include_children' => false,
			);
            break;
        case 'top_rate':
            $args['meta_key']='_wc_average_rating';
            $args['orderby']='meta_value_num';
            $args['order']='DESC';
            $args['meta_query'] = array();
            break;
        case 'recent_product':
            $args['meta_query'] = array();
			$args['orderby']='date';
            $args['order']='DESC';
            break;
        case 'on_sale':
            $args['meta_query'] = array();
            $product_ids_on_sale    = wc_get_product_ids_on_sale();
			$product_ids_on_sale[]  = 0;
            $args['post__in'] = $product_ids_on_sale;
            break;
        case 'recent_review':
            if($post_per_page == -1) $_limit = 4;
            else $_limit = $post_per_page;
            global $wpdb;
            $query = "SELECT c.comment_post_ID FROM {$wpdb->posts} p, {$wpdb->comments} c WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0 ORDER BY c.comment_date ASC LIMIT 0, %d";
            $safe_sql = $wpdb->prepare( $query, $_limit );
			$results = $wpdb->get_results($safe_sql, OBJECT);
            $_pids = array();
            foreach ($results as $re) {
                $_pids[] = $re->comment_post_ID;
            }

            $args['meta_query'] = array();
            $args['post__in'] = $_pids;
            break;
        case 'deals':
            $args['meta_query'] = array();
            $args['meta_query'][] = array(
                                 'key' => '_sale_price_dates_to',
                                 'value' => '0',
                                 'compare' => '>');
            $product_ids_on_sale    = wc_get_product_ids_on_sale();
			$product_ids_on_sale[]  = 0;
            $args['post__in'] = $product_ids_on_sale;
            break;
		case 'ids':
			$ids = array_filter(array_map('trim', explode(',', $ids)));
			$args['post__in'] = $ids;
		    $args['orderby'] = 'post__in';
			break;
    }
	if ( 'yes' == get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
		$args['tax_query'][] = array(
			array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'outofstock',
				'operator' => 'NOT IN',
			),
		);
		$args['meta_query'][] = array(
			'key'       => '_stock_status',
			'value'     => 'outofstock',
			'compare'   => 'NOT IN'
		);
	}
    if($cat!=''){
        $args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => $cat
			);
		if (!$type) {
			$args['orderby']='menu_order';
            $args['order']='ASC';
		}
    }
	if($keyword){
		$args['s'] = $keyword;
	}
    return $args;
}
function orienko_make_id($length = 5){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
//Change excerpt length
add_filter( 'excerpt_length', 'orienko_excerpt_length', 999 );
function orienko_excerpt_length( $length ) {
	global $orienko_opt;
	if(isset($orienko_opt['excerpt_length'])){
		return $orienko_opt['excerpt_length'];
	}
	return 22;
}
function orienko_get_the_excerpt($post_id) {
	global $post;
	$temp = $post;
    $post = get_post( $post_id );
    setup_postdata( $post );
    $excerpt = get_the_excerpt();
    wp_reset_postdata();
    $post = $temp;
    return $excerpt;
}

//Add breadcrumbs
function orienko_breadcrumb() {
	global $post, $orienko_opt;
	
	$brseparator = '<span class="separator">/</span>';
	if (!is_home()) {
		echo '<div class="breadcrumbs">';
		
		echo '<a href="';
		echo esc_url( home_url( '/' ) );
		echo '">';
		echo esc_html__('Home', 'orienko');
		echo '</a>'.$brseparator;
		if (is_category() || is_single()) {
			the_category($brseparator);
			if (is_single()) {
				echo ''.$brseparator;
				the_title();
			}
		} elseif (is_page()) {
			if($post->post_parent){
				$anc = get_post_ancestors( $post->ID );
				$title = get_the_title();
				foreach ( $anc as $ancestor ) {
					$output = '<a href="'. esc_url(get_permalink($ancestor)).'" title="'.esc_attr(get_the_title($ancestor)).'">'. esc_html(get_the_title($ancestor)) .'</a>'.$brseparator;
				}
				echo wp_kses($output, array(
						'a'=>array(
							'href' => array(),
							'title' => array()
						),
						'span'=>array(
							'class'=>array()
						)
					)
				);
				echo '<span title="'.esc_attr($title).'"> '.esc_html($title).'</span>';
			} else {
				echo '<span> '. esc_html(get_the_title()).'</span>';
			}
		}
		elseif (is_tag()) {single_tag_title();}
		elseif (is_day()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'orienko'), get_the_time('F jS, Y')); echo '</span>';}
		elseif (is_month()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'orienko'), get_the_time('F, Y')); echo '</span>';}
		elseif (is_year()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'orienko'), get_the_time('Y')); echo '</span>';}
		elseif (is_author()) {echo "<span>" . esc_html__('Author Archive', 'orienko'); echo '</span>';}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>" . esc_html__('Blog Archives', 'orienko'); echo '</span>';}
		elseif (is_search()) {echo "<span>" . esc_html__('Search Results', 'orienko'); echo '</span>';}
		
		echo '</div>';
	} else {
		echo '<div class="breadcrumbs">';
		
		echo '<a href="';
		echo esc_url( home_url( '/' ) );
		echo '">';
		echo esc_html__('Home', 'orienko');
		echo '</a>'.$brseparator;
		
		if(isset($orienko_opt['blog_header_text']) && $orienko_opt['blog_header_text']!=""){
			echo esc_html($orienko_opt['blog_header_text']);
		} else {
			echo esc_html__('Blog', 'orienko');
		}
		
		echo '</div>';
	}
}
//social share products
function orienko_product_sharing() {
	global $orienko_opt;
	$pro_social_share = array();
	if(isset($orienko_opt['pro_social_share']) && is_array($orienko_opt['pro_social_share'])){
		$pro_social_share = array_filter($orienko_opt['pro_social_share']);
	}
	if(!empty($pro_social_share)){
		if(isset($_POST['data'])) { // for the quickview
			$postid = intval( $_POST['data'] );
		} else {
			$postid = get_the_ID();
		}
		
		$share_url = get_permalink( $postid );

		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'large' );
		$postimg = $large_image_url[0];
		$posttitle = get_the_title( $postid );
		?>
		<div class="widget widget_socialsharing_widget">
			<h3 class="widget-title"><?php if(isset($orienko_opt['product_share_title'])) { echo esc_html($orienko_opt['product_share_title']); } else { esc_html_e('Share this product', 'orienko'); } ?></h3>
			<ul class="social-icons">
				<?php if(!empty($orienko_opt['pro_social_share']['facebook'])){ ?>
				<li><a class="facebook social-icon" href="javascript:void(0)" onclick="javascript:window.open('<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.esc_url($share_url); ?>', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" title="<?php echo esc_attr__('Facebook', 'orienko'); ?>"><i class="fa fa-facebook"></i></a></li>
				<?php } ?>
				<?php if(!empty($orienko_opt['pro_social_share']['twitter'])){ ?>
				<li><a class="twitter social-icon" href="javascript:void(0)" onclick="javascript:window.open('<?php echo 'https://twitter.com/home?status='.esc_html($posttitle).'&nbsp;'.esc_url($share_url); ?>', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" title="<?php echo esc_attr__('Twitter', 'orienko'); ?>" ><i class="fa fa-twitter"></i></a></li>
				<?php } ?>
				<?php if(!empty($orienko_opt['pro_social_share']['pinterest'])){ ?>
				<li><a class="pinterest social-icon" href="javascript:void(0)" onclick="javascript:window.open('<?php echo 'https://pinterest.com/pin/create/button/?url='.esc_url($share_url).'&amp;media='.esc_html($postimg).'&amp;description='.esc_url($posttitle); ?>', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" title="<?php echo esc_attr__('Pinterest', 'orienko'); ?>"><i class="fa fa-pinterest"></i></a></li>
				<?php } ?>
				<?php if(!empty($orienko_opt['pro_social_share']['gplus'])){ ?>
				<li><a class="gplus social-icon" href="javascript:void(0)" onclick="javascript:window.open('<?php echo 'https://plus.google.com/share?url='.esc_url($share_url); ?>', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" title="<?php echo esc_attr__('Google +', 'orienko'); ?>"><i class="fa fa-google-plus"></i></a></li>
				<?php } ?>
				<?php if(!empty($orienko_opt['pro_social_share']['linkedin'])){ ?>
				<li><a class="linkedin social-icon" href="javascript:void(0)" onclick="javascript:window.open('<?php echo 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.esc_url($share_url).'&amp;title='.esc_html($posttitle); ?>', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" title="<?php echo esc_attr__('LinkedIn', 'orienko'); ?>"><i class="fa fa-linkedin"></i></a></li>
				<?php } ?>
			</ul>
		</div>
	<?php
	}
}
//social share blog
function orienko_blog_sharing() {
	global $orienko_opt;
	$blog_social_share = array();
	if(isset($orienko_opt['blog_social_share']) && is_array($orienko_opt['blog_social_share'])){
		$blog_social_share = array_filter($orienko_opt['blog_social_share']);
	}
	if(!empty($blog_social_share)){
		if(isset($_POST['data'])) { // for the quickview
			$postid = intval( $_POST['data'] );
		} else {
			$postid = get_the_ID();
		}
		
		$share_url = get_permalink( $postid );

		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'large' );
		$postimg = $large_image_url[0];
		$posttitle = get_the_title( $postid );
		?>
		<div class="widget widget_socialsharing_widget">
			<ul class="social-icons">
				<?php if(!empty($orienko_opt['blog_social_share']['facebook'])){ ?>
				<li><a class="facebook social-icon" href="javascript:void(0)" onclick="javascript:window.open('<?php echo 'https://www.facebook.com/sharer/sharer.php?u='. esc_url($share_url); ?>', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" title="<?php echo esc_attr__('Facebook', 'orienko'); ?>"><i class="fa fa-facebook"></i></a></li>
				<?php } ?>
				<?php if(!empty($orienko_opt['blog_social_share']['twitter'])){ ?>
				<li><a class="twitter social-icon" href="javascript:void(0)" onclick="javascript:window.open('<?php echo 'https://twitter.com/home?status='.esc_html($posttitle).'&nbsp;'.esc_url($share_url); ?>', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" title="<?php echo esc_attr__('Twitter', 'orienko'); ?>"><i class="fa fa-twitter"></i></a></li>
				<?php } ?>
				<?php if(!empty($orienko_opt['blog_social_share']['pinterest'])){ ?>
				<li><a class="pinterest social-icon" href="javascript:void(0)" onclick="javascript:window.open('<?php echo 'https://pinterest.com/pin/create/button/?url='.esc_url($share_url).'&amp;media='.esc_url($postimg).'&amp;description='.esc_html($posttitle); ?>', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" title="<?php echo esc_attr__('Pinterest', 'orienko'); ?>"><i class="fa fa-pinterest"></i></a></li>
				<?php } ?>
				<?php if(!empty($orienko_opt['blog_social_share']['gplus'])){ ?>
				<li><a class="gplus social-icon" href="javascript:void(0)" onclick="javascript:window.open('<?php echo 'https://plus.google.com/share?url='.esc_url($share_url); ?>', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" title="<?php echo esc_attr__('Google +', 'orienko'); ?>"><i class="fa fa-google-plus"></i></a></li>
				<?php } ?>
				<?php if(!empty($orienko_opt['blog_social_share']['linkedin'])){ ?>
				<li><a class="linkedin social-icon" href="javascript:void(0)" onclick="javascript:window.open('<?php echo 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.esc_url($share_url).'&amp;title='.esc_html($posttitle); ?>', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" title="<?php echo esc_attr__('LinkedIn', 'orienko'); ?>"><i class="fa fa-linkedin"></i></a></li>
				<?php } ?>
			</ul>
		</div>
		<?php
	}
}
// function display number view of posts.
function orienko_get_post_viewed($postID){
    $count_key = 'post_views_count';
	delete_post_meta($postID, 'post_like_count');
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return 0;
    }
    return $count;
}
// function to count views.
function orienko_set_post_view($postID){
    $count_key = 'post_views_count';
    $count = (int)get_post_meta($postID, $count_key, true);
    if(!$count){
        $count = 1;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, $count);
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//get taxonomy list by parent children
function orienko_get_all_taxonomy_terms($taxonomy = 'product_cat', $all = false){
	
	global $wpdb;
	
	$arr = array(
		'orderby' => 'name',
		'hide_empty' => 0
	);
	$categories = $wpdb->get_results($wpdb->prepare("SELECT t.name,t.slug,t.term_group,x.term_taxonomy_id,x.term_id,x.taxonomy,x.description,x.parent,x.count FROM {$wpdb->prefix}term_taxonomy x LEFT JOIN {$wpdb->prefix}terms t ON (t.term_id = x.term_id) WHERE x.taxonomy=%s ORDER BY x.parent ASC, t.name ASC;", $taxonomy));
	$output = array();
	if($all) $output = array( array('label' => esc_html__('All categories', 'orienko'), 'value' => '') );
	if(!is_array($categories)) return $output;
	orienko_get_repare_terms_children( 0, 0, $categories, 0, $output );
	
	return $output;
}

function orienko_get_repare_terms_children( $parent_id, $pos, $categories, $level, &$output ) {
	for ( $i = $pos; $i < count( $categories ); $i ++ ) {
		if ( isset($categories[ $i ]->parent) && $categories[ $i ]->parent == $parent_id ) {
			$name = str_repeat( " - ", $level ) . ucfirst($categories[ $i ]->name);
			$value = $categories[ $i ]->slug;
			$output[] = array( 'label' => $name, 'value' => $value );
			orienko_get_repare_terms_children( (int)$categories[ $i ]->term_id, $i, $categories, $level + 1, $output );
		}
	}
}


//Footer html addition
add_action( 'wp_footer', 'orienko_popup_onload');
function orienko_popup_onload(){

	global $orienko_opt;
	
	// quickview wrapper
	echo '<div class="quickview-wrapper"><div class="overlay-bg" onclick="hideQuickView()"></div><div class="quick-modal"><span class="qvloading"></span><span class="closeqv"><i class="fa fa-times"></i></span><div id="quickview-content"></div><div class="clearfix"></div></div></div>';
	
	//side social icons display
	if(!empty($orienko_opt['sticky_icons']) && !empty($orienko_opt['social_icons'])){ ?>
		<div class="block-social <?php echo esc_attr($orienko_opt['sticky_icons']) ?>">
			<ul>
				<?php foreach($orienko_opt['sticky_social_icons'] as $key=>$value ) { 
					$s_title = ucwords(esc_attr($key));
					if(!empty($orienko_opt['sticky_social_titles'][$key])) $s_title = $orienko_opt['sticky_social_titles'][$key];
					?>
					<?php if($value!=''){ ?>
						<?php if($key=='vimeo'){ ?>
							<li><a class="<?php echo esc_attr($key) ?>" target="_blank" href="<?php echo esc_url($value) ?>"><span><i class="fa fa-vimeo-square"></i><span class="social-text"><?php echo esc_attr($s_title); ?></span></span></a></li>
						<?php }elseif($key=='mail-to'){ ?>
							<li><a class="<?php echo esc_attr($key) ?>" target="_blank" href="<?php echo esc_url($value) ?>"><span><i class="fa fa-envelope-o"></i><span class="social-text"><?php echo esc_attr($s_title); ?></span></span></a></li>
						<?php }else{ ?>
							<li><a class="<?php echo esc_attr($key) ?>" target="_blank" href="<?php echo esc_url($value) ?>"><span><i class="fa fa-<?php echo esc_attr($key) ?>"></i><span class="social-text"><?php echo esc_attr($s_title); ?></span></span></a></li>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</ul>
		</div>
	<?php } 
	
	// newletter-form popup
	if(isset($orienko_opt['enable_popup']) && $orienko_opt['enable_popup']){
		if (is_front_page() && (!empty($orienko_opt['popup_onload_form']) || !empty($orienko_opt['popup_onload_content']))) {
			$no_again = 0; 
			if(isset($_COOKIE['no_again'])) $no_again = $_COOKIE['no_again'];
			if(!$no_again){
		?>
			<div class="popup-content" id="popup_onload">
				<div class="overlay-bg-popup"></div>
				<div class="popup-content-wrapper">
					<a class="close-popup" href="javascript:void(0)"><i class="fa fa-times"></i></a>
					<?php if(!empty($orienko_opt['popup_onload_content'])){ ?>
					<div class="popup-content-text">
						<?php echo '' . $orienko_opt['popup_onload_content']; ?>
					</div>
					<?php } ?>
					<?php if(!empty($orienko_opt['popup_onload_form'])){ ?>
					<div class="newletter-form">
						<?php 
							$short_code = (!empty($orienko_opt['use_mailchimp_form'])) ? 'mc4wp_form' : 'wysija_form';
							echo do_shortcode( '['. $short_code .' id="'. $orienko_opt['popup_onload_form'] .'"]' ); 
						?>
					</div>
					<?php } ?>
					<label class="not-again"><input type="checkbox" value="1" name="not-again" /><span><?php echo esc_html__('Do not show this popup again', 'orienko'); ?></span></label>
				</div>
			</div>
		<?php } 
		}
	}
}

// save purchase code in option
add_action( 'wp_ajax_orienko_save_purchased_code', 'orienko_save_purchased_code' );
add_action( 'wp_ajax_nopriv_orienko_save_purchased_code', 'orienko_save_purchased_code' );
function orienko_save_purchased_code() {
	$code = $_POST['code'];
	$item_id = $_POST['item_id'];
	update_option( 'envato_purchase_code_' . $item_id, $code );
	update_option( 'envato_purchase_code_orienko', $code );
	die('1');
}

// new page to submit purchase code
add_action('admin_menu', 'orienko_admin_menu');
function orienko_admin_menu() {
	$menu = add_theme_page( 'Orienko theme verify', 'Orienko theme verify', 'manage_options', 'orienko_theme_verify', 'orienko_theme_verify_page' );
	add_action('admin_print_scripts-' . $menu, 'orienko_theme_verify_script' );
}

// show notice in dashboard
add_action( 'admin_notices', 'orienko_admin_notice' );
function orienko_admin_notice() {
	$code = get_option( 'envato_purchase_code_orienko' );
	if (!$code) {
		?>
		<div class="notice notice-error">
			<p><?php echo sprintf(wp_kses(__( 'You did not register theme purchase code yet! Please search on youtube tutorial video to see how to get purchase code on themeforest.net then register it in <a href="%s">here</a>', 'orienko' ), array('a'=> array('href' => array()))), admin_url('admin.php?page=orienko_theme_verify')); ?></p>
		</div>
		<?php
	}
}

// custom js in admin
function orienko_theme_verify_script() {
	wp_enqueue_script( 'orienko-theme-verify', get_template_directory_uri() . '/js/theme-verify.js', array('jquery'), filemtime( get_template_directory() . '/js/theme-verify.js'), true );
}

// verify page content
function orienko_theme_verify_page() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'orienko' ) );
	}
	$code = get_option( 'envato_purchase_code_orienko' );
	?>
	<div id="theme-verify" class="wrap">
		<h1><?php _ex( 'Orienko theme puchased code verify', 'title of the main page', 'orienko' ); ?></h1>
		<p><?php echo esc_html__('From May 2018, you must verify purchased code in here to ensure you are buyer of Orienko theme item on Themeforest market', 'orienko'); ?></p>
		<div class="orienko-verify">
		<table class="form-table">
			<tr>
				<th class="row">
					<?php echo esc_html__('Purchased code:', 'orienko') ?>
				</th>
				<td>
					<p class="correct<?php echo esc_attr(($code) ? ' show': ''); ?>"><?php echo esc_html__('Your purchased code is correct, you can continue use Orienko theme', 'orienko') ?></p>
					<input type="text" id="purchased_code" value="<?php echo esc_attr($code) ?>" />
					<p class="incorrect"><?php echo esc_html__('Incorrect purchase code, please check again!', 'orienko') ?></p>
				<td>
			</tr>
		</table>
		<p class="submit">
			<input id="orienko-submit-code" type="button" class="button button-primary" value="<?php echo esc_html__('Save', 'orienko') ?>" />
			<img width="24" height="24" class="loading" src="<?php echo get_template_directory_uri() . '/images/small-loading.gif'; ?>" />
		</p>
		</div>
	</div>
	<?php
}
?>