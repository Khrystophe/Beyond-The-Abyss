<?php
require('../../vendor/autoload.php');

if (isset($content) && !empty($content)) {

  $frame = explode('.', $content);
  $video_file = '../assets/videos/' . $content;
  $frame_second = 1;
  $ffmpeg = FFMpeg\FFMpeg::create();
  $video = $ffmpeg->open(dirname("../Diplome") . '/' . $video_file);
  $video
    ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($frame_second))
    ->save('../../assets/images/' . $frame[0] . '.jpg');
}
