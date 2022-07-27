<?php

class Form_validation_callback_library
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function captcha($captcha_response)
    {
        $check = [
            'secret'   => $_SERVER['CAPTCHA_SECRETKEY'] ?? '',
            'response' => $captcha_response,
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($check));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $googleResponses = json_decode(curl_exec($curl), true);

        return (bool) ($googleResponses['success']);
    }
}
