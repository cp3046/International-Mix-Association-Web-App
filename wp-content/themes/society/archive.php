<?php get_header();?>

<style>.background-all {position:absolute;position:fixed;margin-top:80px;z-index:0}</style>
<div class="background-all"><img src="<?php bloginfo('template_url'); ?>/images/bg-clear.JPG" width="960px" height="468px" /></div>  
<div class="int-content">
    
    <?php get_sidebar();?>
    
    <!--以下为正文-->
    <div class="new-main" id="new-00-mai">
    <div style="width:650px;height:6px;position:absolute;margin-left:25px;margin-top:20px;background-image:url(<?php bloginfo('template_url'); ?>/images/content-bar.png)"></div>
    <br><br>
    <br><br><center><h1>动态</h1>
    <br><br>
    <br><br>
    </center>
    <!--以下是news-14-->
    <ul>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <li class="cat_list">
        <div class="thumb">
        <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {?>
                              <?php 
							  $thumbnail_id = get_post_thumbnail_id( $post->ID );
							  $image = wp_get_attachment_image_src($thumbnail_id , 'thumbnail' );
							  //$metadata = wp_get_attachment_metadata($thumbnail_id); ?>
                              <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" ><img src="<?php echo $image[0];?>" /></a>
                              <?php }?>
        </div>
        <div class="desc">
          <h3><?php the_title();?></h3>
          <p><?php echo get_the_excerpt();?></p>
        </div>
        <div class="clear"></div>
      </li>
    <?php endwhile; ?>
	<?php else : ?>
        <li class="error">
           <p><strong>No relevant pages</strong><br />I'm sorry, I didn't find relevant page information, you can search or again.<a href="<?php echo get_settings('home'); ?>">Return to homepage</a></p>
        </li>
    <?php endif; ?>
    </ul>
    </div>
    <!--以上为正文-->
    
  </div>
  
<?php get_footer();?>