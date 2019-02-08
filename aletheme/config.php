<?php
/**
 * Get current theme options
 * 
 * @return array
 */
function aletheme_get_options() {
	$comments_style = array(
		'wp'  => 'Alethemes Comments',
		'fb'  => 'Facebook Comments',
		'dq'  => 'DISQUS',
		'lf'  => 'Livefyre',
		'off' => 'Disable All Comments',
	);

    $headerfont = array_merge(ale_get_safe_webfonts(), ale_get_google_webfonts());

    $background_defaults = array(
        'color' => '',
        'image' => '',
        'repeat' => 'repeat',
        'position' => 'top center',
        'attachment'=>'scroll'
    );

	
	$imagepath =  ALETHEME_URL . '/assets/images/';
	
	$options = array();
		
	$options[] = array("name" => "Theme",
						"type" => "heading");

    $options[] = array( "name" => "Site Logo",
                        "desc" => "Upload or put the site logo link (Default logo size: 133-52px)",
                        "id" => "ale_sitelogo",
                        "std" => "",
                        "type" => "upload");

    $options[] = array( "name" => "Site Footer Logo",
                        "desc" => "Upload or put the site logo link (Default logo size: 133-52px)",
                        "id" => "ale_sitelogofooter",
                        "std" => "",
                        "type" => "upload");

    $options[] = array( 'name' => "Manage Background",
                        'desc' => "Select the background color, or upload a custom background image. Default background is the #f5f5f5 color",
                        'id' => 'ale_background',
                        'std' => $background_defaults,
                        'type' => 'background');

    $options[] = array( "name" => "Show Site Preloader",
                        "desc" => "Description kakoito.",
                        "id" => "ale_backcover",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Uplaod a favicon icon",
                        "desc" => "Upload or put the link of your favicon icon",
                        "id" => "ale_favicon",
                        "std" => "",
                        "type" => "upload");
    
    $options[] = array( "name" => "Uplaod a point Map icon",
                        "desc" => "Upload or put the link of your point Map icon",
                        "id" => "ale_pointmap",
                        "std" => "",
                        "type" => "upload");                    

	$options[] = array( "name" => "Comments Style",
						"desc" => "Choose your comments style. If you want to use DISQUS comments please install and activate this plugin from <a href=\"" . admin_url('plugin-install.php?tab=search&type=term&s=Disqus+Comment+System&plugin-search-input=Search+Plugins') . "\">Wordpress Repository</a>.  If you want to use Livefyre Realtime Comments comments please install and activate this plugin from <a href=\"" . admin_url('plugin-install.php?tab=search&type=term&s=Livefyre+Realtime+Comments&plugin-search-input=Search+Plugins') . "\">Wordpress Repository</a>.",
						"id" => "ale_comments_style",
						"std" => "wp",
						"type" => "select",
						"options" => $comments_style);

	$options[] = array( "name" => "AJAX Comments",
						"desc" => "Use AJAX on comments posting (works only with Alethemes Comments selected).",
						"id" => "ale_ajax_comments",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Social Sharing",
						"desc" => "Enable social sharing for posts.",
						"id" => "ale_social_sharing",
						"std" => "1",
						"type" => "checkbox");

    $options[] = array( "name" => "Copyrights",
                        "desc" => "Your copyright message.",
                        "id" => "ale_copyrights",
                        "std" => "",
                        "type" => "editor");

    $options[] = array( "name" => "Home Page Slider slug",
                        "desc" => "Insert the slider slug. Get the slug on Sliders Section",
                        "id" => "ale_homeslugfull",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Blog Slider slug",
                        "desc" => "Insert the slider slug. Get the slug on Sliders Section",
                        "id" => "ale_blogslugfull",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Typography",
                        "type" => "heading");

    $options[] = array( "name" => "Select the body Font from Google Library",
                        "desc" => "The default Font is - Raleway",
                        "id" => "ale_headerfont",
                        "std" => "Raleway",
                        "type" => "select",
                        "options" => $headerfont);

    $options[] = array( "name" => "Select the body Font (Extended) from Google Library",
                        "desc" => "The default Font (extended) is - 600",
                        "id" => "ale_headerfontex",
                        "std" => "600",
                        "type" => "text",
                        );

    $options[] = array( "name" => "Select the Headers Font from Google Library",
                        "desc" => "The default Font is - Libre Baskerville",
                        "id" => "ale_mainfont",
                        "std" => "Libre+Baskerville",
                        "type" => "select",
                        "options" => $headerfont);

    $options[] = array( "name" => "Select the Headers Font (Extended) from Google Library",
                        "desc" => "The default Font (extended) is - 400,400italic",
                        "id" => "ale_mainfontex",
                        "std" => "400,400italic",
                        "type" => "text",
                        );

    $options[] = array( 'name' => "H1 Style",
                        'desc' => "Change the h1 style",
                        'id' => 'ale_h1sty',
                        'std' => array('size' => '22px','face' => 'Libre+Baskerville','style' => 'normal','color' => '#111111'),
                        'type' => 'typography');

    $options[] = array( 'name' => "H2 Style",
                        'desc' => "Change the h2 style",
                        'id' => 'ale_h2sty',
                        'std' => array('size' => '20px','face' => 'Libre+Baskerville','style' => 'normal','color' => '#111111'),
                        'type' => 'typography');

    $options[] = array( 'name' => "H3 Style",
                        'desc' => "Change the h3 style",
                        'id' => 'ale_h3sty',
                        'std' => array('size' => '18px','face' => 'Libre+Baskerville','style' => 'normal','color' => '#111111'),
                        'type' => 'typography');

    $options[] = array( 'name' => "H4 Style",
                        'desc' => "Change the h4 style",
                        'id' => 'ale_h4sty',
                        'std' => array('size' => '16px','face' => 'Libre+Baskerville','style' => 'normal','color' => '#111111'),
                        'type' => 'typography');

    $options[] = array( 'name' => "H5 Style",
                        'desc' => "Change the h5 style",
                        'id' => 'ale_h5sty',
                        'std' => array('size' => '14px','face' => 'Libre+Baskerville','style' => 'normal','color' => '#111111'),
                        'type' => 'typography');

    $options[] = array( 'name' => "H6 Style",
                        'desc' => "Change the h6 style",
                        'id' => 'ale_h6sty',
                        'std' => array('size' => '12px','face' => 'Libre+Baskerville','style' => 'normal','color' => '#111111'),
                        'type' => 'typography');

    $options[] = array( 'name' => "Body Style",
                        'desc' => "Change the body font style",
                        'id' => 'ale_bodystyle',
                        'std' => array('size' => '11px','face' => 'Libre+Baskerville','style' => 'normal','color' => '#111111'),
                        'type' => 'typography');

	$options[] = array( "name" => "Social",
						"type" => "heading");

    $options[] = array( "name" => "Twitter",
                        "desc" => "Your twitter profile URL.",
                        "id" => "ale_twi",
                        "std" => "",
                        "type" => "text");
	$options[] = array( "name" => "Facebook",
						"desc" => "Your facebook profile URL.",
						"id" => "ale_fb",
						"std" => "",
						"type" => "text");
    $options[] = array( "name" => "Google+",
                        "desc" => "Your google+ profile URL.",
                        "id" => "ale_gog",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Pinterest",
                        "desc" => "Your pinteres profile URL.",
                        "id" => "ale_pint",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Flickr",
                        "desc" => "Your flickr profile URL.",
                        "id" => "ale_flickr",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Linkedin",
                        "desc" => "Your linked profile URL.",
                        "id" => "ale_linked",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Instagram",
                        "desc" => "Your instagram profile URL.",
                        "id" => "ale_insta",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Email",
                        "desc" => "Your email",
                        "id" => "ale_emailcont",
                        "std" => "",
                        "type" => "text");
    $options[] = array( "name" => "Show RSS",
                        "desc" => "Check if you want to show the RSS icon on your site",
                        "id" => "ale_rssicon",
                        "std" => "1",
                        "type" => "checkbox");

	
	$options[] = array( "name" => "Facebook Application ID",
						"desc" => "If you have Application ID you can connect the blog to your Facebook Profile and monitor statistics there.",
						"id" => "ale_fb_id",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Enable Open Graph",
						"desc" => "The <a href=\"http://www.ogp.me/\">Open Graph</a> protocol enables any web page to become a rich object in a social graph.",
						"id" => "ale_og_enabled",
						"std" => "",
						"type" => "checkbox");


	
	$options[] = array( "name" => "Advanced Settings",
						"type" => "heading");

	
	$options[] = array( "name" => "Google Analytics",
						"desc" => "Please insert your Google Analytics code here. Example: <strong>UA-22231623-1</strong>",
						"id" => "ale_ga",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Footer Code",
						"desc" => "If you have anything else to add in the footer - please add it here.",
						"id" => "ale_footer_info",
						"std" => "",
						"type" => "textarea");

    $options[] = array( "name" => "Custom CSS Styles",
                        "desc" => "You can add here your styles. ex. .boxclass { padding:10px; }",
                        "id" => "ale_customcsscode",
                        "std" => "",
                        "type" => "textarea");

    $options[] = array( "name" => "Footer menu title",
                        "desc" => "Insert the footer menu title",
                        "id" => "ale_footermenutitle",
                        "std" => "Select a category",
                        "type" => "text");

    $options[] = array( "name" => "Footer menu title",
                        "desc" => "Insert the footer menu title",
                        "id" => "ale_footermenutitle_1",
                        "std" => "",
                        "type" => "images",
                        "options" => array(
                            'image_1' => $imagepath.'/1col.png',
                            'image_2' => $imagepath.'/2cl.png',
                            'image_3' => $imagepath.'/2cr.png', ),
        );
	
	return $options;
}

