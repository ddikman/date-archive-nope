<?php
/*
Plugin Name: Date Archive Nope
Description: This WordPress plugin removes the date archive pages, completely.
Version: 1.0
Author: David Dikman
Plugin URI: https://github.com/ddikman/date-archive-nope
*/


function date_archive_nope_return_404()
{
    if (is_date()){
        $target = get_option('siteurl');
        $status = '301';
        wp_redirect($target, 301);
        die();
    }
}

function add_nofollow_to_elementor_pagination($html) {
    // Use a regular expression to find and modify pagination links
    $pattern = '/<a\s[^>]*class=["\']page-numbers["\'][^>]*>/i';
    return preg_replace_callback($pattern, function($matches) {
        $link = $matches[0];
        if (strpos($link, 'rel=') === false) {
            $link = str_replace('>', ' rel="nofollow">', $link);
        } else {
            $link = preg_replace('/rel=(["\'])(.*?)(["\'])/', 'rel="nofollow $2"', $link);
        }
        return $link;
    }, $html);
}

add_action('template_redirect', 'date_archive_nope_return_404');