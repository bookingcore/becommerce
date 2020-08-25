(function ($) {
    'use strict';

	// Product Variations
	$("[href='#variations']").on('shown.bs.tab', function (e) {
		reloadVariations();
	});

	function reloadVariations() {
		var p = $('#variations');
		var gr = p.closest('.product-information-tabs');
		gr.addClass('loading');
		p.find('.variation-list').load(bookingCore.url+'/admin/module/product/ajaxVariationList/'+p.data('product-id'),function(){
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
			url:bookingCore.url+'/admin/module/product/ajaxSaveVariations',
			data:data,
			type:'post',
			success:function (json) {
				gr.removeClass('loading');
				if(json.status){
					// reloadVariations();
				}
				if(json.message){
					bookingCoreApp.showSuccess(json);
				}
			},
			error:function (e) {
				gr.removeClass('loading');
				bookingCoreApp.showAjaxError(e);
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
		bookingCoreApp.showConfirm({
			message:i18n.delete_confirm,
			callback:function(result){
				if(!result) return;
				gr.addClass('loading');
				$.ajax({
					url:bookingCore.url+'/admin/module/product/ajaxDeleteVariation',
					data:{
						id:me.data('id')
					},
					type:'post',
					success:function (json) {
						if(json.status){
							reloadVariations();
						}
						if(json.message){
							bookingCoreApp.showSuccess(json);
						}
					},
					error:function (e) {
						bookingCoreApp.showAjaxError(e);
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
			url:bookingCore.url+'/admin/module/product/ajaxAddVariation',
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
					bookingCoreApp.showSuccess(json);
				}
			},
			error:function (e) {
				gr.removeClass('loading');
				bookingCoreApp.showAjaxError(e);
			}
		});
	}
	window.variation_bulk_action_add_all = function (action,p) {
		$.ajax({
			url:bookingCore.url+'/admin/module/product/ajaxAddVariation',
			data:{
				id:p.data('id')
			},
			type:'post',
			success:function (json) {
				if(json.status){
					reloadVariations();
				}
				if(json.message){
					bookingCoreApp.showSuccess(json);
				}
			},
			error:function (e) {
				bookingCoreApp.showAjaxError(e);
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
})(jQuery);
