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

add_action('template_redirect', 'date_archive_nope_return_404');