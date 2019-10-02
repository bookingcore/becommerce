(function ($) {

	// Product Variations
	$('[href=#variations]').on('shown.bs.tab', function (e) {
		reloadVariations();
	});

	function reloadVariations() {
		var p = $('#variations');
		p.find('.variation-list').load(bookingCore.url+'/admin/module/product/ajaxVariationList/'+p.data('product-id'));
	}

	$('.ajax-bulk-action-variations .btn').click(function () {
		var p = $('.ajax-bulk-action-variations');
		var a = p.find('select').val();

		if(!a) return;

		var func = "variation_bulk_action_"+a;
		if(typeof window[func] == 'function')
		{
			func(a,p);
		}
	});

	window.variation_bulk_action_add = function (action,p) {
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
})(jquery);