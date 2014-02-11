<?php
class class_social_widget extends WP_widget
{

	function class_social_widget()
	{
            $options = array(
                                    "classname" => "class_social_widget",
                                    "description" => "Managed in the Theme Options."
                                    );
            parent::WP_Widget( false, $name='Social Icons', $options);
        }

	function widget($arguments, $data)
	{
                $defaut = array("title" => "Social Icons");
                $data = wp_parse_args($data, $defaut);

                global $wpdb;
                $table_prefix = $wpdb->prefix;

                extract($arguments);

                echo $before_widget;
                echo '<h3>' . $data['title'] . '</h3>';
                echo '<nav class="social-icons">';
                $included = include(TEMPLATEPATH . "/includes/theme-social.php");
                echo "<nav/>";
                    
        echo $after_widget;
        }
	

	function update($content_new, $content_old)
	{
                $content_new['title'] = esc_attr($content_new['title']);
                return $content_new;
        }

	function form($data)
        {
                $defaut = array( "title" => "Yes, We're Social" );
                $data = wp_parse_args($data, $defaut);

                global $wpdb;
                $table_prefix = $wpdb->prefix;
                ?>
                    <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','dandy'); ?></label><br />
                    <input value="<?php echo $data['title']; ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" type="text" />
                    </p>
                <?php
                        
        }
} 
function social_widget()
{
	register_widget("class_social_widget");
}
add_action("widgets_init", "social_widget");

?>