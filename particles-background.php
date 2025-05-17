<?php
/*
 * Plugin Name: Particles Background Ultimate by DDG - site go-studio.pro
* Description: Полные настройки фона из частиц с выбором страниц и цветов
 * Plugin URI: https://www.go-studio.pro/plugin/particles 
 * Plugin Info: wp-content/plugins/particles-background/readme.txt
 * Description: [EN] Animated waves on the background of the site with color settings and the number of page IDs. [RU] Анимированные волны на фоне сайта с настройками цвета, и количества ID страниц.
 * Version: 2.0 : 17.05.2025
 * Author: Dorel Dankov
 */

if (!defined('ABSPATH')) exit;

class Particles_Background_Ultimate {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'settings_init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        add_action('wp_body_open', array($this, 'add_container'));
    }

    public function add_admin_menu() {
        add_options_page(
            'Particles by DDG',
            'Particles by DDG',
            'manage_options',
            'particles-background',
            array($this, 'render_settings_page')
        );
    }

    public function settings_init() {
        register_setting('particles_settings_group', 'particles_settings');

        // Основная секция
        add_settings_section(
            'particles_basic_section',
            'Основные настройки',
            array($this, 'render_section_description'),
            'particles-background'
        );

        // Поля настроек
        $this->add_field('selected_pages', 'Страницы для отображения', 'render_pages_field');
        $this->add_field('particles_number', 'Количество частиц', 'render_number_field');
        $this->add_field('particles_speed', 'Скорость частиц', 'render_speed_field');
        
        // Цвета частиц
        $this->add_field('particles_color_1', 'Цвет частиц 1', 'render_color1_field');
        $this->add_field('particles_color_2', 'Цвет частиц 2', 'render_color2_field');
        $this->add_field('particles_color_3', 'Цвет частиц 3', 'render_color3_field');
        
        // Линии
        $this->add_field('lines_enabled', 'Линии между частицами', 'render_lines_field');
        $this->add_field('lines_color', 'Цвет линий', 'render_lines_color_field');
        $this->add_field('lines_width', 'Толщина линий', 'render_lines_width_field');
        
        // Фон
        $this->add_field('background_type', 'Тип фона', 'render_bg_type_field');
        $this->add_field('background_color', 'Цвет фона', 'render_bg_color_field');
        $this->add_field('gradient_start', 'Градиент (начало)', 'render_gradient_start_field');
        $this->add_field('gradient_end', 'Градиент (конец)', 'render_gradient_end_field');
        $this->add_field('gradient_angle', 'Угол градиента (deg)', 'render_gradient_angle_field');
    }

    private function add_field($name, $title, $callback) {
        add_settings_field(
            'particles_'.$name,
            $title,
            array($this, $callback),
            'particles-background',
            'particles_basic_section'
        );
    }

    public function render_section_description() {
        echo '<p>Настройте внешний вид фона из частиц</p>';
    }

    // Методы рендеринга полей
    public function render_pages_field() {
        $options = get_option('particles_settings');
        $pages = get_pages();
        
        echo '<select name="particles_settings[selected_pages][]" multiple style="height:150px;width:300px;">';
        foreach ($pages as $page) {
            $selected = isset($options['selected_pages']) && in_array($page->ID, (array)$options['selected_pages']) ? 'selected' : '';
            echo '<option value="'.esc_attr($page->ID).'" '.$selected.'>'.esc_html($page->post_title).'</option>';
        }
        echo '</select><p class="description">Выберите страницы для отображения (удерживайте Ctrl для выбора нескольких)</p>';
    }

    public function render_number_field() {
        $options = get_option('particles_settings');
        echo '<input type="number" name="particles_settings[particles_number]" value="'.esc_attr($options['particles_number'] ?? 80).'" min="10" max="500">';
    }

    public function render_speed_field() {
        $options = get_option('particles_settings');
        echo '<input type="number" step="0.1" name="particles_settings[particles_speed]" value="'.esc_attr($options['particles_speed'] ?? 3).'" min="0.1" max="10">';
    }

    public function render_color1_field() {
        $options = get_option('particles_settings');
        echo '<input type="color" name="particles_settings[particles_color_1]" value="'.esc_attr($options['particles_color_1'] ?? '#ff0000').'">';
    }

    public function render_color2_field() {
        $options = get_option('particles_settings');
        echo '<input type="color" name="particles_settings[particles_color_2]" value="'.esc_attr($options['particles_color_2'] ?? '#00ff00').'">';
    }

    public function render_color3_field() {
        $options = get_option('particles_settings');
        echo '<input type="color" name="particles_settings[particles_color_3]" value="'.esc_attr($options['particles_color_3'] ?? '#0000ff').'">';
    }

    public function render_lines_field() {
        $options = get_option('particles_settings');
        echo '<select name="particles_settings[lines_enabled]">
              <option value="1" '.selected($options['lines_enabled'] ?? 1, 1, false).'>Включены</option>
              <option value="0" '.selected($options['lines_enabled'] ?? 1, 0, false).'>Выключены</option>
              </select>';
    }

    public function render_lines_color_field() {
        $options = get_option('particles_settings');
        echo '<input type="color" name="particles_settings[lines_color]" value="'.esc_attr($options['lines_color'] ?? '#ffffff').'">';
    }

    public function render_lines_width_field() {
        $options = get_option('particles_settings');
        echo '<input type="number" step="0.1" name="particles_settings[lines_width]" value="'.esc_attr($options['lines_width'] ?? 1).'" min="0.1" max="5"> px';
    }

    public function render_bg_type_field() {
        $options = get_option('particles_settings');
        echo '<select name="particles_settings[background_type]">
              <option value="color" '.selected($options['background_type'] ?? 'color', 'color', false).'>Однотонный</option>
              <option value="gradient" '.selected($options['background_type'] ?? 'color', 'gradient', false).'>Градиент</option>
              </select>';
    }

    public function render_bg_color_field() {
        $options = get_option('particles_settings');
        echo '<input type="color" name="particles_settings[background_color]" value="'.esc_attr($options['background_color'] ?? '#000000').'">';
    }

    public function render_gradient_start_field() {
        $options = get_option('particles_settings');
        echo '<input type="color" name="particles_settings[gradient_start]" value="'.esc_attr($options['gradient_start'] ?? '#000000').'">';
    }

    public function render_gradient_end_field() {
        $options = get_option('particles_settings');
        echo '<input type="color" name="particles_settings[gradient_end]" value="'.esc_attr($options['gradient_end'] ?? '#ffffff').'">';
    }

    public function render_gradient_angle_field() {
        $options = get_option('particles_settings');
        echo '<input type="number" name="particles_settings[gradient_angle]" value="'.esc_attr($options['gradient_angle'] ?? 180).'" min="0" max="360"> градусов';
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>Particles Background Ultimate by DDG - site <a href="https://www.go-studio.pro/plugin/particles">go-studio.pro</a></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('particles_settings_group');
                do_settings_sections('particles-background');
                submit_button('Сохранить настройки');
                ?>
            </form>
        </div>
        <?php
    }

    public function enqueue_assets() {
        $options = get_option('particles_settings');
        $current_page_id = get_queried_object_id();
        
        // Проверяем, нужно ли подключать на текущей странице
        if (!empty($options['selected_pages'])) {
            if (!in_array($current_page_id, (array)$options['selected_pages'])) {
                return;
            }
        }
        
        wp_enqueue_script('particles-js', 'https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js', array(), null, true);
        wp_enqueue_script('particles-init', plugin_dir_url(__FILE__).'assets/js/particles-init.js', array('particles-js'), '2.0', true);
        
        // Передаем настройки в JS
        wp_localize_script('particles-init', 'particlesConfig', array(
            'number' => $options['particles_number'] ?? 80,
            'speed' => $options['particles_speed'] ?? 3,
            'colors' => array(
                $options['particles_color_1'] ?? '#ff0000',
                $options['particles_color_2'] ?? '#00ff00',
                $options['particles_color_3'] ?? '#0000ff'
            ),
            'lines' => array(
                'enabled' => $options['lines_enabled'] ?? 1,
                'color' => $options['lines_color'] ?? '#ffffff',
                'width' => $options['lines_width'] ?? 1
            ),
            'background' => array(
                'type' => $options['background_type'] ?? 'color',
                'color' => $options['background_color'] ?? '#000000',
                'gradient' => array(
                    'start' => $options['gradient_start'] ?? '#000000',
                    'end' => $options['gradient_end'] ?? '#ffffff',
                    'angle' => $options['gradient_angle'] ?? 180
                )
            )
        ));
        
        wp_enqueue_style('particles-style', plugin_dir_url(__FILE__).'assets/css/particles-style.css');
    }

    public function add_container() {
        $options = get_option('particles_settings');
        $current_page_id = get_queried_object_id();
        
        // Проверяем, нужно ли отображать на текущей странице
        if (!empty($options['selected_pages'])) {
            if (!in_array($current_page_id, (array)$options['selected_pages'])) {
                return;
            }
        }
        
        echo '<div id="particles-js"></div>';
    }
}

new Particles_Background_Ultimate();