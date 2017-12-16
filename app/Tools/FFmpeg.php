<?php
/**
 * Created by PhpStorm.
 * User: xiaohigh
 * Date: 2017/12/16
 * Time: 上午7:53
 */

namespace App\Tools;


class FFmpeg
{
    /**
     * 获取视频时长
     */
    public static function getDuration($path)
    {
        if(!is_file($path)) {
            return 0;
        }

        $ffprobe = \FFMpeg\FFProbe::create();
        $time = $ffprobe
            ->format($path) // extracts file informations
            ->get('duration');
        return intval($time);
    }
}