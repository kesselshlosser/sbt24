﻿/*
 * Java-скрипты
 */

	/* toTop Button */
	
		$(function() { 
			$(window).scroll(function() { 
			if($(this).scrollTop() != 0) { 
				$('#toTop').fadeIn(); 
					} else {	 
						$('#toTop').fadeOut(); 
					}	 
				}); 
				$('#toTop').click(function() { 
				$('body,html').animate({scrollTop:0},800); 
			}); 
		});
	
	
	/*Fix menu */
	
	$(document).ready(function(){
	        var $menu = $("#main-menu-container");
	        $(window).scroll(function(){
	            if ( $(this).scrollTop() > 100 && $menu.hasClass("default") ){
	                $menu.removeClass("default").addClass("fixed");
	            } else if($(this).scrollTop() <= 100 && $menu.hasClass("fixed")) {
	                $menu.removeClass("fixed").addClass("default");
			}
		});//scroll
	});
	
	/*scroll to anchor */
	$(document).ready(function() {
		$("a.scrolling-links").click(function () {
		  var elementClick = $(this).attr("href");
		  var destination = $(elementClick).offset().top-50;
		  $('html,body').animate( { scrollTop: destination }, 1100 );
		  return false;
		});
	});
	
	/* active-menu-main */
		/*function ActiveLinksMain(id){
			try{
				var el=document.getElementById(id).getElementsByTagName('a');
					var url=document.location.href;
					for(var i=0;i<el.length; i++){
					if (url==el[i].href){
					el[i].className = 'active_menu';
					};
				};
			}
			catch(e){}
			};*/
	
	/* active-menu-catalog */
		/*function ActiveLinksCatalog(id){
			try{
				var el=document.getElementById(id).getElementsByTagName('a');
					var url=document.location.href;
					for(var i=0;i<el.length; i++){
					if (url==el[i].href){
					el[i].className = 'active_menu';
					};
				};
			}
			catch(e){}
			};*/
	
	/* add to cart from goods preview */
		$('.buy-from-preview').click(function () {			
                    $('#cart-price').html(
                            parseInt($('#cart-price').html()) + parseInt($(this.parentNode).find('span').html())
                    );
                    $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
                    Cookies.set('cart-price', parseInt($('#cart-price').html()), { expires: 10 });
                    Cookies.set('cart-quantity', parseInt($('#cart-quantity').html()), { expires: 10 });
                    $.gritter.add({
                        title: 'Товар добавлен:',
                        text: $(this.parentNode).find('h4').html(),
                        image: $(this.parentNode).find('img').attr('src'),
                        sticky: false,
                        position: 'top-right',
                        time: '2000'
                    });
		}) ;
        
        /* add to cart from catalog-view */
		$('.buy-from-catalog-view').click(function () {			
                    $('#cart-price').html(
                            parseInt($('#cart-price').html()) + parseInt($(this.parentNode).find('span').html())
                    );
                    $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
                    Cookies.set('cart-price', parseInt($('#cart-price').html()), { expires: 10 });
                    Cookies.set('cart-quantity', parseInt($('#cart-quantity').html()), { expires: 10 });
                    $.gritter.add({
                        title: 'Товар добавлен:',
                        text: $(this.parentNode.parentNode).find('h3 a').html(),
                        image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'),
                        sticky: false,
                        position: 'top-right',
                        time: '2000'
                    });
		}) ;
        
        /* add to cart from good's view */
		$('.buy-from-view1').click(function () {			
                    $('#cart-price').html(
                        parseInt($('#cart-price').html()) + parseInt($(this.parentNode).find('span').html())
                    );
                    $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
                    var totalSum = 0;
                    $('#cart-table').find('#cart-table-empty-tr').remove();
                    $('#cart-table').find('#cart-table-total-tr').remove();
                    $('#cart-table').append('<tr>');
                    $('#cart-table').append(
                        '<tr>' +
                        '<td class="text-center" width="20%"><img src="' + $(this.parentNode.parentNode.parentNode.parentNode).find('img').attr('src') + '" alt="" class="img-responsive"></td>' +
                        '<td>' + $('h1').html() + $('#goods-id').html() + '</td>' +
                        '<td class="cart-table-price">' + parseInt($(this.parentNode).find('span').html()) + '</td></tr>'
                    );
                    /*var cartGoods = {
                        image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'), 
                        name: $('h1').html(), 
                        price: parseInt($(this.parentNode).find('span').html())
                    };
                    var cartGoodsJSON = JSON.stringify(cartGoods);*/
                    /*if (Cookies.get('cart-goods')) {
                        var goodsInCookies = [];
                        goodsInCookies.push(Cookies.get('cart-goods'));
                        goodsInCookies.push($('h1').html());
                    }*/
                    $('#cart-table').append(
                        '<tr id="cart-table-total-tr">' +
                        '<td></td>' +
                        '<td>Итого:</td>' +
                        '<td class="text-center text-danger"><span id="cart-total"></span></td></tr>'
                    );
                    $('#cart-table').find('.cart-table-price').each(function( ) {
                        var currentSum = $(this).html();
                        totalSum = Number(totalSum) + Number(currentSum);
                        $('#cart-total').html(totalSum);
                    });
                    $('#cart-table-buttons-block').removeClass('hidden');
                    Cookies.set('cart-price', parseInt($('#cart-price').html()), { expires: -1 });
                    Cookies.set('cart-quantity', parseInt($('#cart-quantity').html()), { expires: -1 });
                    
                    /*
                     * алгоритм:
                     * проверяем, есть ли кука
                     * если нет - пишем в нее id и кол-во товара (1)
                     * если есть - читаем куку, и обновляем кол-во товара (+1)
                     * сохранаяем куку
                     */
                    /*var goodsArray = {};
                    var goodsFromCookies;
                    if (!Cookies.get('cart-goods')) {
                        goodsArray = { 
                            id:  $('#goods-id').html(), 
                            count: 1, 
                            price: parseInt($(this.parentNode).find('span').html())
                        };
                    } else {
                        goodsFromCookies = JSON.parse(Cookies.get('cart-goods'));
                        goodsArray = { 
                            id:  $('#goods-id').html(), 
                            count: (goodsFromCookies.count+1),
                            price: parseInt($(this.parentNode).find('span').html())
                        };
                    }
                    Cookies.set('cart-goods', JSON.stringify(goodsArray), { expires: -1 });*/
                    //alert(goodsFromCookies.id + ', ' + goodsFromCookies.count + ', ' + goodsFromCookies.price);
                    
                    /*if (!Cookies.get('sbt24order')) {
                    var orderCookies = RandomString(12);
                        Cookies.set('sbt24order', orderCookies, { expires: -1 });
                    } else {
                        alert(Cookies.get('sbt24order'));
                    };*/
                    
                    /*if (!Cookies.get('sbt24order')) {
                    var orderCookies = RandomString(12);
                        Cookies.set('sbt24order', orderCookies, { expires: -1 });
                    } else {
                        alert(Cookies.get('sbt24order'));
                    };*/
                    
                    /*var company = 'new';
                    $.ajax({
                        url: 'ajax/cart-add-client',
                        type: 'POST',
                        data: { company: company },
                        success: function(res){
                            console.log(res);
                        },
                        error: function(err){
                            alert(err.responseText);
                            console.log(err);
                        }
                    });*/
                    
                    //Cookies.remove('sbt24order');
                    $.gritter.add({
                        title: 'Товар добавлен:',
                        text: $('h1').html(),
                        image: $(this.parentNode.parentNode.parentNode.parentNode.parentNode).find('img').attr('src'),
                        sticky: false,
                        position: 'top-right',
                        time: '2000'
                    });
		}) ;
        
        /* read cart from cookies https://itchief.ru/lessons/javascript/javascript-working-with-cookies */
                /*$(document).ready(function () {
                    if (Cookies.get('cart-quantity')) {
                        $('#cart-price').html(parseInt(Cookies.get('cart-price')));
                        $('#cart-quantity').html(parseInt(Cookies.get('cart-quantity')));
                    } else {
                        $('#cart-price').html('0.00');
                        $('#cart-quantity').html(parseInt(0));
                    }
                });*/
	
        /* swiper slider on main page */
        $(document).ready(function () {
            //initialize swiper when document ready
            var mySwiper = new Swiper ('.swiper-container', {
            // Optional parameters
            autoplay: {
                delay: 5000,
                },
            pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    //type: 'progressbar',
                    bulletElement: 'span',
                    bulletClass: 'swiper-pagination-bullets',
                    bulletActiveClass: 'swiper-pagination-bullet-active',
                    clickable: true
                },
            navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            mousewheel: {
                invert: true,
                },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
                },
            coverflowEffect: {
                rotate: 30,
                slideShadows: false,
                },
            loop: true
            })
        });
	
        /* active menu */
	    $(function () {
            var location = window.location.href;
            var cur_url = '/sbt24/' + location.split('/').pop();    // !!!убрать '/sbt24/' заменить на '/'

            $('#main-menu ul li').each(function () {
                var link = $(this).find('a').attr('href');
                
                if (cur_url == link) {
                    $(this).find('a').addClass('active_menu');
                }
            });
        });
        
        /* preview i chevron change */
	    $(function () {
            $('.preview').on('click', function(){
                if ($(this).find('i').hasClass('fa-chevron-down')) {
                    $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
                } else {
                    $(this).find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                }
            });
        });
        
        // randomize file name
        function RandomString(length) {
            var str = '';
            for ( ; str.length < length; str += Math.random().toString(36).substr(2) );
            return str.substr(0, length);
        }(20);
        
        // admin/category: toggle category
        $('.category-level-0').find('li').on('click', '.has-subcat', function (e) {
            e.preventDefault();
            $(this.parentNode.parentNode.parentNode).find('.category-level-1').toggle();
            var folder = $(this.parentNode).find('i');
            if(folder.hasClass('fa-folder-open')) {
                folder.removeClass('fa-folder-open').addClass('fa-folder');
            } else {
                
                folder.removeClass('fa-folder').addClass('fa-folder-open');
            }
        });

        // admin/category:  toggle category on DOM load
        $(function () {
            $('.category-level-1').toggle();
        });


        // admin/category: delete category
        $('.admin-categories-list').on('click', '.fa-close', function () { 
            alert($(this.parentNode).text());
        });

        // admin/goods: category filter block
        $('.category-filter-block').find('.btn-group a').click(function () {
            $('.category-filter-block').find('.btn-group a').each(function () {
                $(this).removeClass('active');
            });
                var filterCat = $(this).attr('category');
                $(this).addClass('active');
                var counter = 1;
            $('.tovar-block').each(function () {
                var cat = $(this).attr('category');
                $(this).addClass('hidden');
                if(cat){
                    if(filterCat == 0){
                        $(this).removeClass('hidden');
                    } else {
                        if (filterCat == cat) {
                            $(this).removeClass('hidden');
                        }
                    }
                    if(!$(this).hasClass('hidden')) {
                        $(this).find('.tovar-counter').html(counter);
                        counter++;
                    }
                }
                var cursUsd = $('#curs-usd').html();
                var cursEur = $('#curs-eur').html();
                var rub = $(this).find('.tovar-price-rub').html();
                var usd = parseFloat($(this).find('.tovar-price-usd').html()) * parseFloat(cursUsd);
                var eur = parseFloat($(this).find('.tovar-price-eur').html()) * parseFloat(cursEur);
                
                if(rub == 0) {
                    $(this).find('.tovar-price-rub').html(parseFloat(rub) + parseFloat(usd) + parseFloat(eur));
                }
            });
        });
        
        // admin/goods: category filter block on DOM load
        $(function () {
            $('.category-filter-block').find('.btn-group .active').click();
        });

        // admin/goods: build category-pagination-block and page attr for .tovar-block
        function buildPagination(pageSize) {
            $('.category-pagination-block .btn-group').find('button').each(function() {
                $(this).remove();
            });
            $('<button>', {
                html: '1',
                id: 'btn-pagination-block-1',
                class: 'btn btn-default active',
                click: function() {
                    var page = $(this).html();
                    
                    $('.category-pagination-block').find('.btn-group button').each(function () {
                        $(this).removeClass('active');
                    });

                    $(this).addClass('active');

                    $('.tovar-block').each(function () {
                        $(this).hide();
                        if($(this).attr('page') == page) {
                            $(this).show();
                        }
                    });
                }
            }).appendTo('.category-pagination-block .btn-group');

            //var pageSize = $('#select-pages-count').val();       // change pagination page size here!
            var page = 1;           // current page number
            var goodsCounter = 0;   // counter for all goods
            var first = 1;          // first good number in range
            var last = (Number(first) + Number(pageSize) - 1);    // last good number in range
            
            $('.tovar-block').each(function () {
                if (goodsCounter == last) {
                    first = last;
                    last = (Number(first) + Number(pageSize)); 
                    page++;
                }
                $(this).attr('page', page);
                goodsCounter++;
            });

            for(var i=1; i<page; i++) {
                $('<button>', {
                    html: (i+1),
                    class: 'btn btn-default',
                    click: function() {    
                        var page = $(this).html();
                        
                        $('.category-pagination-block').find('.btn-group button').each(function () {
                            $(this).removeClass('active');
                        });
    
                        $(this).addClass('active');
                        
    
                        $('.tovar-block').each(function () {
                            $(this).hide();
                            if($(this).attr('page') == page) {
                                $(this).show();
                            }
                        });
                    }
                }).appendTo('.category-pagination-block .btn-group');
            }
        }
        // admin/goods: show category-pagination-block
        $(function () {
            buildPagination($('#select-pages-count').val());
        });
        
        $('#select-pages-count').change(function () {
            buildPagination($(this).val());
            $('.category-pagination-block').find('.btn-group .active').click();
        });


        // admin/goods: category-pagination-block click on button
        /*$('.category-pagination-block1').find('.btn-group button').click(function () {
            
            var page = $(this).html();
            alert( $(this).attr('page'));
            $('.category-pagination-block').find('.btn-group button').each(function () {
                $(this).removeClass('active');
            });

            $(this).addClass('active');
            

            $('.tovar-block').each(function () {
                $(this).hide();
                if($(this).attr('page') == page) {
                    $(this).show();
                }
            });

        });*/

        $(function () {
            $('#btn-pagination-block-1').click();
        });

        // admin/goods: search goods
        /*$('#search-goods-input').on('keyup', function() {
            var input = $(this).val();
            $('.tovar-block').each(function () {
                $(this).find('.tovar-name-block a').filter(input);
            });
        });*/

        // admin: image click delegation on id
        function imgLoad(id){
            document.getElementById(id).click();
        }

        // admin: download image function
        function previewImage(imgId, fileId, fileNameId) {  
            // создаем переменные для картинки и файла из input
            var preview = document.getElementById(imgId);
            var file    = document.getElementById(fileId).files[0];
            var reader  = new FileReader();
            reader.onloadend = function () {
                preview.src = reader.result;
                // file name generetion
                function RandomString(length) {    
                    var str = '';
                    for ( ; str.length < length; 
                        str += Math.random().toString(36).substr(2) );
                    return str.substr(0, length);
                }(20);
                // get file extantion
                var ext = file.name.substring(file.name.lastIndexOf('.'));
                document.getElementById(fileNameId).value = RandomString(20) + ext;
            }
            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "images/image.png";
            }
        }
        
        // admin/banners: load image on button '#btn-load-image' click
        $(function () {
            $('#btn-load-image').click(function() {
                imgLoad('input-load-image');
            });
        });

        // admin/banners: load image on banner '#banner-image' click
        $(function () {
            $('#banner-image').click(function() {
                imgLoad('input-load-image');
            });
        });

        // admin/banners/category: load image on banner '#banner-image' click
        //$(function () {
            $('#input-load-image').change(function() {
                previewImage('banner-image','input-load-image','input-image-file');
            });
        //});

        // admin/banners: select help text on change
        $('#select-banner-position').change(function() {          
            var key = $(this).val();
            var text = '';            
            switch (key) {
                case '0':
                    text = 'Выберите позицию из списка';
                    break;
                case '1':
                    text = 'Слайдер на главной странице состоит из одного или нескольких слайдов.<br> Размер всех картинок для слайдера должен быть одинаковым, оптимально: 900х380px';
                    break;           
                case '2':
                    text = 'Баннер на главной странице между блоками Новые товары и Хиты продаж. Баннер должен быть горизонтальным, оптимальный размер 900х380px';
                    break;             
                case '3':
                    text = 'Баннер в каталоге выводится в разделах каталога. Баннер должен быть горизонтальным, оптимальный размер 900х240px';
                    break;
                case '4':
                    text = 'Баннер в левом меню, можно добавлять несколько баннеров  в позицию, выводятся в случайном порядке по  2 шт. Оптимальный размер 400х300px';
                    break;
                default:
                    text = 'Выберите позицию из списка';
                    break;
            }
            $('#position-comment').html( text );
        });

        
        $(function () {
            $('#select-banner-position').change();
        });

        /*$('.goods-view-block').find('form').on('beforeValidate', function(event) {
            alert('beforeValidate');
            event.preventDefault();
            $('#cart-price').html(
                            parseInt($('#cart-price').html()) + parseInt($(this.parentNode).find('span').html())
                    );
            $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
            Cookies.set('cart-price', parseInt($('#cart-price').html()), { expires: 10 });
            Cookies.set('cart-quantity', parseInt($('#cart-quantity').html()), { expires: 10 });
            $.gritter.add({
                title: 'Товар добавлен:',
                text: $('h1').html(),
                image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'),
                sticky: false,
                position: 'top-right',
                time: '2000'
            });
            return false;
        });*/
        
        /*$('.goods-view-block').find('form').on('submit', function(event) {
            event.preventDefault();
            alert($(this).html());
            $('#cart-price').html(
                            parseInt($('#cart-price').html()) + parseInt($(this.parentNode).find('span').html())
                    );
            $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
            Cookies.set('cart-price', parseInt($('#cart-price').html()), { expires: 10 });
            Cookies.set('cart-quantity', parseInt($('#cart-quantity').html()), { expires: 10 });
            $.gritter.add({
                title: 'Товар добавлен:',
                text: $('h1').html(),
                image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'),
                sticky: false,
                position: 'top-right',
                time: '2000'
            });
            $('.goods-view-block').find('form').reset();
            $.pjax.reload({container: $(this)});
            return true;
        });*/
        