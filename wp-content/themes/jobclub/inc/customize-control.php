<?php

function jobclub_sanitize_checkbox( $input ) {
    if ( true === $input ) {
        return 1;
     } else {
        return 0;
     }
}
function jobclub_sanitize_url( $url ) {
  return esc_url_raw( $url );
}


if (!function_exists('jobclub_get_categories_select')):
    function jobclub_get_categories_select()
    {
        $jobclub_categories = get_categories();
        $results = [];

        if (!empty($jobclub_categories)):
            $results[''] = __('Select Category', 'jobclub');
            foreach ($jobclub_categories as $result) {
                $results[$result->slug] = $result->name;
            }
        endif;
        return $results;
    }
endif;

function jobclub_sanitize_select($input, $setting)
{
    $input = sanitize_key($input);

    $choices = $setting->manager->get_control($setting->id)->choices;

    return array_key_exists($input, $choices) ? $input : $setting->default;
}
