<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use getID3;

class VideoController extends Controller
{
    /**
     * Save the uploaded video locally with random name
     * and return getId3 in json format
     * @param Request $video
     * @param getID3 $getID3
     * @return \Illuminate\Http\JsonResponse
     */
    public function postVideo(Request $video, getID3 $getID3)
    {
        $this->validate($video, ['video' => 'required']);
        $fileInfo = $getID3->analyze(uploadVideo($video));

        return response()->json(convertToUtf8($fileInfo));
    }
}
