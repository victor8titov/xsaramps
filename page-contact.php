<?php
/*
*   Template name: Contact
*/


get_header();
?>

<?php if( have_posts() ){ while( have_posts() ){ the_post(); ?>
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php the_content(); ?>
</div>
<?php } /* конец while */ ?>
<div class="navigation">
<div class="next-posts"><?php next_posts_link(); ?></div>
<div class="prev-posts"><?php previous_posts_link(); ?></div>
</div>
<?php
} // конец if
else
echo "<h2>Записей нет.</h2>";
?>

<?php get_footer(); ?>