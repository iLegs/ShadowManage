<?php
/**
 * 前台首页控制器。
 *
 * @author    fairyin <fairyin@126.com>
 * @copyright © 2018 www.imcn.vip
 * @version   v1.0
 */

namespace App\Http\Controllers;

use Input;
use Redis;

class PhotoDelController extends WebController
{
    public function onPost()
    {
        $i_photo_id = Input::get('pid', 0);
        if (0 >= $i_photo_id) {
            return $this->errorJson('编号错误！');
        }
        $s_key = 'photo_del_queue';
        $a_row = array(
            'pid' => $i_photo_id,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'ua' => $_SERVER['HTTP_USER_AGENT'],
            'cookie' => $_SERVER['HTTP_COOKIE']
        );
        Redis::lpush($s_key, json_encode($a_row));

        return $this->successJson();
    }
}
