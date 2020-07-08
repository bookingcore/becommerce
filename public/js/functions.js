$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
window.bravo_format_money =  function($money) {

    if (!$money) {
        //return Bravo.free_text;
    }
    //if (typeof Bravo.booking_currency_precision && Bravo.booking_currency_precision) {
    //    $money = Math.round($money).toFixed(Bravo.booking_currency_precision);
    //}

    $money            = bravo_number_format($money, Bravo.booking_decimals, Bravo.decimal_separator, Bravo.thousand_separator);
    var $symbol       = Bravo.currency_symbol;
    var $money_string = '';

    switch (Bravo.currency_position) {
        case "right":
            $money_string = $money + $symbol;
            break;
        case "left_space":
            $money_string = $symbol + " " + $money;
            break;

        case "right_space":
            $money_string = $money + " " + $symbol;
            break;
        case "left":
        default:
            $money_string = $symbol + $money;
            break;
    }

    return $money_string;
}

window.bravo_number_format = function (number, decimals, dec_point, thousands_sep) {


    number         = (number + '')
        .replace(/[^0-9+\-Ee.]/g, '');
    var n          = !isFinite(+number) ? 0 : +number,
        prec       = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep        = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec        = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s          = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                .toFixed(prec);
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s              = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
        .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
            .join('0');
    }
    return s.join(dec);
}

window.bravo_handle_error_response = function(e){
    switch (e.status) {
        case 401:
            // not logged in
            $('#login').modal('show');
            break;
    }
};

// Form validation
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
});

var BravoApp ={
    showSuccess:function (configs){
        var args = {};
        if(typeof configs == 'object')
        {
            args = configs;
        }else{
            args.message = configs;
        }
        if(!args.title){
            args.title = i18n.success;
        }
        args.centerVertical = true;
        bootbox.alert(args);
    },
    showError:function (configs) {
        var args = {};
        if(typeof configs == 'object')
        {
            args = configs;
        }else{
            args.message = configs;
        }
        if(!args.title){
            args.title = i18n.warning;
        }
        args.centerVertical = true;
        bootbox.alert(args);
    },
    showAjaxError:function (e) {
        var json = e.responseJSON;
        if(typeof json !='undefined'){
            if(typeof json.errors !='undefined'){
                var html = '';
                _.forEach(json.errors,function (val) {
                    html+=val+'<br>';
                });

                return this.showError(html);
            }
            if(json.message){
                return this.showError(json.message);
            }
        }
        if(e.responseText){
            return this.showError(e.responseText);
        }
    },
    showAjaxMessage:function (json) {
        if(json.message)
        {
            if(json.status){
                this.showSuccess(json);
            }else{
                this.showError(json);
            }
        }
    },
    showConfirm:function (configs) {
        var args = {};
        if(typeof configs == 'object')
        {
            args = configs;
        }
        args.buttons = {
            confirm: {
                label: '<i class="fa fa-check"></i> '+i18n.confirm,
            },
            cancel: {
                label: '<i class="fa fa-times"></i> '+i18n.cancel,
            }
        };
        args.centerVertical = true;
        bootbox.confirm(args);
    }
};
$(document).on('click','.bravo_add_to_cart',function(e){
    e.preventDefault();
    $(this).addClass('loading');
    var me = $(this);
    var product = me.data('product');
    var q_input =  $('.quantity-input input[name=quantity]');
    var quantity = {qty: (!isNaN(parseInt(q_input.val()))) ? parseInt(q_input.val()) : 1};
    var variations = Bravo.currentVariation;
    console.log(me.attr('data-product'));

    $.ajax({
        url:Bravo.routes.add_to_cart,
        data: Object.assign(product, quantity, variations),
        type:'post',
        dataType:'json',
        beforeSend:function(){
            me.addClass('loading');
        },
        success:function(json){
            me.removeClass('loading');
            if(json.fragments){
                for(var k in json.fragments){
                    $(k).html(json.fragments[k]);
                }
            }
            if(json.url){
                window.location.href = json.url;
            }
            if(json.message){
                BravoApp.showAjaxMessage(json);
                setTimeout(function () {
                    let url = $(`.wishlist-items-wrapper .product-remove.item_${product.id} > a`).attr('href');
                    if (url !== undefined) window.open(url,'_self');
                },1000)
            }
        },
        error:function(err){
            me.removeClass('loading');
            console.log(err)
        }
    })
})

$(document).on('click','.bravo_delete_cart_item',function(e){
    e.preventDefault();

    var c = confirm(i18n.delete_cart_item_confirm);
    if(!c) return;

    var me = $(this);
    var id = $(this).data('id');
    $.ajax({
        url:bookingCore.routes.remove_cart_item,
        data:{
            id:id
        },
        type:'post',
        dataType:'json',
        success:function(json){
            if(json.fragments){
                for(var k in json.fragments){
                    $(k).html(json.fragments[k]);
                }
            }
            if(json.url){
                window.location.href = json.url;
            }
            if(json.reload){
                window.location.reload();
            }
            if(json.message){
                // bookingCoreApp.showAjaxMessage(json);
            }

        },
        error:function(err){
            bravo_handle_error_response(err);
            console.log(err)
        }
    })
})
