<?php 
global $zController,$zendvn_sp_settings;    
$meta_key = "_zendvn_sp_post_";
$vHtml=new HtmlControl();
$productModel=$zController->getModel("/frontend","ProductModel"); 
$the_query=$wp_query;
$totalItemsPerPage=0;
$pageRange=10;
$currentPage=1; 
if(!empty($zendvn_sp_settings["article_number"]))
    $totalItemsPerPage=$zendvn_sp_settings["article_number"];        
if(!empty(@$_POST["filter_page"]))          
    $currentPage=@$_POST["filter_page"];  
$productModel->setWpQuery($the_query);   
$productModel->setPerpage($totalItemsPerPage);        
$productModel->prepare_items();               
$totalItems= $productModel->getTotalItems();               
$arrPagination=array(
  "totalItems"=>$totalItems,
  "totalItemsPerPage"=>$totalItemsPerPage,
  "pageRange"=>$pageRange,
  "currentPage"=>$currentPage   
);    
$pagination=$zController->getPagination("Pagination",$arrPagination); 
?>
<form  method="post"  class="frm" name="frm">
    <input type="hidden" name="filter_page" value="1" /> 
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
                $k=1  ; 
                while ($the_query->have_posts()) {
                    $the_query->the_post();     
                    $post_id=$the_query->post->ID;                          
                    $permalink=get_the_permalink($post_id);
                    $title=get_the_title($post_id);                   
                    $excerpt=get_post_meta($post_id,"intro",true);   
                    $excerpt=substr($excerpt, 0,250)."...";                 
                    $featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));                                                     
                    ?>                              
                    <div class="margin-bottom-15">
                        <div class="fafa padding-top-5 padding-bottom-5 padding-left-5 padding-right-5">
                            <div class="col-lg-3 no-padding-left"><center><a href="<?php echo $permalink; ?>"><figure><img src="<?php echo $featureImg; ?>" /></figure></a></center></div>
                            <div class="col-lg-9 no-padding">
                                <div>
                                    <h2 class="product-home-title "><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h2>
                                    <div class="article-home-excerpt margin-top-5"><?php echo $excerpt; ?></div>
                                    <div class="margin-top-5"><a class="readmore" href="<?php echo $permalink; ?>">Xem thêm</a></div>
                                    <div class="clr"></div>
                                </div>     
                            </div>  
                            <div class="clr"></div>     
                        </div>                                                                
                    </div>                                            
                    <?php                    
                }               
                wp_reset_postdata();              
            }       
            ?>    
        </div>     
        <div>
            <?php echo $pagination->showPagination();            ?>
            <div class="clr"></div>
        </div>
    </div>                
</div>
</form>



