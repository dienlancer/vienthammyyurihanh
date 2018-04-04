<?php 
global $zController,$zendvn_sp_settings,$wpdb;
$vHtml=new HtmlControl();
$width=$zendvn_sp_settings["product_width"];    
$height=$zendvn_sp_settings["product_height"];      
$post_meta_key = "_zendvn_sp_post_";
$page_meta_key = "_zendvn_sp_page_";
$product_meta_key = "_zendvn_sp_zaproduct_";
if(!empty($instance['item_id'])){
	$arrItemID=explode(",",$instance["item_id"]);		
	$title=$instance["title"];
	$description=$instance["description"];
	$position=$instance["position"];
	if(count($arrItemID) > 0){
		switch ($position) {			
			case "about-our-spa":
			case "special-service":
			?>
			<div class="about-our-spa container">		
				<div class="row">
					<?php 
					$k=1;
					foreach ($arrItemID as $key => $value){
						$args = array(  		
							'p' => 	$value,			
							'post_type' => 'page'
						);			
						$the_query = new WP_Query($args);				
						if($the_query->have_posts()){																	
							while ($the_query->have_posts()) {
								$the_query->the_post();		
								$post_id=$the_query->post->ID;							
								$permalink=get_the_permalink($post_id);
								$title=get_the_title($post_id);
								$excerpt=get_post_meta($post_id,"intro",true);													
								$featureImg=get_the_post_thumbnail_url($post_id, 'full');						                
								?>										
								<div class="col-lg-6 no-padding about-img opacity-absolute "><img src="<?php echo $featureImg; ?>" /></div>
								<div class="col-lg-6 no-padding">
									<div class="about-our-spa-child">
										<h1 class="bellesa-title"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h1>
										<div><?php echo $excerpt; ?></div>
									</div>								
								</div>
								<?php

							}				
							wp_reset_postdata();  
						}				
					}					
					?>
				</div>				
			</div>
			<?php
			break;
			case "why-we-are":
			?>
			<div class="why-we-are container">						
					<?php 
					$k=1;
					foreach ($arrItemID as $key => $value){
						$args = array(  		
							'p' => 	$value,			
							'post_type' => 'page'
						);			
						$the_query = new WP_Query($args);				
						if($the_query->have_posts()){																	
							while ($the_query->have_posts()) {
								$the_query->the_post();		
								$post_id=$the_query->post->ID;							
								$permalink=get_the_permalink($post_id);
								$title=get_the_title($post_id);
								$excerpt=get_post_meta($post_id,"intro",true);													
								$featureImg=get_the_post_thumbnail_url($post_id, 'full');							                
								?>										
								<div class="col-lg-6 no-padding">
								<div class="about-our-spa-child">
									<h1 class="bellesa-title"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h1>
									<div><?php echo $excerpt; ?></div>
								</div>								
							</div>
							<div class="col-lg-6 no-padding about-img opacity-absolute"><img src="<?php echo $featureImg; ?>" /></div>
								<?php

							}				
							wp_reset_postdata();  
						}				
					}					
					?>			
			</div>
			<?php
			break;
			case "special-service-1":
			case "special-service-2":
			case "special-service-3":
			case "special-service-4":
			foreach ($arrItemID as $key => $value){
				$args = array(  		
					'p' => 	$value,			
					'post_type' => 'page'
				);							
				$the_query = new WP_Query($args);	
				if($the_query->have_posts()){
					while ($the_query->have_posts()){
						$the_query->the_post();		
						$post_id=$the_query->post->ID;							
						$permalink=get_the_permalink($post_id);
						$title=get_the_title($post_id);
						$excerpt=get_post_meta($post_id,"intro",true);		
						$excerpt=substr($excerpt, 0,235).'...';																		
						$featureImg=get_the_post_thumbnail_url($post_id, 'full');	
						?>
						<div>
							<h1 class="special-service-child-title"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h3>			
							<div>
								<p>
										<?php echo $excerpt; ?>
								</p>
							</div>
						</div>    
						<?php
					}
					wp_reset_postdata(); 
				}
			}
			break;
			case "massage-theraphy":					
				?>		
				<div>					
					<div class="margin-top-15">
						<div class="category-description"><?php echo $description; ?></div>
						<div class="clr"></div>
					</div>	
					<div class="margin-top-15">
						<script type="text/javascript" language="javascript">
							jQuery(document).ready(function(){
								jQuery(".massage-theraphy").owlCarousel({
									autoplay:true,                    
									loop:true,
									margin:10,                        
									nav:true,            
									mouseDrag: true,
									touchDrag: true,                                
									responsiveClass:true,
									responsive:{
										0:{
											items:1
										},
										600:{
											items:4
										},
										1000:{
											items:4
										}
									}
								});
								var chevron_left='<i class="fa fa-chevron-left"></i>';
								var chevron_right='<i class="fa fa-chevron-right"></i>';
								jQuery("div.massage-theraphy div.owl-prev").html(chevron_left);
								jQuery("div.massage-theraphy div.owl-next").html(chevron_right);
							});                
						</script>
						<div class="owl-carousel massage-theraphy owl-theme">						
							<?php 
							foreach ($arrItemID as $key => $value) {
								$term = get_term( $value,"category" );	
								$id=$term->term_id;
								$title=$term->name;	
								$slug=$term->slug;				
								$permalink=get_term_link($term,'category');					
								$excerpt=$term->description;	
								$excerpt=substr($excerpt, 0,150).'...';												
								$featureImg = get_field( 'image',$term);		
								if($slug != 'uncategorized'){
									?>			
									<div class="massage-theraphy-slick">
										<div><center><figure><a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg['url']; ?>" /></a></figure></center></div>
										<div class="product-article">
											<h2 class="product-home-title margin-top-15"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h2>
											<div class="article-home-excerpt margin-top-15"><?php echo $excerpt; ?></div>
											<div class="margin-top-15"><a class="readmore" href="<?php echo $permalink; ?>">Xem thêm</a></div>
											<div class="clr"></div>
										</div>								
									</div>
									<?php
								}					
							}							
							?>			
						</div>						
					</div>								
				</div>			
				<?php	
				break;				
		}
	}	
}
?>






