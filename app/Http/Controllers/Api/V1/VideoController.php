<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use getID3;

class VideoController extends Controller
{
    public function postVideo(Request $video, getID3 $getID3)
    {
        $this->validate($video, ['video' => 'required']);
        $fileInfo = $getID3->analyze(uploadVideo($video));

        return convertToUtf8($fileInfo);
    }
}
