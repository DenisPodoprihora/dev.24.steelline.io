function yaRequest(param) {
	if(typeof(yaCounter36412445)  == "undefined") {
		return;
	}

    yaCounter36412445.reachGoal(param);
}
$(function () {

    $("[data-yandex='collection_button']").on("click", function(){
        yaRequest($(this).attr("data-yandex"));
    });
    $("[data-yandex='question_button']").on("click", function(){
        yaRequest($(this).attr("data-yandex"));
    })
    //$('input[data-valid="phone"]').mask("9999-999-99-99");

    //------------------ UI handlers ------------------------

    $('.scrollTop').click(function () {
        var sec = $(document).scrollTop() / 4;
        $('html, body').animate({scrollTop: 0}, sec);
        return false;
    });

    $('.js_cart').each(function () {
        switcher($(this));
    });

    $('.js_tabs').each(function () {
        tabs($(this));
    });

    $('.js_input').each(function () {
        input($(this));
    });

    if ($('.js_select').length) {
        $('.js_select').each(function () {
            select_list($(this));
        });
        $(document).click(function (e) {
            if ($(e.target).closest(".js_select").length)
                return;
            $(".js_select_list").hide();
        });
    };

    $('[data-scroll]').click(function (e) {
        e.preventDefault();
        var end_top = $($(this).attr('data-scroll')).offset().top,
            time = Math.abs(end_top - $(this).offset().top) * 0.1 + 200;

        $('html, body').animate({
            scrollTop: end_top - 100
        }, time);
    });

    $(".our_like").on("click", function(e){onLike(e)})
    $(".collections input[type='checkbox']").on("change", function(){
        if($(this).prop("checked")) {
            if($(this).val() == "all") {
                unfilterAll();
            } else {
                $(".collections .all input[type='checkbox']").prop("checked", false);
                $(".collections .all label").removeClass("active");
            }
            $(this).closest("label").addClass("active");
        } else {
            $(this).closest("label").removeClass("active");
        }

        filterCollection();
    })

    //----------------------   --------------------------------

}); // end document ready

function onLike(e) {
        $(".our_like").unbind("click");
        var id = $(e.target).attr("data-id");
        var cnt = $(e.target).closest(".like_but").find(".count");
        var count_likes = cnt.text() ? parseInt(cnt.text()) : 0 ;
        
        var data = {"id" : id};
        if(liked[id] === "0" || !liked[id]) {
            liked[id] = "1";
            $(e.target).closest(".like_but").addClass("liked");
            cnt.text(count_likes + 1);
        } else {
            liked[id] = "0";
            cnt.text(count_likes - 1);
            $(e.target).closest(".like_but").removeClass("liked");
            data["minus"] = 1;
        }
        
        $.ajax({
            url : "/request/ajax/like.php",
            data : data,
            type: "post",
            success : function(res) {
                localStorage.setItem("liked", JSON.stringify(liked));
                $(".our_like").on("click", function(e){onLike(e)});
            }
        })
    }

var liked = localStorage.getItem("liked") ? JSON.parse(localStorage.getItem("liked")) : {};

