function ajaxThemeCreation() {
	//general infos
	var author = jQuery('input[name="themeAuthor"]').attr('value');
	var authorURL = jQuery('input[name="themeAuthorURL"]').attr('value');
	var name = jQuery('input[name="themeName"]').attr('value');
	var URL = jQuery('input[name="themeURL"]').attr('value');
	var version = jQuery('input[name="themeVersion"]').attr('value');
	var tags = jQuery('input[name="themeTags"]').attr('value');
	var description = jQuery('textarea[name="themeDescription"]').attr('value');
	var licence = jQuery('textarea[name="themeLicence"]').attr('value');
	//structure infos
	var themeCols = jQuery('input[name="themeCols"]').attr('value');
	var mainPos = jQuery('select[name="mainPos"]').attr('value');
	var sidebars = 0;
	var footers = 0;
	var topOut = 0;
	var topIn = 0;
	var bottomIn = 0;
	//setting variables depending on preview elements' title
	if (jQuery('#pre_sidebar1').attr('title') == 'act') {
		if (jQuery('#pre_sidebar2').attr('title') == 'act') {
			sidebars = 2;
		} else {
			sidebars = 1;
		}
	}
	if (jQuery('#pre_footer1').attr('title') == 'act') {
		if (jQuery('#pre_footer2').attr('title') == 'act') {
			footers = 2;
		} else {
			footers = 1;
		}
	}
	if (jQuery('#pre_topOutArea').attr('title') == 'act') {
		topOut = 1;
	}
	if (jQuery('#pre_topInArea').attr('title') == 'act') {
		topIn = 1;
	}
	if (jQuery('#pre_bottomInArea').attr('title') == 'act') {
		bottomIn = 1;
	}
	//preparing the variable to be send via AJAX
	var ajaxRequestData = "themeAuthor=" + author + "\&themeAuthorURL=" + authorURL + "\&themeName=" + name + "\&themeURL=" + URL + "\&themeVersion=" + version + "\&themeTags=" + tags + "\&themeDescription=" + description + "\&themeLicence=" + licence + "\&themeCols=" + themeCols + "\&sidebars=" + sidebars + "\&mainPos=" + mainPos + "\&footers=" + footers + "\&topOut=" + topOut + "\&topIn=" + topIn + "\&bottomIn=" + bottomIn;
	//actual AJAX request/response
	jQuery.ajax({
		method: "GET",
		url: "../wp-content/plugins/wowpth/createTheme.php",
		data: ajaxRequestData,
		beforeSend: function() {
			jQuery('#answerContainer').empty().append('Creazione in corso');
			jQuery('#answerContainer').css('visibility', 'visible');
		},
		success: function(response) {
			jQuery('#answerContainer').empty().append(response);
		}
	})
}