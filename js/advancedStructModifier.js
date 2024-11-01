var west1Layout, west2Layout, east1Layout, east2Layout, headerLayout, topExternalLayout, footer1Layout, footer2Layout, topIntLayout;
var arrayLayout = new Array();
var i = 0;
function secondWest1Layout(){
	jQuery("#west1closed input").replaceWith('<input type="button" class="button" value="Open" onClick="openWest1()" />');
	jQuery("#west1closed").hide();
	jQuery("#West_area_1").append('<div id="west1open" class="layoutContainer"></div>');
	jQuery("#west1open").append('<div class="resArea" id="West_1_center">West 1 center<br /><input type="button" class="button" value="Close" onClick="closeWest1()" /></div>');
	jQuery("#west1open").append('<div class="ui-layout-north resArea" id="West_1_north">West 1 north</div>');
	jQuery("#west1open").append('<div class="ui-layout-south resArea" id="West_1_south">West 1 south</div>');
	
	west1Layout = jQuery('#west1open').layout({
		center__paneSelector: "#West_1_center"
		, spacing_open: 6
		, spacing_closed: 6
		, north__size: 150
		, south__size: 150
	});
	
	arrayLayout[i] = west1Layout;
	i++;
};

function closeWest1(){
	jQuery("#west1open").hide();
	jQuery("#west1closed").show();
};

function openWest1(){
	jQuery("#west1closed").hide();
	jQuery("#west1open").show();
	west1Layout.resizeAll();
};

function secondWest2Layout(){
	jQuery("#west2closed input").replaceWith('<input type="button" class="button" value="Open" onClick="openWest2()" />');
	jQuery("#west2closed").hide();
	jQuery("#West_area_2").append('<div id="west2open" class="layoutContainer"></div>');
	jQuery("#west2open").append('<div class="resArea" id="West_2_center">West 2 center<br /><input type="button" class="button" value="Close" onClick="closeWest2()" /></div>');
	jQuery("#west2open").append('<div class="ui-layout-north resArea" id="West_2_north">West 2 north</div>');
	jQuery("#west2open").append('<div class="ui-layout-south resArea" id="West_2_south">West 2 south</div>');
	
	west2Layout = jQuery('#west2open').layout({
		center__paneSelector: "#West_2_center"
		, spacing_open: 6
		, spacing_closed: 6
		, north__size: 150
		, south__size: 150
	});
	
	arrayLayout[i] = west2Layout;
	i++;
};

function closeWest2(){
	jQuery("#west2open").hide();
	jQuery("#west2closed").show();
};

function openWest2(){
	jQuery("#west2closed").hide();
	jQuery("#west2open").show();
	west2Layout.resizeAll();
};

function secondEast1Layout(){
	jQuery("#east1closed input").replaceWith('<input type="button" class="button" value="Open" onClick="openEast1()" />');
	jQuery("#east1closed").hide();
	jQuery("#East_area_1").append('<div id="east1open" class="layoutContainer"></div>');
	jQuery("#east1open").append('<div class="resArea" id="East_1_center">East 1 center<br /><input type="button" class="button" value="Close" onClick="closeEast1()" /></div>');
	jQuery("#east1open").append('<div class="ui-layout-north resArea" id="East_1_north">East 1 north</div>');
	jQuery("#east1open").append('<div class="ui-layout-south resArea" id="East_1_south">East 1 south</div>');
	
	east1Layout = jQuery('#east1open').layout({
		center__paneSelector: "#East_1_center"
		, spacing_open: 6
		, spacing_closed: 6
		, north__size: 150
		, south__size: 150
	});
	
	arrayLayout[i] = east1Layout;
	i++;
};

function closeEast1(){
	jQuery("#east1open").hide();
	jQuery("#east1closed").show();
};

function openEast1(){
	jQuery("#east1closed").hide();
	jQuery("#east1open").show();
	east1Layout.resizeAll();
};

