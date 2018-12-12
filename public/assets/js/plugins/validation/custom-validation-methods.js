//Custom Validation Methods

(function(factory) {
	if (typeof define === "function" && define.amd) {
		define(["jquery", "./jquery.validate"], factory);
	} else if (typeof module === "object" && module.exports) {
		module.exports = factory(require("jquery"));
	} else {
		factory(jQuery);
	}
}(function($) {
	// Vaidation methods come here
	$.validator.addMethod('check_slug', function(value, element, params) {
		// Validation body comes here
		var regexp = /^(?![0-9-]+$)(?:(?:[a-z]+-?|[0-9]-?)\/?)+(?:^|[^\-\?])\/?$/;
		return this.optional(element) || regexp.test(value);
	}, 'Please enter a valid slug');

	$.validator.addMethod('alpha_dash', function (value, element, params) {
		var regexp = /^[a-z][a-z0-9-]+$/i;
		return this.optional(element) || regexp.test(value);
	}, 'Use only letters (should begin with a letter), numbers, and dashes');

	$.validator.addMethod('leap_date', function (value, element, params) {
		var regexp = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
		return this.optional(element) || regexp.test(value);
	}, 'Invalid date');

	$.validator.addMethod('min_number', function (value, element, params) {
		return this.optional( element ) || value.replace(/,/g, '') >= params;
	}, $.validator.format( "Please enter a value greater than or equal to {0}." ));

	$.validator.addMethod('max_number', function (value, element, params) {
		return value.replace(/,/g, '') <= params;	
	}, $.validator.format( "Please enter a value less than or equal to {0}." ));
}));
