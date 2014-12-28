<!--以下为正文左导航-->
    <div class="navigation-left-bar"></div> 
	<div class="navigation-left" id="navigation-left">
      <div class="left_head">信息导航</div>
      <?php if ( function_exists( 'wp_nav_menu' ) ) {?>
	  <?php wp_nav_menu( array(
            'theme_location' => 'sidemenu',
            'container' => '', 
            'menu_id'      => 'sidemenu',
            'menu_class'      => 'sidemenu'
            )); ?>
      <?php }?>
      <br />
      <br />
      <?php $lang=$_GET['lang'];?>
      <div class="left_head">认识我们</div>
      <ul>
      <?php if($lang=='en'){?><?php wp_list_pages('title_li=&child_of=84');?><?php }else{?><?php wp_list_pages('title_li=&child_of=2');?><?php }?>
      </ul>
      
      <br />
      <br />
      <div class="left_head">章程</div>
      <ul>
      <?php if($lang=='en'){?><?php wp_list_pages('title_li=&child_of=81');?><?php }else{?><?php wp_list_pages('title_li=&child_of=26');?><?php }?>
      </ul>
	 </div>    
<!--以上为正文左导航-->