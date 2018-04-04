<?php 
global $zController,$zendvn_sp_settings;
$vHtml=new HtmlControl();
$category_id=$instance["category_id"];
$items_per_page=$instance["items_per_page"];
$description=$instance["description"];
$position=$instance["position"];
$meta_key = "_zendvn_sp_post_";
$page_id_contact = $zController->getHelper('GetPageId')->get('_wp_page_template','contact.php');
$contact_link = get_permalink($page_id_contact);    
$arrID=array(); 	
if((int)@$category_id==0){
	$terms = get_terms( array(
		'taxonomy' => 'category_banner',
		'hide_empty' => false,  ) );	
	if(count($terms) > 0){
		foreach ($terms as $key => $value) {
			$arrID[]=$value->term_id;
		}
	}		
}else{
	$arrID[]=(int)@$category_id;
}		
$args = array(
	'post_type' => 'banner',  
	'orderby' => 'date',
	'order'   => 'DESC',  
	'posts_per_page' => $items_per_page,        								
	'tax_query' => array(
		array(
			'taxonomy' => 'category_banner',
			'field'    => 'term_id',
			'terms'    => $arrID,									
		),
	),
);    		
$the_query = new WP_Query($args);	
if($the_query->have_posts()){
	switch ($position) {
		case "slideshow":			
		?>
		<div class="container">
			<script type="text/javascript" language="javascript">        
				jQuery(document).ready(function(){
					jQuery(".slick-slideshow").slick({
						dots: true,
						autoplay:true,
						arrows:false,
						adaptiveHeight:true,
						loop:true
					});  
				});     
			</script>
			<div class="slick-slideshow">
				<?php 						
				while ($the_query->have_posts()) {
					$the_query->the_post();		
					$post_id=$the_query->post->ID;
					$alt=get_post_meta($post_id,"alt",true);
					$link_web=get_post_meta($post_id,"url",true);
					$featureImg=get_the_post_thumbnail_url($post_id, 'full');
					?>
					<div><a href="<?php echo $link_web; ?>" target="_blank"><img alt="<?php echo $alt; ?>" src="<?php echo $featureImg; ?>" /></a></div>  
					<?php
				}
				wp_reset_postdata();  			
				?>				
			</div>
		</div>			
		<?php
		break;			
	}
}	
?>






