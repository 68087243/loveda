/* ----------------------------------------

 * Ideal Forms 1.02
 * Copyright 2011, Cedric Ruiz
 * Free to use under the GPL license.
 * http://www.spacirdesigns.com

 -----------------------------------------*/

/* ---------------------------------------
 Set min-width
 ----------------------------------------*/
var setMinWidth = function (el) {
    var minWidth = 0;
    el
        .each(function () {
            var width = $(this).width();
            if (width > minWidth) {
                minWidth = width;
            }
        })
        .width(minWidth);
};

/* ---------------------------------------
 Start plugin
 ----------------------------------------*/
(function ($) {

    $.fn.idealforms = function () {
        this.each(function () {

            var $idealform,
                $labels,
                $selects,
                $radios,
                $checks;

            $idealform = $(this);
            $idealform.addClass('idealform');

            /* ---------------------------------------
             Label
             ----------------------------------------*/

            $labels = $idealform.find('div').children('label').addClass('main-label');
            $labels.filter('.required').prepend('<span>*</span>');
            setMinWidth($labels);
            // Create & Insert all idealselects
            $selects = $idealform.find('.idealforms_select_obj');
            // Create & Insert all idealselects
            $selects.each(function () {
                var that = $(this);
                that.menu = that.siblings('ul.idealforms_select_menu');
                that.items = that.menu.find('li');

                that.find('input[type=text]').val( that.menu.find('li').eq(0).text());
                that.find('input[type=hidden]').val( that.menu.find('li').eq(0).data('value'));
                // Events
                that.events = {
                    open : function () {
                        that.siblings('ul.idealforms_select_menu').show();
                    },
                    close : function () {
                        that.siblings('ul.idealforms_select_menu').hide();
                    } ,
                    click: function () {
                        that.find('input[type=hidden]').val($(this).data('value'));
                        that.find('input[type=text]').val( $.trim($(this).text()));
                        that.siblings('ul.idealforms_select_menu').hide();
                    }
                };
                that.siblings('ul.idealforms_select_menu').delegate(that.siblings('ul.idealforms_select_menu'),'mouseleave',that.events.close);
                that.delegate(that.menu,'click', that.events.open);
                that.menu.delegate('li','click',that.events.click);
            });

            /* ---------------------------------------
             Radio & Check
             ----------------------------------------*/

            $radios = $idealform.find(':radio');
            $checks = $idealform.find(':checkbox');

            // Radio
            $radios.each(function () {
                $(this)
                    .after('<span class="radio"></span>')
                    .parents('ul').addClass('idealradio');
                if ($(this).is(':checked')) {
                    $(this).next('span').addClass('checked');
                }
            }).change(function () {
                $(this).parents('ul').find('span').removeClass('checked');
                $(this).next('span').addClass('checked');
            });

            // Check
            $checks.each(function () {
                $(this)
                    .after('<span class="check"></span>')
                    .parents('ul').addClass('idealcheck');
                if ($(this).is(':checked')) {
                    $(this).next('span').addClass('checked');
                }
            }).change(function () {
                $(this).next('span').toggleClass('checked');
            });

        });

    };
})(jQuery);


/**
 * 自定义select 设置选中
 * @param obj
 * @param $val
 */
function setSelectSelected(obj,$val){
    if($val){
        $(obj).val($val);
        $(obj).parents().siblings('.idealforms_select_menu').find('li').each(function(){
            if($val == $(this).data('value')){
                $(obj).siblings('input[type=text]').val($(this).text());
            }
        })
    }
}

/**
 * 自定义radio 设置选中
 * @param obj
 * @param $val
 */
function setRadioCheck(obj,$val){
    $(obj).each(function(){
        if($val ==$(this).val()){
            $(this).attr('checked',true);
            $(this).siblings('span[class=radio]').addClass('checked');
        }
    })
}

/**
 * 自定义Checkbox 设置选中
 * @param obj
 * @param $val
 */
function setCheckboxCheck(obj){
    $(obj).each(function(){
        if($(this).data('check') == true){
            $(this).attr('checked',true);
            $(this).siblings('span[class=check]').addClass('checked');
        }
    })
}