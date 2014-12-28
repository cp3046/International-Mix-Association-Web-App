<?php get_header();?>

<style>.background-all {position:absolute;position:fixed;margin-top:80px;z-index:0}</style>
<div class="background-all"><img src="<?php bloginfo('template_url'); ?>/images/bg-clear.JPG" width="960px" height="468px" /></div>  
<div class="content">
    <div class="box">
     <h2><a href="<?php echo get_category_link(1);?>"><?php echo get_cat_name(1);?></a></h2>
     <ul>
       <?php 
        $args=array(
		'posts_per_page' => 10,
		'category' => 1);
		$new_posts = get_posts( $args ); 
		foreach ($new_posts as $post):setup_postdata($post); ?>
		  <li><a href="<?php the_permalink();?>"  title="<?php the_title();?>"><?php the_title();?></a></li>
		<?php endforeach; wp_reset_query(); ?> 
     </ul>
    </div>
    
    <div class="box1">
     <h2><a href="<?php echo get_page_link(37);?>">交友区</a></h2>
     <div style="background:#FFF; padding:10px 0px; font-size:12px;">
     <ul>
       <li>
         <img src="<?php bloginfo('template_url'); ?>/images/avtar/avtar_1.jpg" /><br />
         <span>avtar_1</span>
       </li>
       <li>
         <img src="<?php bloginfo('template_url'); ?>/images/avtar/avtar_2.jpg" /><br />
         <span>avtar_2</span>
       </li>
       <li>
         <img src="<?php bloginfo('template_url'); ?>/images/avtar/avtar_3.jpg" /><br />
         <span>avtar_3</span>
       </li>
       <li>
         <img src="<?php bloginfo('template_url'); ?>/images/avtar/avtar_4.jpg" /><br />
         <span>avtar_4</span>
       </li>
     </ul>
     <div class="clear"></div>
     </div>
    </div>
    
    <div class="box2">
     <a href="<?php echo get_page_link(51);?>">论坛区</a>
    </div>
  </div>
  
<?php get_footer();?>
  

