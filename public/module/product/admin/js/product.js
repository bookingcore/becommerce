(function ($) {
    'use strict';
    $('.ajax-add-term input').on('keypress',function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            e.preventDefault();
            ajaxAddTerm($(this).closest('.ajax-add-term'));
            return false;
        }
    });
    $('.ajax-add-term .btn').on('click',function (e) {
        ajaxAddTerm($(this).closest('.ajax-add-term'));
    });

    function ajaxAddTerm(p) {
        if(p.find('input').val().trim() && p.data('attr-id')){
            $.ajax({
                url:BC.url+'/admin/module/product/ajaxAddTerm',
                data:{
                    name:p.find('input').val().trim(),
                    attr_id:p.data('attr-id')
                },
                type:'post',
                success:function (json) {
                    if(json.status){
                        var newOption = new Option(json.name, json.id, true, true);
                        p.closest('.controls').find('.bc-select2').append(newOption).trigger('change');
                        p.find('input').val('');
                    }
                }
            })
        }
    }
	// Product Variations
	$("[href='#variations']").on('shown.bs.tab', function (e) {
		reloadVariations();
	});

	function reloadVariations() {
		var p = $('#variations');
		var gr = p.closest('.product-information-tabs');
		gr.addClass('loading');
		p.find('.variation-list').load(BC.url+'/admin/module/product/ajaxVariationList/'+p.data('product-id'),function(){
			gr.removeClass('loading');
			init_condition_engine();
		});
	}


	$('.btn-save-variations').on('click',function(e){
		e.preventDefault();
		var p = $(this).closest('.tab-pane');
		var gr = p.closest('.product-information-tabs');
		gr.addClass('loading');
		var data = $('.variation-list').find('input,textarea,select').serialize();
		data+='&product_id=' + p.data('product-id');
		$.ajax({
			url:BC.url+'/admin/module/product/ajaxSaveVariations',
			data:data,
			type:'post',
			success:function (json) {
				gr.removeClass('loading');
				if(json.status){
					// reloadVariations();
				}
				if(json.message){
					//BCApp.showSuccess(json);
				}
			},
			error:function (e) {
				gr.removeClass('loading');
				BCApp.showAjaxError(e);
			}
		});
	});

	$('.btn-save-attributes').on('click',function(e){
		e.preventDefault();
		var p = $(this).closest('.tab-pane');
		var gr = p.closest('.product-information-tabs');
		gr.addClass('loading');
		var data = p.find('input,textarea,select').serialize();
		data+='&product_id=' + p.data('product-id');
		$.ajax({
			url:BC.url+'/admin/module/product/ajaxSaveTerms',
			data:data,
			type:'post',
			success:function (json) {
				gr.removeClass('loading');
				if(json.status){
					// reloadVariations();
				}
				if(json.message){
					//BCApp.showSuccess(json);
                    if(typeof BCToast !== 'undefined'){
                        BCToast.showAjaxSuccess(json)
                    }
				}
			},
			error:function (e) {
				gr.removeClass('loading');
				BCApp.showAjaxError(e);
                if(typeof BCToast !== 'undefined'){
                    BCToast.showAjaxError(e)
                }
			}
		});
	});

	$(document).on('click','.variation-header',function(e){
		if($(e.target).hasClass('variation-header')){
			$($(this).data('target')).collapse('toggle');
		}
	});
	$(document).on('click','.btn-delete-variation',function(){
		var me = $(this);
		var p = $(this).closest('.tab-pane');
		var gr = p.closest('.product-information-tabs');
		BCApp.showConfirm({
			message:i18n.confirm_delete,
			callback:function(result){
				if(!result) return;
				gr.addClass('loading');
				$.ajax({
					url:BC.url+'/admin/module/product/ajaxDeleteVariation',
					data:{
						id:me.data('id')
					},
					type:'post',
					success:function (json) {
						if(json.status){
							reloadVariations();
						}
						if(json.message){
							BCApp.showSuccess(json);
						}
					},
					error:function (e) {
						BCApp.showAjaxError(e);
					}
				});
			}
		});
	})

	$('.ajax-bulk-action-variations .btn').on('click',function () {
		var p = $(this).closest('.tab-pane');
		var a = p.find('select').val();

		if(!a) return;

		var func = "variation_bulk_action_"+a;
		if(typeof window[func] == 'function')
		{
			window[func](a,p);
		}
	});

	window.variation_bulk_action_add = function (action,p) {
		var gr = p.closest('.product-information-tabs');
		gr.addClass('loading');
		$.ajax({
			url:BC.url+'/admin/module/product/ajaxAddVariation',
			data:{
				id:p.data('product-id')
			},
			type:'post',
			success:function (json) {
				gr.removeClass('loading');
				if(json.status){
					reloadVariations();
				}
				if(json.message){
					BCApp.showSuccess(json);
				}
			},
			error:function (e) {
				gr.removeClass('loading');
				BCApp.showAjaxError(e);
			}
		});
	}
	window.variation_bulk_action_add_all = function (action,p) {
		$.ajax({
			url:BC.url+'/admin/module/product/ajaxAddVariation',
			data:{
				id:p.data('id')
			},
			type:'post',
			success:function (json) {
				if(json.status){
					reloadVariations();
				}
				if(json.message){
					BCApp.showSuccess(json);
				}
			},
			error:function (e) {
				BCApp.showAjaxError(e);
			}
		});
	}



	// Variation conditional engine
	var condition_object='select, input[type="radio"]:checked, input[type="text"], input[type="hidden"], input.ot-numeric-slider-hidden-input,input[type="checkbox"]';

    function init_condition_engine(){

        $('#variations').off( 'change.conditionals');
        $('#variations').on( 'change.conditionals', condition_object, function(e) {
            run_variations_condition_engine($(this).closest('.variation-item'));
        });

        $('.variation-item').each(function(){
            run_variations_condition_engine($(this));
        })
    }
    function run_variations_condition_engine(parent){
        $('[v-condition]',parent).each(function() {
            var passed;
            var conditions = get_match_condition( $( this ).attr( 'v-condition' ) );
            var operator = ( $( this ).data( 'operator' ) || 'and' ).toLowerCase();

            $.each( conditions, function( index, condition ) {

                var target   = $( '[data-name='+ condition.check+']' ,parent);

                var targetEl = !! target.length && target.first();

                if ( ! target.length || ( ! targetEl.length && condition.value.toString() != '' ) ) {
                    return;
                }

                var v1 = targetEl.length ? targetEl.val().toString() : '';
                var v2 = condition.value.toString();

                var result;

                if(targetEl.length && targetEl.attr('type')=='radio'){
                    v1 = $( '[data-name='+ condition.check+']:checked').val();
                }
                if(targetEl.length && targetEl.attr('type')=='checkbox'){
                    v1=targetEl.is(':checked')?v1:'';
                }

                switch ( condition.rule ) {
                    case 'less_than':
                        result = ( parseInt( v1 ) < parseInt( v2 ) );
                        break;
                    case 'less_than_or_equal_to':
                        result = ( parseInt( v1 ) <= parseInt( v2 ) );
                        break;
                    case 'greater_than':
                        result = ( parseInt( v1 ) > parseInt( v2 ) );
                        break;
                    case 'greater_than_or_equal_to':
                        result = ( parseInt( v1 ) >= parseInt( v2 ) );
                        break;
                    case 'contains':
                        result = ( v1.indexOf(v2) !== -1 ? true : false );
                        break;
                    case 'is':
                        result = ( v1 == v2 );
                        break;
                    case 'not':
                        result = ( v1 != v2 );
                        break;
                }

                if ( 'undefined' == typeof passed ) {
                    passed = result;
                }

                switch ( operator ) {
                    case 'or':
                        passed = ( passed || result );
                        break;
                    case 'and':
                    default:
                        passed = ( passed && result );
                        break;
                }

            });

            if ( passed ) {
                $(this).show();
            } else {
                $(this).hide();
            }

            passed = undefined;
        });
    }

    function get_match_condition(condition){
        var match;
        var regex = /(.+?):(is|not|contains|less_than|less_than_or_equal_to|greater_than|greater_than_or_equal_to)\((.*?)\),?/g;
        var conditions = [];

        while( match = regex.exec( condition ) ) {
            conditions.push({
                'check': match[1],
                'rule':  match[2],
                'value': match[3] || ''
            });
        }

        return conditions;
    }

    $('.bc-search-box').each(function(){
       var me = $(this);
       var url = me.data('url');
       var dropdown = me.find('.dropdown-menu');
       var input  = me.find('.search-input');
       var html = '';
       var timeout = null;
       var template = Handlebars.compile(document.getElementById(me.data('template')).innerHTML);
       var first_load = true;
       var autocomplete = function(data){
           if(timeout) window.clearTimeout(timeout);
           timeout = window.setTimeout(function(){
               dropdown.show();
            $.ajax({
                url:url,
                data:data,
                method:'get',
                type:'json',
                success:function(json){
                    if(json.data && json.data.length){
                        html = '';
                        dropdown.empty();
                        json.data.map(function(item){
                            var html_item = $(template(item))
                            html_item.data('item',item);
                            html_item.on('click',function(e){
                                me.trigger('bc.dropdown.click',item);
                                dropdown.hide().addClass('hidden');
                            })
                            dropdown.prepend(html_item);
                        });
                    }else{
                        dropdown.html(me.find('.template .no-data').html());
                    }
                }
            })
           },300);
        }

       input.on('keyup',function(){
           autocomplete({
               s:input.val()
           })
       });
       input.on('click',function(){
           if(!first_load) return;
           first_load = false;

           autocomplete({
               s:input.val()
           })
       })

    });
    var grouped_item_template = Handlebars.compile(document.getElementById('grouped-item-template').innerHTML);

    $('.bc-grouped-product').on('bc.dropdown.click',function(e,data){
        var p = $(this).closest('.form-group-item');
        p.find('.g-items').append(grouped_item_template(data))
    })
    var upsell_item_template = Handlebars.compile(document.getElementById('up-sell-item-template').innerHTML);

    $('.bc-up-sell-product').on('bc.dropdown.click',function(e,data){
        var p = $(this).closest('.form-group-item');
        p.find('.g-items').append(upsell_item_template(data))
    })
    var cross_sell_template = Handlebars.compile(document.getElementById('cross-sell-item-template').innerHTML);

    $('.bc-cross-sell-product').on('bc.dropdown.click',function(e,data){
            var p = $(this).closest('.form-group-item');
            p.find('.g-items').append(cross_sell_template(data))
        })
})(jQuery);
