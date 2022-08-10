<?php
/* Custom Settings Page */

add_action('admin_menu', 'add_contact_menu');

function add_contact_menu () {  
    add_options_page('Website Settings', get_bloginfo('site_name'), 'manage_options', 'functions', 'custom_options');  
}

function custom_options () {  
    wp_enqueue_script('dashboard');
?>  
    <div class="wrap">  
        <h2><?php bloginfo('site_name'); ?></h2>
        
        <style>
            #custom_settings_form label {
                display: inline-block;
                font-size: 15px;
                margin: 0px 10px 0px 0px;
                text-align: right;
                vertical-align: top;
                width: 150px;
            }

            #custom_settings_form input[type=text] {
                margin-bottom: 5px;
                vertical-align: middle;
            }

            #custom_settings_form textarea.contact_map {
                margin-bottom: 5px;
                vertical-align: middle;
                width: 100%;
                max-width: 375px;
            }

            #custom_settings_form .hours-table td {
                text-align: center;
            }

            #custom_settings_form .hours {
                width: 95% !important;
            }
            
            #custom_settings_form .postbox .hndle {
                cursor: pointer !important;
            }
            
            #custom_settings_form .postbox .inside {
                padding-top: 15px;
                padding-bottom: 15px;
            }
		</style>
        
        <form id="custom_settings_form" method="post" action="options.php">  
		<?php wp_nonce_field('update-options') ?>
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-1">
                <div id="postbox-container-2" class="postbox-container">
                    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                        
                        <!-- Contact Information -->

                        <div class="postbox" id="headerdiv">
                            <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: headerdiv</span><span class="toggle-indicator" aria-hidden="true"></span></button>
                            <h3 class="hndle"><span>Contact Information</span></h3>

                            <div class="inside">        
                                <label>Company</label>
                                <input type="text" name="company_name" size="45" value="<?php echo get_option('company_name'); ?>" /><br />
                                <label>Contact Name</label>
                                <input type="text" name="contact_name" size="45" value="<?php echo get_option('contact_name'); ?>" /><br />
                                <label>Contact Email</label>
                                <input type="text" name="admin_email" size="45" value="<?php echo get_option('admin_email'); ?>" /><br />
                                <label>Phone Number</label>
                                <input type="text" name="contact_phone" size="45" value="<?php echo get_option('contact_phone'); ?>" /><br />
                                <label>Toll Free</label>
                                <input type="text" name="contact_toll_free" size="45" value="<?php echo get_option('contact_toll_free'); ?>" /><br />
                                <label>Fax</label>
                                <input type="text" name="contact_fax" size="45" value="<?php echo get_option('contact_fax'); ?>" /><br />
                                <label>Street Address</label>
                                <input type="text" name="contact_address" size="45" value="<?php echo get_option('contact_address'); ?>" /><br />
                                <label>City</label>
                                <input type="text" name="contact_city" size="45" value="<?php echo get_option('contact_city'); ?>" /><br />
                                <label>Province</label>
                                <input type="text" name="contact_province" size="45" value="<?php echo get_option('contact_province'); ?>" /><br />
                                <label>Postal Code</label>
                                <input type="text" name="contact_postal_code" size="45" value="<?php echo get_option('contact_postal_code'); ?>" /><br />
                                <label>Map</label>
                                <textarea class="contact_map" name="contact_map"><?php echo get_option('contact_map'); ?></textarea><br />
                            </div>
                        </div>
                        
                        <!-- Social Media -->

                        <div class="postbox" id="headerdiv">
                            <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: headerdiv</span><span class="toggle-indicator" aria-hidden="true"></span></button>
                            <h3 class="hndle"><span>Social Media</span></h3>

                            <div class="inside">        
                                <label>Facebook</label>
                                <input type="text" name="facebook_url" size="45" value="<?php echo get_option('facebook_url'); ?>" /><br />
                                <label>Instagram</label>
                                <input type="text" name="instagram_url" size="45" value="<?php echo get_option('instagram_url'); ?>" /><br />
                                <label>Twitter</label>
                                <input type="text" name="twitter_url" size="45" value="<?php echo get_option('twitter_url'); ?>" /><br />
                                <label>YouTube</label>
                                <input type="text" name="youtube_url" size="45" value="<?php echo get_option('youtube_url'); ?>" /><br />
                                <label>LinkedIn</label>
                                <input type="text" name="linkedin_url" size="45" value="<?php echo get_option('linkedin_url'); ?>" /><br />
                            </div>
                        </div>
                        
                        <!-- Business Hours -->

                        <div class="postbox" id="headerdiv">
                            <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: headerdiv</span><span class="toggle-indicator" aria-hidden="true"></span></button>
                            <h3 class="hndle"><span>Business Hours</span></h3>

                            <div class="inside">        
                                <table class="hours-table" cellpadding="5" cellspacing="0" style="margin-left: 50px;" width="550">
                                <tr>
                                    <th width="50%">Day(s)</th>
                                    <th width="50%">Hours</th>
                                </tr>
                                <tr>
                                    <td class="instructions">Example: Monday, or Monday - Friday</th>
                                    <td class="instructions">Example: 10:00am - 9:30pm</th>
                                </tr>
                                <tr>
                                    <td><input type="text" class="hours" name="days_1" value="<?php echo get_option('days_1'); ?>" /></td>
                                    <td><input type="text" class="hours" name="hours_1" value="<?php echo get_option('hours_1'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="hours" name="days_2" value="<?php echo get_option('days_2'); ?>" /></td>
                                    <td><input type="text" class="hours" name="hours_2" value="<?php echo get_option('hours_2'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="hours" name="days_3" value="<?php echo get_option('days_3'); ?>" /></td>
                                    <td><input type="text" class="hours" name="hours_3" value="<?php echo get_option('hours_3'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="hours" name="days_4" value="<?php echo get_option('days_4'); ?>" /></td>
                                    <td><input type="text" class="hours" name="hours_4" value="<?php echo get_option('hours_4'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="hours" name="days_5" value="<?php echo get_option('days_5'); ?>" /></td>
                                    <td><input type="text" class="hours" name="hours_5" value="<?php echo get_option('hours_5'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="hours" name="days_6" value="<?php echo get_option('days_6'); ?>" /></td>
                                    <td><input type="text" class="hours" name="hours_6" value="<?php echo get_option('hours_6'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="hours" name="days_7" value="<?php echo get_option('days_7'); ?>" /></td>
                                    <td><input type="text" class="hours" name="hours_7" value="<?php echo get_option('hours_7'); ?>" /></td>
                                </tr>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Call to Action -->

                        <div class="postbox" id="headerdiv">
                            <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: headerdiv</span><span class="toggle-indicator" aria-hidden="true"></span></button>
                            <h3 class="hndle"><span>Call to Action</span></h3>

                            <div class="inside">
                                <?php
                                    $cta_content = get_option('cta_content');
                                    $editor_id = 'cta_content';

                                    wp_editor($cta_content, $editor_id);
                                ?>
                            </div>
                        </div>

                        <!-- Theme Settings -->

                        <div class="postbox" id="headerdiv">
                            <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: headerdiv</span><span class="toggle-indicator" aria-hidden="true"></span></button>
                            <h3 class="hndle"><span>Theme Settings</span></h3>

                            <div class="inside">
                                <table class="form-table">
                                <tbody>
                                    <tr>
                                        <th>Show Top Bar</th>
                                        <td>
                                            <?php
                                                $show_top_bar = get_option('show_top_bar');
    
                                                if ($show_top_bar) {
                                                    $checked = ' checked ';
                                                } else {
                                                    $checked = ' ';
                                                }
                                            ?>
                                            <input<?php echo $checked; ?>type="checkbox" name="show_top_bar" value="1" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Show Breadcrumbs</th>
                                        <td>
                                            <?php
                                                $show_breadcrumbs = get_option('show_breadcrumbs');
    
                                                if ($show_breadcrumbs) {
                                                    $checked = ' checked ';
                                                } else {
                                                    $checked = ' ';
                                                }
                                            ?>
                                            <input<?php echo $checked; ?>type="checkbox" name="show_breadcrumbs" value="1" />
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
            
		<input class="button-primary" type="submit" name="Submit" value="Save" /></p>  
        <input type="hidden" name="action" value="update" />  
        <input type="hidden" name="page_options" value="
            company_name,
            contact_name,
            admin_email,
            contact_phone,
            contact_toll_free,
            contact_fax,
            contact_address,
            contact_city,
            contact_province,
            contact_postal_code,
            contact_map,
            facebook_url,
            instagram_url,
            linkedin_url,
            twitter_url,
            youtube_url,
            days_1,
            hours_1,
            days_2,
            hours_2,
            days_3,
            hours_3,
            days_4,
            hours_4,
            days_5,
            hours_5,
            days_6,
            hours_6,
            days_7,
            hours_7,
            cta_content, 
            show_top_bar,
            show_breadcrumbs
		" />  
        </form>  
    </div>
<?php  
} 
?>