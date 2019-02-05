<?php 

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
                                <a href="#map" id="show_point_map" data-ID ="<?php echo get_the_ID(); ?>"><?php echo wp_trim_words(ale_get_meta('coordinate_park'), 5, '...'); ?></a>
                            </div>
                        </div>                        
                        <div class="content">
                            <p><?php echo wp_trim_words(get_the_content(), 15, '...'); ?></p>
                            <a href="<?php echo get_the_permalink(); ?>">Больше информации</a>
                        </div>
                    </div>
                </div>
            
        </div>
           