<?php
/*Plugin Name: WoWPth
Plugin URI: http://morpheus.micc.unifi.it/wowpth/
Description: A WordPress plugin to create a theme and customize its structure in an easy and interactive way
Version: 2.0
Author: MICC
Author URI: http://www.micc.unifi.it/
License: Creative Commons CC-BY-NC-SA
*/
add_action('admin_menu', 'interactiveTE_menu');
wp_enqueue_style("ITE_style", "/wp-content/plugins/wowpth/css/style.css", false, "1.0", "screen");
wp_enqueue_style("previewDefault", "/wp-content/plugins/wowpth/css/preview/default.css", array('ITE_style'), "1.0", "screen");
wp_enqueue_style("preview-choice", "/wp-content/plugins/wowpth/css/preview/1c.css", array('ITE_style', 'previewDefault'), "1.0", "screen");
wp_enqueue_script('jquery');
wp_enqueue_script("jquery-ui-script", "/wp-content/plugins/wowpth/js/jquery-ui-1.8.11.custom.min.js", array('jquery'), "1.0", false);
wp_enqueue_script("jqueryLayout", "/wp-content/plugins/wowpth/js/jquery.layout-latest.js", array('jquery'), "1.0", false);
wp_enqueue_script("ITE_structModifier", "/wp-content/plugins/wowpth/js/structModifier.js", array('jquery'), "1.0", false);
wp_enqueue_script("ajaxThemeCreation", "/wp-content/plugins/wowpth/js/ajaxThemeCreation.js", array('jquery'), "1.0", false);
wp_enqueue_script("ITE_preview", "/wp-content/plugins/wowpth/js/preview.js", array('jquery'), "1.0", false);
wp_enqueue_script("ATE_structModifier", "/wp-content/plugins/wowpth/js/advancedStructModifier.js", array('jquery'), "1.0", false);
wp_enqueue_script("ajaxAdvancedThemeCreation","/wp-content/plugins/wowpth/js/ajaxAdvancedThemeCreation.js", array('jquery'), "1.0", false);
wp_enqueue_script("ATE_preview", "/wp-content/plugins/wowpth/js/advancedPreview.js",array('jquery'), "1.0", false);

function interactiveTE_menu() {
	add_theme_page("WoWPth", "WoWPth", 'edit_themes', 'interactive_theme_editor', 'interactiveTE_page');
}

