<?php
/*
  * Template name: One Type Catalog
  * */

get_header();

/*
 if(ale_get_meta('descr1')){
     echo ale_get_meta('descr1');
 }
*/
?>
<section class = "main wrapper">
    <article class = "desc-type">
        <h1>I'ts page-one-type-catalog.php</h1>

        <!--                Стандартный Цикл и цикл на основе query_posts()         -->
        <!-- **************************************************************************************************-->
        <?php 
        $id_page = '';
        if( have_posts() ) : while( have_posts() ): the_post();
        $id_page = get_the_ID();
        ?>
            
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
    </article>


    <?php 
      
        
    ?>

    <article class = "list">
    
        
        <!--            Цикл на основе get_posts()      -->
        <!-- **************************************************************************************************-->
        <?php
            global $post;
            // Получаем массив объектов taxonomy
            $taxonomy = get_the_terms($id_page, 'catalog-category');

            //  Проходим все таксономи к которым относится страница
            //  И собираем все слаги от такосонми catalog-category в список
            foreach ($taxonomy as $obj_taxonomy) {
                if ($obj_taxonomy -> taxonomy === "catalog-category") {
                    $list[] = $obj_taxonomy -> slug;
                }
            };
            
            //  Проверка
            //  Должна получатся всегда один термин из таксономи catalog-category
            //  В противном случае выведем предупреждение
            if (count($list) > 1)  {
                echo "<h3>Не корректно выбран вид парка</h3>";
                $list = '';
            };
            
            //  Параметры запроса к базе данных
            $args = array( //  Parmetrs for loop
                'numberposts' => -1,
                'post_type' => 'catalog',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'catalog-category',
                        'field'    => 'slug',
                        'terms' => $list[0],                
                    )
                ),
            );    
            $myposts = get_posts( $args );
            foreach($myposts as $post): 
        ?>
        <?php setup_postdata($post); ?>
            <!-- Data -->    
            <div class="container">
                <div class="catalog-up-row">
                    <div>
                        <div class="title"><?php the_title(); ?></div>
                    
                        <?php if (ale_get_meta('catalog_price')): ?>
                            <div class="price">
                                <?php echo ale_get_meta('catalog_price'). ' деревянных'; ?>
                            </div>    
                        <?php endif; ?>
                
                    
                    </div>
                </div>
                <!-- BLOCK FOTO SLIDER SLICK -->
                <div class="slider-type">
                <?php if(ale_get_meta('foto-1')): ?>
                    <div >
                        
                        <img src = "<?php  ale_meta('foto-1'); ?>" alt = "">
                        <div class = "poitns"></div>
                        
                    </div>
                    <?php endif; ?>
                    <?php if(ale_get_meta('foto-2')): ?>
                    <div >
                        <img src = "<?php  ale_meta('foto-2'); ?>" alt = "">
                        <div class = "poitns"></div>
                    </div>
                    <?php endif; ?>
                    <?php if(ale_get_meta('foto-3')): ?>
                    <div >
                        <img src = "<?php  ale_meta('foto-3'); ?>" alt = "">
                        <div class = "poitns"></div>
                    </div>
                    <?php endif; ?>
                    
                </div>
            
            


                <div class = "content">
                    <?php the_content() ?>
                    <div class = "download-dwg">
                        <a href="<?php echo ale_get_meta('fileupload'); ?>">DWG</a>
                    </div>
                    
                </div>
            
            </div>
            
            
        <?php 
            endforeach; 
            wp_reset_postdata(); // Сбрасываем переменную $post
        ?>
        <!--            END LOOP get_posts()            --->

    </article>


    <!--            PAGINATION         -->
    <!-- **************************************************************************************************-->
    <div class="pagination"><?php ale_page_links_custom($custom_query); ?></div>
</section>
<?php get_footer();

