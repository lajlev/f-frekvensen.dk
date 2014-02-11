<?php
class class_dribbble_widget extends WP_widget
{

	function class_dribbble_widget()
	{
            $options = array(
                                    "classname" => "class_dribbble_widget",
                                    "description" => "Displaying your latest Dribbble Shots (just set your user name in the Theme Options)."
                                    );
            parent::WP_Widget( false, $name='Dribbble', $options);
        }

	function widget($arguments, $data)
	{
                $defaut = array("title" => "Dribbble");
                $data = wp_parse_args($data, $defaut);

                global $wpdb;
                $table_prefix = $wpdb->prefix;

                extract($arguments);

                echo $before_widget;
                echo '<h3>' . $data['title'] . '</h3>';
                $html = print ('<ul class="shotsByPlayerId"></ul>');
                    
        echo $after_widget;
        }
	

	function update($content_new, $content_old)
	{
                $content_new['title'] = esc_attr($content_new['title']);
                return $content_new;
        }

	function form($data)
        {
                $defaut = array( "title" => "dribbble" );
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
function dribbble_widget()
{
	register_widget("class_dribbble_widget");
}
add_action("widgets_init", "dribbble_widget");

?>