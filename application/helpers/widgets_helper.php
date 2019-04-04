<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('build_path')) {

    function add_image($url)
    {
    }
}
if (!function_exists('getMultiImageBinary')) {

    function getMultiImageBinary($image_name, $index)
    {
        $errors = array();
        $allowedImages = array('jpg', 'jpeg', 'png', 'gif');
        $maxFileSize = 2097152;
//        $minWidth = 220;
//        $minHeight = 220;
        if (!empty($_FILES[$image_name]['tmp_name'][$index]) && $_FILES["cities_images"]["size"][$index] != 0 ) {
            $image = $_FILES[$image_name]["name"][$index];
            $tmp_name = $_FILES[$image_name]["tmp_name"][$index];
            $path_info = pathinfo($image);
            if (in_array($path_info['extension'], $allowedImages)) {
                if ($_FILES[$image_name]["size"][$index] <= $maxFileSize) {
                    $image_d = getimagesize($tmp_name);
//                    if (($image_d[0] <= $minWidth) && ($image_d[1] <= $minHeight)) {
//                        $errors[] = "invalid dimension";
//                    }
                } else {
                    $errors[] = "invalid file size";
                }
            } else {
                $errors[] = "format not supported";
            }
        } else {
            $errors[] = 'Please select at least one image.';
        }

        if (!empty($errors)) {
            return [
                "status" => "fail",
                "errors" => $errors
            ];
        }

        return [
            "status" => "success",
            "data" => base64_encode(file_get_contents($_FILES[$image_name]['tmp_name'][$index]))
        ];
    }

}