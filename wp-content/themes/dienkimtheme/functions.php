<?php
require_once get_template_directory() . DS . 'inc'.DS.'customizer.php';

global $customizerGlobal;
$customizerGlobal = new CustomizerControl();
add_filter( 'nav_menu_link_attributes', 'wp_nav_menu_link', 10, 3 );
function wp_nav_menu_link( $atts, $item, $args ) {	
	if(in_array("current-menu-item", $item->classes)){
		$class = 'active'; 
    	$atts['class'] = $class;    
	}
    return $atts;
}
add_action('init', 'zendvn_theme_register_menus');
function zendvn_theme_register_menus(){
	register_nav_menus(
		array(						
			'main-menu' 			=> __('MainMenu'),
			'mobile-menu' 			=> __('MobileMenu'),					
			'footer-menu' 			=> __('FooterMenu'),		
			'category-article-menu' 			=> __('CategoryArticleMenu'),	
			'category-product-menu' 			=> __('CategoryProductMenu'),	
		)
	);
}
add_action('after_setup_theme', 'zendvn_theme_support');
function zendvn_theme_support(){
	add_theme_support( 'post-formats', array('aside','image','gallery','video','audio') );
	add_theme_support('post-thumbnails');
	add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	
	
}
add_action('widgets_init', 'zendvn_theme_widgets_init');
function zendvn_theme_widgets_init(){	
	$themeName="dienkimtheme";	
	register_sidebar(array(
		'name'          => __( 'Slideshow', $themeName ),
		'id'            => 'slideshow',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'Massage Theraphy', $themeName ),
		'id'            => 'massage-theraphy',		
		'class'         => '',
		'before_widget' => '<div>',
		'before_title'  => '<h1 class="bellesa-title">',
		'after_title'   => '</h1>',
		'after_widget'  => '</div>'		
	));	
	register_sidebar(array(
		'name'          => __( 'About our spa', $themeName ),
		'id'            => 'about-our-spa',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'Why we are', $themeName ),
		'id'            => 'why-we-are',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'Special service', $themeName ),
		'id'            => 'special-service',		
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'before_title'  => '<h1 class="bellesa-title">',
		'after_title'   => '</h1>',
		'after_widget'  => '</div>'				
	));
	register_sidebar(array(
		'name'          => __( 'Special service 1', $themeName ),
		'id'            => 'special-service-1',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'Special service 2', $themeName ),
		'id'            => 'special-service-2',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''			
	));
	register_sidebar(array(
		'name'          => __( 'Special service 3', $themeName ),
		'id'            => 'special-service-3',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''			
	));
	register_sidebar(array(
		'name'          => __( 'Special service 4', $themeName ),
		'id'            => 'special-service-4',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''			
	));
	register_sidebar(array(
		'name'          => __( 'Working our team', $themeName ),
		'id'            => 'working-our-team',		
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'before_title'  => '<h1 class="bellesa-title">',
		'after_title'   => '</h1>',
		'after_widget'  => '</div>'					
	));
	register_sidebar(array(
		'name'          => __( 'All service', $themeName ),
		'id'            => 'all-service-widget',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'Face service', $themeName ),
		'id'            => 'face-service-widget',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''			
	));
	register_sidebar(array(
		'name'          => __( 'Foot service', $themeName ),
		'id'            => 'foot-service-widget',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''			
	));
	register_sidebar(array(
		'name'          => __( 'Body service', $themeName ),
		'id'            => 'body-service-widget',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'Massage service', $themeName ),
		'id'            => 'massage-service-widget',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''			
	));	
	
	register_sidebar(array(
		'name'          => __( 'Slogan bottom', $themeName ),
		'id'            => 'slogan-bottom',		
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		'after_widget'  => '</div>'				
	));
	register_sidebar(array(
		'name'          => __( 'Fanpage', $themeName ),
		'id'            => 'fanpage',		
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		'after_widget'  => '</div>'				
	));
	register_sidebar(array(
		'name'          => __( 'Quick contact', $themeName ),
		'id'            => 'quick-contact',		
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		'after_widget'  => '</div>'				
	));
	register_sidebar(array(
		'name'          => __( 'Copyright', $themeName ),
		'id'            => 'copyright',		
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		'after_widget'  => '</div>'				
	));
	
}
add_action("wp_enqueue_scripts",function(){
	wp_deregister_script("jquery");
	wp_deregister_script("jquery-migrate");
});
add_action('wp_footer', 'footer_script_code');
add_action('wp_head', 'header_script_code');
function header_script_code(){
	$strScript='<script type="text/javascript" language="javascript">
        ddsmoothmenu.init({
            mainmenuid: "smoothmainmenu", 
            orientation: "h", 
            classname: "ddsmoothmenu",
            contentsource: "markup" 
        });         
    </script>';
    echo $strScript;
}
function footer_script_code(){
	$strScript= '<script type=\'text/javascript\'>
	var wpexLocalize = {
		"mobileMenuOpen" : "Browse Categories",
		"mobileMenuClosed" : "Close navigation",
		"homeSlideshow" : "false",
		"homeSlideshowSpeed" : "7000",
		"UsernamePlaceholder" : "Username",
		"PasswordPlaceholder" : "Password",
		"enableFitvids" : "true"
	};	
	</script>
	';
	echo $strScript;
}

function loadCategoryList($attrs){		
	ob_start();        	
	extract(
		shortcode_atts(
			array(
				'item' => '',	
				'taxonomy'=>''				
			), 
			$attrs
		)
	);	
	global $zController,$zendvn_sp_settings;
	$vHtml=new HtmlControl();    		
	$data=explode(',',$item);	
	if(count($data) > 0){
		$k=1  ; 
		foreach ($data as $key => $value) {
			$term = get_term( $value, $taxonomy );	
			$id=$term->term_id;
			$title=$term->name;    
			$slug=$term->slug;             
			$permalink=get_term_link($term,$taxonomy);                    
			$excerpt=$term->description;   
			$excerpt=substr($excerpt, 0,100).'...';       
			$featureImg = get_field( 'image',$term);                                       			 
			?>          
			<div class="col-sm-3">
				<div class="margin-top-30">
					<div><center><a href="<?php echo $permalink; ?>"><figure><img src="<?php echo $featureImg["url"]; ?>" /></figure></a></center></div>
					<div class="product-article">
						<h2 class="product-home-title margin-top-15"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h2>
						<div class="article-home-excerpt margin-top-15"><?php echo $excerpt; ?></div>
						<div class="margin-top-15"><a class="readmore" href="<?php echo $permalink; ?>">Đọc thêm</a></div>
						<div class="clr"></div>
					</div>                              
				</div>                        
			</div>
			<?php
			if($k%4 ==0 || $k==count($data)){
				echo '<div class="clr"></div>';
			}
			$k++;
		}
	}
}
add_shortcode('category_list', 'loadCategoryList');