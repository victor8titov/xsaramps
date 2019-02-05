<?php get_header(); ?>

<?php ale_get_name_url("I'ts page for project archive-project.php"); ?>

<!-- --------------------------------------------------------------------------------------
                        NAVIGATION
------------------------------------------------------------------------------------------->
<section class="navigation">
    <h1>РЕАЛИЗОВАННЫЕ ПРОЕКТЫ СКЕЙТПАРКОВ</h1>
    <nav>
        <ul>
            <?php 
                $terms = get_terms( array(
                'taxonomy' => 'type',  // вид таксономи
                'hide_empty' => false, // показывать пустые
                ));            
                foreach($terms as $term):
            ?>
            <li>
                <a href = "<?php echo get_term_link( $term->slug, $term->taxonomy ); ?>">
                    <?php echo $term->name ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</section>

<!-- --------------------------------------------------------------------------------------
                        MAIN
------------------------------------------------------------------------------------------->
<section class="main">
    <div class="grid" >  
        <?php if( have_posts() ): while( have_posts() ): the_post(); 
           
           $taxonomies = get_the_taxonomies(get_the_ID(), array(
                    'template'      => '<span style="display:none"> %s:</span><span>%l</span>',
                    'term_template' => '%2$s', 
                ));

              
        ?>
        <div class="grid-item">
            
            <div class="flipper">
                <div class="front">
                    <?php echo get_the_post_thumbnail( get_the_ID(), 'project-medium' ); ?>
                </div>
                <div class="back">
                    <h2><?php echo wp_trim_words(get_the_title(), 4, '...'); ?></h2>
                    <div class="info_blocks">
                        <div class="city">
                            <?php 
                                echo $taxonomies['city'];
                            ?>

                        </div>
                        <div class="year">
                        <?php 
                                echo $taxonomies['year'];
                            ?>
                        </div>
                        <div class="area">
                            <?php echo ale_get_meta('area_park') ?> м<sup>2</sup>.
                        </div>
                        <div class="whoes">
                            <?php ale_meta('whoes_name'); ?>
                        </div>
                        <div class="point_map">
                            <a href="#map" id="show_point_map" data-ID="<?php echo get_the_ID(); ?>"><?php echo wp_trim_words(ale_get_meta('coordinate_park'), 5, '...'); ?></a>
                        </div>
                    </div>                        
                    <div class="content">
                        <p><?php echo wp_trim_words(get_the_content(), 8, '...'); ?></p>
                        <a href="<?php echo get_the_permalink(); ?>" >Больше информации</a>
                    </div>
                </div>
            </div>
        
        </div>
                            
        <?php endwhile; ?>
    </div>

        <?php else: echo "<h2>Записей нет.</h2>"; ?>
        <?php endif; ?>
        <?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <script>
        var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
        var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
        var current_page = '<?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>';
        var max_pages = '<?php echo $wp_query->max_num_pages; ?>; '
        var adress = '<?php echo json_encode($adress); ?>';
        </script>
        <div id="true_loadmore">Загрузить ещё</div>
            
        <?php endif; ?>
              

</section> 

<!-- --------------------------------------------------------------------------------------
                        MAP
------------------------------------------------------------------------------------------->

<section class = "map" id = "map">

   
</section>

<?php get_footer(); ?>


<?php 
/*
*           OLD CONTENT
*

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
            
        <div class = "this_link">
          <?php ale_page_links(); ?>
          </div>

*/




?>