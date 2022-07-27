<?php

defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Upload
 */
class UploadFoto
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('upload');
        // $this->CI->load->helper('text');
        $this->CI->load->helper('url');
    }

    /**
     *  cek file diupload atau tidak
     */
    public function fileUploaded(string $formField)
    {
        if (empty($_FILES)) {
            return false;
        }
        $this->file = $_FILES[$formField];
        if (! file_exists($this->file['tmp_name']) || ! is_uploaded_file($this->file['tmp_name'])) {
            $this->errors['FileNotExists'] = true;

            return false;
        }

        return true;
    }

    /**
     * Upload foto
     */
    public function doUpload(string $fieldName, bool $thumb = false, string $newName = '', int $maxSize = 2048, int $width = 2000, int $height = 2000): array
    {
        $data = [];

        $config = [
            'upload_path'      => $this->CI->config->item('uploadPath'),
            'allowed_types'    => 'gif|jpg|png|jpeg|bmp',
            'max_width'        => $width,
            'max_height'       => $height,
            'max_size'         => $maxSize,
            'max_filename'     => 35,
            'file_ext_tolower' => true,
            'remove_spaces'    => true,
            'file_name'        => $newName,
        ];

        $this->CI->upload->initialize($config);

        if (! $this->CI->upload->do_upload($fieldName)) {
            $data['message'] = $this->CI->upload->display_errors();
            $data['pass']    = false;

        // $this->load->view('upload_form', $error);
        } else {
            $data            = $this->CI->upload->data();
            $data['pass']    = true;
            $data['message'] = 'Image uploaded successfully';

            if ($thumb) {
                $create_thumb = $this->resize($data['full_path'], $data['file_path'] . 'thumb');

                if ($create_thumb) {
                    $data['thumb_file_path'] = $data['file_path'] . 'thumb/';
                    $data['thumb_full_path'] = $data['file_path'] . 'thumb/' . $data['file_name'];
                }
            }
        }

        return $data;
    }

    public function resize($source_path, $target_path, $width = 370, $height = 237)
    {
        // Create thumnail or resize image
        $config2 = [
            'source_image' => $source_path, //get original image
            'new_image'    => $target_path, //save as new image //need to create thumbs first
            // 'maintain_ratio' => true,
            'width'  => $width,
            'height' => $height,
        ];
        $this->CI->load->library('image_lib'); //load library
        $this->CI->image_lib->initialize($config2);
        $return = $this->CI->image_lib->resize();
        // $this->CI->image_lib->crop();
        $this->CI->image_lib->clear();

        return (bool) ($return);
    }
}
