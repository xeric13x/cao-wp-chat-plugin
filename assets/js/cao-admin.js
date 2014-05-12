var wth = jQuery.noConflict();

wth(function() {
	var caoPIdWrapper = wth('#cao-placement-id-wrapper');
	caoPIdWrapper.hide();
	wth('input[name=cao_display_icon]').change(function() {
		$this = wth(this);
		if ($this.is(':checked')) {
			caoPIdWrapper.show();
		} else {
			caoPIdWrapper.hide();
		}
	});
});