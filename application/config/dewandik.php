<?php

defined('BASEPATH') || exit('No direct script access allowed');

$config = [
    'uploadPath'          => realpath(FCPATH . '/uploads/images/'),
    'uploadPublikasiPath' => realpath(FCPATH . '/uploads/docs/'),
    'postWidthImage'      => 500,
    'postHeightImage'     => 320,
];
