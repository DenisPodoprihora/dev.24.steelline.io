<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<script src="<?= SITE_TEMPLATE_PATH . "/script/scriptMap.js" ?>"></script>
<script type="text/javascript">

    ymaps.ready(initMap);


    function initMap() {
        var myPlacemark;
        initIcons(ymaps);



        myMap = new ymaps.Map('map', {
            center: [44.7, 87],
            zoom: 3,
            controls: ["zoomControl"]
        }, {
            searchControlProvider: 'yandex#search'
        }),
                objectManager = new ymaps.ObjectManager({
                    clusterize: true,
                    clusterIconLayout: MyIconContentLayout,
                    geoObjectOpenBalloonOnClick: false,
                    clusterOpenBalloonOnClick: false,
                    clusterDisableClickZoom: false
                });

        objectManager.clusters.options.set('preset', 'cluster#icon');

        myMap.geoObjects.add(objectManager);
        objectManager.add(data);

        objectManager.objects.each(function (object) {
            if (object.isSalon) {
                objectManager.objects.setObjectOptions(object.id, {
                    preset: iconSalon
                });
            } else {
                objectManager.objects.setObjectOptions(object.id, {
                    preset: iconBrand
                });
            }
        });




        objectManager.objects.events.add(['click', 'mouseenter', 'mouseleave'], onObjectEvent);
        objectManager.clusters.events.add(['mouseenter', 'mouseleave'], onClusterEvent);
        objectManager.objects.events.add('balloonclose', onBaloonClose);
        objectManager.objects.events.add('balloonopen', onBaloonOpen);



        myMap.events.add('boundschange', onBoundsChange);

        $(".citySelect").on("change", function () {
            if ($(this).val())
                cityZoom($(this).val());
        })
        $(".block_arrow").on("click", function (e) {
            onDomEvent($(this).attr("data-id"), "click");
        })
        $(".block_arrow").on("mouseenter", function (e) {
            onDomEvent($(this).attr("data-id"), "mouseenter");
        })
        $(".block_arrow").on("mouseleave", function (e) {
            onDomEvent($(this).attr("data-id"), "mouseleave");
        })

	<?if($arParams['COUNTRY']) {?>
	$('.countries_select').find('li:contains("<?=$arParams['COUNTRY']?>")').trigger('click')
	<? } ?>

        
    }


			var unFilterValueRegion = "All regions";
            var unFilterValueCountry = "All countries";
            var Item = {"ID":0};
            $(".js_select_list li").on("click", function() {
                if($(this).hasClass("active")) return;
                var country, region;
                if($(this).closest(".regions_select").length > 0) {
                    region = $(this).text();
                    country = $(".countries_select .active").text();
                } else {
                    country = $(this).text();
                    if(country !== unFilterValueCountry) {
						$(".regions_select li").removeClass("selectable");
						$(".regions_select li:contains('"+unFilterValueRegion+"')").addClass("selectable");

						for(var i in countries) {
							if(i === country) {
								for(var j in countries[i]) {
									$(".regions_select li:contains('"+j+"')").addClass("selectable");
								}
							}
						}
						if($(".regions_select .active.selectable").text()) {
							region = $(".regions_select .active.selectable").text();
						} else {
							region = unFilterValueRegion;
							$(".regions_select li").removeClass("active");
							$(".regions_select .js_selected").text(unFilterValueRegion);
						}
                    } else {
                        $(".regions_select li").addClass("selectable");
						$(".regions_select li").removeClass("active");
						$(".regions_select .js_selected").text(unFilterValueRegion);
						region = unFilterValueRegion;
                    }
                }
                
                selectChange(country, region);
            });
            
            $(function () {
                $('.ajax_map').on('click', function (e) {
                    e.preventDefault();
                    
                    if($('.detail_salon').attr("data-id") !== Item["ID"]) {
                        Item = Items[$(this).attr("data-id")];
                        var html = '<i class="return"></i>';
                        html += '<p class="img"><img src="'+Item["PICTURE"]+'" alt="'+Item["NAME"]+'"></p>';
                        html += '<div class="info">';
                        html += '<h3 class="name">'+Item["NAME"]+'</h3>';
                        html += '<p class="num">Number of doors available for purchase: '+Item["COUNT_IN_STOCK"]+'</p>';
                        html += '<p class="address">'+Item["ADDRESS"]+'</p>';
                        for(var i in Item["PHONES"]) {
                            html += '<span class="phone">'+Item["PHONES"][i]+'</span>';
                        }

                        for(var i in Item["WORK_TIME"]) {
                            html += '<span class="time">'+Item["WORK_TIME"][i]+'</span>';
                        }
						if(Item["CODE"]) {
                        	html += '<a href="'+Item["DETAIL_PAGE_URL"]+'" class="link">Shop page</a>';
						}
                        html += '</div>';
                        $('.detail_salon').html(html);
                        $('.detail_salon').attr("data-id", Item["ID"]);
                        $('.return').on('click', function () {
                            $('.detail_salon').removeClass('show');
                        });
                    }
                    $('.detail_salon').addClass('show');
                });
                
                $('.block_arrow').on('click', function (e) {
                    e.stopPropagation();
                });
                
            });

</script>