<?php
/*
  * Template name: Catalog
  * */

get_header();

/*
 if(ale_get_meta('descr1')){
     echo ale_get_meta('descr1');
 }
*/
?>

<h1>I'ts page-catalog.php</h1>

<!--            Цикл на основе get_posts()      -->
<!-- -------------------------------------------------------------------->
<?php
    global $post;
    $args = array( //  Parmetrs for loop
        'numberposts' => -1,
        'post_type' => 'page',
        'tax_query' => array(
            array(
                'taxonomy' => 'catalog-category',
                //'field'    => 'slug',
                'operator' => 'EXISTS',
            )
        ),
    );    
    $myposts = get_posts( $args );
    foreach($myposts as $post): 
?>
<?php setup_postdata($post); ?>
    <!-- Data -->
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
   
<?php 
    endforeach; 
    wp_reset_postdata(); // Сбрасываем переменную $post
?>
<!--            END LOOP get_posts()            --->



<!--                Стандартный Цикл и цикл на основе query_posts()         -->
<?php if( have_posts() ) : while( have_posts() ): the_post(); ?>

    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php the_content(); ?>
    </div>

<?php endwhile;  /* конец while */ ?>

<div class="navigation">
    <div class="next-posts"><?php next_posts_link(); ?></div>
    <div class="prev-posts"><?php previous_posts_link(); ?></div>
</div>

<?php else: ?>
<h2>Записей нет.</h2>
<?php endif; ?>
<!--            END STANDART LOOP           -->




<div class="pagination"><?php ale_page_links_custom($custom_query); ?></div>

<?php get_footer();

