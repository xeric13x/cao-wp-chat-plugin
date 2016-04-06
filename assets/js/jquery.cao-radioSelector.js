(function($) {
	$.fn.radioSelector = function() {
		return this.each(function() {
			var groupWrapper = $(this),
				uniqueId = 'cao-' + (Math.round(new Date().getTime())),
				selectedClass = 'cao-selected';

			groupWrapper.prop('id', uniqueId);
			groupWrapper.find('input:checked').parent('span').addClass(selectedClass);
			groupWrapper.find('input').hide().click(function() {
				$this = $(this);
				$this.parent('span').addClass(selectedClass).siblings().removeClass(selectedClass);
			});
		});
	}
})(jQuery);