function secondEast2Layout(){
	jQuery("#east2closed input").replaceWith('<input type="button" class="button" value="Open" onClick="openEast2()" />');
	jQuery("#east2closed").hide();
	jQuery("#East_area_2").append('<div id="east2open" class="layoutContainer"></div>');
	jQuery("#east2open").append('<div class="resArea" id="East_2_center">East 2 center<br /><input type="button" class="button" value="Close" onClick="closeEast2()" /></div>');
	jQuery("#east2open").append('<div class="ui-layout-north resArea" id="East_2_north">East 2 north</div>');
	jQuery("#east2open").append('<div class="ui-layout-south resArea" id="East_2_south">East 2 south</div>');

	east2Layout = jQuery('#east2open').layout({
		center__paneSelector: "#East_2_center"
		, spacing_open: 6
		, spacing_closed: 6
		, north__size: 150
		, south__size: 150
	});
	
	arrayLayout[i] = east2Layout;
	i++;
};

function closeEast2(){
	jQuery("#east2open").hide();
	jQuery("#east2closed").show();
};

function openEast2(){
	jQuery("#east2closed").hide();
	jQuery("#east2open").show();
	east2Layout.resizeAll();
};

function secondTopExtLayout(){
	jQuery("#topExtClosed input").replaceWith('<input type="button" class="button" value="Open" onClick="openTopExt()" />');
	jQuery("#topExtClosed").hide();
	jQuery("#Top_external_area").append('<div id="topExtOpen" class="layoutContainer"></div>');
	jQuery("#topExtOpen").append('<div class="resArea" id="Top_ext_center">Top external center <br /><input type="button" class="button" value="Close" onClick="closeTopExt()" /></div>');
	jQuery("#topExtOpen").append('<div class="top-ext-west resArea" id="Top_ext_west">Top external west</div>');
	jQuery("#topExtOpen").append('<div class="top-ext-east resArea" id="Top_ext_east">Top external east</div>');

	topExternalLayout = jQuery('#topExtOpen').layout({
		center__paneSelector: "#Top_ext_center"
		, west__paneSelector: "#Top_ext_west"
		, east__paneSelector: "#Top_ext_east"
		, spacing_open: 6
		, spacing_closed: 6
	});
	
	arrayLayout[i] = topExternalLayout;
	i++;
};

function closeTopExt(){
	jQuery("#topExtOpen").hide();
	jQuery("#topExtClosed").show();
};

function openTopExt(){
	jQuery("#topExtClosed").hide();
	jQuery("#topExtOpen").show();
	topExternalLayout.resizeAll();
};

function secondFooter1Layout(){
	jQuery("#footer1closed input").replaceWith('<input type="button" class="button" value="Open" onClick="openFooter1()" />');
	jQuery("#footer1closed").hide();
	jQuery("#Footer_area_1").append('<div id="footer1open" class="layoutContainer"></div>');
	jQuery("#footer1open").append('<div class="resArea" id="Footer_1_center">Footer 1 center <br /><input type="button" class="button" value="Close" onClick="closeFooter1()" /></div>');
	jQuery("#footer1open").append('<div class="resArea" id="Footer_1_west">Footer 1 west</div>');
	jQuery("#footer1open").append('<div class="resArea" id="Footer_1_east">Footer 1 east</div>');

	footer1Layout = jQuery('#footer1open').layout({
		center__paneSelector: "#Footer_1_center"
		, west__paneSelector: "#Footer_1_west"
		, east__paneSelector: "#Footer_1_east"
		, spacing_open: 6
		, spacing_closed: 6
	});
	
	arrayLayout[i] = footer1Layout;
	i++;
};

function closeFooter1(){
	jQuery("#footer1open").hide();
	jQuery("#footer1closed").show();
};

function openFooter1(){
	jQuery("#footer1closed").hide();
	jQuery("#footer1open").show();
	footer1Layout.resizeAll();
};

