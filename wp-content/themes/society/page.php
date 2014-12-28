<?php get_header();?>

<div class="background-all"></div>  
<div class="int-content" style=" height:auto !important;min-height:800px !important;">
<div class="forums-div" style=" margin-top:50px; padding:10px;"> 
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
  <center><h2><?php the_title();?></h2></center>
  <?php the_content();?>
  
  <?php endwhile; ?>
	<?php else : ?>
        <div class="error">
           <p><strong>No relevant pages</strong><br />I'm sorry, I didn't find relevant page information, you can search or again.<a href="<?php echo get_settings('home'); ?>">Return to homepage</a></p>
        </div>
    <?php endif; ?>
</div>   
    
</div>
  
<?php get_footer();?>