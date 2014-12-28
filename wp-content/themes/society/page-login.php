<?php
/*
Template Name: Login
*/
?>

<?php get_header();?>

<style>.background-all {position:absolute;position:fixed;margin-top:80px;z-index:0}</style>
<div class="background-all"><img src="<?php bloginfo('template_url'); ?>/images/bg-clear.JPG" width="960px" height="468px" /></div>  
<div class="int-content">
    
    <?php get_sidebar();?>
    
    <!--以下为正文-->
    <div class="int-main">
    <div style="width:650px;height:6px;position:absolute;margin-left:25px;margin-top:20px;background-image:url(<?php bloginfo('template_url'); ?>/images/content-bar.png)"></div>

    <br><br>
    <?php if(is_user_logged_in()) {
			global $current_user;
			get_currentuserinfo();?>
    <br><br>
    
    <center><p>Hi, <?php echo $current_user->user_login;?>, Welcome to Beijing University of Technology International Mix.</p></center>       
            
	<?php }else{?>
    <br><br><center><h1><?php the_title();?></h1></center>
    <div style=" width:630px; margin-left:30px;">
    <?php echo do_shortcode('[nd_login]'); ?>
    </div>
    <?php }?>
    </div>
    <!--以上为正文-->
    
  </div>
  
<?php get_footer();?>