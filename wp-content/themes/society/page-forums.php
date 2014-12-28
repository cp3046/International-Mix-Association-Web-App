<?php
/*
Template Name: Forums
*/
?>

<?php get_header();?>

<div class="background-all"></div>  
<div class="int-content" style=" height:auto !important;min-height:800px !important;">
<div class="forums-div" style=" margin-top:50px; padding:10px;"> 
  <div
  <center><h2><?php the_title();?></h2></center>
  <h3>社区版块</h3>
  <div class="forum">
  <?php echo do_shortcode('[bbp-forum-index]'); ?>
  </div>
  
  
  <h3>最新话题</h3>
  <div class="topic">
  <?php echo do_shortcode('[bbp-topic-index]'); ?>
  </div>
</div>   
    
  </div>
  
<?php get_footer();?>