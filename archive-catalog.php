<?php get_header(); ?>
<h1>I'ts page archive-catalog.php</h1>
<!--            Цикл на основе get_posts()      -->
<?php
    global $post;
    $args = array( //  Parmetrs for loop
        'numberposts' => -1,
        'post_type' => 'catalog',
        'tax_query' => array(
            array(
                'taxonomy' => 'catalog-category',
                //'field'    => 'slug',
                //'terms' => 'concrete_park'
                'operator' => 'EXISTS',
            )
        ),
        //'category' => 14,
    );    
    $myposts = get_posts( $args );
    foreach($myposts as $post): 
?>
<?php setup_postdata($post); ?>
    <!-- Data -->
    <p> this !!!</p>
    <p><?php the_title(); ?></p>
<?php 
    endforeach; 
    wp_reset_postdata(); // Сбрасываем переменную $post
?>
<!--            END LOOP get_posts()            --->    

<?php /*

<!-- Content -->
    <div class="portfolio-center-align">

        <div class="portfolio-categories">
            <div class="nav">
                <a href="<?php echo home_url(); ?>/gallery" class="active"><?php _e('All', 'aletheme')?></a>
                <?php $args = array(
                    'type'                     => 'gallery',
                    'child_of'                 => 0,
                    'parent'                   => '',
                    'orderby'                  => 'name',
                    'order'                    => 'ASC',
                    'hide_empty'               => 1,
                    'hierarchical'             => 1,
                    'exclude'                  => '',
                    'include'                  => '',
                    'number'                   => '',
                    'taxonomy'                 => 'gallery-category',
                    'pad_counts'               => false );

                $categories = get_categories( $args );

                foreach($categories as $cat){
                    echo '<span>/</span><a href="'.home_url().'/gallery-category/'.$cat->slug.'">'.$cat->name.'</a>';
                }
                ?>
            </div>
        </div>


        <div class="portfolio-line">

            <div class="scrollable" id="scrollable">
                <div class="items">
                    <?php global $query_string; query_posts($query_string.'&posts_per_page=3');?>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <!-- Item -->
                    <div class="item">
                        <div class="img">
                            <a href="<?php the_permalink(); ?>">
                                <p><?php _e('open portfolio','aletheme'); ?></p>
                                <span class="darken"></span>
                                <span class="border"></span>
                                <?php echo get_the_post_thumbnail($post->ID,'gallery-thumba') ?>
                            </a>
                            <div class="portfolio-text">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p class="by">by <?php the_author(); ?></p>
                                <div class="text">
                                    <?php echo ale_trim_excerpt(15); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile;  endif;  ?>

                </div>
            </div>

          <?php ale_page_links(); ?>

        </div>
    </div>
    */ ?>
<?php get_footer(); ?>