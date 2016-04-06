(function($) {
	$(function() {
		var caoPIdWrapper = $('#cao-placement-id-wrapper');
		caoPIdWrapper.hide();
		$('input[name*=display_icon]').change(function() {
			$this = $(this);
			if ($this.is(':checked')) {
				caoPIdWrapper.show();
			} else {
				caoPIdWrapper.hide();
			}
		});
		$('input[name*=display_icon]').trigger('change');

		$('.cao-radio-group').radioSelector();
	});
})(jQuery);