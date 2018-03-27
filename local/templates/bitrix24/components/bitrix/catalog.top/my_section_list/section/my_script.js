$(document).ready(function() {
    $('.mm-page .tab-pane .webform-small-button-text').click(function() {
        var price = parseFloat($(this).parent('span').parent('div').siblings('div[data-entity="props-block"]').find('dd').text()),
            count = parseInt($(this).parent('span').siblings('.fields.string').find('input').val());

        var items_count = 0,
            cur_id = $(this).attr('id');

        $('#result-panel .product-item').each(function() {
            if ($(this).hasClass(cur_id)) items_count++;
        });
        if ($('#result-panel .empty-basket').css('display') == 'block') {
            $('#result-panel .empty-basket').css('display', 'none');
            $('.mm-page #pull_product_in_basket').css('background', '#cd0019');
            $('.mm-page #pull_product_in_basket').css('pointer-events', 'all');
        }
        if (items_count == 0)
            $('#result-panel .panel-body').append(
                "<div class=\"product-item " + cur_id + "\">" +
                "<div class=\"product-preview\"><a class=\"product-item-image-wrapper\" data-entity=\"image-wrapper\">" +
                $(this).parent('span').parent('div').siblings('a').html() +
                "</a></div>" +
                "<div class=\"product-descr\">" +
                "<div class=\"product-name\">" +
                $(this).parent('span').parent('div').siblings('.product-item-title').text() +
                "</div>" +
                "<div class=\"fields string\">" +
                "<input type=\"text\" onblur=\"checkNull($(this))\" onkeyup=\"checkSum($(this))\" onkeypress=\"checkKeyCode($(this), event)\" name=\"count_product\" value=\"" +
                count +
                "\" size=\"20\" class=\"fields string\">" +
                "</div>" +
                "<div class=\"product-single-price\">" +
                "<div class=\"price-title\">Стоимость за ед.:</div>" +
                "<span>" + $(this).parent('span').parent('div').siblings('div[data-entity="props-block"]').find('dd').text() + "</span>" +
                "</div>" +
                "<div class=\"product-result-price\">" +
                "<div class=\"price-title\">Общая стоимость:</div>" +
                "<span>" + price * count + " руб." + "</span>" +
                "</div></div>" +
                "<span class=\"product-del\" onclick=\"del_from_cart(" + $(this).attr('id') + ")\";\"></span></div>"
            );
        $(this).parent('span').siblings('.fields.string').find('input').val('1');
        $('.order-result span').text('0');
        $('#result-panel .product-item').each(function() {
            $('.order-result span').text((parseFloat($('.order-result span').text()) + parseFloat($(this).find('.product-result-price span').text())) + " руб.");
        });
    });



    var Products_id = [], Product = [], json_str;
    $('#result-panel .webform-small-button-text').click(function() {
        console.clear();
        Products_id = [];
        $('#result-panel .product-item').each(function() {
            Product = [];
            Product.id = $(this).attr('class').replace('product-item ', '');
            Product.count =  $(this).find('.fields.string input').val();
            Products_id.push(Product);
        });
        json_str = "{ ";
        for (var key in Products_id) {
            if (Products_id.hasOwnProperty(key)) {
                if (key > 0) json_str += ", ";
                json_str += "\"" + Products_id[key]["id"] + "\": \"" + Products_id[key]["count"] + "\" ";
            }
        }
        json_str += " }";

        if (Products_id.length != 0) pushProduct();
        else alert('Корзина пуста!');
        $('#result-panel .product-item').each(function() {
            $(this).remove();
            $('.order-result span').text('0 руб.');
        });
    });

    $('.mm-page #result-panel .fields.string input').focusout(function() {
        alert('asdf');
        if ($(this).val() == "") $(this).val('1');
    });

    function pushProduct(){
       // console.log(Products_id);
        $.ajax({
            url: "/ajax.handler.php",
            type: "POST",

            data:{ "PAGE": "MARKETING",  "jsonData": json_str},
            success: function(data){
                $('#result-panel .empty-basket').css('display', 'block');
                $('.mm-page #pull_product_in_basket').css('background', '#e45b6b');
                $('.mm-page #pull_product_in_basket').css('pointer-events', 'none');
                $('#result-panel .empty-basket').html(
                    "Набор товаров успешно добавлен." + "<a href=\"/crm/product/show/" + data + "/?list_section_id=0\"><br/>Номер заказа: " + data + "</a>"
                );
            }
        });
    }
    JSON.stringify(Products_id, function (key, value) {
        return value;
    });
});

    function del_from_cart(id) {
        $('.order-result span').text((parseFloat($('.order-result span').text()) - parseFloat($('#result-panel .' + id + ' .product-result-price span').text())) + " руб.");
        $('#result-panel .' + id).remove();
        var items_count = 0;
        $('#result-panel .product-item').each(function() {
            if ($(this).hasClass(cur_id)) items_count++;
        });
        if (items_count == 0) {
            $('#result-panel .empty-basket').css('display', 'block');
            $('.mm-page #pull_product_in_basket').css('background', '#e45b6b');
            $('.mm-page #pull_product_in_basket').css('pointer-events', 'none');
        }
    }
