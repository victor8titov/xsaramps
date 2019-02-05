<?php get_header(); ?>

<h1> single-project.php</h1>


<?php if( have_posts() ): while( have_posts() ): the_post(); ?>

    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php the_content(); ?>
    </div>
<?php endwhile; ?>
    
    <div class="navigation">
        <div class="next-posts"><?php next_posts_link(); ?></div>
        <div class="prev-posts"><?php previous_posts_link(); ?></div>
    </div>

<?php else: echo "<h2>Записей нет.</h2>"; ?>
<?php endif; ?>

<?php get_footer(); ?>