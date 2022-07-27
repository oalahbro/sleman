<?php

if (! function_exists('countPendingComment')) {
    function countPendingComment()
    {
        $CI = &get_instance();

        $CI->load->model('M_komentar', 'komentar');
        $count = $CI->komentar->counter(0);

        return $count->num_rows();
    }
}

if (! function_exists('IDYouTube')) {
    /**
     * Ambil ID Video Youtube dari URL
     * 
     * see: https://gist.github.com/totoprayogo1916/7e0706d6932b832fdc79c6a9d6d84cfd
     */
    function IDYouTube(string $url): string
    {
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\\/)[^&\n]+(?=\\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $match);

        return $match[0];
    }
}

if (! function_exists('thumbYouTube')) {
    /**
     * Ambil thumbnail Video Youtube dari ID
     */
    function thumbYouTube(string $IDYouTube, string $quality = 'mq'): string
    {
        if (in_array($quality, ['sd', 'mq', 'hq', 'maxresd'], true)) {
            return 'http://img.youtube.com/vi/' . $IDYouTube . '/' . $quality . 'default.jpg';
        }

        return 'http://img.youtube.com/vi/' . $IDYouTube . '/default.jpg';
    }
}
