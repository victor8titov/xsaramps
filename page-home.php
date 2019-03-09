<?php
/*
* Template name: Home
*/

get_header(); ?>

<div class = "wrapper" >
<h1>I'ts Home page! page-home.php</h1>


<!--            SLIDER          --->

<pre>
<?php 
    /*
    *   времянка для визуала переменных и функ.
    */
    $stack_rwmb =  rwmb_meta( 'xsa_home_settings' );
    $stack_img = get_post_meta($post->ID, 'home_slider_show_hidden');
    print_r( get_post_meta($post->ID, 'xsa_home_slider_show_hidden') );      
    print_r( get_post_meta($post->ID, 'xsa_home_slider_image') );      
    print_r( get_post_meta($post->ID, 'xsa_home_slider_enable', true) );  
?>
</pre>
<div class="flexslider" style = "width: 800px;">
  <ul class="slides">
  <?php 
    foreach ( get_post_meta($post->ID, 'xsa_home_slider_image' ) as $image ):  ?>
    <li>
      <?php echo wp_get_attachment_image( $image, 'large'); ?>      
      <?php 
            $swith = get_post_meta($post->ID, 'xsa_home_slider_enable', true);
            if ( $swith ): 
        ?>      
      <p class="flex-caption">
          <?php 
                $array_image = image_info( $image );                
                $source = get_post_meta( $post->ID, 'xsa_home_slider_description', true);
                echo $array_image[ $source ];
            ?>    
      </p>
        <?php endif; ?>
    </li>
<?php endforeach; ?> 
  </ul>
</div>
<!--            end slider          --->

<!--        Выборка 5 последних проектов            -->
<div class = "five_block_project" >
<?php
    global $post; 
    // не обязательно 
    // 5 записей из рубрики 9
    $myposts = get_posts( array(
        'post_type' => 'project',
        'posts_per_page' => 5,
        ));
    foreach( $myposts as $post ):
            setup_postdata( $post );
    ?>
     
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>" style="display: inline-block;">
<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php  echo get_the_post_thumbnail( get_the_ID() , 'thumbnail' ); ?>
</div>

<?php   
    endforeach; 
    wp_reset_postdata(); // сбрасываем переменную $post
?>
</div>

<!--        end                 --->




<?php if( have_posts() ){ 
        while( have_posts() ){ the_post(); ?>

        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <?php the_content(); ?>
        </div>

<?php } /* конец while */ ?>

<?php
    } // конец if
    else echo "<h2>Записей нет.</h2>";
?>
</div>
<?php get_footer();

