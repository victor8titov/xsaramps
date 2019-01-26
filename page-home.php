<?php
/*
  * Template name: Home
  * */

get_header();

/*
 if(ale_get_meta('descr1')){
     echo ale_get_meta('descr1');
 }
*/



 ?>
    


<div class = "wrapper" >


<h1>I'ts Home page! page-home.php</h1>


<?php 
/*
*               example ajax 
*/


/*
<div class = "images_ajax">

<div class = "button_ajax" id = "VT_button" >Foto</div>
</div>
*/
?>



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









<?php /*
<h1>Пагинация для Галерей</h1>
<section>
    <?php //global $query_string; query_posts($query_string.'&posts_per_page=3');

    if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
    elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
    else { $paged = 1; }


    $custom_query = new WP_Query(array('post_type'=>'gallery','posts_per_page'=>'3','paged'=>$paged));


   ?>
    <?php if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
        <!-- Item -->
        <div>
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
            <div class="portfolio-text">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="by">by <?php the_author(); ?></p>
                <div class="text">
                    <?php echo ale_trim_excerpt(15); ?>
                </div>
            </div>
        </div>
    <?php endwhile;  endif;  ?>
</section>
 */ ?>


<div class="pagination"><?php ale_page_links_custom($custom_query); ?></div>
</div>
<?php get_footer();