/**
 * Add custom scripts to Options Page
 */
function aletheme_options_custom_scripts() {
 ?>

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#ale_commentongallery').click(function() {
        jQuery('#section-ale_gallerycomments_style').fadeToggle(400);
    });
    if (jQuery('#ale_commentongallery:checked').val() !== undefined) {
        jQuery('#section-ale_gallerycomments_style').show();
    }
});
</script>

<?php
}

/**
 * Add Metaboxes
 * @param array $meta_boxes
 * @return array 
 */
function aletheme_metaboxes($meta_boxes) {
	
	$meta_boxes = array();

    $prefix = "ale_";
    /*------------------------------------------------------------------------------------------
    *                   МЕТАДАННЫЕ ДЛЯ ПОСТОВ РАЗДЕЛА КАТАЛОГ
    *                   meta data for custom post type catalog
    ------------------------------------------------------------------------------------------------*/
    $meta_boxes[] = array(
        'id'         => 'catalog_metadata',
        'title'      => 'Данные по проекту',
        'pages'      => array( 'catalog', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        // 'show_on'    => array( 'key' => 'page-template', 'value' => array('template-press.php'), ), // Specific post templates to display this metabox
        'fields'     => array(
            array(
                'name' => 'Цена парка',
                'desc' => 'Укажите стоимость проекта',
                'id'   => $prefix . 'catalog_price',                
                'type' => 'text_money',
            ),
            array(
                'name' => 'DWG file',
                'desc' => 'Файл ландшафта',
                'id'   => $prefix . 'fileupload',
                'type' => 'file',
            ),
            array(
                'name' => 'План №1',
                'desc' => 'Загрузите фото проекта',
                'id'   => $prefix . 'foto-1',
                'type' => 'file',
            ),
            array(
                'name' => 'План №2',
                'desc' => 'Загрузите фото проекта',
                'id'   => $prefix . 'foto-2',
                'type' => 'file',
            ),
            array(
                'name' => 'План №3',
                'desc' => 'Загрузите фото проекта',
                'id'   => $prefix . 'foto-3',
                'type' => 'file',
            ),

                     
        )
    );


     /*------------------------------------------------------------------------------------------
    *                   МЕТАДАННЫЕ ДЛЯ ПОСТОВ РАЗДЕЛА ПРОЕКТЫ
    *                   meta data for custom post type PROJECT
    ------------------------------------------------------------------------------------------------*/
    $meta_boxes[] = array(
        'id'         => 'project_metadata',
        'title'      => 'Данные по проекту',
        'pages'      => array( 'project', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left        
        'fields'    => array(
            array(
                'name' => 'Площадь парка',
                'desc' => 'Площадь занимаемая парком',
                'id'   => $prefix . 'area_park',
                'type' => 'text',
            ),

            array(
                'name' => 'Дней работ',
                'desc' => 'Сколько ушло времени на строительство',
                'id'   => $prefix . 'day_work',
                'type' => 'text',
            ),
            array(
                'name' => 'Адрес парка',
                'desc' => 'Адрес будет использован для отображения точки на карте',
                'id'   => $prefix . 'coordinate_park',
                'type' => 'text',
            ),
            array(
                'name' => 'Имя заказчика',
                'desc' => 'Организация заказавшая парк',
                'id'   => $prefix . 'whoes_name',
                'type' => 'text',
            ),
            array(
                'name'    => 'Тип заказчика',
                'desc'    => 'Тип заказчика',
                'id'      => $prefix . 'whoes_type',
                'type'    => 'multicheck',
                'options' => array(
                    'state'    => 'Государственные',
                    'business' => 'Бизнес',
                    'private'  => 'Частные',
                ),
            ),
        ),
        
    );
    /*
    $meta_boxes[] = array(
        'id'         => 'home_page_metabox',
        'title'      => 'Home Meta Options',
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on'    => array( 'key' => 'page-template', 'value' => array('page-home.php'), ), // Specific post templates to display this metabox

        'fields' => array(
            array(
                'name' => 'Показать/Скрыть',
                'desc' => 'Показать или скрыть цену на странице',
                'id'   => 'catalog_show_metadata',
                'type' => 'radio',
                'options' => array(
                    array(
                        'name'  => 'Show',
                        'value' => 'show'
                    ),                    
                ),
            ),
            array(
                'name' => 'First Description',
                'desc' => 'Insert the text',
                'id'   => $prefix . 'descr1',
                'type' => 'textarea',
            ),
            array(
                'name' => 'Second Description',
                'desc' => 'Insert the text',
                'id'   => $prefix . 'descr2',
                'type' => 'text',
            ),
            array(
                'name' => 'File Upload',
                'desc' => 'Insert the text',
                'id'   => $prefix . 'fileupload',
                'type' => 'file',
            ),
            array(
                'name' => 'Text Date',
                'desc' => 'Insert the text',
                'id'   => $prefix . 'datefield',
                'type' => 'wysiwyg',
            ),
        )
    );
    */
    /*
    $meta_boxes[] = array(
        'id'         => '',
        'title'      => '',
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on'    => array( 'key' => 'page-template', 'value' => array('template-press.php'), ), // Specific post templates to display this metabox
        'fields' => array(
            array(
                'name' => '',
                'desc' => '',
                'id'   => $prefix . '',
                'type' => 'text',
            ),
            array(
                'name' => '',
                'desc' => '',
                'id'   => $prefix . '',
                'type' => 'file',
            ),
            array(
                'name' => '',
                'desc' => '',
                'id'   => $prefix . '',
                'type'    => 'wysiwyg',
            ),            
        )
    );
    */
	return $meta_boxes;
}

/**
 * Get image sizes for images
 * 
 * @return array
 */
function aletheme_get_images_sizes() {
	return array(
        'project' => array(
            array(
                'name'      => 'project-medium',
                'width'     => 320,
                'height'    => 200,
                'crop'      => true,
            ),
                  
        ),
        /*
        'gallery' => array(
            array(
                'name'      => 'gallery-thumba',
                'width'     => 430,
                'height'    => 267,
                'crop'      => true,
            ),
            array(
                'name'      => 'gallery-mini',
                'width'     => 100,
                'height'    => 67,
                'crop'      => true,
            ),
            array(
                'name'      => 'gallery-big',
                'width'     => 680,
                'height'    => 9999,
                'crop'      => false,
            ),
        ),
        'post' => array(
            array(
                'name'      => 'post-thumba',
                'width'     => 475,
                'height'    => 295,
                'crop'      => true,
            ),
            array(
                'name'      => 'post-minibox',
                'width'     => 500,
                'height'    => 200,
                'crop'      => true,
            ),
        ),
        */

    );
}

/**
 * Add post types that are used in the theme 
 * 
 * @return array
 */
function aletheme_get_post_types() {
	return array(
        /*
        'gallery' => array(
            'config' => array(
                'public' => true,
                'menu_position' => 20,
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'editor',
                    'thumbnail',
                ),
                'show_in_nav_menus'=> true,
            ),
            'singular' => 'Gallery',
            'multiple' => 'Galleries',
            'columns'    => array(
                'first_image',
            )
            
        ),
        */
        /*
        * -------------------------------- POST TYPE - КАТАЛОГ ------------------------------------------------------------------
        */
        'catalog' => array(
            'config' => array(
                'public' => true,
                'menu_position' => 10,
                //'menu_icon' => 'dashicons-format-audio',
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'editor',
                    'thumbnail',
                ),
                'show_in_nav_menus'=> true,
                //'taxonomies' => array('category', 'post_tag'),
            ),
            'singular' => 'Каталог',
            'multiple' => 'Каталог'
        ),
        /*
        *           end post type
        */

        /*
        * -------------------------------- POST TYPE - ПРОЕКТЫ ------------------------------------------------------------------
        */
        'project' => array(
            'config' => array(
                'public' => true,
                'menu_position' => 10,
                //'menu_icon' => 'dashicons-format-audio',
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'editor',
                    'thumbnail',
                ),
                'show_in_nav_menus'=> true,
            ),
            'singular' => 'Проекты',
            'multiple' => 'Проекты'
        ),
        /*
        *           end post type
        */

        /*
        * -------------------------------- POST TYPE - КОМАНДА ------------------------------------------------------------------
        */
        'team' => array(
            'config' => array(
                'public' => true,
                'menu_position' => 10,
                //'menu_icon' => 'dashicons-format-audio',
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'editor',
                    'thumbnail',
                ),
                'show_in_nav_menus'=> true,
            ),
            'singular' => 'Команда',
            'multiple' => 'Команда'
        ),
        /*
        *           end post type
        */

        /*
        * -------------------------------- POST TYPE - ВИДЕО ------------------------------------------------------------------
        */
        'video' => array(
            'config' => array(
                'public' => true,
                'menu_position' => 10,
                //'menu_icon' => 'dashicons-format-audio',
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'editor',
                    'thumbnail',
                ),
                'show_in_nav_menus'=> true,
            ),
            'singular' => 'Видео',
            'multiple' => 'Видео'
        ),
        /*
        *           end post type
        */
    );
}

