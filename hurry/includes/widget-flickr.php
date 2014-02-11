<?php
class class_flickr_widget extends WP_widget
{

	function class_flickr_widget()
	{
            $options = array(
                                    "classname" => "class_flickr_widget",
                                    "description" => "Displaying your flickr feed (just set your user name in the Theme Options)."
                                    );
            parent::WP_Widget( false, $name='Flickr', $options);
        }

	function widget($arguments, $data)
	{
                $defaut = array("title" => "Flickr");
                $data = wp_parse_args($data, $defaut);

                global $wpdb;
                $table_prefix = $wpdb->prefix;

                extract($arguments);

                echo $before_widget;
                echo '<h3>' . $data['title'] . '</h3>';
                $html = print ('<div class="flickr-feed"></div>');
                    
        echo $after_widget;
        }
	

	function update($content_new, $content_old)
	{
                $content_new['title'] = esc_attr($content_new['title']);
                return $content_new;
        }

	function form($data)
        {
                $defaut = array( "title" => "flickr" );
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
function flickr_widget()
{
	register_widget("class_flickr_widget");
}
add_action("widgets_init", "flickr_widget");

?>