<?php 

if(have_posts()){
    while (have_posts()) {
        the_post();
        ?>
        <form  method="post"  class="frm" name="frm">
            <input type="hidden" name="filter_page" value="1" /> 
            <div class="our-member relative">
                <div class="opacity-absolute"></div>
                <div class="tarik">
                   <h1 class="container category-service"><?php the_title( '','', true ); ?></h1>
               </div>
            </div>
            <div class="container">
                <div>            
                    <?php the_content(); ?>
                </div>                       
            </div>    
        </form>
        <?php
    }
    wp_reset_postdata();  
}
?>
