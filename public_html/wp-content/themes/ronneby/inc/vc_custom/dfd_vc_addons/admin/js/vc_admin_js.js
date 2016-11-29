(function($) {
	$('body, iframe').on('click','#vc_add-new-element, [data-vc-element="add-element-action"], .vc_controls [data-vc-control="add"], [data-vc-element="add-element-action"], #vc_add-new-element, .vc_control-btn-prepend, .vc_control-btn-append, .vc_controls [data-vc-control="prepend"], .vc_controls [data-vc-control="append"]',function() {
		$('#vc_ui-panel-add-element').find('.vc_edit-form-tab-control').eq(4).find('button').click();
	});
})(jQuery);