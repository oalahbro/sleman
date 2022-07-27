<?php

if (!function_exists('user_logged_in')) {
    function user_logged_in()
    {
        $CI = &get_instance();
        $CI->load->library('session');
        if ($CI->session->has_userdata('loggedIn')) {
            if ($CI->session->userdata('loggedIn')) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('cekuser')) {
    function cekuser()
    {
        $var_ci = &get_instance();
        if ($var_ci->session->userdata('role') !== 1) {
            redirect('forbidden');

            exit;
        }
    }
}

if (!function_exists('set_flashdata')) {
    function set_flashdata($key, $val)
    {
        \FlashMessage\FlashMessage::push($key, $val);

        return;
    }
}

if (!function_exists('flashdata')) {
    function flashdata(string $key)
    {
        $message = \FlashMessage\FlashMessage::next_type($key);

        if ($message !== false) {
            return $message['text'];
        }

        return '';
    }
}
