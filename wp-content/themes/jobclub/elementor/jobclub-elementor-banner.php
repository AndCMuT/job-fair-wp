<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Define our Pt Elementor Call Out settings.
 */
class jobclub_elementor_banner extends Widget_Base {
	/**
	 * Define our get_name settings.
	 */
	public function get_name() {
		return 'jobclub-banner';
	}
	/**
	 * Define our get_title settings.
	 */
	public function get_title() {
		return __( 'Banner', 'jobclub' );
	}
	/**
	 * Define our get_icon settings.
	 */
	public function get_icon() {
		return 'eicon-call-to-action';
	}
	/**
	 * Define our get_categories settings.
	 */
	public function get_categories() {
		return [ 'jobclub-elementor-widget' ];
	}
	/**
	 * Define our _register_controls settings.
	 */
	protected function register_controls()
    {
        /**
         * Info Box Title and Description Section.
         */
        $this->start_controls_section(
            'jobclub_banner_section',
            [
                'label' => esc_html__('Banner Options', 'jobclub'),
            ]
        );
        $this->add_control(
            'jobclub_banner_title',
            [
                'label' => __('Enter Title', 'jobclub'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Title', 'jobclub' ),
            ]
        );

        $this->add_control(
            'jobclub_banner_desc',
            [
                'label' => __('Enter Description', 'jobclub'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Description', 'jobclub' ),
            ]
        );


        $this->add_control(
            'jobclub_banner_button_text',
            [
                'label' => __('Enter Button Text', 'jobclub'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Button Text', 'jobclub' ),
            ]
        );

        $this->add_control(
            'jobclub_banner_button_url',
            [
                'label' => __( 'Button Link', 'jobclub' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'jobclub' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $this->add_control(
            'jobclub_banner_img',
            [
                'label' => __( 'Choose Banner Background Image', 'jobclub' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

    }
	/**
	 * Define our Content Display inline settings.
	 */
	protected function add_inline_editing_attributes( $key, $toolbar = 'basic' ) {
		if ( ! Plugin::$instance->editor->is_edit_mode() ) {
			return;
		}
		$this->add_render_attribute( $key, [
			'class' => 'elementor-inline-editing',
			'data-elementor-setting-key' => $key,
		] );
		if ( 'basic' !== $toolbar ) {
			$this->add_render_attribute( $key, [
				'data-elementor-inline-editing-toolbar' => $toolbar,
			] );
		}
	}

	/**
	 * Define our Content Display settings.
	 */
	protected function render() {
        $settings = $this->get_settings();
        $jobclub_banner_title = $settings['jobclub_banner_title'];
        $jobclub_banner_desc = $settings['jobclub_banner_desc'];
         $jobclub_banner_button_text = $settings['jobclub_banner_button_text'];
        $jobclub_banner_img = $settings['jobclub_banner_img']['url'];
        $jobclub_banner_button_url = $settings['jobclub_banner_button_url']['url'];
        if (!empty($jobclub_banner_img)) {
            $image_style = "style='background-image:url(" . esc_url($jobclub_banner_img) . ")'";
        } else {
            $image_style = '';
        }
        ?>


        <div class="banner-section" <?php echo wp_kses_post($image_style); ?>>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        
                                <?php
                                if ($jobclub_banner_title)
                                    echo '<h1>' . esc_html($jobclub_banner_title) . '</h1>';

                                if ($jobclub_banner_desc)
                                    echo '<span>' . esc_html($jobclub_banner_desc) . '</span>';
          if( $jobclub_banner_button_text && $jobclub_banner_button_url):?>
                                    <a href="<?php echo esc_url($jobclub_banner_button_url); ?>" class="btn-default"><?php echo esc_html($jobclub_banner_button_text); ?></a>
                                <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

    <?php

	}
	
}
/*=============Call this every widget ====================*/
Plugin::instance()->widgets_manager->register_widget_type( new jobclub_elementor_banner() );

