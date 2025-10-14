<?php
namespace Elementor;
function jobclub_elementor_init(){
    Plugin::instance()->elements_manager->add_category(
        'jobclub-elementor-widget',

        [
            'title'  => 'Jobclub Free Elementor Widgets',
            'icon' => 'font'
        ],
        1
    );
}
add_action('elementor/init','Elementor\jobclub_elementor_init');