function Validator() {
    var params = [
        'js_validate',
        'data-valid',
        'data-valid-min',
        'js_class_valid',
        'js_invalid_animate',
        'error',
        'ok'
    ],
            forms = $('.' + params[0]),
            fields = forms.find('[' + params[1] + ']'),
            animate_stopper = true,
            regulars = {
                name: /^[A-Za-zА-Яа-яЁё_-\s]+$/,
                phone: /^(\+375){1}(\s){1}(\(){1}(\d){2}(\)){1}(\s){1}(\d){3}(\-){1}(\d){2}(\-){1}(\d){2}$/,
                email: /^([a-zA-ZА-Яа-яЁё0-9_-]+\.)*[a-zA-ZА-Яа-яЁё0-9_-]+@[a-zA-ZА-Яа-яЁё0-9_-]+(\.[a-zA-ZА-Яа-яЁё0-9_-]+)*\.[a-zA-ZА-Яа-яЁё]{2,6}$/,
                number: /^\d+$/
            };

    function worker(exp, field_wrap) {
        field_wrap.removeClass(params[5]);
        exp ?
                field_wrap.removeClass(params[6]).addClass(params[5]) :
                field_wrap.addClass(params[6]);
    };

    function check_reg(field) {
        var field_wrap, min;

        field.attr(params[2]) ?
                min = (field.val().length < field.attr(params[2])) : min = false;

        field.hasClass(params[3]) ?
                field_wrap = field : field_wrap = field.closest('.' + params[3]);

        switch (field.attr(params[1])) {
            case 'name':
                worker(min || !regulars.name.test(field.val()), field_wrap);
                break;
            case 'phone':
                worker(min || !regulars.phone.test(field.val()), field_wrap);
                break;
            case 'email':
                worker(min || !regulars.email.test(field.val()), field_wrap);
                break;
            case 'number':
                worker(min || !regulars.number.test(field.val()), field_wrap);
                break;
            case 'all':
                worker(min, field_wrap);
                break;
        }
    };

    function validate(form) {
        var input = form.find('.' + params[3]),
                submit = true;

        input.each(function () {
            if ($(this).hasClass(params[5])) {
                return submit = false;
            }
        });

        if (form.hasClass(params[4]) && animate_stopper) {
            animate_stopper = false;
            input.each(function () {
                if ($(this).hasClass(params[5])) {
                    $(this)
                            .animate({left: "-12px"}, 100).animate({left: "12px"}, 100)
                            .animate({left: "-10px"}, 100).animate({left: "8px"}, 100)
                            .animate({left: "-6px"}, 100).animate({left: "0px"}, 100, function () {
                        animate_stopper = true;
                    });
                }
            });
        };

        return submit;
    };

    fields.on('keyup', function () {
        check_reg($(this));
    });

    fields.on('change', function () {
        check_reg($(this));
    });

    forms.on('submit', function (e) {
        $(this).find('[' + params[1] + ']').each(function () {
            check_reg($(this));
        });
        if($(this).hasClass("ajax-form")) {
            e.preventDefault();
            var returnVal = validate($(this))
            if(returnVal) {
                ajaxFormHandler($(this));
                return returnVal;
            }
            
        }
        return validate($(this));
    })
};

function input(parent) {
    var input = parent.find('input[type="text"]');

    input.on('focus', function () {
        parent.addClass('focus');
    });
    input.on('blur', function () {
        if (!input.val()) {
            parent.removeClass('focus');
        }
    });
};

function search_res() {
    var parent = $('.js_search_result'),
        res = parent.find('.js_link'),
        form = parent.find('form'),
        reset = parent.find('.js_reset'),
        input = parent.find('input[type="text"]');


    res.eq(0).addClass('hover');
    $('.search_btn').on('click', function () {
        input.focus();
    })
    reset.on('click', function () {
        input.val('').change();
        input.focus();
    })
     
};

function Popup() {

    $("body").wrapInner('<div class="blur_wrap none"></div>');

    var blur = $('.blur_wrap'),
            Obj = this;

    $('.js_popup').each(function () {
        blur.after($(this));
    });
    blur.after($('.fade'));

    this.open_pop = function (tgt) {
        $(tgt.attr('data-open')).show();
        setTimeout(function () {
            $(tgt.attr('data-open')).addClass('opened');
        }, 4)
        $('.fade').show();
        blur.removeClass('none');
        $('body').css('overflow','hidden');
        
    };

    this.close_pop = function () {
        $('.js_popup').removeClass('opened');
        setTimeout(function () {
            $('.js_popup').hide();
        }, 200);
        $('.fade').fadeOut(200);
        blur.addClass('none');
        $('body').css('overflow','auto');
       
    };

    $('[data-open]').on('click', function () {
        Obj.open_pop($(this));
    });

    $('.close_popup,.close,.fade').on('click', function () {
        Obj.close_pop();
    })

    $(document).keydown(function (e) {
        if (e.keyCode == 27) {
            Obj.close_pop();
        }
    });
};

