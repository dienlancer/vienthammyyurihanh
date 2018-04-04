<?php 
$post_meta_key = "_zendvn_sp_post_";
$page_meta_key = "_zendvn_sp_page_";
$the_query=$wp_query;
$term=array();
$post_id=0;
?>
<div class="our-member relative">
	<div class="opacity-absolute"></div>
	<div class="tarik">
		<h1 class="container category-service"><?php single_cat_title(); ?></h1>
	</div>
</div>
<div class="container margin-top-15">
	<div class="col-lg-3">
		<div class="ducati">
			<div>
				<h1>Danh mục dịch vụ</h1>
				<div class="comsuon">
					<?php     
					$args = array( 
						'menu'              => '', 
						'container'         => '', 
						'container_class'   => '', 
						'container_id'      => '', 
						'menu_class'        => 'categorymenu', 
						'menu_id'           => '', 
						'echo'              => true, 
						'fallback_cb'       => 'wp_page_menu', 
						'before'            => '', 
						'after'             => '', 
						'link_before'       => '', 
						'link_after'        => '', 
						'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',  
						'depth'             => 3, 
						'walker'            => '', 
						'theme_location'    => 'category-article-menu' 
					);
					wp_nav_menu($args);
					?>   
					<div class="clr"></div> 
				</div>
			</div>            
		</div>
	</div>
	<div class="col-lg-9">
		<div>
			<?php 
			if($the_query->have_posts()){
				while ($the_query->have_posts()) {
					$the_query->the_post();                     
					$post_id=$the_query->post->ID;               
					$permalink=get_the_permalink($post_id);
					$title=get_the_title($post_id);            
					$term = wp_get_object_terms( $post_id,  'category' );
					if(count($term) ==0 ){
						$term = wp_get_object_terms( $post_id,  'category_news' );
					}
					$excerpt=get_post_meta($post_id,"intro",true);            
					$content=get_the_content($post_id);        
					$featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));            
					?>
					<h2 class="bellesa-title emmanuel"><?php echo $title; ?></h2>                     
					<div class="margin-top-15">
						<?php echo $content; ?>
					</div>      
					<?php
				}
				wp_reset_postdata();    
			}
			?>
		</div> 
		<div>
			<h1 class="bimbim margin-top-15 padding-bottom-5">Bài viết liên quan</h1>
			<div class="margin-top-5">
				<?php 
				$arrID=array(); 
				if(count($term) > 0){
					foreach ($term as $key => $value) {
						$arrID[]=$value->term_id;
					}
				}    
				$args = array(
					'post_type' => 'post',  
					'orderby' => 'date',
					'order'   => 'DESC',  
					'posts_per_page' => 10,        
					'post__not_in'=>array($post_id),
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'term_id',
							'terms'    => $arrID,                   
						),
					),
				);     
				$the_query=new WP_Query($args);  
				if($the_query->have_posts()){
					?>
					<ul class="baivietlienquan">
						<?php 
						while ($the_query->have_posts()){
							$the_query->the_post();
			                $postID=$the_query->post->ID;
			                $title=get_the_title($postID);
			                $permalink=get_the_permalink($postID);
			                $featureImg=get_the_post_thumbnail_url($postID, 'full');
			                ?>
			                <li>                                              
			                	<a href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
                			</li>
			                <?php
						}
						?>
					</ul>
					<?php					
				}
				?>
			</div>
		</div>       
	</div>  
	<div class="clr"></div>  
</div>