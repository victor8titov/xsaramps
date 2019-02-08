
<!-- --------------------------------------------------------------------------------------
                        NAVIGATION
------------------------------------------------------------------------------------------->
<section class="navigation" id="navTop">
    <h1>РЕАЛИЗОВАННЫЕ ПРОЕКТЫ СКЕЙТПАРКОВ</h1>
    <nav>
        <ul>
            <li>
                <a href = "<?php echo  get_post_type_archive_link('project'); ?>">
                    Все проекты
                </a>
            </li>
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
            <li>
                <a href = "#navTop" id="buttonFilterBox">Расширенный фильтр</a>
            </li>
        </ul>
    </nav>
    <section class="filterBox" >
        <!-- action пустой, чтобы ссылалось на текущую страницу -->
        <form class="filter" action="<?php echo  get_post_type_archive_link('project'); ?>" method="get">
                <ul>
                    <li>
                        <a href="#">S Объекта</a>
                        <ul>
                                <li>
                                    <label>
                                        <input type="checkbox" name="form_area_park[]" value="0-300"><span>менее 300м<sup>2</sup></span>
                                    </label>
                                </li>
                                <li>
                                    <label><input type="checkbox" name="form_area_park[]" value="301-650"><span>301-650м<sup>2</sup></span>
                                </label>
                                </li>
                                <li>
                                    <label><input type="checkbox" name="form_area_park[]" value="651-1300"><span>651-1300м<sup>2</sup></span>
                                </label>
                                </li>
                                <li>
                                    <label><input type="checkbox" name="form_area_park[]" value="1301-99999"><span>1300м<sup>2</sup> и более</span>
                                </label>
                                </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Тип заказчика</a>
                        <ul>
                            
                                <li>
                                    <label><input type="checkbox" name="form_whoes_type[]" value="state"><span>Государство</span></label>
                                </li>
                                <li>
                                    <label><input type="checkbox" name="form_whoes_type[]" value="business"><span>Бизнес</span></label>
                                </li>
                                <li>
                                    <label><input type="checkbox" name="form_whoes_type[]" value="private"><span>Частные</span></label>
                                </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="#">Тип скейтпарка</a>
                        <ul>
                            <?php 
                                $terms = get_terms( array(
                                'taxonomy' => 'type',  // вид таксономи
                                'hide_empty' => false, // показывать пустые
                                ));            
                                foreach($terms as $term):
                            ?>
                                <li>
                                    <label>
                                        <input type="checkbox" name="form_type[]" value="<?php echo $term->slug ?>" data-href="<?php echo get_term_link( $term->slug, $term->taxonomy ); ?>"><span><?php echo $term->name ?></span>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Год постройки</a>
                        <ul>
                            <?php 
                                $terms = get_terms( array(
                                'taxonomy' => 'years',  // вид таксономи
                                'hide_empty' => false, // показывать пустые
                                ));            
                                foreach($terms as $term):
                            ?>
                                <li>
                                    <label>
                                        <input type="checkbox" name="form_years[]" value="<?php echo $term->slug ?>" data-href="<?php echo get_term_link( $term->slug, $term->taxonomy ); ?>"><span><?php echo $term->name ?></span>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Выбрать город</a>
                        <ul>
                            <?php 
                                $terms = get_terms( array(
                                'taxonomy' => 'city',  // вид таксономи
                                'hide_empty' => false, // показывать пустые
                                ));            
                                foreach($terms as $term):
                            ?>
                                <li>
                                    <label>
                                        <input type="checkbox" name="form_city[]" value="<?php echo $term->slug ?>" data-href="<?php echo get_term_link( $term->slug, $term->taxonomy ); ?>"><span><?php echo $term->name ?></span>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                   <li><button type="submit">Применить</button></li>
                </ul>

                
        </form>
    </section>
</section>

<!-- --------------------------------------------------------------------------------------
                        MAIN
