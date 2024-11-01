jQuery(document).ready( function() {
	jQuery('#themeCols').attr('value', 1);
	modifyAvailableOptions();
	
	jQuery('#moreCols').click( function() {
		var colsNumber = jQuery('#themeCols').attr('value');

		if (colsNumber == 1) {
			jQuery('#themeCols').attr('value', 2);
			adaptPreview(2, 'left');
		} else if (colsNumber == 2) {
			jQuery('#themeCols').attr('value', 3);
			adaptPreview(3, 'left');
		}
		modifyAvailableOptions();
	});

	jQuery('#lessCols').click( function() {
		var colsNumber = jQuery('#themeCols').attr('value');

		if (colsNumber == 3) {
			jQuery('#themeCols').attr('value', 2);
			adaptPreview(2, 'left');
		} else if (colsNumber == 2) {
			jQuery('#themeCols').attr('value', 1);
			adaptPreview(1, '');
		}
		modifyAvailableOptions();
	});
	
	jQuery('#mainPos').change( function() {
		adaptPreview( jQuery('#themeCols').attr('value'), jQuery('#mainPos').attr('value') );
	});
});

//Enables and disables options depending on the selected number of columns
function modifyAvailableOptions() {
	if (jQuery('#themeCols').attr('value') == 1) { //su una colonna, non ci sono sidebar e non c'è da scegliere la posizione del main
		jQuery('#mainPos').attr('value', 'center');
		jQuery('#mainPos').attr('disabled', true);
	} else {
		jQuery('#mainPos').attr('value', 'left');
		jQuery('#mainPos').attr('disabled', false);
		if (jQuery('#themeCols').attr('value') == 2) { //su due colonne, il main non può stare in quella centrale
			jQuery('#positionValueCenter').remove();
		} else if (jQuery('#positionValueCenter').attr('value') != 'center') {
			jQuery('#mainPos').append('<option id="positionValueCenter" value="center">Center</option>');
		}
	}
}

//Changes the css for the preview, depending on the number of columns and main block's position chosed by the user
function adaptPreview( c, p ) {
	if (c == 1) {
		jQuery("link[id=preview-choice-css]").attr('href', "http://morpheus.micc.unifi.it/wowpth/wp-content/plugins/wowpth/css/preview/1c.css?ver=1.0");
	} else if (c == 2 && p == 'left') {
		jQuery("link[id=preview-choice-css]").attr('href', "http://morpheus.micc.unifi.it/wowpth/wp-content/plugins/wowpth/css/preview/2c-l.css?ver=1.0");
	} else if (c == 2 && p == 'right') {
		jQuery("link[id=preview-choice-css]").attr('href', "http://morpheus.micc.unifi.it/wowpth/wp-content/plugins/wowpth/css/preview/2c-r.css?ver=1.0");
	} else if (c == 3 && p == 'left') {
		jQuery("link[id=preview-choice-css]").attr('href', "http://morpheus.micc.unifi.it/wowpth/wp-content/plugins/wowpth/css/preview/3c-l.css?ver=1.0");
	} else if (c == 3 && p == 'center') {
		jQuery("link[id=preview-choice-css]").attr('href', "http://morpheus.micc.unifi.it/wowpth/wp-content/plugins/wowpth/css/preview/3c-c.css?ver=1.0");
	} else if (c == 3 && p == 'right') {
		jQuery("link[id=preview-choice-css]").attr('href', "http://morpheus.micc.unifi.it/wowpth/wp-content/plugins/wowpth/css/preview/3c-r.css?ver=1.0");
	}
}