jQuery(document).ready(function () {
	jQuery("#MainLimit").width(800);
	jQuery("#MainLimit").append('<div class="extra-outer-center container">');	
	jQuery(".extra-outer-center").append('<div class="outer-center container">');
	jQuery(".outer-center").append('<div class="middle-center container">');
	jQuery(".middle-center").append('<div class="inner-center resArea" id="Main_block">Main block</div>');
	jQuery(".middle-center").append('<div class="ui-layout-north resArea" id="Top_internal_area"><div id="topIntClosed" class="layoutContainer">Top internal area<br/><input type="button" onClick="secondTopIntLayout()" class="button" value="Open" /></div></div>');
	jQuery(".middle-center").append('<div class="ui-layout-south resArea" id="Bottom_internal_area"><div id="bottomIntClosed" class="layoutContainer">Bottom internal area<br/><input type="button" class="button" value="Open" onClick="secondBottomIntLayout()"/></div></div>');
	jQuery(".outer-center").append('<div class="middle-west resArea" id="West_area_2"><div id="west2closed" class="layoutContainer">West area 2<br/><input type="button" class="button" value="Open" onClick="secondWest2Layout()" /></div></div>');
	jQuery(".outer-center").append('<div class="middle-east resArea" id="East_area_2"><div id="east2closed" class="layoutContainer">East area 2<br/><input type="button" class="button" value="Open" onClick="secondEast2Layout()" /></div></div>');
	jQuery(".extra-outer-center").append('<div class="outer-west resArea" id="West_area_1"><div id="west1closed" class="layoutContainer">West area 1<br/><input type="button" class="button" value="Open" onClick="secondWest1Layout()" /></div></div>');
	jQuery(".extra-outer-center").append('<div class="outer-east resArea" id="East_area_1"><div id="east1closed" class="layoutContainer">East area 1<br/><input type="button" class="button" value="Open" onClick="secondEast1Layout()" /></div></div>');
	jQuery(".extra-outer-center").append('<div class="ui-layout-north resArea" id="Top_external_area"><div id="topExtClosed" class="layoutContainer">Top external area<br/><input type="button" class="button" value="Open" onClick="secondTopExtLayout()" /></div></div>');
	jQuery(".extra-outer-center").append('<div class="ui-layout-south resArea" id="Footer_area_1"><div id="footer1closed" class="layoutContainer">Footer area 1<br/><input type="button" class="button" value="Open" onClick="secondFooter1Layout()" /></div></div>');
	jQuery("#MainLimit").append('<div class="ui-layout-north resArea" id="Header">Header</div>');
	jQuery("#MainLimit").append('<div class="ui-layout-south resArea" id="Footer_area_2"><div id="footer2closed" class="layoutContainer">Footer area 2<br/><input type="button" class="button" value="Open" onClick="secondFooter2Layout()" /></div></div>');

	var outerLayout, middleLayout, innerLayout, extraOuterLayout;
	
	extraOuterLayout = jQuery('#MainLimit').layout({
		center__paneSelector: ".extra-outer-center"
		, spacing_open: 6 
		, spacing_closed: 6 
		, north__size: 75
		, south__size: 75
		, south__minSize: 50
		, north__closable: false
		, north__resizable: false
	});
	
	outerLayout = jQuery('.extra-outer-center').layout({
		center__paneSelector: ".outer-center"
		, west__paneSelector: ".outer-west"
		, east__paneSelector: ".outer-east"
		, spacing_open: 6 
		, spacing_closed: 6 
		, north__size: 75
		, south__size: 75
		, west__size: 100
		, east__size: 100
		, north__minSize: 50
		, south__minSize: 50
		, west__minSize: 50
		, east__minSize: 50
		, north__onresize: "resizeContainer()"
		, south__onresize: "resizeContainer()"
		, west__onclose: "resizeContainer()"
		, east__onclose: "resizeContainer()"
	});
	
	middleLayout = jQuery('div.outer-center').layout({
		center__paneSelector: ".middle-center"
		, west__paneSelector: ".middle-west"
		, east__paneSelector: ".middle-east"
		, spacing_open: 6 
		, spacing_closed: 6 
		, west__size: 100
		, east__size: 100
		, west__minSize: 50
		, east__minSize: 50
		, east__onresize: "resizeContainer()"
		, west__onresize: "resizeContainer()"
		, west__onclose: "resizeContainer()"
		, east__onclose: "resizeContainer()"
	});
	
	innerLayout = jQuery('div.middle-center').layout({
		center__paneSelector: ".inner-center"
		, spacing_open: 6 
		, spacing_closed: 6 
		, west__spacing_closed: 6
		, east__spacing_closed: 6
		, north__size: 75
		, south__size: 75
		, north__minSize: 50
		, south__minSize: 50
	});

	jQuery('#layoutWidth').attr('value', 800);
	jQuery('#layoutMinHeight').attr('value', 900);

	jQuery("#widthSlider").slider({
		slide: function(event, ui){
				jQuery("#layoutWidth").attr("value", ui.value)
				jQuery("#MainLimit > div").hide();
				var height = jQuery("#layoutMinHeight").attr("value");
				var size = ((height*800)/ui.value);
				jQuery("#MainLimit").height(size);
				jQuery("#advancedPreviewArea").height(size);
				jQuery("#MainLimit").css("border-width", "2px")
			}
		, stop: function(event, ui){
				jQuery("#MainLimit > div").show();
				jQuery("#MainLimit").css("border-width", "0px");
				extraOuterLayout.resizeAll();
				outerLayout.resizeAll();
				middleLayout.resizeAll();
				innerLayout.resizeAll();
				resizeContainer();
			}
		, value: 800
		, min: 600
		, max: 2000
		, step: 2
	});
	
	jQuery("#heightSlider").slider({
		slide: function(event, ui){
				jQuery("#layoutMinHeight").attr("value", ui.value)
				jQuery("#MainLimit > div").hide();
				var width = jQuery("#layoutWidth").attr("value");
				var size = ((ui.value*800)/width);
				jQuery("#MainLimit").height(size);
				jQuery("#advancedPreviewArea").height(size);
				jQuery("#MainLimit").css("border-width", "2px")
			}
		, stop: function(event, ui){
				jQuery("#MainLimit > div").show();
				jQuery("#MainLimit").css("border-width", "0px");
				extraOuterLayout.resizeAll();
				outerLayout.resizeAll();
				middleLayout.resizeAll();
				innerLayout.resizeAll();
				resizeContainer();
			}
		, value: 900
		, min: 600
		, max: 2000
		, step: 2
	});
	
	jQuery("#layoutWidth").live('change', function(){
		if(jQuery("#layoutWidth").attr("value") < 600){
			jQuery("#layoutWidth").attr("value", 600);	
		}
		if(jQuery("#layoutWidth").attr("value") > 2000){
			jQuery("#layoutWidth").attr("value", 2000);	
		}
		var width = jQuery("#layoutWidth").attr("value");
		var height = jQuery("#layoutMinHeight").attr("value");
		var size = ((height*800)/width);
		jQuery("#MainLimit").height(size);
		jQuery("#advancedPreviewArea").height(size);
		extraOuterLayout.resizeAll();
		outerLayout.resizeAll();
		middleLayout.resizeAll();
		innerLayout.resizeAll();
		resizeContainer();
		jQuery("#widthSlider").slider("option", "value", height);
	});
	
	jQuery("#layoutMinHeight").live('change', function(){
		if(jQuery("#layoutMinHeight").attr("value") < 600){
			jQuery("#layoutMinHeight").attr("value", 600);	
		}
		if(jQuery("#layoutMinHeight").attr("value") > 2000){
			jQuery("#layoutMinHeight").attr("value", 2000);	
		}
		var width = jQuery("#layoutWidth").attr("value");
		var height = jQuery("#layoutMinHeight").attr("value");
		var size = ((height*800)/width);
		jQuery("#MainLimit").height(size);
		jQuery("#advancedPreviewArea").height(size);
		extraOuterLayout.resizeAll();
		outerLayout.resizeAll();
		middleLayout.resizeAll();
		innerLayout.resizeAll();
		resizeContainer();
		jQuery("#heightSlider").slider("option", "value", height);
	});
	jQuery("#editorContainer").hide();
});

function ajaxAction(){
	if(jQuery("#advancedEditorContainer").css('display') == 'none'){
		ajaxThemeCreation();
	}
	else{
		ajaxAdvancedThemeCreation();
	}
};

function simpleEditor(){
	jQuery("#advancedEditorContainer").hide();
	jQuery("#editorContainer").show();
};