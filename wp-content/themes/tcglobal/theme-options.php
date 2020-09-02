<?php

/** Tc global theme options **/
/* Hook - Add admin theme option  */

// Define settings fields - start
function theme_settings_page()
{
    ?>
	    <div class="wrap">
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}

function display_twitter_element()
{
	?>
    	<input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}
function display_facebook_element()
{
	?>
    	<input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}
function display_linkedin_element()
{
	?>
    	<input type="text" name="linkedin" id="linkedin" value="<?php echo get_option('linkedin'); ?>" />
    <?php
}
function display_youtube_element()
{
	?>
    	<input type="text" name="youtube" id="youtube" value="<?php echo get_option('youtube'); ?>" />
    <?php
}
function display_search_tool()
{?>
    <input type="text" name="search_tool" id="search_tool" value="<?php echo get_option('search_tool'); ?>" />
    
    <?php
}
function display_help_center()
{?>
	<input type="text" name="help_center" id="help_center" value="<?php echo get_option('help_center'); ?>" />
    
    <?php
}
function display_portal()
{?>
	<input type="text" name="portal" id="portal" value="<?php echo get_option('portal'); ?>" />
    <?php
}
function display_copy_element()
{?>
    <input type="text" name="copy" id="copy" value="<?php echo get_option('copy'); ?>" />
    
    <?php
}
function display_terms_element()
{?>
    <input type="text" name="terms" id="terms" value="<?php echo get_option('terms'); ?>" />
    <input type="text" name="terms_link" id="terms_link" value="<?php echo get_option('terms_link'); ?>" />
    <?php
}
function display_privacy_element()
{?>
    <input type="text" name="privacy" id="privacy" value="<?php echo get_option('privacy'); ?>" />
    <input type="text" name="privacy_link" id="privacy_link" value="<?php echo get_option('privacy_link'); ?>" />
    <?php
}
/** settings fields - ends **/

// Register our settings. Add the settings section, 
function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "theme-options");
	
    add_settings_field("search_tool", "Search Tool URL", "display_search_tool", "theme-options", "section");
	add_settings_field("help_center", "Help Center URL", "display_help_center", "theme-options", "section");
    add_settings_field("portal", "Portal URL", "display_portal", "theme-options", "section");
    add_settings_field("twitter_url", "Twitter URL", "display_twitter_element", "theme-options", "section");
    add_settings_field("facebook_url", "Facebook URL", "display_facebook_element", "theme-options", "section");
    add_settings_field("linkedin", "Linkedin URL", "display_linkedin_element", "theme-options", "section");
    add_settings_field("youtube", "Youtube URL", "display_youtube_element", "theme-options", "section");
    add_settings_field("copy", "Copy Right", "display_copy_element", "theme-options", "section");
    add_settings_field("terms", "Terms & Condition", "display_terms_element", "theme-options", "section");
    add_settings_field("privacy", "Privacy Policy", "display_privacy_element", "theme-options", "section");
   
   register_setting("section", "search_tool");
    register_setting("section", "help_center");
    register_setting("section", "portal");
    register_setting("section", "twitter_url");
    register_setting("section", "facebook_url");
    register_setting("section", "linkedin");
    register_setting("section", "youtube");
    register_setting("section", "copy");
    register_setting("section", "terms");
    register_setting("section", "terms_link");
    register_setting("section", "privacy");
    register_setting("section", "privacy_link");
    
}

add_action("admin_init", "display_theme_panel_fields");

/** Hook - To display admin option **/
function add_theme_menu_item()
{
	add_menu_page("Theme Option", "Theme Option", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");



