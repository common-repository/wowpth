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

	$themeName = $_GET["themeName"];	
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
			$sidebarOutput = "";
			for($i = 1; $i <= $_GET["sidebars"]; $i++){
				$sidebarOutput .= "<div id=\"sidebar" . "$i" . "\" class=\"widget-area\">\n";
				$sidebarOutput .= "\t<ul class=\"xoxo\">\n";
				$sidebarOutput .= "\t\t<?php dynamic_sidebar('widget_area_". "$i" ."'); ?>\n";
				$sidebarOutput .= "\t</ul>\n";
				$sidebarOutput .= "</div>\n\n";
			}			
			for($j = 1; $j <= $_GET["footers"]; $j++){
				$sidebarOutput .= "<div id=\"footer" . "$j" . "\" class=\"widget-area\">\n";
				$sidebarOutput .= "\t<ul class=\"xoxo\">\n";
				$sidebarOutput .= "\t\t<?php dynamic_sidebar('footer_widget_area_". "$j" ."'); ?>\n";
				$sidebarOutput .= "\t</ul>\n";
				$sidebarOutput .= "</div>\n\n";
			}
			
			$fh1 = fopen("../../themes/" . "$themeName" . "/sidebar.php", 'w');
			fwrite($fh1, $sidebarOutput);
			fclose($fh1);
			
			$TopInText = "<?php get_header(); ?>\n\n";
			$TopInText .= "\t\t<div id=\"container\">\n";
			$TopInText .= "\t\t\t<div id=\"topInWidgetArea\" class=\"widget-area\">\n";
			$TopInText .= "\t\t\t\t<ul class=\"xoxo\">\n";
			$TopInText .= "\t\t\t\t\t<?php dynamic_sidebar('top_in_widget_area'); ?>\n";
			$TopInText .= "\t\t\t\t</ul>\n";
			$TopInText .= "\t\t\t</div>\n\n";
			
			$BottomInText = "\t\t\t<div id=\"bottomInWidgetArea\" class=\"widget-area\">\n";
			$BottomInText .= "\t\t\t\t<ul class=\"xoxo\">\n";
			$BottomInText .= "\t\t\t\t\t<?php dynamic_sidebar('bottom_in_widget_area'); ?>\n";
			$BottomInText .= "\t\t\t\t</ul>\n";
			$BottomInText .= "\t\t\t</div>\n\n";
			$BottomInText .= "\t\t</div><!-- #container -->\n\n";
			$BottomInText .= "<?php get_sidebar(); ?>\n";
			$BottomInText .= "<?php get_footer(); ?>";
			
			$TopOutText = "\t\t<div id=\"topOutWidgetArea\" class=\"widget-area\">\n";
			$TopOutText .= "\t\t\t<ul class=\"xoxo\">\n";
			$TopOutText .= "\t\t\t\t<?php dynamic_sidebar('top_out_widget_area'); ?>\n";
			$TopOutText .= "\t\t\t</ul>\n";
			$TopOutText .= "\t\t</div>\n";
			$TopOutText .= "\t</div><!-- #header -->\n\n";
			$TopOutText .= "\t<div id=\"main\">\n";
			
			insertText($themeName,"/404.php",$TopInText,$BottomInText);
			insertText($themeName,"/archive.php",$TopInText,$BottomInText);
			insertText($themeName,"/attachment.php",$TopInText,$BottomInText);
			insertText($themeName,"/author.php",$TopInText,$BottomInText);
			insertText($themeName,"/category.php",$TopInText,$BottomInText);
			insertText($themeName,"/index.php",$TopInText,$BottomInText);
			insertText($themeName,"/page.php",$TopInText,$BottomInText);
			insertText($themeName,"/search.php",$TopInText,$BottomInText);
			insertText($themeName,"/single.php",$TopInText,$BottomInText);
			insertText($themeName,"/tag.php",$TopInText,$BottomInText);
			
			$fh1 = fopen("../../themes/" . "$themeName" . "/header.php", 'a');
			fwrite($fh1,$TopOutText);
			fclose($fh1);
			
			//edits the functions.php support file, adding the registration function for the requested widget-areas
			$functionsOutput = "function theme_widgets_init() {\n";
			if( $_GET["topOut"] == 1) {
				$functionsOutput .= "\tregister_sidebar( array (\n";
				$functionsOutput .= "\t\t'name' => 'Widget Area Above Columns',\n";
				$functionsOutput .= "\t\t'id' => 'top_out_widget_area',\n";
				$functionsOutput .= "\t\t'before_widget' => '<li id=\"%1" . '$s' . "\" class=\"widget-container %2" . '$s' . "\">',\n";
				$functionsOutput .= "\t\t'after_widget' => \"</li>\",\n";
				$functionsOutput .= "\t\t'before_title' => '<h3 class=\"widget-title\">',\n";
				$functionsOutput .= "\t\t'after_title' => '</h3>',\n";
				$functionsOutput .= "\t) );\n\n";
			}
			for($i = 1; $i <= $_GET["sidebars"]; $i++){
				$functionsOutput .= "\tregister_sidebar( array (\n";
				$functionsOutput .= "\t\t'name' => 'Lateral Widget Area " . "$i" . "',\n";
				$functionsOutput .= "\t\t'id' => 'widget_area_" . "$i" . "',\n";
				$functionsOutput .= "\t\t'before_widget' => '<li id=\"%1" . '$s' . "\" class=\"widget-container %2" . '$s' . "\">',\n";
				$functionsOutput .= "\t\t'after_widget' => \"</li>\",\n";
				$functionsOutput .= "\t\t'before_title' => '<h3 class=\"widget-title\">',\n";
				$functionsOutput .= "\t\t'after_title' => '</h3>',\n";
				$functionsOutput .= "\t) );\n\n";
			}
			if( $_GET["topIn"] == 1 ) {
				$functionsOutput .= "\tregister_sidebar( array (\n";
				$functionsOutput .= "\t\t'name' => 'Widget Area Above Main Block',\n";
				$functionsOutput .= "\t\t'id' => 'top_in_widget_area',\n";
				$functionsOutput .= "\t\t'before_widget' => '<li id=\"%1" . '$s' . "\" class=\"widget-container %2" . '$s' . "\">',\n";
				$functionsOutput .= "\t\t'after_widget' => \"</li>\",\n";
				$functionsOutput .= "\t\t'before_title' => '<h3 class=\"widget-title\">',\n";
				$functionsOutput .= "\t\t'after_title' => '</h3>',\n";
				$functionsOutput .= "\t) );\n\n";
			}
			if( $_GET["bottomIn"] == 1 ) {
				$functionsOutput .= "\tregister_sidebar( array (\n";
				$functionsOutput .= "\t\t'name' => 'Widget Area Below Main Block',\n";
				$functionsOutput .= "\t\t'id' => 'bottom_in_widget_area',\n";
				$functionsOutput .= "\t\t'before_widget' => '<li id=\"%1" . '$s' . "\" class=\"widget-container %2" . '$s' . "\">',\n";
				$functionsOutput .= "\t\t'after_widget' => \"</li>\",\n";
				$functionsOutput .= "\t\t'before_title' => '<h3 class=\"widget-title\">',\n";
				$functionsOutput .= "\t\t'after_title' => '</h3>',\n";
				$functionsOutput .= "\t) );\n\n";
			}
			for($j = 1; $j <= $_GET["footers"]; $j++){
				$functionsOutput .= "\tregister_sidebar( array (\n";
				$functionsOutput .= "\t\t'name' => 'Footer Widget Area " . "$j" . "',\n";
				$functionsOutput .= "\t\t'id' => 'footer_widget_area_" . "$j" . "',\n";
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
			//creates the css file, basing on the structure informations specified in the form
			//header
			$cssOutput = "/*\n";
			$cssOutput .= "Theme Name: " . $_GET["themeName"] . "\n";
			$cssOutput .= "Theme URI: " . $_GET["themeURL"] . "\n";
			$cssOutput .= "Description: " . $_GET["themeDescription"] . "\n";
			$cssOutput .= "Author: " . $_GET["themeAuthor"] . "\n";
			$cssOutput .= "Author URI: " . $_GET["themeAuthorURL"] . "\n";
			$cssOutput .= "Version: " . $_GET["themeVersion"] . "\n";
			$cssOutput .= "License: " . $_GET["themeLicence"] . "\n";
			$cssOutput .= "Tag: " . $_GET["themeTags"] . "\n";
			$cssOutput .= "*/\n";
			$cssOutput .= "\n";
			//reset and basic styles
			$cssOutput .= "@import url('styles/reset.css');\n";
			$cssOutput .= "@import url('styles/rebuild.css');\n";
			$cssOutput .= "@import url('styles/wp.css');\n";	
			//custom structure
			if($_GET["themeCols"] == 1 ){ //single column
				//NIENTE DA AGGIUNGERE
			} else if($_GET["themeCols"] == 2 && $_GET["mainPos"] == "left"){ //two columns, main on the left
				$cssOutput .= "@import url('styles/2c-r.css');\n";			
			} else if($_GET["themeCols"] == 2 && $_GET["mainPos"] == "right") { //two columns, main on the right
				$cssOutput .= "@import url('styles/2c-l.css');\n";
			} else if($_GET["themeCols"] == 3 && $_GET["mainPos"] == "center") { //three columns, main in the middle
				$cssOutput .= "@import url('styles/3c-b.css');\n";
			} else if($_GET["themeCols"] == 3 && $_GET["mainPos"] == "left") { //three columns, main on the left
				$cssOutput .= "@import url('styles/3c-r.css');\n";
			} else if($_GET["themeCols"] == 3 && $_GET["mainPos"] == "right") { //three columns, main on the right
				$cssOutput .= "@import url('styles/3c-l.css');\n";
			}
			//displaying other widget areas
			if( $_GET["topOut"] == 0 ) {
				$cssOutput .= "#topOutWidgetArea {display: none;}";
			}
			if( $_GET["topIn"] == 0 ) {
				$cssOutput .= "#topInWidgetArea {display: none;}";
			}
			if( $_GET["bottomIn"] == 0 ) {
				$cssOutput .= "#bottomInWidgetArea {display: none;}";
			}			
			//remaining css rules
			$cssOutput .= "
body {margin: 1.5em 15%;}
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
.widget-area ul ul {list-style: disc; margin-left: 1.1em;}
.widget-area ul ul ul {margin-left: 2.5em;}
.widget-container {margin: 0 0 1.5em 0;}
#sidebar1{ background: rgb(199,255,171); border: 1px solid rgb(0, 128, 0);}
#sidebar2{ background: rgb(199,255,171); border: 1px solid rgb(0, 128, 0);}
#footer1{ min-height: 10px; background: rgb(199,255,171); border: 1px solid rgb(0, 128, 0); clear: both;}
#footer2{ min-height: 10px; background: rgb(199,255,171); border: 1px solid rgb(0, 128, 0); clear: both;}
#topOutWidgetArea{ min-height: 10px; background: rgb(199,255,171); border: 1px solid rgb(0, 128, 0); clear: both;}
#topInWidgetArea{ min-height: 10px; background: rgb(199,255,171); border: 1px solid rgb(0, 128, 0); clear: both;}
#bottomInWidgetArea{ min-height: 10px; background: rgb(199,255,171); border: 1px solid rgb(0, 128, 0); clear: both;}";
			$fh3 = fopen("../../themes/" . "$themeName" . "/style.css", 'w');
			fwrite($fh3, $cssOutput);
			fclose($fh3);
			//result to be printed in the user's page
			echo ("Theme \"" . "$themeName" . "\" successfully created!<br />You can now activate it in the \"Themes\" section of your administration page.");
		}
	}
?>