function Tooltip() {
    var Obj = this,
            inf = $('.js_inf');

    this.show = function (tgt) {
        var tool = tgt.find('.js_tooltip');

        if (tgt.hasClass('show')) {
            Obj.hide(tgt);
        } else {
            inf.each(function () {
                $(this).removeClass('show').find('.js_tooltip').removeClass('opened').fadeOut(150);
            });
            tool.show();
            setTimeout(function () {
                tool.addClass('opened');
                tgt.addClass('show');
            }, 4);
        }
    };

    this.hide = function (tgt) {
        var tool = tgt.find('.js_tooltip');
        tool.removeClass('opened');
        setTimeout(function () {
            tool.hide();
            tgt.removeClass('show');
        }, 150);
    };

    inf.find('.icon').on('click', function () {
        Obj.show($(this).closest('.js_inf'));
    });

    $(document).click(function (e) {
        if ($(e.target).closest(".js_inf").length) {
            return;
        }
        inf.each(function () {
            Obj.hide($(this));
        });
    });
};

function switcher_item() {
    var parent = $('.js_item'),
            ui = parent.find('.js_switch'),
            imgs = parent.find('.js_item_img img'),
            props = parent.find('.js_props'),
            art = parent.find('.js_art');

    ui.eq(0).addClass('curr');
    if(ui.length==1) {
        parent.find('.galery').hide();
    };
    imgs.each(function (i) {
        var mini = ui.eq(0).find('img').eq(i);
        $(this).attr({
            'src': mini.attr('data-big'),
            'data-zoom-image': mini.attr('data-big')
        });
    });
    props.each(function (i) {
        $(this).text(ui.eq(0).find('img').eq(i).attr('data-props'));
    });
    art.text(ui.eq(0).attr('data-art'));

    ui.on('click', function () {
        if (!$(this).hasClass('curr')) {
            var self = $(this).find('img');

            ui.removeClass('curr');
            $(this).addClass('curr');
            imgs.each(function (i) {
                $(this).attr({
                    'src': self.eq(i).attr('data-big'),
                    'data-zoom-image': self.eq(i).attr('data-big')
                });
                if (!device.mobile()&&!device.ios()) {
                    $('.zoom_zoom').eq(i).data('elevateZoom')
                            .swaptheimage(self.eq(i).attr('data-big'), self.eq(i).attr('data-big'));
                };
            });

            props.each(function (i) {
                $(this).text(self.eq(i).attr('data-props'))
            });
            art.text($(this).attr('data-art'));

        };
    })

};

function switcher(parent) {

    var tgt = parent.find('.js_switch');
    tgt.unbind('click');
    tgt.on('click', function () {
        if (!$(this).hasClass('curr')) {
            var imgs = parent.find('.js_cart_img img'),
                    self = $(this).find('img');

            tgt.removeClass('curr');
            $(this).addClass('curr');
            imgs.each(function (i) {
                $(this).attr('src', self.eq(i).attr('src'));
            });
        };
    });

};

function fast_tabs(parent) {

    var tab = parent.find('.js_tab'),
            table = parent.find('.js_table');

    tab.on('click', function () {
        parent.find('[data-bind]').removeClass('curr');
        parent.find('[data-bind="' + $(this).attr('data-bind') + '"]').addClass('curr');
    })

};

function tabs(parent) {

    var img = parent.find('.js_img'),
            tab = parent.find('.js_tab'),
            text = parent.find('.js_text');

    img.eq(0).show();
    tab.eq(0).addClass('curr').next().slideDown();

    tab.on('click', function () {
        if (!$(this).hasClass('curr')) {
            tab.removeClass('curr');
            text.slideUp(200);
            $(this).addClass('curr').next().slideDown(200);
            img.hide();
            parent.find('[data-bind="' + $(this).attr('data-bind') + '"]').show();
        }
    });

};


function select_list(parent) {

    var placeholder = parent.attr('data-placeholder'),
            selected = parent.find('.js_selected'),
            list = parent.find('.js_select_list'),
            li = list.find('li'),
            all_list = $('.js_select_list');

    if (!list.find('.active').length) {
        selected.text(placeholder).addClass('default');
    } else {
        selected.text(list.find('.active').text());
    }
    ;

    selected.on('click', function () {
        all_list.hide();
        list.fadeIn(100);
    });

    li.on('click', function () {
        var str = '';
        if ($(this).text().length > 21) {
            str = $(this).text().substr(0, 18) + '...';
        } else {
            str = $(this).text();
        }
        selected.removeClass('default').text(str);
        li.removeClass('active');
        list.hide();
        $(this).addClass('active');
    });

};


