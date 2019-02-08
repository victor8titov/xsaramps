<?php get_header(); ?>

<?php ale_get_name_url("I'ts page for project archive-project.php"); ?>

<?php get_template_part( 'partials/project-content' ); ?>

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