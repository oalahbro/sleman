<?php

$this->CI = &get_instance();

$config = [
    'auth/login' => [
        [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required|valid_email',
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'g-recaptcha-response',
            'label' => 'Google reCaptcha',
            'rules' => [
                'trim',
                'required',
                [
                    'recaptcha',
                    function ($str) {
                        return $this->CI->fv->captcha($str);
                    },
                ],
            ],
            'errors' => [
                'recaptcha' => 'Anda Bot? mohon masukkan reCaptcha!',
            ],
        ],
    ],
    'aspirasi/submit' => [
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required|valid_email',
        ],
        [
            'field' => 'tipe',
            'label' => 'Jenis Aspirasi',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'isi',
            'label' => 'Isi Aspirasi',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'g-recaptcha-response',
            'label' => 'Google reCaptcha',
            'rules' => [
                'trim',
                'required',
                [
                    'recaptcha',
                    function ($str) {
                        return $this->CI->fv->captcha($str);
                    },
                ],
            ],
            'errors' => [
                'recaptcha' => 'Anda Bot? mohon masukkan reCaptcha!',
            ],
        ],

    ],
    'struktur/submit' => [
        [
            'field' => 'jabatan',
            'label' => 'Jabatan',
            'rules' => 'trim|required',
        ],
        [
            'field'  => 'nama_pengurus',
            'label'  => 'Nama Pengurus',
            'rules'  => 'trim|required|regex_match[/^[A-Za-z\d\-.\'\s]+$/]',
            'errors' => [
                'regex_match' => 'Maaf, tidak diperkenankan menggunakan karakter spesial kecuali tanda penghubung (-) dan tanda petik satu (\').',
            ],
        ],
        [
            'field'  => 'masjab',
            'label'  => 'Nama Jabatan',
            'rules'  => 'trim|required|regex_match[/^[A-Za-z\d\-\s]+$/]',
            'errors' => [
                'regex_match' => 'Maaf, tidak diperkenankan menggunakan karakter spesial kecuali tanda penghubung (-)',
            ],
        ],
    ],
    'profile/update' => [
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'deskripsi',
            'label' => 'deskripsi',
            'rules' => 'trim',
        ],
    ],
    'profile/password_update' => [
        [
            'field' => 'pass_lama',
            'label' => 'Password Lama',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'pass_baru',
            'label' => 'Password Baru',
            'rules' => 'trim|required|min_length[8]',
        ],
        [
            'field' => 'ulangi_pass_baru',
            'label' => 'Ulangi Password Baru',
            'rules' => 'trim|required|min_length[8]|matches[pass_baru]',
        ],
    ],
];
