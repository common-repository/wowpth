<?php
	//function to recursively copy all the files from a directory into another one
	function recursiveCopy($src,$dst) {
		$dir = opendir($src);
		@mkdir($dst);
			while(false !== ( $file = readdir($dir)) ) {
	        if (( $file != '.' ) && ( $file != '..' )) {
	            if ( is_dir($src . '/' . $file) ) {
	                recursiveCopy($src . '/' . $file, $dst . '/' . $file);
	            }
	            else {
	                copy($src . '/' . $file,$dst . '/' . $file);
	            }
	        }
	    }
	    closedir($dir);
	}
	
	function insertText($themeName,$pageName,$TopInText,$BottomInText) {
		$fh = fopen("../../themes/" . "$themeName" . "$pageName", 'r');
		$bytes = filesize("../../themes/" . "$themeName" . "$pageName");
		$testo = fread($fh,$bytes);
		fclose($fh);
		$fh = fopen("../../themes/" . "$themeName" . "$pageName", 'w');
		fwrite($fh,$TopInText);
		fclose($fh);
		$fh = fopen("../../themes/" . "$themeName" . "$pageName", 'a');
		fwrite($fh,$testo);
		fclose($fh);
		$fh = fopen("../../themes/" . "$themeName" . "$pageName", 'a');
		fwrite($fh,$BottomInText);
		fclose($fh);	
	}

	$themeName = $_REQUEST["themeName"];
	if($themeName == ""){
		echo ("You forgot to insert the theme's name");
	} else {
		$themePath = "../../themes/" . "$themeName";
		if (file_exists("$themePath")) {
			echo ("The name you specified already exists. Please chose another name");
		} else {
			//creates the folder for the theme, basing on the name specified in the form
			mkdir( "$themePath" );
			//copies all the files needed by the theme, except the main css, in the newly created folder
			recursiveCopy("themeStructure", "../../themes/" . "$themeName");
			//creates the sidebar.php template
			$i = 0;
			$positionSidebar = array();
			$nameSidebar = array();
			$positionFooter = array();
			$nameFooter = array();
			$positionTopExt = array();
			$nameTopExt = array();
			$positionTopInt = array();
			$nameTopInt = array();
			$positionBottomInt = array();
			$nameBottomInt = array();
			
			$cssOutput = "/*\n";
			$cssOutput .= "Theme Name: " . $_REQUEST["themeName"] . "\n";
			$cssOutput .= "Theme URI: " . $_REQUEST["themeURL"] . "\n";
			$cssOutput .= "Description: " . $_REQUEST["themeDescription"] . "\n";
			$cssOutput .= "Author: " . $_REQUEST["themeAuthor"] . "\n";
			$cssOutput .= "Author URI: " . $_REQUEST["themeAuthorURL"] . "\n";
			$cssOutput .= "Version: " . $_REQUEST["themeVersion"] . "\n";
			$cssOutput .= "License: " . $_REQUEST["themeLicence"] . "\n";
			$cssOutput .= "Tag: " . $_REQUEST["themeTags"] . "\n";
			$cssOutput .= "*/\n";
			$cssOutput .= "\n";
			//reset and basic styles
			$cssOutput .= "@import url('styles/reset.css');\n";
			$cssOutput .= "@import url('styles/rebuild.css');\n";
			$cssOutput .= "@import url('styles/wp.css');\n";
			$cssOutput .= "
body {margin: 1.5em 15%; font-family:Verdana, Geneva, sans-serif}
/* Header */
#branding {margin: 0 0 1.5em 0;}
/* Menu */
#access {margin: 0 0 1.5em 0; overflow: auto;}
.skip-link {display: none;}
.menu ul {list-style: none; margin: 0;}
.menu ul ul {display: none;}
.menu li {display: inline;}
.menu a {display: block; float: left;}
/* Content */
.post {margin: 0 0 3em 0;}
.entry-content, .entry-summary {margin: 1.5em 0 0 0;}
/* Navigation */
.navigation {margin: 0 0 1.5em 0; overflow: auto;}
/* Widget Areas */
.widget-area ul {list-style: none; margin-left: 0;}
.widget-area ul ul {list-style: disc; margin-left: 1.1em; padding: 5px;!important;}
.widget-area ul ul ul {margin-left: 2.5em;}
/*.widget-container {margin: 0 0 1.5em 0;}*/
#container {width:".floor($_REQUEST["width"])."px; float:left}
#wrapper {width:".floor($_REQUEST["width"])."px!important; margin: 0px auto;}
.widget-area {border-radius: 6px; -moz-border-radius: 6px; -webkit-border-radius: 6px; background-color:#E6E6E6; border: 1px solid #666666;}
.container {margin-top: 2px!important; margin-bottom: 2px!important}\n";

//graphic stuff
$cssOutput .= "
/* graphic info - not important for the proper functionality of the plugin */\n
body{font-family:Verdana, Geneva, sans-serif; background: #F1F1F1;}
a{text-decoration:none!important;}
.widget-area{background-color:#DDEEF6!important;}
.widget-area ul ul{padding: 5px!important;}
.widget-area ul {list-style: none!important}
.post{border-top:1px solid}
.entry-title{font-size:16px;border-top:1px solid}
.entry-meta{font-style:italic;border-bottom:1px dashed}

/* ***************** */\n\n";
			
			$heightMain = floor($_REQUEST["height"])-90-floor($_REQUEST["height_top_ext"])-2;
			$cssOutput .= "#main {min-height:".$heightMain."px!important;}\n";
			$sidebarOutput = "";
			$center = 24;
			$marginW = 0;
			$marginW2 = floor($_REQUEST["width"]);
			
			if( $_REQUEST["west_1"] == "true" ){
				$center = $center-6;
				$sidebarOutput .= "<div id=\"west_1\" class=\"widget-area container\">\n";
				$sidebarOutput .= "\t<ul class=\"xoxo\">\n";
				if( $_REQUEST["west_1_open"] == "false" ){
					$sidebarOutput .= "\t\t<?php dynamic_sidebar('west_1'); ?>\n";
					$i++;
					$positionSidebar[$i] = "West 1";
					$nameSidebar[$i] = "west_1";
				}
				else{
					$cssOutput .= "#west_1{ background:transparent!important; border:none!important }\n";
				}
				$width = floor($_REQUEST["width_west_1"]);
				$cssOutput .= "#west_1{ width:".$width."px; float:left; margin: 0px 0px 0px -".$marginW2."px; vertical-align:baseline; overflow:auto;}\n";
				$marginW = $marginW+$width+8;
				$marginW2 = $marginW2-$width-8;
				$width = $width-2;
				if( $_REQUEST["west_1_north"] == "true" ){
					$i++;
					$positionSidebar[$i] = "West 1 North";
					$nameSidebar[$i] = "west_1_north"; 					
					$sidebarOutput .= "\t\t<li><div id=\"west_1_north\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('west_1_north'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#west_1_north{ width:".$width."px; min-height:".floor($_REQUEST["height_west_1_north"])."px; float:left; overflow:auto;}\n";
				}
				if( $_REQUEST["west_1_open"] == "true" ){
					$i++;
					$positionSidebar[$i] = "West 1 Center";
					$nameSidebar[$i] = "west_1_center"; 					
					$sidebarOutput .= "\t\t<li><div id=\"west_1_center\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('west_1_center'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#west_1_center{ width:".$width."px; min-height:".floor($_REQUEST["height_west_1_center"])."px; margin:6px 0px; float:left; overflow:auto;}\n";
				}
				if( $_REQUEST["west_1_south"] == "true" ){
					$i++; 					
					$positionSidebar[$i] = "West 1 South";
					$nameSidebar[$i] = "west_1_south";
					$sidebarOutput .= "\t\t<li><div id=\"west_1_south\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('west_1_south'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#west_1_south{ width:".$width."px; min-height:".floor($_REQUEST["height_west_1_south"])."px; float:left; overflow:auto;}\n";
				}
				$sidebarOutput .= "\t</ul>\n";
				$sidebarOutput .= "</div>\n\n";
			}
			
			if( $_REQUEST["west_2"] == "true" ){
				$center = $center-6;
				$sidebarOutput .= "<div id=\"west_2\" class=\"widget-area container\">\n";
				$sidebarOutput .= "\t<ul class=\"xoxo\">\n";
				if( $_REQUEST["west_2_open"] == "false" ){
					$sidebarOutput .= "\t\t<?php dynamic_sidebar('west_2'); ?>\n";
					$i++;
					$positionSidebar[$i] = "West 2";
					$nameSidebar[$i] = "west_2";
				}
				else{
					$cssOutput .= "#west_2{ background:transparent!important; border:none!important }\n";
				}
				$width = floor($_REQUEST["width_west_2"]);
				$cssOutput .= "#west_2{ width:".$width."px; float:left; margin: 0px 0px 0px -".$marginW2."px; overflow:auto;}\n";
				$marginW = $marginW+$width+8;
				$width = $width-2;
				if( $_REQUEST["west_2_north"] == "true" ){
					$i++;
					$positionSidebar[$i] = "West 2 North";
					$nameSidebar[$i] = "west_2_north"; 					
					$sidebarOutput .= "\t\t<li><div id=\"west_2_north\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('west_2_north'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#west_2_north{ width:".$width."px; min-height:".floor($_REQUEST["height_west_2_north"])."px; float:left; overflow:auto;}\n";
				}
				if( $_REQUEST["west_2_open"] == "true" ){
					$i++;
					$positionSidebar[$i] = "West 2 Center";
					$nameSidebar[$i] = "west_2_center"; 					
					$sidebarOutput .= "\t\t<li><div id=\"west_2_center\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('west_2_center'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#west_2_center{ width:".$width."px; min-height:".floor($_REQUEST["height_west_2_center"])."px; margin:6px 0px; float:left; overflow:auto;}\n";
				}
				if( $_REQUEST["west_2_south"] == "true" ){
					$i++; 					
					$positionSidebar[$i] = "West 2 South";
					$nameSidebar[$i] = "west_2_south";
					$sidebarOutput .= "\t\t<li><div id=\"west_2_south\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('west_2_south'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#west_2_south{ width:".$width."px; min-height:".floor($_REQUEST["height_west_2_south"])."px; float:left; overflow:auto;}\n";
				}
				$sidebarOutput .= "\t</ul>\n";
				$sidebarOutput .= "</div>\n\n";
			}
			
			$marginE = 0;
			$marginE2 = 0;
			
			if( $_REQUEST["east_1"] == "true" ){
				$center = $center-6;
				$sidebarOutput .= "<div id=\"east_1\" class=\"widget-area container\">\n";
				$sidebarOutput .= "\t<ul class=\"xoxo\">\n";
				if( $_REQUEST["east_1_open"] == "false" ){
					$sidebarOutput .= "\t\t<?php dynamic_sidebar('east_1'); ?>\n";
					$i++;
					$positionSidebar[$i] = "East 1";
					$nameSidebar[$i] = "east_1";
				}
				else{
					$cssOutput .= "#east_1{ background:transparent!important; border:none!important }\n";
				}
				$width = floor($_REQUEST["width_east_1"]);
			    $marginE = $marginE+$width+8;
				$marginE2 = $marginE2+$width+2;
				$cssOutput .= "#east_1{ width:".$width."px; float:left; margin: 0px 0px 0px -".$marginE2."px; vertical-align:baseline; overflow:auto;}\n";
				$marginE2 = $marginE2+6;
				$width = $width-2;
				if( $_REQUEST["east_1_north"] == "true" ){
					$i++;
					$positionSidebar[$i] = "East 1 North";
					$nameSidebar[$i] = "east_1_north"; 					
					$sidebarOutput .= "\t\t<li><div id=\"east_1_north\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('east_1_north'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#east_1_north{ width:".$width."px; min-height:".floor($_REQUEST["height_east_1_north"])."px; float:left; overflow:auto;}\n";
				}
				if( $_REQUEST["east_1_open"] == "true" ){
					$i++;
					$positionSidebar[$i] = "East 1 Center";
					$nameSidebar[$i] = "east_1_center"; 					
					$sidebarOutput .= "\t\t<div id=\"east_1_center\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('east_1_center'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#east_1_center{ width:".$width."px; min-height:".floor($_REQUEST["height_east_1_center"])."px; margin:6px 0px; float:left; overflow:auto;}\n";
				}
				if( $_REQUEST["east_1_south"] == "true" ){
					$i++; 					
					$positionSidebar[$i] = "East 1 South";
					$nameSidebar[$i] = "east_1_south";
					$sidebarOutput .= "\t\t<li><div id=\"east_1_south\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('east_1_south'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#east_1_south{ width:".$width."px; min-height:".floor($_REQUEST["height_east_1_south"])."px; float:left; overflow:auto;}\n";
				}
				$sidebarOutput .= "\t</ul>\n";
				$sidebarOutput .= "</div>\n\n";
			}
			
			if( $_REQUEST["east_2"] == "true" ){
				$center = $center-6;
				$sidebarOutput .= "<div id=\"east_2\" class=\"widget-area container\">\n";
				$sidebarOutput .= "\t<ul class=\"xoxo\">\n";
				if( $_REQUEST["east_2_open"] == "false" ){
					$sidebarOutput .= "\t\t<?php dynamic_sidebar('east_2'); ?>\n";
					$i++;
					$positionSidebar[$i] = "East 2";
					$nameSidebar[$i] = "east_2";
				}
				else{
					$cssOutput .= "#east_2{ background:transparent!important; border:none!important }\n";
				}
				$width = floor($_REQUEST["width_east_2"]);
				$marginE = $marginE+$width+8;
				$marginE2 = $marginE2+$width+2;
				$cssOutput .= "#east_2{ width:".$width."px; float:left; margin: 0px 0px 0px -".$marginE2."px; vertical-align:baseline; overflow:auto;}\n";
				$width = $width-2;
				if( $_REQUEST["east_2_north"] == "true" ){
					$i++;
					$positionSidebar[$i] = "East 2 North";
					$nameSidebar[$i] = "east_2_north"; 					
					$sidebarOutput .= "\t\t<li><div id=\"east_2_north\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('east_2_north'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#east_2_north{ width:".$width."px; min-height:".floor($_REQUEST["height_east_2_north"])."px; float:left; overflow:auto;}\n";
				}
				if( $_REQUEST["east_2_open"] == "true" ){
					$i++;
					$positionSidebar[$i] = "East 2 Center";
					$nameSidebar[$i] = "east_2_center"; 					
					$sidebarOutput .= "\t\t<li><div id=\"east_2_center\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('east_2_center'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#east_2_center{ width:".$width."px; min-height:".floor($_REQUEST["height_east_2_center"])."px; margin:6px 0px; float:left; overflow:auto;}\n";
				}
				if( $_REQUEST["east_2_south"] == "true" ){
					$i++; 					
					$positionSidebar[$i] = "East 2 South";
					$nameSidebar[$i] = "east_2_south";
					$sidebarOutput .= "\t\t<li><div id=\"east_2_south\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('east_2_south'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#east_2_south{ width:".$width."px; min-height:".floor($_REQUEST["height_east_2_south"])."px; float:left; overflow:auto;}\n";
				}
				$sidebarOutput .= "\t</ul>\n";
				$sidebarOutput .= "</div>\n\n";
			}
			
			$cssOutput .= "#content{margin: 0px ".$marginE."px 0px ".$marginW."px}";
			$sidebars = $i;
						
			$j = 0;
			if( $_REQUEST["footer_1"] == "true" ){
				$sidebarOutput .= "<div id=\"footer_1\" class=\"widget-area container\">\n";
				$sidebarOutput .= "\t<ul class=\"xoxo\">\n";
				if( $_REQUEST["footer_1_open"] == "false" ){
					$sidebarOutput .= "\t\t<?php dynamic_sidebar('footer_1'); ?>\n";
					$j++;
					$positionFooter[$j] = "Footer 1";
					$nameFooter[$j] = "footer_1";
				}
				else{
					$cssOutput .= "#footer_1{ background:transparent!important; border:none!important }\n";
				}
				$height = floor($_REQUEST["height_footer_1"]);
				$cssOutput .= "#footer_1{ min-height:".$height."px; clear:both; overflow:auto;}\n";
				$height = $height-2;
				$gap = 4;
				if( $_REQUEST["footer_1_east"] == "true"){
					$gap = $gap-2;
				}
				if( $_REQUEST["footer_1_west"] == "true" ){
					$j++;
					$positionFooter[$j] = "Footer 1 West";
					$nameFooter[$j] = "footer_1_west";
					$sidebarOutput .= "\t\t<li><div id=\"footer_1_west\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('footer_1_west'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#footer_1_west{ min-height:".$height."px; width:".floor($_REQUEST["width_footer_1_west"])."px; float:left; overflow:auto;}\n";
					$gap = $gap-2;							
				}
				if( $_REQUEST["footer_1_open"] == "true" ){
					$j++;
					$positionFooter[$j] = "Footer 1 Center";
					$nameFooter[$j] = "footer_1_center";
					$sidebarOutput .= "\t\t<li><div id=\"footer_1_center\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('footer_1_center'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$widthCenter = floor($_REQUEST["width"])-floor($_REQUEST["width_footer_1_west"])-floor($_REQUEST["width_footer_1_east"])-20+$gap;
					$cssOutput .= "#footer_1_center{ min-height:".$height."px; width:".$widthCenter."px; float:left; margin:0px 6px; overflow:auto;}\n";							
				}
				if( $_REQUEST["footer_1_east"] == "true" ){
					$j++;
					$positionFooter[$j] = "Footer 1 East";
					$nameFooter[$j] = "footer_1_east";
					$sidebarOutput .= "\t\t<li><div id=\"footer_1_east\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('footer_1_east'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#footer_1_east{ min-height:".$height."px; width:".floor($_REQUEST["width_footer_1_east"])."px; float:left; overflow:auto;}\n";							
				}
				$sidebarOutput .= "\t</ul>\n";
				$sidebarOutput .= "</div>\n\n";
			}
			if( $_REQUEST["footer_2"] == "true" ){
				$sidebarOutput .= "<div id=\"footer_2\" class=\"widget-area container\">\n";
				$sidebarOutput .= "\t<ul class=\"xoxo\">\n";
				if( $_REQUEST["footer_2_open"] == "false" ){
					$sidebarOutput .= "\t\t<?php dynamic_sidebar('footer_2'); ?>\n";
					$j++;
					$positionFooter[$j] = "Footer 2";
					$nameFooter[$j] = "footer_2";
				}
				else{
					$cssOutput .= "#footer_2{ background:transparent!important; border:none!important }\n";
				}
				$height = floor($_REQUEST["height_footer_2"]);
				$cssOutput .= "#footer_2{ min-height:".$height."px; clear:both; overflow:auto;}\n";
				$height = $height-2;
				$gap = 4;
				if( $_REQUEST["footer_2_east"] == "true"){
					$gap = $gap-2;
				}
				if( $_REQUEST["footer_2_west"] == "true" ){
					$j++;
					$positionFooter[$j] = "Footer 2 West";
					$nameFooter[$j] = "footer_2_west";
					$sidebarOutput .= "\t\t<li><div id=\"footer_2_west\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('footer_2_west'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$localWidth = floor($_REQUEST["width_footer_2_west"]);							
					$cssOutput .= "#footer_2_west{ min-height:".$height."px; width:".floor($_REQUEST["width_footer_2_west"])."px; float:left; overflow:auto;}\n";
					$gap = $gap-2;
				}
				if( $_REQUEST["footer_2_open"] == "true" ){
					$j++;
					$positionFooter[$j] = "Footer 2 Center";
					$nameFooter[$j] = "footer_2_center";
					$sidebarOutput .= "\t\t<li><div id=\"footer_2_center\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('footer_2_center'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$widthCenter = floor($_REQUEST["width"])-floor($_REQUEST["width_footer_2_west"])-floor($_REQUEST["width_footer_2_east"])-20+$gap;
					$cssOutput .= "#footer_2_center{ min-height:".$height."px; width:".$widthCenter."px; float:left; margin:0px 6px; overflow:auto;}\n";
				}
				if( $_REQUEST["footer_2_east"] == "true" ){
					$j++;
					$positionFooter[$j] = "Footer 2 East";
					$nameFooter[$j] = "footer_2_east";
					$sidebarOutput .= "\t\t<li><div id=\"footer_2_east\" class=\"widget-area\">\n";
					$sidebarOutput .= "\t\t\t<ul class=\"xoxo\">\n";
					$sidebarOutput .= "\t\t\t\t<?php dynamic_sidebar('footer_2_east'); ?>\n";
					$sidebarOutput .= "\t\t\t</ul>\n";
					$sidebarOutput .= "\t\t</div></li>\n\n";
					$cssOutput .= "#footer_2_east{ min-height:".$height."px; width:".floor($_REQUEST["width_footer_2_east"])."px; float:left; overflow:auto;}\n";
				}
				$sidebarOutput .= "\t</ul>\n";
				$sidebarOutput .= "</div>\n\n";
			}
			
			$fh1 = fopen("../../themes/" . "$themeName" . "/sidebar.php", 'w');
			fwrite($fh1, $sidebarOutput);
			fclose($fh1);
			
			$footers = $j;
			$topextOutput = "";
			$y = 0;
			if( $_REQUEST["top_ext"] == "true" ){
				$topextOutput .= "\t\t<div id=\"top_ext\" class=\"widget-area container\">\n";
				$topextOutput .= "\t\t\t<ul class=\"xoxo\">\n";
				if( $_REQUEST["top_ext_open"] == "false" ){
					$topextOutput .= "\t\t\t\t<?php dynamic_sidebar('top_ext'); ?>\n";
					$y++;
					$positionTopExt[$y] = "Top Ext";
					$nameTopExt[$y] = "top_ext";
				}
				else{
					$cssOutput .= "#top_ext{ background:transparent!important; border:none!important }\n";
				}
				$height = floor($_REQUEST["height_top_ext"]);
				$cssOutput .= "#top_ext{ min-height:".$height."px; clear:both; overflow:auto;}\n";
				$height = $height-2;
				$gap = 4;
				if( $_REQUEST["top_ext_east"] == "true" ){
					$gap = $gap-2;
				}
				if( $_REQUEST["top_ext_west"] == "true" ){
					$y++;
					$positionTopExt[$y] = "Top Ext West";
					$nameTopExt[$y] = "top_ext_west";
					$topextOutput .= "\t\t\t\t<li><div id=\"top_ext_west\" class=\"widget-area\">\n";
					$topextOutput .= "\t\t\t\t\t<ul class=\"xoxo\">\n";
					$topextOutput .= "\t\t\t\t\t\t<?php dynamic_sidebar('top_ext_west'); ?>\n";
					$topextOutput .= "\t\t\t\t\t</ul>\n";
					$topextOutput .= "\t\t\t\t</div></li>\n\n";
					$cssOutput .= "#top_ext_west{ min-height:".$height."px; width:".floor($_REQUEST["width_top_ext_west"])."px; float:left; overflow:auto;}\n";
					$gap = $gap-2;
				}
				if( $_REQUEST["top_ext_open"] == "true" ){
					$y++;
					$positionTopExt[$y] = "Top Ext Center";
					$nameTopExt[$y] = "top_ext_center";
					$topextOutput .= "\t\t\t\t<li><div id=\"top_ext_center\" class=\"widget-area\">\n";
					$topextOutput .= "\t\t\t\t\t<ul class=\"xoxo\">\n";
					$topextOutput .= "\t\t\t\t\t\t<?php dynamic_sidebar('top_ext_center'); ?>\n";
					$topextOutput .= "\t\t\t\t\t</ul>\n";
					$topextOutput .= "\t\t\t\t</div></li>\n\n";
					$widthCenter = floor($_REQUEST["width"])-floor($_REQUEST["width_top_ext_west"])-floor($_REQUEST["width_top_ext_east"])-20+$gap;
					$cssOutput .= "#top_ext_center{ min-height:".$height."px; width:".$widthCenter."px; float:left; margin:0px 6px; overflow:auto;}\n";
				}
				if( $_REQUEST["top_ext_east"] == "true" ){
					$y++;
					$positionTopExt[$y] = "Top Ext East";
					$nameTopExt[$y] = "top_ext_east";
					$topextOutput .= "\t\t\t\t<li><div id=\"top_ext_east\" class=\"widget-area\">\n";
					$topextOutput .= "\t\t\t\t\t<ul class=\"xoxo\">\n";
					$topextOutput .= "\t\t\t\t\t\t<?php dynamic_sidebar('top_ext_east'); ?>\n";
					$topextOutput .= "\t\t\t\t\t</ul>\n";
					$topextOutput .= "\t\t\t\t</div></li>\n\n";
					$cssOutput .= "#top_ext_east{ min-height:".$height."px; width:".floor($_REQUEST["width_top_ext_east"])."px; float:left; overflow:auto;}\n";
				}
				$topextOutput .= "\t\t\t</ul>\n";
				$topextOutput .= "\t\t</div>\n\n";
			}
			
			$topextOutput .="\t</div><!-- #header -->\n\n";
			$topextOutput .="\t<div id=\"main\">";
			$fh4 = fopen("../../themes/" . "$themeName" . "/header.php",'a');
			fwrite($fh4, $topextOutput);
			fclose($fh4);
			
			$topExt = $y;
			
			$topintOutput = "";
			$topintOutput .= "<?php get_header(); ?>\n\n";
			$topintOutput .= "\t\t<div id=\"container\">";
			$z = 0;
			if( $_REQUEST["top_int"] == "true" ){
				$topintOutput .= "\t\t\t<div id=\"top_int\" class=\"widget-area container\">\n";
				$topintOutput .= "\t\t\t\t<ul class=\"xoxo\">\n";
				if( $_REQUEST["top_int_open"] == "false" ){
					$topintOutput .= "\t\t\t\t\t<?php dynamic_sidebar('top_int'); ?>\n";
					$z++;
					$positionTopInt[$z] = "Top Int";
					$nameTopInt[$z] = "top_int";
				}
				else{
					$cssOutput .= "#top_int{ background:transparent!important; border:none!important }\n";
				}
				$height = floor($_REQUEST["height_top_int"]);
				$cssOutput .= "#top_int{ min-height:".$height."px; clear:both; overflow:auto;}\n";
				$height = $height-2;
				$gap = 4;
				if( $_REQUEST["top_int_east"] == "true" ){
					$gap = $gap-2;
				}
				if( $_REQUEST["top_int_west"] == "true" ){
					$z++;
					$positionTopInt[$z] = "Top Int West";
					$nameTopInt[$z] = "top_int_west";
					$topintOutput .= "\t\t\t\t\t<li><div id=\"top_int_west\" class=\"widget-area\">\n";
					$topintOutput .= "\t\t\t\t\t\t<ul class=\"xoxo\">\n";
					$topintOutput .= "\t\t\t\t\t\t\t<?php dynamic_sidebar('top_int_west'); ?>\n";
					$topintOutput .= "\t\t\t\t\t\t</ul>\n";
					$topintOutput .= "\t\t\t\t\t</div></li>\n\n";
					$cssOutput .= "#top_int_west{ min-height:".$height."px; width:".floor($_REQUEST["width_top_int_west"])."px; float:left; overflow:auto;}\n";
					$gap = $gap-2;
				}
				if( $_REQUEST["top_int_open"] == "true" ){
					$z++;
					$positionTopInt[$z] = "Top Int Center";
					$nameTopInt[$z] = "top_int_center";
					$topintOutput .= "\t\t\t\t\t<li><div id=\"top_int_center\" class=\"widget-area\">\n";
					$topintOutput .= "\t\t\t\t\t\t<ul class=\"xoxo\">\n";
					$topintOutput .= "\t\t\t\t\t\t\t<?php dynamic_sidebar('top_int_center'); ?>\n";
					$topintOutput .= "\t\t\t\t\t\t</ul>\n";
					$topintOutput .= "\t\t\t\t\t</div></li>\n\n";
					$widthCenter = floor($_REQUEST["width"])-$marginE-$marginW-floor($_REQUEST["width_top_int_west"])-floor($_REQUEST["width_top_int_east"])-20+$gap;
					$cssOutput .= "#top_int_center{ min-height:".$height."px; width:".$widthCenter."px; float:left; margin:0px 6px; overflow:auto;}\n";
				}
				if( $_REQUEST["top_int_east"] == "true" ){
					$z++;
					$positionTopInt[$z] = "Top Int East";
					$nameTopInt[$z] = "top_int_east";
					$topintOutput .= "\t\t\t\t\t<li><div id=\"top_int_east\" class=\"widget-area\">\n";
					$topintOutput .= "\t\t\t\t\t\t<ul class=\"xoxo\">\n";
					$topintOutput .= "\t\t\t\t\t\t\t<?php dynamic_sidebar('top_int_east'); ?>\n";
					$topintOutput .= "\t\t\t\t\t\t</ul>\n";
					$topintOutput .= "\t\t\t\t\t</div></li>\n\n";
					$cssOutput .= "#top_int_east{ min-height:".$height."px; width:".floor($_REQUEST["width_top_int_east"])."px; float:left; overflow:auto;}\n";
				}
				$topintOutput .= "\t\t\t\t</ul>\n";
				$topintOutput .= "\t\t\t</div>\n\n";
			}
			$cssOutput .= "#top_int{margin: 0px ".$marginE."px 0px ".$marginW."px}";
			
			$topInt = $z;
			
			$v = 0;
			$bottomintOutput = "";
			if( $_REQUEST["bottom_int"] == "true" ){
				$bottomintOutput .= "\t\t\t<div id=\"bottom_int\" class=\"widget-area container\">\n";
				$bottomintOutput .= "\t\t\t\t<ul class=\"xoxo\">\n";
				if( $_REQUEST["bottom_int_open"] == "false" ){
					$bottomintOutput .= "\t\t\t\t\t<?php dynamic_sidebar('bottom_int'); ?>\n";
					$v++;
					$positionBottomInt[$v] = "Bottom Int";
					$nameBottomInt[$v] = "bottom_int";
				}
				else{
					$cssOutput .= "#bottom_int{ background:transparent!important; border:none!important }\n";
				}
				$height = floor($_REQUEST["height_bottom_int"]);
				$cssOutput .= "#bottom_int{ min-height:".$height."px; clear:both; overflow:auto;}\n";
				$height = $height-2;
				$gap = 4;
				if( $_REQUEST["bottom_int_east"] == "true" ){
					$gap = $gap-2;
				}
				if( $_REQUEST["bottom_int_west"] == "true" ){
					$v++;
					$positionBottomInt[$v] = "Bottom Int West";
					$nameBottomInt[$v] = "bottom_int_west";
					$bottomintOutput .= "\t\t\t\t\t<li><div id=\"bottom_int_west\" class=\"widget-area\">\n";
					$bottomintOutput .= "\t\t\t\t\t\t<ul class=\"xoxo\">\n";
					$bottomintOutput .= "\t\t\t\t\t\t\t<?php dynamic_sidebar('bottom_int_west'); ?>\n";
					$bottomintOutput .= "\t\t\t\t\t\t</ul>\n";
					$bottomintOutput .= "\t\t\t\t\t</div></li>\n\n";
					$cssOutput .= "#bottom_int_west{ min-height:".$height."px; width:".floor($_REQUEST["width_bottom_int_west"])."px; float:left; overflow:auto;}\n";
					$gap = $gap-2;
				}
				if( $_REQUEST["bottom_int_open"] == "true" ){
					$v++;
					$positionBottomInt[$v] = "Bottom Int Center";
					$nameBottomInt[$v] = "bottom_int_center";
					$bottomintOutput .= "\t\t\t\t\t<li><div id=\"bottom_int_center\" class=\"widget-area\">\n";
					$bottomintOutput .= "\t\t\t\t\t\t<ul class=\"xoxo\">\n";
					$bottomintOutput .= "\t\t\t\t\t\t\t<?php dynamic_sidebar('bottom_int_center'); ?>\n";
					$bottomintOutput .= "\t\t\t\t\t\t</ul>\n";
					$bottomintOutput .= "\t\t\t\t\t</div></li>\n\n";
					$widthCenter = floor($_REQUEST["width"])-$marginE-$marginW-floor($_REQUEST["width_bottom_int_west"])-floor($_REQUEST["width_bottom_int_east"])-20+$gap;
					$cssOutput .= "#bottom_int_center{ min-height:".$height."px; width:".$widthCenter."px; float:left; margin:0px 6px; overflow:auto;}\n";
				}
				if( $_REQUEST["bottom_int_east"] == "true" ){
					$v++;
					$positionBottomInt[$v] = "Bottom Int East";
					$nameBottomInt[$v] = "bottom_int_east";
					$bottomintOutput .= "\t\t\t\t\t<li><div id=\"bottom_int_east\" class=\"widget-area\">\n";
					$bottomintOutput .= "\t\t\t\t\t\t<ul class=\"xoxo\">\n";
					$bottomintOutput .= "\t\t\t\t\t\t\t<?php dynamic_sidebar('bottom_int_east'); ?>\n";
					$bottomintOutput .= "\t\t\t\t\t\t</ul>\n";
					$bottomintOutput .= "\t\t\t\t\t</div></li>\n\n";
					$cssOutput .= "#bottom_int_east{ min-height:".$height."px; width:".floor($_REQUEST["width_bottom_int_east"])."px; float:left; overflow:auto;}\n";
				}
				$bottomintOutput .= "\t\t\t\t</ul>\n";
				$bottomintOutput .= "\t\t\t</div>\n\n";
			}
			
			$bottomintOutput .= "\t\t</div><!-- #container -->\n\n";
			$bottomintOutput .= "<?php get_sidebar(); ?>\n";
			$bottomintOutput .= "<?php get_footer(); ?>";
			$cssOutput .= "#bottom_int{margin: 0px ".$marginE."px 0px ".$marginW."px}";
			
			insertText($themeName,"/404.php",$topintOutput,$bottomintOutput);
			insertText($themeName,"/archive.php",$topintOutput,$bottomintOutput);
			insertText($themeName,"/attachment.php",$topintOutput,$bottomintOutput);
			insertText($themeName,"/author.php",$topintOutput,$bottomintOutput);
			insertText($themeName,"/category.php",$topintOutput,$bottomintOutput);
			insertText($themeName,"/index.php",$topintOutput,$bottomintOutput);
			insertText($themeName,"/page.php",$topintOutput,$bottomintOutput);
			insertText($themeName,"/search.php",$topintOutput,$bottomintOutput);
			insertText($themeName,"/single.php",$topintOutput,$bottomintOutput);
			insertText($themeName,"/tag.php",$topintOutput,$bottomintOutput);

			$bottomInt = $v;
			
			//edits the functions.php support file, adding the registration function for the requested widget-areas
			$functionsOutput = "function theme_widgets_init() {\n";
			for($y = 1; $y <= $topExt; $y++) {
				$functionsOutput .= "\tregister_sidebar( array (\n";
				$functionsOutput .= "\t\t'name' => 'Widget Area " . "$positionTopExt[$y]" . "',\n";
				$functionsOutput .= "\t\t'id' => '" . "$nameTopExt[$y]" . "',\n";
				$functionsOutput .= "\t\t'before_widget' => '<li id=\"%1" . '$s' . "\" class=\"widget-container %2" . '$s' . "\">',\n";
				$functionsOutput .= "\t\t'after_widget' => \"</li>\",\n";
				$functionsOutput .= "\t\t'before_title' => '<h3 class=\"widget-title\">',\n";
				$functionsOutput .= "\t\t'after_title' => '</h3>',\n";
				$functionsOutput .= "\t) );\n\n";
			}
			for($z = 1; $z <= $topInt; $z++) {
				$functionsOutput .= "\tregister_sidebar( array (\n";
				$functionsOutput .= "\t\t'name' => 'Widget Area " . "$positionTopInt[$z]" . "',\n";
				$functionsOutput .= "\t\t'id' => '" . "$nameTopInt[$z]" . "',\n";
				$functionsOutput .= "\t\t'before_widget' => '<li id=\"%1" . '$s' . "\" class=\"widget-container %2" . '$s' . "\">',\n";
				$functionsOutput .= "\t\t'after_widget' => \"</li>\",\n";
				$functionsOutput .= "\t\t'before_title' => '<h3 class=\"widget-title\">',\n";
				$functionsOutput .= "\t\t'after_title' => '</h3>',\n";
				$functionsOutput .= "\t) );\n\n";
			}
			for($i = 1; $i <= $sidebars; $i++){
				$functionsOutput .= "\tregister_sidebar( array (\n";
				$functionsOutput .= "\t\t'name' => 'Widget Area " . "$positionSidebar[$i]" . "',\n";
				$functionsOutput .= "\t\t'id' => '" . "$nameSidebar[$i]" . "',\n";
				$functionsOutput .= "\t\t'before_widget' => '<li id=\"%1" . '$s' . "\" class=\"widget-container %2" . '$s' . "\">',\n";
				$functionsOutput .= "\t\t'after_widget' => \"</li>\",\n";
				$functionsOutput .= "\t\t'before_title' => '<h3 class=\"widget-title\">',\n";
				$functionsOutput .= "\t\t'after_title' => '</h3>',\n";
				$functionsOutput .= "\t) );\n\n";
			}
			for($v = 1; $v <= $bottomInt; $v++) {
				$functionsOutput .= "\tregister_sidebar( array (\n";
				$functionsOutput .= "\t\t'name' => 'Widget Area " . "$positionBottomInt[$v]" . "',\n";
				$functionsOutput .= "\t\t'id' => '" . "$nameBottomInt[$v]" . "',\n";
				$functionsOutput .= "\t\t'before_widget' => '<li id=\"%1" . '$s' . "\" class=\"widget-container %2" . '$s' . "\">',\n";
				$functionsOutput .= "\t\t'after_widget' => \"</li>\",\n";
				$functionsOutput .= "\t\t'before_title' => '<h3 class=\"widget-title\">',\n";
				$functionsOutput .= "\t\t'after_title' => '</h3>',\n";
				$functionsOutput .= "\t) );\n\n";
			}
			for($j = 1; $j <= $footers; $j++){
				$functionsOutput .= "\tregister_sidebar( array (\n";
				$functionsOutput .= "\t\t'name' => 'Widget Area " . "$positionFooter[$j]" . "',\n";
				$functionsOutput .= "\t\t'id' => '" . "$nameFooter[$j]" . "',\n";
				$functionsOutput .= "\t\t'before_widget' => '<li id=\"%1" . '$s' . "\" class=\"widget-container %2" . '$s' . "\">',\n";
				$functionsOutput .= "\t\t'after_widget' => \"</li>\",\n";
				$functionsOutput .= "\t\t'before_title' => '<h3 class=\"widget-title\">',\n";
				$functionsOutput .= "\t\t'after_title' => '</h3>',\n";
				$functionsOutput .= "\t) );\n\n";
			}

			$functionsOutput .= "}\n\n";
			$functionsOutput .= "add_action( 'init', 'theme_widgets_init' );\n\n";
			$fh2 = fopen("../../themes/" . "$themeName" . "/functions.php", 'a');
			fwrite($fh2, $functionsOutput);
			fclose($fh2);			
			
			$fh3 = fopen("../../themes/" . "$themeName" . "/style.css", 'w');
			fwrite($fh3, $cssOutput);
			fclose($fh3);
			//result to be printed in the user's page
			echo ("Theme \"" . "$themeName" . "\" successfully created!<br />You can now activate it in the \"Themes\" section of your administration page.");
		}
	}
?>