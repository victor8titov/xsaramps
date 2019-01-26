<?php
/****************************************************************
 * DO NOT DELETE
 ****************************************************************/
if ( get_stylesheet_directory() == get_template_directory() ) {
	define('ALETHEME_PATH', get_template_directory() . '/aletheme');
	define('ALETHEME_URL', get_template_directory_uri() . '/aletheme');
}  else {
    define('ALETHEME_PATH', get_theme_root() . '/fuerza/aletheme');
    define('ALETHEME_URL', get_theme_root_uri() . '/fuerza/aletheme');
}

require_once ALETHEME_PATH . '/init.php';

load_theme_textdomain( 'aletheme', get_template_directory() . '/lang' );
$locale = get_locale();
$locale_file = get_template_directory() . "/lang/$locale.php";
if ( is_readable($locale_file) )
    require_once($locale_file);

/****************************************************************
 * You can add your functions here.
 * 
 * BE CAREFULL! Functions will dissapear after update.
 * If you want to add custom functions you should do manual
 * updates only.
 ****************************************************************/

/*-----------------------------------------------------------------------------------*/
/* Убираем мусор: feed, shortlink
/*-----------------------------------------------------------------------------------*/
function mw_clear_wp_head()
{
  //add_filter('xmlrpc_enabled', '__return_false');
  remove_action( 'wp_head', 'feed_links', 2 ); // Удаляет ссылки RSS-лент записи и комментариев
  remove_action( 'wp_head', 'feed_links_extra', 3 ); // Удаляет ссылки RSS-лент категорий и архивов

  remove_action( 'wp_head', 'rsd_link' ); // Удаляет RSD ссылку для удаленной публикации
  remove_action( 'wp_head', 'wlwmanifest_link' ); // Удаляет ссылку Windows для Live Writer
  remove_action( 'wp_head', 'wp_generator' ); // Удаляет версию WordPress

  remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0); // Удаляет короткую ссылку
  //remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Удаляет ссылки на предыдущую и следующую статьи
}
add_action( 'wp_head', 'mw_clear_wp_head', 1 );

/*-----------------------------------------------------------------------------------*/
/*          Разрешаем загрузку запрещенных типов файлов
/*-----------------------------------------------------------------------------------*/
add_filter( 'upload_mimes', 'upload_allow_types' );
function upload_allow_types( $mimes ) {
	// разрешаем новые типы
	$mimes['dwg']  = 'image/vnd.dwg'; 
	
    /*
	// отключаем имеющиеся
	unset( $mimes['mp4a'] );
    */
    
	return $mimes;
}

add_action('wp_enqueue_scripts', 'my_ajax_data', 99);
function my_ajax_data() {
   
    wp_localize_script('ale_scripts','myajax',array(
        'url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('myajax-nonce'),
    ));
}


/*
*               example ajax for home page 
*
//  проверяем, является ли текущий запрос AJAX запросом WordPress
if (wp_doing_ajax()) {

    add_action('wp_ajax_myAjax', 'test_func' );
    add_action('wp_ajax_nopriv_myAjax', 'test_func');
    
    function test_func() {

        //  проверяем nonce код, если проверка не пройдена прерываем обработку
        check_ajax_referer('myajax-nonce','nonce_code');
        
        
        // тело запроса здесь формируем то что отдадим фронтенду
       $images = array(
            'http://xsaramps/wp-content/uploads/2019/01/X9h6FreG-5k.jpg',
            'http://xsaramps/wp-content/uploads/2019/01/GOPR0007.jpg',
            'http://xsaramps/wp-content/uploads/2019/01/GOPR0008.jpg',
            'http://xsaramps/wp-content/uploads/2019/01/GOPR0009.jpg',
            'http://xsaramps/wp-content/uploads/2019/01/GOPR0011.jpg',
            'http://xsaramps/wp-content/uploads/2019/01/DJI_0007.jpg-nggid0267-ngg0dyn-0x360-00f0w010c010r110f110r010t010.jpg',
            'http://xsaramps/wp-content/uploads/2019/01/DJI_0007-1.jpg-nggid0268-ngg0dyn-0x360-00f0w010c010r110f110r010t010.jpg',
            'http://xsaramps/wp-content/uploads/2019/01/GOPR0002-1.jpg',
            'http://xsaramps/wp-content/uploads/2019/01/DJI_0008.jpg-nggid0269-ngg0dyn-0x360-00f0w010c010r110f110r010t010.jpg',
       );
       $number_page = $_POST['page'] * 3 + 1;
       if ($_POST['page'] < 3): 
        
            ?> 
            <div class = "foto_ajax">
            <?php 
            for ($i=0; $i < 3; $i++ ) :
                ?>
                <div class = "img_ajax">
                <img src = "<?php echo $images[$number_page] ?>" alt = "" >
                </div>
                <?php
                $number_page++;
            endfor;        
            ?>        
            </div> <?php

        endif;
        
      
      wp_die();  
    };

}

*           end ajax example
*/