------------------------------------------------------------------------------------------->
<!--            проверяем на запрос от фильтров         -->
<?php if ($_GET && !empty($_GET)) { // если было передано что-то из формы
        go_filter(); // запускаем функцию фильтрации
};
    function go_filter() {
        global $wp_query; // нужно заглобалить текущую выборку постов
        
        $args = array(); // подготовим массив 

        $args['tax_query'] = array('relation' => 'AND'); // можно OR
        if ($_GET['form_type'] != '') { // если передана фильтрация по разделу
                $args['tax_query'][] = array( // пешем условия в meta_query
                    'taxonomy'           => 'type',
                    'field'              => 'slug', // название произвольного поля
                    'terms'              => $_GET['form_type'], // переданное значение произвольного поля
                    //'operator'         => 'AND', // одновременно, можно IN - тогда хотя бы одному термину
                    //'include_children' => false // чтобы работало для иерархических таксономий                        
                );
        };
        if ($_GET['form_years'] != '') { // если передана фильтрация по разделу
            $args['tax_query'][] = array( // пешем условия в meta_query
                'taxonomy'           => 'years',
                'field'              => 'slug', // название произвольного поля
                'terms'              => $_GET['form_years'], // переданное значение произвольного поля
                //'operator'         => 'IN', // одновременно, можно IN - тогда хотя бы одному термину
                //'include_children' => false // чтобы работало для иерархических таксономий                        
            );
        };
        if ($_GET['form_city'] != '') { // если передана фильтрация по разделу
            $args['tax_query'][] = array( // пешем условия в meta_query
                'taxonomy'           => 'city',
                'field'              => 'slug', // название произвольного поля
                'terms'              => $_GET['form_city'], // переданное значение произвольного поля
                //'operator'         => 'IN', // одновременно, можно IN - тогда хотя бы одному термину
                //'include_children' => false // чтобы работало для иерархических таксономий                        
            );
        };
        
        
        $args['meta_query'] = array('relation' => 'AND'); // отношение между условиями, у нас это "И то И это", можно ИЛИ(OR)
        
        if (!empty($_GET['form_area_park'])) { // если передан массив с фильтром по комнатам
            $param = array('relation' => 'OR');
            foreach($_GET['form_area_park'] as $key => $value) {
                $value = explode("-", $value);
                $range = [];
                foreach($value as $_key => $_value) { $range[] = (int) $_value; };                
                $param[] = array( // пешем условия в meta_query
                    'key'     => 'ale_area_park', // название произвольного поля
                    'value'   => $range, // переданное значения, $_GET['rooms'] содержит массив со значениями отмеченных чекбоксов
                    'type'    => 'numeric', // тип поля - число
                    'compare' => 'BETWEEN' // тип сравнения IN, т.е. значения поля комнат должно быть одним из значений элементов массива
                );
            };
            $args['meta_query'][] = $param;
        };
        if (!empty($_GET['form_whoes_type'])) { // если передан массив с фильтром по комнатам            
            $param = array('relation' => 'OR');
            foreach($_GET['form_whoes_type'] as $key => $value) {                                
                $param[] = array( // пешем условия в meta_query
                    'key'       => 'ale_whoes_type', // название произвольного поля
                    'value'     => $value, // переданное значения, $_GET['rooms'] содержит массив со значениями отмеченных чекбоксов                    
                    'compare'   => '=' // тип сравнения IN, т.е. значения поля комнат должно быть одним из значений элементов массива
                );
            };
            $args['meta_query'][] = $param;
        };
                
        query_posts( array_merge($wp_query->query , $args) ); // сшиваем текущие условия выборки стандартного цикла wp с новым массивом переданным из формы и фильтруем       
    };
    
 ?>
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
                                echo $taxonomies['years'];
                            ?>
                        </div>
                        <div class="area">
                            <?php echo ale_get_meta('area_park') ?> м<sup>2</sup>.
                        </div>
                        <div class="whoes">
                            <?php ale_meta('whoes_name'); ?>
                            <?php ale_meta('whoes_type'); ?>
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

    <?php else: ?>
    </div>
    <div class="nofound">
        <p class="nofound">Скейт парк с заданными параметрами не найден...</p>
        <a href = "<?php echo  get_post_type_archive_link('project'); ?>">Назад в Проекты</a>
    </div>                
    <?php ; ?>
        <?php endif; ?>
                     
    <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <div id="true_loadmore">Загрузить ещё</div>
    <?php endif; ?>
</section> 

<!-- --------------------------------------------------------------------------------------
                        MAP
------------------------------------------------------------------------------------------->

<section class = "map" id = "map"> 
</section>


