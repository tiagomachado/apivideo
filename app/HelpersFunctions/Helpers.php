<?php

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Illuminate\Http\Request;

if (!function_exists('randomName')) {
    /**
     * Create Random Name
     * @return string
     */
    function randomName()
    {
        return  time().'_'.str_random(10).'_'.str_random(10);
    }
}

if (!function_exists('convertToUtf8')) {
    /**
     * Converts recursively
     * all values of an array to UTF8.
     * @param $fileInfo
     * @return array in UTF8
     */
    function convertToUtf8($fileInfo)
    {
        array_walk_recursive($fileInfo, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });
        return $fileInfo;
    }
}

if (!function_exists('uploadVideo')) {
    /**
     * Save the uploaded video locally
     * @param Request $video
     * @return video
     */
    function uploadVideo(Request $video)
    {
        try {
            $videosPath = storage_path('videos');
            $videoUpload = $video->file('video');
            $randomName = randomName().'.'.$videoUpload->getClientOriginalExtension();
            $videoUpload->move($videosPath, $randomName);

        } catch (FileException $e) {
            abort(500, $e->getMessage());
        }

        return $videosPath.'/'.$randomName;
    }
}
