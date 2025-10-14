<?php
require get_template_directory(). '/elementor/elementor-helper.php';

add_action( 'elementor/widgets/widgets_registered', 'jobclub_free_elementor_widgets' );

function jobclub_free_elementor_widgets($widgets_manager){
    // We check if the Elementor plugin has been installed / activated.

    if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {
        require get_template_directory(). '/elementor/jobclub-elementor-blog.php';
        require get_template_directory(). '/elementor/jobclub-elementor-banner.php';
        require get_template_directory(). '/elementor/jobclub-elementor-job-list.php';

    }
}