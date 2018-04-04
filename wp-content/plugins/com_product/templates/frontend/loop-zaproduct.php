<?php 
$meta_key = "_zendvn_sp_zaproduct_";                   
    global $zController,$zendvn_sp_settings;    
    $vHtml=new HtmlControl();    
    /* begin load config contact */
    $width=$zendvn_sp_settings["product_width"];    
    $height=$zendvn_sp_settings["product_height"];    
    $width_thumbnail=$width/5;
    $height_thumbnail=$height/5;  
    $contacted_phone=$zendvn_sp_settings['contacted_phone'];
    $email_to=$zendvn_sp_settings['email_to'];
    $address=$zendvn_sp_settings['address'];
    $to_name=$zendvn_sp_settings['to_name'];
    $telephone=$zendvn_sp_settings['telephone'];
    $website=$zendvn_sp_settings['website'];
    $opened_time=$zendvn_sp_settings['opened_time'];
    $opened_date=$zendvn_sp_settings['opened_date'];
    $contaced_name=$zendvn_sp_settings['contacted_name'];
    $facebook_url=$zendvn_sp_settings['facebook_url'];
$twitter_url=$zendvn_sp_settings['twitter_url'];
$google_plus=$zendvn_sp_settings['google_plus'];
$youtube_url=$zendvn_sp_settings['youtube_url'];
$instagram_url=$zendvn_sp_settings['instagram_url'];
$pinterest_url=$zendvn_sp_settings['pinterest_url'];  
$linkedin_url=$zendvn_sp_settings['linkedin_url'];  

    /* end load config contact */
    $term_slug='';
    $query=$wp_query;
    $post_id=0;
    if($query->have_posts()){
        while ($query->have_posts()){
            $query->the_post();                            
            $post_id=$query->post->ID;                                             
            $permalink=get_the_permalink($post_id);                    
            $title=get_the_title($post_id);                    
            $excerpt='';
            $excerpt=get_post_meta($post_id,$meta_key."intro",true);   
            $excerpt=substr($excerpt, 0,250) . '...';                 
            $content=get_the_content($post_id);        
            $arrPicture=array();
            $featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));        
            $featureImg=$vHtml->getFileName($featureImg);
            $product_image=$featureImg;
            $small_img=$width.'x'.$height.'-'.$featureImg;                    
            $small_img=site_url( '/wp-content/uploads/'.$small_img, null ) ; 
            $large_img=site_url( '/wp-content/uploads/'.$featureImg, null ) ; 
            $term = wp_get_object_terms( $post_id,  'za_category' );                    
            $term_name=$term[0]->name;
            $term_slug=$term[0]->slug;
            $product_code=get_post_meta( $post_id,$meta_key.'product_code', true );
            $price_text="";
        $sale_price_text="";
        $price=get_post_meta( $post_id, $meta_key . 'price', true );            
        $sale_price=get_post_meta( $post_id, $meta_key . 'sale_price', true );           
        if(!empty($price)){
            $price_text='<div class="bellesa-price">'.$vHtml->fnPrice($price).'</div>';
        }
        if(!empty($sale_price)){
            $sale_price_text='<div class="bellesa-sale-price">'.$vHtml->fnPrice($sale_price).'</div>';
        }        
            ?>
            <form  method="post"  class="frm" name="frm">
                <div class="our-member relative">
                    <h1 class="category-service">
                     <?php echo $term_name; ?>
                 </h1>
             </div>
                <div class="container margin-top-15">
                    <div class="col-lg-3">
                        <div class="ducati">
                            <div>
                                <h1>Danh mục sản phẩm</h1>
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
                                        'theme_location'    => 'category-product-menu' 
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
                            <div class="col-sm-4">
                                <div>
                                    <center><img class="zoom" src="<?php echo $small_img; ?>" data-zoom-image="<?php echo $large_img; ?>" /></center>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div>
                                    <h2 class="bellesa-product-detail-title"><?php echo $title; ?></h2>
                                    <div class="bellesa-zaproduct">                                    
                                        <ul>
                                            <li><a href="javascript:void(0;)"><i class="fa fa-star"></i></a></li>
                                            <li><a href="javascript:void(0;)"><i class="fa fa-star"></i></a></li>
                                            <li><a href="javascript:void(0;)"><i class="fa fa-star"></i></a></li>
                                            <li><a href="javascript:void(0;)"><i class="fa fa-star"></i></a></li>
                                            <li><a href="javascript:void(0;)"><i class="fa fa-star-o"></i></a></li>
                                        </ul>                                 
                                    </div>
                                    <?php echo $price_text; ?>
                                    <?php echo $sale_price_text; ?>
                                    <div class="bellesa-cart">
                                        <ul class="inline-block">
                                            <li>
                                                <input type="text" name="quantity" value="1" onkeypress="return isNumberKey(event);" class="quantity" />
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-alert-add-cart" onclick="javascript:addToCart(<?php echo $post_id; ?>,document.getElementsByName('quantity')[0].value);" >Add to cart</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="bellesa-hr margin-top-15"></div>
                                    <div class="bellesa-detail">
                                        <?php echo $content; ?>
                                    </div>
                                    <div class="bellesa-hr margin-top-15"></div>
                                    <div class="share-product">Share this product</div>
                                    <div class="bellesa-social margin-top-5">
                                        <ul class="inline-block social">
                                            <li><a href="<?php echo $facebook_url; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <li><a href="<?php echo $twitter_url; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            <li><a href="<?php echo $instagram_url; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                            <li><a href="<?php echo $google_plus; ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                            <li><a href="<?php echo $linkedin_url; ;?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <script language="javascript" type="text/javascript">
                    jQuery('.zoom').elevateZoom({
                        zoomType: "inner",
                        cursor: "crosshair",
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 750
                    });
                </script>  
            </form>            
            <?php
        }
    }
?>