function secondFooter2Layout(){
	jQuery("#footer2closed input").replaceWith('<input type="button" class="button" value="Open" onClick="openFooter2()" />');
	jQuery("#footer2closed").hide();
	jQuery("#Footer_area_2").append('<div id="footer2open" class="layoutContainer"></div>');
	jQuery("#footer2open").append('<div class="resArea" id="Footer_2_center">Footer 2 center <br /><input type="button" class="button" value="Close" onClick="closeFooter2()" /></div>');
	jQuery("#footer2open").append('<div class="resArea" id="Footer_2_west">Footer 2 west</div>');
	jQuery("#footer2open").append('<div class="resArea" id="Footer_2_east">Footer 2 east</div>');

	footer2Layout = jQuery('#footer2open').layout({
		center__paneSelector: "#Footer_2_center"
		, west__paneSelector: "#Footer_2_west"
		, east__paneSelector: "#Footer_2_east"
		, spacing_open: 6
		, spacing_closed: 6
	});
	
	arrayLayout[i] = footer2Layout;
	i++;
};

function closeFooter2(){
	jQuery("#footer2open").hide();
	jQuery("#footer2closed").show();
};

function openFooter2(){
	jQuery("#footer2closed").hide();
	jQuery("#footer2open").show();
	footer2Layout.resizeAll();
};

function secondTopIntLayout(){
	jQuery("#topIntClosed input").replaceWith('<input type="button" class="button" value="Open" onClick="openTopInt()" />');
	jQuery("#topIntClosed").hide();
	jQuery("#Top_internal_area").append('<div id="topIntOpen" class="layoutContainer"></div>');
	jQuery("#topIntOpen").append('<div class="resArea" id="Top_int_center">Top int center <br /><input type="button" class="button" value="Close" onClick="closeTopInt()" /></div>')
	jQuery("#topIntOpen").append('<div class="resArea" id="Top_int_west">Top int west <br /></div>');
	jQuery("#topIntOpen").append('<div class="resArea" id="Top_int_east">Top int east</div>');
	
	var width = jQuery("#topIntOpen").width();
	
	topIntLayout = jQuery('#topIntOpen').layout({
		center__paneSelector: "#Top_int_center"
		, west__paneSelector: "#Top_int_west"
		, east__paneSelector: "#Top_int_east"
		, spacing_open: 6
		, spacing_closed: 6
		, center__size: ((width-14)/3)	
		, west__size: ((width-14)/3)
		, east__size: ((width-14)/3)
	});
	
	arrayLayout[i] = topIntLayout;
	i++;
};

function closeTopInt(){
	jQuery("#topIntOpen").hide();
	jQuery("#topIntClosed").show();
};

function openTopInt(){
	jQuery("#topIntClosed").hide();
	jQuery("#topIntOpen").show();
	topIntLayout.resizeAll();
};

function secondBottomIntLayout(){
	jQuery("#bottomIntClosed input").replaceWith('<input type="button" class="button" value="Open" onClick="openBottomInt()" />');
	jQuery("#bottomIntClosed").hide();
	jQuery("#Bottom_internal_area").append('<div id="bottomIntOpen" class="layoutContainer"></div>');
	jQuery("#bottomIntOpen").append('<div class="bottom_int_center resArea" id="Bottom_int_center">Bottom int center <br /><input type="button" class="button" value="Close" onClick="closeBottomInt()" /></div>')
	jQuery("#bottomIntOpen").append('<div class="bottom-int-west resArea" id="Bottom_int_west">Bottom int west <br /></div>');
	jQuery("#bottomIntOpen").append('<div class="bottom-int-east resArea" id="Bottom_int_east">Bottom int east</div>');
	
	var width = jQuery("#bottomIntOpen").width();
	
	bottomIntLayout = jQuery('#bottomIntOpen').layout({
		center__paneSelector: "#Bottom_int_center"
		, west__paneSelector: "#Bottom_int_west"
		, east__paneSelector: "#Bottom_int_east"
		, spacing_open: 6
		, spacing_closed: 6
		, center__size: ((width-14)/3)	
		, west__size: ((width-14)/3)
		, east__size: ((width-14)/3)
	});
	
	arrayLayout[i] = bottomIntLayout;
	i++;
};

function closeBottomInt(){
	jQuery("#bottomIntOpen").hide();
	jQuery("#bottomIntClosed").show();
};

function openBottomInt(){
	jQuery("#bottomIntClosed").hide();
	jQuery("#bottomIntOpen").show();
	bottomIntLayout.resizeAll();
};

function resizeContainer(){
	for(var j=0; j<arrayLayout.length; j++){
		arrayLayout[j].resizeAll();		
	}
};