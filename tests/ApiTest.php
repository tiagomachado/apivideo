<?php

use Illuminate\Http\UploadedFile;

class ApiTest extends TestCase
{
    /**
     *  Test upload video and return getId3 in json format
     */
    public function testApiUploadVideoAndReturnGetId3InJson()
    {
        $videoTestName = 'video-test.mp4';
        $videoTestPath = base_path()."/tests/video-test/{$videoTestName}";
        $file = new UploadedFile($videoTestPath, $videoTestName, 'video/mp4', 446, null, true);
        $response = $this->call('POST', 'api/v1/video', [], [], ['video' => $file]);
        $this->assertEquals(200, $response->status());
        json_decode($response->content(), true);
    }


    /**
     *  Test HTTP POST on video end point
     */
    public function testHttpPost()
    {
        $response = $this->call('POST', '/api/v1/video');
        $this->assertEquals(422, $response->status());
    }
}