/**
 * Add taxonomies that are used in theme
 * 
 * @return array
 */
function aletheme_get_taxonomies() {
	return array(
        /*
        'gallery-category'    => array(
            'for'        => array('gallery'),
            'config'    => array(
                'sort'        => true, //Следует ли этой таксономии запоминать порядок в котором созданные элементы
                //'args'        => array('orderby' => 'term_order'),
                'hierarchical' => true, // таксономия будет древовидная (как категории)
            ),
            'singular'    => 'Gallery Category',
            'multiple'    => 'Gallery Categories',
        ),
        */
        /*
        *
        *----------------------------------------------------------------- 
        */
        /*
        ''    => array(
            'for'        => array(''),
            'config'    => array(
                'sort'        => true, //Следует ли этой таксономии запоминать порядок в котором созданные элементы
                //'args'        => array('orderby' => 'term_order'),
                'hierarchical' => true, // таксономия будет древовидная (как категории)
            ),
            'singular'    => '',
            'multiple'    => '',
        ),
        */
        /* ---------------------------------------------------------------------------------------------------
        *                       КАТАЛОГ     
        *                       Таксономи для пост тайпа каталог
        -------------------------------------------------------------------------------------------------------*/
        
        'catalog-category'    => array(
            'for'        => array('catalog', 'page'),   // таксономи есть у castom post type catalog и страницы нужно для циклов и общей структуры
            'config'    => array(
                'sort'        => true, //Следует ли этой таксономии запоминать порядок в котором созданные элементы
                //'args'        => array('orderby' => 'term_order'),
                'hierarchical' => true, // таксономия будет древовидная (как категории)
            ),
            'singular'    => 'Вид парка',
            'multiple'    => 'Виды парков',
        ),

        /* ---------------------------------------------------------------------------------------------------
        *                       ПРОЕКТЫ     
        *                       taxonomy for custom post type ПРОЕКТЫ
        -------------------------------------------------------------------------------------------------------*/

        'type' => array(
            'for' => array('project'),
            'config' => array(
                'sort' => true,
                'hierarchical' => true, // таксономия будет древовидная (как категории)
            ),
            'singular' => 'Вид парка',
            'multiple' => 'Виды парков',
        ),
        'years' => array(
            'for' => 'project',
            'config' => array(
                'sort' => true,
                'hierarchical' => true, // таксономия будет древовидная (как категории)

            ),
            'singular' => 'Год постройки',
            'multiple' => 'Год постройки',
        ),
        'city' => array(
            'for' => 'project',
            'config' => array(
                'sort' => true,
                'hierarchical' => true, // таксономия будет древовидная (как категории)

            ),
            'singular' => 'Город проекта',
            'multiple' => 'Города проекта',
        ),

        
    );
}

/**
 * Add post formats that are used in theme
 * 
 * @return array
 */
function aletheme_get_post_formats() {
	return array();
}

/**
 * Get sidebars list
 * 
 * @return array
 */
function aletheme_get_sidebars() {
	$sidebars = array();
	return $sidebars;
}

/**
 * Predefine custom sliders
 * @return array
 */
function aletheme_get_sliders() {
	return array(
		'sneak-peek' => array(
			'title'		=> 'Sneak Peek',
		),
	);
}

/**
 * Post types where metaboxes should show
 * 
 * @return array
 */
function aletheme_get_post_types_with_gallery() {
	return array('');
}

/**
 * Add custom fields for media attachments
 * @return array
 */
function aletheme_media_custom_fields() {
	return array();
}