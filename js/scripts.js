jQuery(function($) {
    "use strict";

    // Custom jQuery Code Here

    //  инициализация фреймворка slick 
    //  слайды фото
    $('.slider-type').slick({
        
    });
    
    $('.portfolioslider').flexslider({
        animation:'slide',
        smoothHeight:true,
        controlNav: false
    });

    $('.newhomeslider').flexslider({
        animation:'slide',
        smoothHeight:true,
        controlNav: false
    });

    var $grid = $('.grid').masonry({
            // options
            itemSelector: '.grid-item',
            columnWidth: 5,
            //gutter: 25,
            fitWidth: true,
        });
    

    // обработчик событий делегированный на карточки парков
    $('.grid').on('click', '.flipper' , function(event){
            var obj = event.currentTarget;
            var target = $(obj);
           target.toggleClass('flipper_event');
           //return false;            
    });
    
    /* -----------------------------------------------------------------------
    *               загрузка проектов в archive-project.php
    *               кнопка загрузить еще
    -------------------------------------------------------------------------*/
    //  инициация ajax запроса и работа с кнопкой.
    $('#true_loadmore').click(function(){
		$(this).text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
		var data = {
			'action': 'loadmore',
			'query': true_posts,
			'page' : current_page
        };        
		$.ajax({
			url:ajaxurl, // обработчик
			data:data, // данные
			type:'POST', // тип запроса
			success:function(data){
                // если данные были отправлены 
				if( data ) { 
                    $('#true_loadmore').text('Загрузить ещё'); // вставляем новые посты
                    
                    // нужно обернуть в объект jquery для работы метода от фреймворка masonary
                    var content = $( data )
                    
                    // доболяем методом jquery в объект 
                    $grid.append( content )
                    // применяем метод masonory для того чтобы он перерасчитал расположение елементов
                    .masonry( 'appended', content );                   
                    
					current_page++; // увеличиваем номер страницы на единицу
                    
                    if (current_page == max_pages) {
                        $("#true_loadmore").remove();
                        } // если последняя страница, удаляем кнопку
				} else {
					$('#true_loadmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
				}
			}
		});
    });
    

    /* -----------------------------------------------------------------------
    *               yandex maps
    -------------------------------------------------------------------------*/
    
    // Функция ymaps.ready() будет вызвана, когда
    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
    
    ymaps.ready(init);
    function init(){ 
        // Создание карты.    
        var myMap = new ymaps.Map("map", {
            // Координаты центра карты.
            center: [45.039203, 38.976953],
            controls: ['zoomControl'],
            zoom: 7
        });
        
        /*
        *   обращаемся к наборам поведения карт
        *    Доступ к поведениям карты предоставляется полем behaviors.
        *   применяем метод disable для отключеня поведеня скорола
        *   выключаем зоом при скроле
        */
       myMap.behaviors.disable('scrollZoom');
        
       /*
        * ajax запрос на получения адресов и данных для карты от сервера
        */
        var dataMap = {},
            counter = 0;

        $.ajax({
            url: ajaxurl,
            data: {
                'action': 'data_for_map',            
            },
            type: 'POST',
            success: function(data) {
                dataMap = JSON.parse(data);
                console.log('получение данных по ajax');
                console.log(dataMap);
                counter = dataMap.points.length;
                add_coords_data_map();
                
            }
        });

        /*
        *   после получения объекта с адресами 
        *   вызываем функц add_coords_data_map
        *   получаем в объект dataMap координаты каждого адреса
        */
        function add_coords_data_map() {
            for( var i=0; i < dataMap.points.length; i++ ) {
                ymaps.geocode(dataMap.points[i].adress , {
                    results: 1
                    }).then( function (res) { 
                        var firstGeoObject = res.geoObjects.get(0),
                            coords = firstGeoObject.geometry.getCoordinates(),
                            request = res.metaData.geocoder.request;
                        //console.log(res);    
                        //console.log(request);
                        dataMap.points.forEach( function (point) {
                            if (point.adress === request) {
                                point.coords = coords; 
                            };
                        });

                        counter--;
                        if (counter === 0) { add_points_to_map() };

                    }, function(err) {
                        console.log("Ошибка ассинхронной передачи геокодирования:" + err);
                    });
            }; 
        }; // end add_coords_data_map()  
        
        /*
        *   после выполнения add_coords_data_map
        *   вызываем add_points_to_map
        *   создаем кластер
        *   добовляем маркеры и устанавливаем их стили
        *   добовляем кластеры на карту
        */
        function add_points_to_map() {
            var myClusterer = new ymaps.Clusterer();
            
            dataMap.points.forEach( function(point) {
                var myPlacemark = new ymaps.Placemark(point.coords, {
                    hintContent: '<div class="yandexMaps-hintHeader"><p>' + point.title + '</p></div>',
                    balloonContentHeader: '<div class="yandexMaps-balloonHeader"><h3>' + point.title + '</h3></div>',
                    balloonContentBody: '<div class="yandexMaps-balloonBody"><p>'+ point.adress+'</p></div>',
                    balloonContentFooter: '<div class="ynadexMaps-ballonFooter"><a href="'+ point.link +'">Открыть</a></div>',                    
                }, {                    
                    iconLayout: 'default#image',                    
                    iconImageHref: dataMap.mapOptions.iconPoint,
                    iconImageSize: [30, 30],
                    iconImageOffset: [-14, 0],                    
                });
                point.geoObject = myPlacemark;
                
                myClusterer.add(myPlacemark);
            });
            myMap.geoObjects.add(myClusterer);  
        }; // end add_points_to_map

        /*
        *   Обработчик событий клика на адрес
        *   показывает на карте метку
        */
       $('.grid').on('click', '#show_point_map', function(event){
            var target = $(event.currentTarget),
                    ID = parseInt(target.attr("data-id"));

            // ищем метку по ID
            for(var i=0; i<dataMap.points.length; i++) {
                var point = dataMap.points[i];
               
                if (point.ID !== ID) continue;
                else {
                    //  переместим фокус карты на нашу точку
                    //  координаты и сам объект берем с объекта dataMap                    
                    myMap.setCenter(point.coords, 13, {    checkZoomRange: true}).then(function(){
                        /*  после выполнения setCenter метод возвращет объект promise
                        *   применяем метод them объекта promise
                        *   выполняется функция только после выполнения метода setCenter
                        *   открываем баллоон для геообъекта в фокусе
                        */
                        point.geoObject.balloon.open();
                    })
                    // покидаем цикл for               
                    break;
                };
            }; 
       }); // end event click link 



    }; // end init();

        
                
        
        
   
        
     
        
        
        
        
        
   
    
    

    
    
    /*
    //  при инициализации сбрасывает настройки установленные в админке
    $('#ale-slider-slider_for_experiment-du4gc').flexslider({
        //animation: 'slide',
        //smoothHeight: true,
       // Primary Controls
        //controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        //directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
        prevText: "back",           //String: Set the text for the "previous" directionNav item
        nextText: "next",               //String: Set the text for the "next" directionNav item
        //slideshow: false,
        
    });
    */


    /*
    *           моя проба ajax на главной странице
    var number_page = 0;
    $("#VT_button").click(function() {
       
        
         
    //console.log(myajax.url);
        $.ajax({
            url: myajax.url,
            type: 'POST',
            data: {
                action: 'myAjax',
                nonce_code: myajax.nonce,
                page: number_page,
            },
            beforeSend: function( xhr ) {
                $('#VT_button').text("Загрузка, 5 сек...");
            },
            success: function( data ) {
                $('#VT_button').text('More foto');
                $('.button_ajax').before( data );
                number_page++;
                if (number_page > 2 ) $('#VT_button').remove(); 
                
            }
        })
        
    });*/

});

/*
*           end ajax example for home page
*/
Modernizr.addTest('ipad', function () {    return !!navigator.userAgent.match(/iPad/i);
});

Modernizr.addTest('iphone', function () {
    return !!navigator.userAgent.match(/iPhone/i);
});

Modernizr.addTest('ipod', function () {
    return !!navigator.userAgent.match(/iPod/i);
});

Modernizr.addTest('appleios', function () {
    return (Modernizr.ipad || Modernizr.ipod || Modernizr.iphone);
});

Modernizr.addTest('positionfixed', function () {
    var test    = document.createElement('div'),
        control = test.cloneNode(false),
        fake = false,
        root = document.body || (function () {
            fake = true;
            return document.documentElement.appendChild(document.createElement('body'));
        }());

    var oldCssText = root.style.cssText;
    root.style.cssText = 'padding:0;margin:0';
    test.style.cssText = 'position:fixed;top:42px';
    root.appendChild(test);
    root.appendChild(control);

    var ret = test.offsetTop !== control.offsetTop;

    root.removeChild(test);
    root.removeChild(control);
    root.style.cssText = oldCssText;

    if (fake) {
        document.documentElement.removeChild(root);
    }

    /* Uh-oh. iOS would return a false positive here.
     * If it's about to return true, we'll explicitly test for known iOS User Agent strings.
     * "UA Sniffing is bad practice" you say. Agreeable, but sadly this feature has made it to
     * Modernizr's list of undectables, so we're reduced to having to use this. */
    return ret && !Modernizr.appleios;
});


// Modernizr.load loading the right scripts only if you need them
Modernizr.load([
    {
        // Let's see if we need to load selectivizr
        test : Modernizr.borderradius,
        // Modernizr.load loads selectivizr and Respond.js for IE6-8
        nope : [ale.template_dir + '/js/libs/selectivizr.min.js', ale.template_dir + '/js/libs/respond.min.js']
    },{
        test: Modernizr.touch,
        yep:ale.template_dir + '/css/touch.css'
    }
]);



jQuery(function($) {
    var is_single = $('#post').length;
    var posts = $('article.post');
    var is_mobile = parseInt(ale.is_mobile);

    var slider_settings = {
        animation: "slide",
        slideshow: false,
        controlNav: false
    }

    $(document).ajaxComplete(function(){
        try{
            if (!posts.length) {
                return;
            }
            FB.XFBML.parse();
            gapi.plusone.go();
            twttr.widgets.load();
            pin_load();
        }catch(ex){}
    });

    // open external links in new window
    $("a[rel$=external]").each(function(){
        $(this).attr('target', '_blank');
    });

    $.fn.init_posts = function() {
        var init_post = function(data) {
            // close other posts
            data.post.siblings('.open-post').find('a.toggle').trigger('click', {
                hide:true
            });

            var loading = data.post.find('span.loading');

            if (data.more.is(':empty')) {
                data.post.addClass('post-loading');
                loading.css('visibility', 'visible');
                data.more.load(ale.ajax_load_url, {
                    'action':'aletheme_load_post',
                    'id':data.post.data('post-id')
                }, function(){
                    loading.remove();
                    data.more.slideDown(400, function(){
                        data.post.addClass('open-post');
                        data.toggler.text('Close Post');
                        $('.video', data.more).fitVids();
                        if (data.scroll) {
                            data.scroll.scrollTo('fast');
                        }
                    });
                    init_comments(data.post);
                });
            } else {
                data.more.slideDown(400, function(){
                    data.post.addClass('open-post');
                    data.toggler.text('Close Post');
                    if (data.scroll) {
                        data.scroll.scrollTo('fast');
                    }
                });
            }
        }

        var load_post = function(e, _opts) {
            e.preventDefault();
            var data  = {
                toggler:$(this),
                scroll:false
            };
            var opts = $.extend({
                comments:false,
                hide:false,
                add_comment:false
            }, _opts);
            data.post = data.toggler.parents('article.post');
            data.more = data.post.find('.full');

            if (data.more.is(':visible')) {
                if (opts.hide == true) {
                    // quick hide for multiple posts
                    data.more.hide();
                } else {
                    data.more.slideUp(400);
                }
                data.toggler.text('Open Post');
                data.post.removeClass('open-post');
            } else {
                if (typeof(e.originalEvent) != 'undefined' ) {
                    data.scroll = data.post;
                }
                init_post(data);
            }
        }

        var init_comments = function(post) {
            var respond = $('section.respond', post);
            var respond_form = $('form', respond);
            var respond_form_error = $('p.error', respond_form);
            //var respond_cancel = $('.cancel-comment-reply a', respond);
            var comments = $('section.comments', post);

            /*$('a.comment-reply-link', post).on('click', function(e){
             e.preventDefault();
             var comment = $(this).parents('li.comment');
             comment.find('>div').append(respond);
             respond_cancel.show();
             respond.find('input[name=comment_post_ID]').val(post.data('post-id'));
             respond.find('input[name=comment_parent]').val(comment.data('comment-id'));
             respond.find('input:first').focus();
             }).attr('onclick', '');

             respond_cancel.on('click', function(e){
             e.preventDefault();
             comments.after(respond);
             respond.find('input[name=comment_post_ID]').val(post.data('post-id'));
             respond.find('input[name=comment_parent]').val(0);
             $(this).hide();
             });
             */
            respond_form.ajaxForm({
                'beforeSubmit':function(){
                    respond_form_error.text('').hide();
                },
                'success':function(_data){
                    var data = $.parseJSON(_data);
                    if (data.error) {
                        respond_form_error.html(data.msg).slideDown('fast');
                        return;
                    }
                    var comment_parent_id = respond.find('input[name=comment_parent]').val();
                    var _comment = $(data.html);
                    var list;
                    _comment.hide();

                    if (comment_parent_id == 0) {
                        list = comments.find('ol');
                        if (!list.length) {
                            list = $('<ol class="commentlist "></ol>');
                            comments.find('.scrollbox .jspContainer .jspPane').append(list);
                        }
                    } else {
                        list = $('#comment-' + comment_parent_id).parent().find('ul');
                        if (!list.length) {
                            list = $('<ul class="children"></ul>');
                            $('#comment-' + comment_parent_id).parent().append(list);
                        }
                        respond_cancel.trigger('click');
                    }
                    list.append(_comment);
                    _comment.fadeIn('fast');
                    //.scrollTo();

                    respond.find('textarea').clearFields();
                },
                'error':function(response){
                    var error = response.responseText.match(/\<p\>(.*)<\/p\>/)[1];
                    if (typeof(error) == 'undefined') {
                        error = 'Something went wrong. Please reload the page and try again.';
                    }
                    respond_form_error.html(error).slideDown('fast');
                }
            });
        }
        $(this).each(function(){
            var post = $(this);
            // init post galleries
            $(window).load(function(){
                $('.preview .flexslider', post).flexslider(slider_settings);
            });
            // do not init ajax posts & comments for mobile
            if (!is_mobile) {
                // ajax posts enabled
                if (ale.ajax_posts) {
                    $('a.toggle', post).click(load_post);
                    $('.video', post).fitVids();
                    $('.preview figure a', post).click(function(e){
                        e.preventDefault();
                        $(this).parents('article.post').find('a.toggle').trigger('click');
                    });
                }
            }
        });
        // init ajax comments on a single post if ajax comments are enabled
        if (is_single && parseInt(ale.ajax_comments)) {
            init_comments(posts);
        }
        // open single post on page
        if (parseInt(ale.ajax_open_single) && !is_single && posts.length == 1) {
            posts.find('a.toggle').trigger('click');
        }
    }
    posts.init_posts();

    $.fn.init_gallery = function() {
        $(this).each(function(){
            var gallery = $(this);
            $(window).load(function(){
                $('.flexslider', gallery).flexslider(slider_settings);
            });

        })
    }
    $('#gallery').init_gallery();

    $.fn.init_archives = function()
    {
        $(this).each(function(){
            var archives = $(this);
            var year = $('#archives-active-year');
            var months = $('div.months div.year-months', archives);
            var arrows = $('a.up, a.down', archives);
            var activeMonth;
            var current, active;
            var animated = false;
            if (months.length == 1) {
                arrows.remove();
                activeMonth = months.filter(':first').addClass('year-active').show();
                year.text(activeMonth.attr('id').replace(/[^0-9]*/, ''));
                return;
            }
            arrows.click(function(e){
                e.preventDefault();
                if (animated) {
                    return;
                }
                var fn = $(this);
                animated = true;
                arrows.css('visibility', 'visible');
                var current = months.filter('.year-active');
                if (fn.hasClass('up')) {
                    active = current.prev();
                    if (!active.length) {
                        active = months.filter(':last');
                    }
                } else {
                    active = current.next();
                    if (!active.length) {
                        active = months.filter(':first');
                    }
                }
                current.removeClass('year-active').fadeOut(150, function(){
                    active.addClass('year-active').fadeIn(150, function(){
                        animated = false;
                    });
                    year.text(active.attr('id').replace(/[^0-9]*/, ''));

                    if (fn.hasClass('up')) {
                        if (!active.prev().length) {
                            arrows.filter('.up').css('visibility', 'hidden');
                        }
                    } else {
                        if (!active.next().length) {
                            arrows.filter('.down').css('visibility', 'hidden');
                        }
                    }
                });
            });
            activeMonth = months.filter(':first').addClass('year-active').show();
            year.text(activeMonth.attr('id').replace(/[^0-9]*/, ''));
            arrows.filter('.up').css('visibility', 'hidden');
        });
    }
    $('#archives .ale-archives').init_archives();






});

// HTML5 Fallbacks for older browsers
jQuery(function($) {
    // check placeholder browser support
    if (!Modernizr.input.placeholder) {
        // set placeholder values
        $(this).find('[placeholder]').each(function() {
            $(this).val( $(this).attr('placeholder') );
        });

        // focus and blur of placeholders
        $('[placeholder]').focus(function() {
            if ($(this).val() == $(this).attr('placeholder')) {
                $(this).val('');
                $(this).removeClass('placeholder');
            }
        }).blur(function() {
                if ($(this).val() == '' || $(this).val() == $(this).attr('placeholder')) {
                    $(this).val($(this).attr('placeholder'));
                    $(this).addClass('placeholder');
                }
            });

        // remove placeholders on submit
        $('[placeholder]').closest('form').submit(function() {
            $(this).find('[placeholder]').each(function() {
                if ($(this).val() == $(this).attr('placeholder')) {
                    $(this).val('');
                }
            });
        });
    }
});