function fix_nav() {

    var top = $(document).scrollTop(),
            fix = $('.js_fix_nav'),
            side = $('.js_side'),
            point = $('header').height(),
            dop_point = $('header').height() + fix.height(),
            dop_fix = $('.js_fix_coll');

    if (fix.find('.active').length) {
        fix.find('.active').eq(0)
                .closest('.js_side').addClass('open');
    } else {
        side.removeClass('open');
    }
    ;

    if (dop_fix.length) {
        top >= dop_point ? dop_fix.addClass('fix') : dop_fix.removeClass('fix');
    } else {
        top >= point ? fix.addClass('fix') : fix.removeClass('fix');
    }

    $(document).on('scroll',function () {
        top = $(document).scrollTop();
        if (dop_fix.length) {
            top >= dop_point ? dop_fix.addClass('fix') : dop_fix.removeClass('fix');
        } else {
            top >= point ? fix.addClass('fix') : fix.removeClass('fix');
        }
    });

};

function fix_nav_single(p,stop) {
    //$(document).unbind('scroll');
    var top = $(document).scrollTop(),
            fix = $('.js_fix_nav_single'),
            point;

    p ? point = p : point = $('header').height();

    if(stop) {
        top >= point && top <= stop ? fix.addClass('fix') : fix.removeClass('fix');
    } else {
        top >= point ? fix.addClass('fix') : fix.removeClass('fix');
    }

    $(document).on('scroll',function () {
        top = $(document).scrollTop();
        if(stop) {
            top >= point && top <= stop ? fix.addClass('fix') : fix.removeClass('fix');
        } else {
            top >= point ? fix.addClass('fix') : fix.removeClass('fix');
        }
    });

};


function row_slider(params) {

    var parent = params.parent_query,
        li_width = params.width_element_with_margin,
        li_visible = params.number_of_visible_elements,
        speed = params.speed_of_motion,
        carret = parent.find('.js_carret'),
        li = carret.find('.js_li'),
        next = parent.find('.js_next'),
        prev = parent.find('.js_prev'),
        state = 0,
        go = true,
        x = 0;

    //init
    carret.css('width', li.length * li_width);
    prev.addClass('disabled');
    if (li.length <= li_visible) {
        next.addClass('disabled');
        return;
    };

    next.on('click', function () {
        if (go) {
            var rest = li.length - state - li_visible;
            go = false;
            prev.removeClass('disabled');
            if (rest <= li_visible) {
                x = rest * li_width;
                state += rest;
                next.addClass('disabled');
            } else {
                x = li_visible * li_width;
                state += li_visible;
            }
            ;
            carret.animate({'margin-left': '-=' + x + 'px'}, (x * 0.4 + 200),
                    function () {
                        go = true
                    });
        };
    });

    prev.on('click', function () {
        if (go) {
            go = false;
            next.removeClass('disabled');
            if (state <= li_visible) {
                x = state * li_width;
                state = 0;
                prev.addClass('disabled');
            } else {
                x = li_visible * li_width;
                state -= li_visible;
            }
            ;
            carret.animate({'margin-left': '+=' + x + 'px'}, (x * 0.4 + 200),
                    function () {
                        go = true
                    });
        };
    });
};

function open_box() {

    var box = $('.js_slider'),
            slide = box.find('.js_slide'),
            galery = $('.js_item .js_switch img'),
            num = $('.js_item .js_switch').length,
            trigger = $('.js_item_img img'),
            opened = false;

    for (var i = 1; i < num; i++) {
        box.append(slide.clone());
    };

    var damm = new DammSlider({
        query: box,
        start_slide: 0,
        speed: 500,
        offsetTop: 0,
        min_height: 0
    });

    trigger.on('click', function () {
        if (!opened) {
            opened = true;
            galery.each(function (i) {
                box.find('img').eq(i).attr('src', $(this).attr('data-big'));
            });
        };
        damm.setStart($('.js_switch.curr').attr('data-number'));
        box.fadeIn(150);
        $('body').css('overflow','hidden');
    });

    $(document).keydown(function (e) {
        if (e.keyCode == 27) {
            box.fadeOut(150);
            $('body').css('overflow','auto');
        }
    });
}
;