function interactiveTE_page(){
	?>
		<div class="wrap">
			<div id="icon-themes" class="icon32"><br /></div>
			<h2>Create your theme</h2>

			<form id="formITE" method="post" action="javascript:ajaxAction()">
				<div class="ITE_block" id="generalInfos">
					<h3>General informations</h3>
					<div id="ITE_block_innerContainer">
						<div id="ITE_block_first">
							<!-- Theme's author -->
							<label for="themeAuthor">Theme author: </label><br />
							<input type="text" size="34" id="themeAuthor" name="themeAuthor" /><br />
							<br />
							<br />
							<!-- Theme's name -->
							<label for="themeName">Theme's name <em>(required)</em>: </label><br />
							<input type="text" size="34" id="themeName" name="themeName" /><br />
							<!-- Theme's URL -->
							<label for="themeURL">Where the theme can be found (URL): </label><br />
							<input type="text" size="34" id="themeURL" name="themeURL" /><br />
							<br />
							<!-- Theme's description -->
							<label class="generalInfosTextareaLabel" for="themeDescription">Theme's description: </label><br />
							<textarea rows="4" cols="40" id="themeDescription" name="themeDescription"></textarea><br />
						</div>
						<div id="ITE_block_second">
							<!-- Theme's author's URL -->
							<label for="themeAuthorURL">Theme author's URL: </label><br />
							<input type="text" size="34" id="themeAuthorURL" name="themeAuthorURL" /><br />
							<br />
							<br />
							<!-- Theme's tags -->
							<label for="themeTags">Tags (comma separated): </label><br />
							<input type="text" size="34" id="themeTags" name="themeTags" /><br />
							<!-- Theme's version -->
							<label for="themeVersion">Theme's version: </label><br />
							<input type="text" size="34" id="themeVersion" name="themeVersion" /><br />
							<br />
							<!-- Theme's licence -->
							<label class="generalInfosTextareaLabel" for="themeLicence">Licence informations: </label><br />
							<textarea rows="4" cols="40" id="themeLicence" name="themeLicence"></textarea>
						</div>
					</div><!-- innerContainer -->
				</div><!-- generalInfos -->

				<div id="editorContainer">
                <div class="ITE_block" id="structInfos">
					<table style="width:100%">
                    	<tr>
                        	<td class="tdStructInfos" id="tdSILeft">
                    			<h3>Your theme's structure</h3>
                            </td>
                            <td class="tdStructInfos" id="tdSIRight">
                    			<p><input type="button" id="AE" class="button" value="Advanced editor" onclick="advancedEditor()"/></p>
                            </td>
                        </tr>
					</table>
                    
					<div id="optionsArea">
						<div class="ITE_block" id="colsDefArea">
							Columns number<br />
							<div class="button" id="lessCols" onclick="lessCols()">-</div>
							<input type="text" size="3" id="themeCols" name="themeCols" disabled="disabled" />
							<div class="button" id="moreCols">+</div>
						</div><!-- colsDefArea -->

						<div class="ITE_block" id="colsPosArea">
							Main column position:
							<select id="mainPos" name="mainPos">
								<option value="left">Left</option>
								<option id="positionValueCenter" value="center">Center</option>
								<option value="right">Right</option>
							</select><br />
						</div><!-- colsPosArea -->

						<p class="ITE_block">
							Your theme's structure will be based on the number of columns specified above.<br />
							<br />
							The theme will feature all the widget areas that will be activated (blue and green) in the preview on the right.<br />
							<br />
							<em>Click on</em> <b>grey</b> <em>areas to activate them.<br />
							</em><b>White dashed</b> <em>areas cannot be activated yet.<br />
							Click on</em> <b>green</b> <em>areas to deactivate them.<br /> 
							</em><b>Blue</b><em> areas cannot be deactivated.</em>
						</p>
					</div><!-- optionsArea -->

					<div class="ITE_block" id="previewArea">
						<div class="ITE_preview_block_unclickable" id="pre_header">Header</div>
						<div class="ITE_preview_block_clickable" id="pre_topOutArea" title="deact">Top external widget area</div>
						<div class="ITE_preview_block_clickable" id="pre_topInArea" title="deact">Top internal widget area</div>
						<div class="ITE_preview_block_unclickable" id="pre_mainCol">Main block</div>
						<div class="ITE_preview_block_clickable" id="pre_bottomInArea" title="deact">Bottom internal widget area</div>
						<div class="ITE_preview_block_clickable" id="pre_footer1" title="deact">Footer widget area 1</div>
						<div class="ITE_preview_block_clickable" id="pre_footer2" title="unact">Footer widget area 2</div>
						<div class="ITE_preview_block_clickable" id="pre_sidebar1" title="deact">Lateral area 1</div>
						<div class="ITE_preview_block_clickable" id="pre_sidebar2" title="unact">Lateral area 2</div>
					</div><!-- previewArea -->

				</div><!-- structInfos -->
                </div><!-- editorContainer --> 
                
                <div id="advancedEditorContainer">
			  	<div class="ITE_block" id="advancedStructInfos" name="advancedStructInfos">
                    <table id="tableASInfos">	
                        <tr>
                    		<td id="tdASIStructure"><h3 align="left">Your theme's structure</h3> 
                           		<div class="ITE_block">
                               		<label for="layoutWidth">Layout Width: </label>
                           	   		<input type="text" id="layoutWidth" class="layoutSize" value="800" maxlength="4" size="5" /><br />
                                    <div id="widthSlider"></div>
                                    <label for="layoutMinHeight">Layout Min-Height: </label>
                                    <input type="text" id="layoutMinHeight" class="layoutSize" value="900" maxlength="4" size="5" /><br />
                               		<div id="heightSlider"></div>
                               	</div></td>
                            <td id="tdASISpace"><h3>&nbsp;</h3></td>
	                    	<td id="layoutHelper"><p><input type="button" id="SE" class="button" value="Simple editor" onclick="simpleEditor()"/>
                            </p>
                            <p id="infos" class="ITE_block"><em>Resize the areas using the handles between them.</em><br /><em>Click on </em><b id="grey">GREY</b><em> rectangles between areas to close them.</em><br /></p></td>
                    	</tr>
                    </table>
                </div>
                <div class="ITE_block" id="advancedPreviewArea" align="center">              
                    <div class="container" id="MainLimit">
                        <p><em>Resizing...</em></p>
                    </div>
                </div>
				</div> <!-- advancedEditorContainer -->

				<div>
					<input type="submit" name="search" value="Generate" class="button" />
				</div>
			</form>
			
			<div class="ITE_block" id="answerContainer"></div>
		</div><!-- wrap -->
	<?php
}
?>
