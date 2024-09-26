<?php
// this file hold all widgget registed in theme
class footer_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'footer_widget',
            __('Widget for footer', 'textdomain'),
            [
                'description' => __('This is widget for footer', 'textdomain'),
            ]
        );
    }
    function widget($args, $instance)
    {
        echo $args['before_widget'];
        $slogan = !empty($instance['slogan']) ? $instance['slogan'] : '';
        $location = !empty($instance['location']) ? $instance['location'] : '';
        $link_location = !empty($instance['link_location']) ? $instance['link_location'] : '#';
        $email = !empty($instance['email']) ? $instance['email'] : '';
        $number = !empty($instance['number']) ? $instance['number'] : '';
        $facebook = !empty($instance['facebook']) ? $instance['facebook'] : '';
        $instagram = !empty($instance['instagram']) ? $instance['instagram'] : '';
        $twitter = !empty($instance['twitter']) ? $instance['twitter'] : '';
        $linkedin = !empty($instance['linkedin']) ? $instance['linkedin'] : '';
        ?>
        <div class="logo">
            <?php
            $siteOption = get_option('site_theme_option');
            if (!$siteOption['site_logo']['url']) {
                ?>
                <h2 class="poppins-bold" style="font-size: 29px;" id="header-logo"><a href="<?php echo get_home_url(); ?>">YOUR
                        LOGO</a></h2>
                <?php
            } else {
                ?>
                <a href="<?php echo get_home_url(); ?>">
                    <img class="mb-3 auto img-logo" src="<?php echo $siteOption['site_logo']['url'] ?>" alt="logo">
                </a>
                <?php
            }
            ?>
        </div>
        <div style="width: 70%;">
            <p class="poppins-regular" style="word-wrap: break-word;"> <?php echo esc_html($slogan) ?></p>
        </div>
        <div style="display: flex;gap:30px;align-items: center;">
            <i class="fa-solid fa-location-crosshairs" style="color: black;"></i>
            <a href="<?php echo esc_url($link_location) ?>" class="text-footer location-link"
                style="margin: 0;"><?php echo esc_html($location) ?></a>
        </div>
        <div>
            <p class="text-footer" style="margin: 0;border-bottom: 1px solid #000;padding-bottom: 3px;width: fit-content;">
                <?php echo esc_html($email) ?></p>
            <p class="text-footer" style="margin: 0;"><?php echo esc_html($number) ?></p>
        </div>
        <div class="footer-brands" style="display: flex;gap:20px">
            <a href="<?php echo esc_url($facebook) ?>"><i class="fa-brands fa-facebook"></i></a>
            <a href="<?php echo esc_url($instagram) ?>"><i class="fa-brands fa-instagram"></i></a>
            <a href="<?php echo esc_url($twitter) ?>"><i class="fa-brands fa-twitter"></i></a>
            <a href="<?php echo esc_url($linkedin) ?>"><i class="fa-brands fa-linkedin"></i></a>
        </div>
        <?php
    }
    function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['slogan'] = (!empty($new_instance['slogan'])) ? sanitize_text_field($new_instance['slogan']) : '';
        $instance['location'] = (!empty($new_instance['location'])) ? sanitize_text_field($new_instance['location']) : '';
        $instance['link_location'] = (!empty($new_instance['link_location'])) ? esc_url_raw($new_instance['link_location']) : '';
        $instance['email'] = (!empty($new_instance['email'])) ? sanitize_text_field($new_instance['email']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? sanitize_text_field($new_instance['number']) : '';
        $instance['facebook'] = (!empty($new_instance['facebook'])) ? esc_url_raw($new_instance['facebook']) : '';
        $instance['instagram'] = (!empty($new_instance['instagram'])) ? esc_url_raw($new_instance['instagram']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter'])) ? esc_url_raw($new_instance['twitter']) : '';
        $instance['linkedin'] = (!empty($new_instance['linkedin'])) ? esc_url_raw($new_instance['linkedin']) : '';
        return $instance;
    }
    function form($instance)
    {
        $default = array(
            'slogan' => 'this is sologan',
            'location' => 'this is locaion',
            'link_location' => 'this is link for location',
            'email' => 'example@gmail.com.vn',
            'number' => '0123456789',
            'facebook' => '#',
            'instagram' => '#',
            'twitter' => '#',
            'linkedin' => '#',
        );
        $instance = wp_parse_args((array) $instance, $default);
        $slogan = esc_attr($instance['slogan']);
        $location = esc_attr($instance['location']);
        $link_location = esc_attr($instance['link_location']);
        $email = esc_attr($instance['email']);
        $number = esc_attr($instance['number']);
        $facebook = esc_attr($instance['facebook']);
        $instagram = esc_attr($instance['instagram']);
        $twitter = esc_attr($instance['twitter']);
        $linkedin = esc_attr($instance['linkedin']);
        ?>
        <p>nhập slogan<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('slogan')) ?>"
                value="<?php echo $slogan; ?>"></p>
        <p>nhập location<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('location')) ?>"
                value="<?php echo $location; ?>"></p>
        <p>nhập link cho location<input type="text" class="widefat"
                name="<?php echo esc_attr($this->get_field_name('link_location')) ?>" value="<?php echo $link_location; ?>">
        </p>
        <p>nhập email<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('email')) ?>"
                value="<?php echo $email; ?>"></p>
        <p>nhập number<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('number')) ?>"
                value="<?php echo $number; ?>"></p>
        <p>nhập facebook<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('facebook')) ?>"
                value="<?php echo $facebook; ?>"></p>
        <p>nhập instagram<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('instagram')) ?>"
                value="<?php echo $instagram; ?>"></p>
        <p>nhập twitter<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('twitter')) ?>"
                value="<?php echo $twitter; ?>"></p>
        <p>nhập linkedin<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('linkedin')) ?>"
                value="<?php echo $linkedin; ?>"></p>
        <?php
        return $instance;
    }
}
add_action('widgets_init', 'create_footer_widget');
function create_footer_widget()
{
    register_widget('footer_widget');
}