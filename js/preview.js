jQuery(document).ready( function() {
	jQuery('.ITE_preview_block_clickable').css('background', 'rgb(220,220,220)');
	jQuery('.ITE_preview_block_clickable').css('border', '1px solid rgb(170,170,170)');
	jQuery('#pre_footer2').css('color', 'rgb(170,170,170)');
	jQuery('#pre_footer2').css('background', 'white');
	jQuery('#pre_footer2').css('border', '1px dashed rgb(170,170,170)');
	jQuery('#pre_sidebar2').css('color', 'rgb(170,170,170)');
	jQuery('#pre_sidebar2').css('background', 'white');
	jQuery('#pre_sidebar2').css('border', '1px dashed rgb(170,170,170)');
	
	jQuery('.ITE_preview_block_clickable').click( function() {
		var activated = jQuery(this).attr('title');
		var clickedElementId = jQuery(this).attr('id');
		if (activated == "deact") { //if the element is deactivated
			jQuery(this).attr('title', 'act');
			jQuery(this).css('background', 'rgb(199,255,171)');
			jQuery(this).css('border', '1px solid rgb(0,128,0)'); //activate it
			if (clickedElementId == 'pre_footer1') { //and, if it's first sidebar or footer
				jQuery('#pre_footer2').css('background', 'rgb(220,220,220)');
				jQuery('#pre_footer2').css('border', '1px solid rgb(170,170,170)');
				jQuery('#pre_footer2').css('color', 'black');
				jQuery('#pre_footer2').attr('title', 'deact');
			} else if (clickedElementId == 'pre_sidebar1') {
				jQuery('#pre_sidebar2').css('background', 'rgb(220,220,220)');
				jQuery('#pre_sidebar2').css('border', '1px solid rgb(170,170,170)');
				jQuery('#pre_sidebar2').css('color', 'black');
				jQuery('#pre_sidebar2').attr('title', 'deact'); //make the second one visible too
			}

		} else if (activated == "act") { //if the element is activated
			jQuery(this).attr('title', 'deact');
			jQuery(this).css('background', 'rgb(220,220,220)');
			jQuery(this).css('border', '1px solid rgb(170,170,170)'); //deactivate it
			if (clickedElementId == 'pre_footer1') { // and, if it's the first sidebar or footer
				jQuery('#pre_footer2').css('background', 'white');
				jQuery('#pre_footer2').css('border', '1px dashed rgb(170,170,170)');
				jQuery('#pre_footer2').css('color', 'rgb(170,170,170)');
				jQuery('#pre_footer2').attr('title', 'unact');
			} else if (clickedElementId == 'pre_sidebar1') {
				jQuery('#pre_sidebar2').css('background', 'white');
				jQuery('#pre_sidebar2').css('border', '1px dashed rgb(170,170,170)');
				jQuery('#pre_sidebar2').css('color', 'rgb(170,170,170)');
				jQuery('#pre_sidebar2').attr('title', 'unact'); //hide the second one
			}
		}
	});
});


function advancedEditor(){
	jQuery("#editorContainer").hide();
	jQuery("#advancedEditorContainer").show();
};