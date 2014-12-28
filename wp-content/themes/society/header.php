<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>	
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> 
<link href="<?php bloginfo('template_url'); ?>/style.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='<?php bloginfo( 'template_url' ); ?>/js/jquery-1.4.2.min.js'></script>
<script type='text/javascript' src='<?php bloginfo( 'template_url' ); ?>/js/jquery.soChange.js'></script>
<script type='text/javascript' src='<?php bloginfo( 'template_url' ); ?>/js/jquery.custom.js'></script>
<?php if(!is_home()){?>
<link href="<?php bloginfo('template_url'); ?>/content-style.css" rel="stylesheet" type="text/css" />
<?php }?>

<?php wp_head();?>
</head>

<body>
<!--以下为导航栏-->

<div class="topbar">

 <!--以下为logo-->
 <div><div class="camp-logo" id="top-logo"><ol><a href="<?php bloginfo('home'); ?>"><li></li></a></ol></div>
 <div class="she-logo" id="top-logo"><ol><a href="<?php bloginfo('home'); ?>"><li></li></a></ol></div></div>
 <!--以上为logo-->

 <div class="topmenu">
  <?php if ( function_exists( 'wp_nav_menu' ) ) {?>
	<?php wp_nav_menu( array(
          'theme_location' => 'primary',
          'container' => '', 
          'menu_id'      => 'pri-menu',
          'menu_class'      => 'pri-menu'
          )); ?>
    <?php }?>
    <?php $lang=$_GET['lang'];?>
  	<div class="index"><a href="<?php bloginfo('home'); ?>"><?php if($lang=='en'){echo 'Home';}else{echo '首页';};?></a></div>
    <div class="index"><a href="<?php echo get_page_link(39);?>"><?php if($lang=='en'){echo 'Login';}else{echo '注册/登陆';};?></a></a></div>
    <div class="index"><?php if($lang=='en'){?><a href="<?php get_bloginfo('home'); ?>?lang=cn"><?php }else{?><a href="<?php get_bloginfo('home'); ?>?lang=en"><?php }?><?php if($lang=='en'){echo '中文';}else{echo 'English';};?></a></div>
 </div>
 </div>
<div class="topbar2" /><!--以上为导航栏-->

<?php if(is_home()){?>
<!--以下为毛笔字-->
<div style="position:absolute;z-index:1;margin-top:65px;margin-left:48px; border:10px solid #1D2C71">
<div class="slider" id="slider">
	<div class="a_bigImg">
      <img src="<?php bloginfo('template_url'); ?>/images/slider/slider1.jpg">
    </div>
    
    <div class="a_bigImg">
      <img src="<?php bloginfo('template_url'); ?>/images/slider/slider2.jpg">
    </div>
    
    <div class="a_bigImg">
      <img src="<?php bloginfo('template_url'); ?>/images/slider/slider3.jpg">
    </div>
    
    <div class="a_bigImg">
      <img src="<?php bloginfo('template_url'); ?>/images/slider/slider4.jpg">
    </div>
             
    <ul class="soul">
            <li><span class="on">1</span></li>
                  <li><span class="">2</span></li>
                  <li><span class="">3</span></li>
                  <li><span class="">4</span></li>
             
    </ul>
    <!--<div class="prev_next">
    <a href="#" class="prevBtn" title="上一个">&lt;</a><a href="#" class="nextBtn" title="下一个">&gt;</a>
    </div>-->
  </div>
</div>
</div>
<!--以上为毛笔字-->

	
<?php	}?>

<div class="<?php if(is_home()){echo 'wrapper';}else{echo 'int-wrapper';}?>">	