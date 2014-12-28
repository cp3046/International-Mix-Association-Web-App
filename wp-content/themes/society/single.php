<?php get_header();?>

<style>.background-all {position:absolute;position:fixed;margin-top:80px;z-index:0}</style>
<div class="background-all"><img src="<?php bloginfo('template_url'); ?>/images/bg-clear.JPG" width="960px" height="468px" /></div>  
<div class="int-content">
    
    <?php get_sidebar();?>
    
    <!--以下为正文-->
    <div class="int-main">
    <div style="width:650px;height:6px;position:absolute;margin-left:25px;margin-top:20px;background-image:url(<?php bloginfo('template_url'); ?>/images/content-bar.png)"></div>
     <br><br><br>
     <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <br><br><center><h1><?php the_title();?></h1></center>
　　 <?php the_content();?>
    <?php endwhile; ?>
	<?php else : ?>
        <div class="error">
           <p><strong>No relevant pages</strong><br />I'm sorry, I didn't find relevant page information, you can search or again.<a href="<?php echo get_settings('home'); ?>">Return to homepage</a></p>
        </div>
    <?php endif; ?>
    </div>
    <!--以上为正文-->
    
  </div>
  
<?php get_footer();?>