var DammSlider = function (param) {

    var delta = param.offsetTop,
        delta_left = param.query.width() + 'px',
        pos_default = {'top': '-2000px', 'left': '0'},
        pos_left = {'top': '0', 'left': '-' + delta_left},
        pos_right = {'top': '0', 'left': delta_left},
        pos_curr = {'top': '0', 'left': '0'},
        slide = param.query.find('.js_slide'),
        curr = param.start_slide,
        ctrl = param.query.find('.js_control'),
        nav = param.query.find('.js_navigation'),
        trigger = true,
        Obj = this;

    this.setStart = function (n) {
        curr = +n;
        slide.css(pos_default).eq(n).css(pos_curr);
    };

    this.init = function () {
        if ($(window).height() > param.min_height) {
            param.query.css('height', $(window).height() - delta + 'px');
        } else {
            param.query.css('height', param.min_height - delta + 'px');
        };
        if (param.min_height === 0) {
            param.query.css('height', '100%');
        };
        if (!nav.find('li').length) {
            for (var i = 0; i < slide.length; i++) {
                $('<li></li>').appendTo(nav);
            };
        };
        nav.find('li').each(function (i) {
            $(this).attr('data-num', i);
        });
        nav.find('li').eq(curr).addClass('curr');
        Obj.setStart(curr);
        if (slide.length == 1) {
            ctrl.hide();
        }
    };

    function move(curr_slide, next_slide, invert) {
        if (trigger) {
            trigger = false;
            if (invert) {
                if (curr_slide > next_slide) {
                    slide.eq(next_slide).css(pos_right).animate({left: '0'}, param.speed);
                    slide.eq(curr_slide).animate({left: '-' + delta_left}, param.speed, function () {
                        trigger = true;
                    });
                } else {
                    slide.eq(next_slide).css(pos_left).animate({left: '0'}, param.speed);
                    slide.eq(curr_slide).animate({left: delta_left}, param.speed, function () {
                        trigger = true;
                    });
                }
                ;
                curr = next_slide;
            } else {
                if (curr_slide < next_slide) {
                    slide.eq(next_slide).css(pos_right).animate({left: '0'}, param.speed);
                    slide.eq(curr_slide).animate({left: '-' + delta_left}, param.speed, function () {
                        trigger = true;
                    });
                } else {
                    slide.eq(next_slide).css(pos_left).animate({left: '0'}, param.speed);
                    slide.eq(curr_slide).animate({left: delta_left}, param.speed, function () {
                        trigger = true;
                    });
                }
                ;
                curr = next_slide;
            }
            return true;
        }
        return false;
    }
    ;

    Obj.init();

    $(window).resize(function () {
        if ($(window).height() > param.min_height&& param.min_height!==0) {
            console.log( param.min_height);
            //param.query.css('height', $(window).height() - delta + 'px');
            //pos_default = {'top': '-' + $(window).height() - delta + 'px', 'left': '0'},
            pos_left = {'top': '0', 'left': '-' + $(document).width() + 'px'},
            pos_right = {'top': '0', 'left': $(document).width() + 'px'},
            slide.css(pos_default).eq(curr).css(pos_curr);
        }
    })

    nav.find('li').on('click', function () {
        if ($(this).hasClass('curr'))
            return;
        if (move(curr, parseInt($(this).attr('data-num')))) {
            nav.find('li').removeClass('curr');
            $(this).addClass('curr');
        };
    });

    function controller(type) {
        var go;
        if (slide.length > 1) {
            if (type) {
                if (curr == slide.length - 1) {
                    var next = 0;
                    go = move(curr, next, true);
                } else {
                    var next = curr + 1;
                    go = move(curr, next, false);
                }
            } else {
                if (curr == 0) {
                    var next = slide.length - 1;
                    go = move(curr, next, true);
                } else {
                    var next = curr - 1;
                    go = move(curr, next, false);
                }
            }
            ;
            if (go) {
                nav.find('li').removeClass('curr');
                nav.find('[data-num="' + next + '"]').addClass('curr');
            }
        }
    }
    ;

    ctrl.on('click', function () {
        if ($(this).hasClass('next')) {
            controller(true);
        } else {
            controller();
        }
    });

    $(document).keydown(function (e) {
        if (e.keyCode == 39) {
            controller(true);
        } else if (e.keyCode == 37) {
            controller();
        }
        ;
    });

    //touchHandle
    var startPos = 0,
            move_f = 0;
    param.query.on('touchstart', function (event) {
        var e = event.originalEvent;
        startPos = e.touches[0].pageX;
    });
    param.query.on('touchend', function (event) {
        var e = event.originalEvent;
        move_f = startPos - e.changedTouches[0].pageX;
        if (Math.abs(move_f) > 40) {
            if (move_f > 0) {
                controller(true);
            } else {
                controller();
            }
        }
        ;
    });
};
function showModalWindow() {
    $("#ajax-form-modal").show();
    setTimeout(function () {
        $("#ajax-form-modal").addClass('opened');
    }, 4);
    $('.fade').show();
    $('.blur_wrap').removeClass('none');
}

