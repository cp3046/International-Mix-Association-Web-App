<?php
/*
Template Name: Friends
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
    <br><br><center><h1><?php the_title();?></h1></center>
    <div style=" width:650px; margin-left:20px;">
      <ul class="friend-list">
        <li>
          <div class="myarvtar">
            <img src="<?php bloginfo('template_url'); ?>/images/avtar/avtar_1.jpg" />
          </div>
          <div class="mydetail">
            <span><strong>国家：</strong>china</span><br />
            <span><strong>年龄：</strong>19</span><br />
            <span><strong>交友宣言：</strong>交友宣言交友宣言交友宣言交友宣言交友宣言交友宣言交友宣言交友宣言交友宣言交友宣言交友宣言。</span>
          </div>
        </li>
        
        <li>
          <div class="myarvtar">
            <img src="<?php bloginfo('template_url'); ?>/images/avtar/avtar_1.jpg" />
          </div>
          <div class="mydetail">
            <span><strong>国家：</strong>china</span><br />
            <span><strong>年龄：</strong>19</span><br />
            <span><strong>交友宣言：</strong>交友宣言交友宣言交友宣言交友宣言交友宣言交友宣言交友宣言交友宣言交友宣言交友宣言交友宣言。</span>
          </div>
        </li>
      </ul>
    
    </div>
    </div>
    <!--以上为正文-->
    
  </div>
  
<?php get_footer();?>