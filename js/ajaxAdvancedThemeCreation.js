function ajaxAdvancedThemeCreation() {
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
	var width = jQuery("#layoutWidth").attr('value');
	var height = jQuery("#layoutMinHeight").attr('value');
	var multiple = (width/800);
	
	//vars for Top_external_area
	var top_ext = false;
	var height_top_ext = 0;
	var top_ext_open = false;
	var top_ext_west = false;
	var width_top_ext_west = 0;
	var top_ext_east = false;
	var width_top_ext_east = 0;
	var width_top_ext_center = 0;
	
	//vars for Top_internal_area
	var top_int = false;
	var height_top_int = 0;
	var top_int_open = false;
	var top_int_west = false;
	var width_top_int_west = 0;
	var top_int_east = false;
	var width_top_int_east = 0;
	var width_top_int_center = 0;
	
	//vars for Footer_area_1
	var footer_1 = false;
	var height_footer_1 = 0;
	var footer_1_open = false;
	var footer_1_west = false;
	var width_footer_1_west = 0;
	var footer_1_east = false;
	var width_footer_1_east = 0;
	var width_footer_1_center = 0;
	
	//vars for Footer_area_2
	var footer_2 = false;
	var height_footer_2 = 0;
	var footer_2_open = false;
	var footer_2_west = false;
	var width_footer_2_west = 0;
	var footer_2_east = false;
	var width_footer_2_east = 0;
	var width_footer_2_center = 0;
	
	//vars for Bottom_internal_area
	var bottom_int = false;
	var height_bottom_int = 0;
	var width_bottom_int = 0;
	var bottom_int_open = false;
	var bottom_int_west = false;
	var width_bottom_int_west = 0;
	var bottom_int_east = false;
	var width_bottom_int_east = 0;
	var width_bottom_int_center = 0;
	
	//vars for West_area_1
	var west_1 = false;
	var width_west_1 = 0;
	var west_1_open = false;
	var west_1_north = false;
	var height_west_1_north = 0;
	var west_1_south = false;
	var height_west_1_south = 0;
	var height_west_1_center = 0;
	
	//vars for West_area_2
	var west_2 = false;
	var width_west_2 = 0;
	var west_2_open = false;
	var west_2_north = false;
	var height_west_2_north = 0;
	var west_2_south = false;
	var height_west_2_south = 0;
	var height_west_2_center = 0;
	
	//vars for East_area_1
	var east_1 = false;
	var width_east_1 = 0;
	var east_1_open = false;
	var east_1_north = false;
	var height_east_1_north = 0;
	var east_1_south = false;
	var height_east_1_south = 0;
	var height_east_1_center = 0;

	//vars for East_area_2
	var east_2 = false;
	var width_east_2 = 0;
	var east_2_open = false;
	var east_2_north = false;
	var height_east_2_north = 0;
	var east_2_south = false;
	var height_east_2_south = 0;
	var height_east_2_center = 0;
	
	//getters for Top_external_area
	if (jQuery('#Top_external_area').css('display') == "block") {
		top_ext = true;
		height_top_ext = (jQuery('#Top_external_area').height())*multiple;
		if(jQuery('#topExtOpen').css('display') == "block"){
			top_ext_open = true;
			if(jQuery('#Top_ext_west').css('display') == "block"){
				top_ext_west = true;
				width_top_ext_west = (jQuery('#Top_ext_west').width())*multiple; 
			}
			if(jQuery('#Top_ext_east').css('display') == "block"){
				top_ext_east = true;
				width_top_ext_east = (jQuery('#Top_ext_east').width())*multiple;
			}
			width_top_ext_center = (jQuery('#Top_ext_center').width())*multiple;
		}
	}
	
	//getters for Top_internal_area
	if (jQuery('#Top_internal_area').css('display') == "block") {
		top_int = true;
		height_top_int = (jQuery('#Top_internal_area').height())*multiple;
		if(jQuery('#topIntOpen').css('display') == "block"){
			top_int_open = true;
			if(jQuery('#Top_int_west').css('display') == "block"){
				top_int_west = true;
				width_top_int_west = (jQuery('#Top_int_west').width())*multiple;
			}
			if(jQuery('#Top_int_east').css('display') == "block"){
				top_int_east = true;
				width_top_int_east = (jQuery('#Top_int_east').width())*multiple;
			}
			width_top_int_center = (jQuery('#Top_int_center').width())*multiple;
		}
	}
	
	//getters for Footer_area_1
	if (jQuery('#Footer_area_1').css('display') == "block") {
		footer_1 = true;
		height_footer_1 = (jQuery('#Footer_area_1').height())*multiple;
		if(jQuery('#footer1open').css('display') == "block"){
			footer_1_open = true;
			if(jQuery('#Footer_1_west').css('display') == "block"){
				footer_1_west = true;
				width_footer_1_west = (jQuery('#Footer_1_west').width())*multiple; 
			}
			if(jQuery('#Footer_1_east').css('display') == "block"){
				footer_1_east = true;
				width_footer_1_east = (jQuery('#Footer_1_east').width())*multiple; 
			}
			width_footer_1_center = (jQuery('#Footer_1_center').width())*multiple;
		}
	}
	
	//getters for Footer_area_2
	if (jQuery('#Footer_area_2').css('display') == "block") {
		footer_2 = true;
		height_footer_2 = (jQuery('#Footer_area_2').height())*multiple;
		if(jQuery('#footer2open').css('display') == "block"){
			footer_2_open = true;
			if(jQuery('#Footer_2_west').css('display') == "block"){
				footer_2_west = true;
				width_footer_2_west = (jQuery('#Footer_2_west').width())*multiple; 
			}
			if(jQuery('#Footer_2_east').css('display') == "block"){
				footer_2_east = true;
				width_footer_2_east = (jQuery('#Footer_2_east').width())*multiple; 
			}
			width_footer_2_center = (jQuery('#Footer_2_center').width())*multiple;
		}
	}
	
	//getters for Bottom_internal_area
	if (jQuery('#Bottom_internal_area').css('display') == "block") {
		bottom_int = true;
		height_bottom_int = (jQuery('#Bottom_internal_area').height())*multiple;
		width_bottom_int = (jQuery('#Bottom_internal_area').width())*multiple;
		if(jQuery('#bottomIntOpen').css('display') == "block"){
			bottom_int_open = true;
			if(jQuery('#Bottom_int_west').css('display') == "block"){
				bottom_int_west = true;
				width_bottom_int_west = (jQuery('#Bottom_int_west').width())*multiple;
			}
			if(jQuery('#Bottom_int_east').css('display') == "block"){
				bottom_int_east = true;
				width_bottom_int_east = (jQuery('#Bottom_int_east').width())*multiple;
			}
			width_bottom_int_center = (jQuery('#Bottom_int_center').width())*multiple;
		}
	}
	
	//getters for West_area_1
	if(jQuery('#West_area_1').css('display') == "block"){
		west_1 = true;
		width_west_1 = (jQuery('#West_area_1').width())*multiple;
		if(jQuery('#west1open').css('display') == "block"){
			west_1_open = true;
			if(jQuery('#West_1_north').css('display') == "block"){
				west_1_north = true;
				height_west_1_north = (jQuery('#West_1_north').height())*multiple;
			}
			if(jQuery('#West_1_south').css('display') == "block"){
				west_1_south = true;
				height_west_1_south = (jQuery('#West_1_south').height())*multiple;
			}
			height_west_1_center = (jQuery('#West_1_center').height())*multiple;
		}
	}
	
	//getters for West_area_2
	if(jQuery('#West_area_2').css('display') == "block"){
		west_2 = true;
		width_west_2 = (jQuery('#West_area_2').width())*multiple;
		if(jQuery('#west2open').css('display') == "block"){
			west_2_open = true;
			if(jQuery('#West_2_north').css('display') == "block"){
				west_2_north = true;
				height_west_2_north = (jQuery('#West_2_north').height())*multiple;
			}
			if(jQuery('#West_2_south').css('display') == "block"){
				west_2_south = true;
				height_west_2_south = (jQuery('#West_2_south').height())*multiple;
			}
			height_west_2_center = (jQuery('#West_2_center').height())*multiple;
		}
	}
	
	//getters for East_area_1
	if(jQuery('#East_area_1').css('display') == "block"){
		east_1 = true;
		width_east_1 = (jQuery('#East_area_1').width())*multiple;
		if(jQuery('#east1open').css('display') == "block"){
			east_1_open = true;
			if(jQuery('#East_1_north').css('display') == "block"){
				east_1_north = true;
				height_east_1_north = (jQuery('#East_1_north').height())*multiple;
			}
			if(jQuery('#East_1_south').css('display') == "block"){
				east_1_south = true;
				height_east_1_south = (jQuery('#East_1_south').height())*multiple;
			}
			height_east_1_center = (jQuery('#East_1_center').height())*multiple;
		}
	}
	
	//getters for East_area_2
	if(jQuery('#East_area_2').css('display') == "block"){
		east_2 = true;
		width_east_2 = (jQuery('#East_area_2').width())*multiple;
		if(jQuery('#east2open').css('display') == "block"){
			east_2_open = true;
			if(jQuery('#East_2_north').css('display') == "block"){
				east_2_north = true;
				height_east_2_north = (jQuery('#East_2_north').height())*multiple;
			}
			if(jQuery('#East_2_south').css('display') == "block"){
				east_2_south = true;
				height_east_2_south = (jQuery('#East_2_south').height())*multiple;
			}
			height_east_2_center = (jQuery('#East_2_center').height())*multiple;
		}
	}

	//preparing the variable to be send via AJAX
	var ajaxRequestDataPost = "themeAuthor=" + author + "\&themeAuthorURL=" + authorURL + "\&themeName=" + name + "\&themeURL=" + URL + "\&themeVersion=" + version + "\&themeTags=" + tags + "\&themeDescription=" + description + "\&themeLicence=" + licence + "\&top_ext=" + top_ext + "\&top_int=" + top_int + "\&west_1=" + west_1 + "\&west_2=" + west_2 + "\&east_1=" + east_1 + "\&east_2=" + east_2 + "\&bottom_int=" + bottom_int + "\&footer_1=" + footer_1 + "\&footer_2=" + footer_2 + "\&width=" + width + "\&height=" + height + "\&height_top_ext=" + height_top_ext + "\&top_ext_open=" + top_ext_open + "\&top_ext_west=" + top_ext_west + "\&width_top_ext_west=" + width_top_ext_west + "\&top_ext_east=" + top_ext_east + "\&width_top_ext_east=" + width_top_ext_east + "\&width_top_ext_center=" + width_top_ext_center + "\&height_top_int=" + height_top_int + "\&top_int_open=" + top_int_open + "&top_int_west=" + top_int_west + "\&width_top_int_west=" + width_top_int_west + "\&top_int_east=" + top_int_east + "\&width_top_int_east=" + width_top_int_east + "\&width_top_int_center=" + width_top_int_center + "\&height_footer_1=" + height_footer_1 + "\&footer_1_open=" + footer_1_open + "\&footer_1_west=" + footer_1_west + "\&width_footer_1_west=" + width_footer_1_west + "\&footer_1_east=" + footer_1_east + "\&width_footer_1_east=" + width_footer_1_east + "\&width_footer_1_center=" + width_footer_1_center + "\&height_footer_2=" + height_footer_2 + "\&footer_2_open=" + footer_2_open + "\&footer_2_west=" + footer_2_west + "\&width_footer_2_west=" + width_footer_2_west + "\&footer_2_east=" + footer_2_east + "\&width_footer_2_east=" + width_footer_2_east + "\&width_footer_2_center=" + width_footer_2_center + "\&height_bottom_int=" + height_bottom_int + "\&width_bottom_int=" + width_bottom_int + "\&bottom_int_open=" + bottom_int_open + "\&bottom_int_west=" + bottom_int_west + "\&width_bottom_int_west=" + width_bottom_int_west + "\&bottom_int_east=" + bottom_int_east + "\&width_bottom_int_east=" + width_bottom_int_east + "\&width_bottom_int_center=" + width_bottom_int_center + "\&width_west_1=" + width_west_1 + "\&west_1_open=" + west_1_open + "\&west_1_north=" + west_1_north + "\&height_west_1_north=" + height_west_1_north + "\&west_1_south=" + west_1_south + "\&height_west_1_south=" + height_west_1_south + "\&height_west_1_center=" + height_west_1_center + "\&width_west_2=" + width_west_2 + "\&west_2_open=" + west_2_open + "\&west_2_north=" + west_2_north + "\&height_west_2_north=" + height_west_2_north + "\&west_2_south=" + west_2_south + "\&height_west_2_south=" + height_west_2_south + "\&height_west_2_center=" + height_west_2_center + "\&width_east_1=" + width_east_1 + "\&east_1_open=" + east_1_open + "\&east_1_north=" + east_1_north + "\&height_east_1_north=" + height_east_1_north + "\&east_1_south=" + east_1_south + "\&height_east_1_south=" + height_east_1_south + "\&height_east_1_center=" + height_east_1_center + "\&width_east_2=" + width_east_2 + "\&east_2_open=" + east_2_open + "\&east_2_north=" + east_2_north + "\&height_east_2_north=" + height_east_2_north + "\&east_2_south=" + east_2_south + "\&height_east_2_south=" + height_east_2_south + "\&height_east_2_center=" + height_east_2_center;
	//actual AJAX request/response
	jQuery.ajax({
		method: "POST",
		url: "../wp-content/plugins/wowpth/createAdvancedTheme.php",
		data: ajaxRequestDataPost,
		beforeSend: function() {
			jQuery('#answerContainer').empty().append('Creazione in corso');
			jQuery('#answerContainer').css('visibility', 'visible');
		},
		success: function(response){
			jQuery('#answerContainer').empty().append(response);
		}
	})
}