function ajaxFormHandler(el) {

        var id = el.attr("id");
        var url = el.attr("action");
        var form = document.forms[id];
        
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    data = xhr.responseText;
                    el.find('input[type="text"]').val('');
                    showModalWindow();
                }
            }
        };

        xhr.send(formData);

}

function filterCollection() {
    var json = $(document.forms.filter).serialize();
    $("#cartList").addClass("loading");
    $.ajax({
        url:"/request/ajax/cartList.php",
        data:json,
        type:"post",
        success:function(res) {
            $("#cartList").html("");
            res = res.replace('<div id="bx_incl_area_1">', '');
            if (JSON.parse(res)) {
                var arRes = JSON.parse(res);
                if (arRes['SECTIONS']) {
                    for (var i in arRes['SECTIONS']) {
                        if (typeof SECTIONS[i] === 'undefined') {
                            SECTIONS[i] = arRes['SECTIONS'][i];
                        }
                    }
                }
                myRenderTemplate(arRes["ITEMS"]);
                $("#cartList").removeClass("loading");
                if (arRes["NAV_STRING"] !== 'false' && arRes["NAV_STRING"]) {
                    $(".get_more").show();
                    $(".dweb").css("margin-top","0");
                    $("#next_page").attr("href", $(arRes["NAV_STRING"]).find("#next_page").attr("href"));
                } else {
                    $(".dweb").css("margin-top","60px");
                    $(".get_more").hide();
                }
            };
            fix_nav_single($('.slide_toggle').offset().top + 190,$('.dweb').offset().top - 350);
            $('html, body').animate({scrollTop: $('.slide_toggle').offset().top}, 500);
        }
    });
}

function unfilterAll() {
    $(".collections input[type='checkbox']").each(function(){
        $(this).prop("checked", false);
        $(".collections .active").removeClass("active");
    })
}

/*var paralax = new Paralax({
    node: layers,
    steps: 12,
    coords: [
        [0,440],
        [180,500],
        [340,560],
        [510,620],
        [650,680]
    ],
    start: 1000,
    end: 1600
})*/

function Paralax(params) {

    var layers = params.node.find('img'),
        arr_points = [],
        arr_scroll = [],
        steps = params.steps,
        self = this;

    function init() {
        var coords = params.coords;

        for (var i = 0; i < coords.length; i++) {
            var arr = [],
                delta = Math.round( (coords[i][1] - coords[i][0])/(steps-1) );

            arr[0] = coords[i][0];
            arr[steps] = coords[i][1];
            for (var j = 1; j < steps; j++) {
                arr[j] = arr[j-1] + delta;
            }
            arr_points.push(arr);

        }

        arr_scroll[0] = params.start;
        arr_scroll[steps] = params.end;
        for (var i = 1; i < steps; i++) {
            arr_scroll[i] = arr_scroll[i-1] + Math.round((params.end - params.start)/(steps-1));
        }
        console.log(arr_points);
    };

    this.render = function(step) {
        layers.each(function(i) {
            $(this).css('left',arr_points[i][step-1])
        })
    };

    $(document).scroll(function() {
        var scroll = $(document).scrollTop();

        if (scroll <= arr_scroll[0]) {
            self.render(1);
            return;
        }
        for (var i = 1; i <= steps; i++) {
            if(i === steps) {
                if (scroll > arr_scroll[i-1] ) {
                    self.render(i);
                }
            } else {
                if (scroll > arr_scroll[i-1] && scroll <= arr_scroll[i]) {
                    self.render(i);
                }
            }
            
        }
    })

    init();
};