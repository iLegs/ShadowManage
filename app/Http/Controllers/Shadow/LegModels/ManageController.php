<?php
/**
 * 模特管理控制器。
 *
 * @author    fairyin <fairyin@126.com>
 * @copyright © 2018 www.imcn.vip
 * @version   v1.0
 */

namespace App\Http\Controllers\Shadow\LegModels;

use Input;
use App\Http\Models\Common\LegModel;
use App\Http\Controllers\ShadowController;

class ManageController extends ShadowController
{
    public function any()
    {
        $i_page = Input::get('pageNum', 1);
        if ($i_page == null) {
            $i_page = 1;
        }
        $i_count = LegModel::where('status', '=', 1)->count();
        $o_legmodels = LegModel::where('status', '=', 1)->orderBy('id', 'DESC')
            ->offset(($i_page - 1) * static::PAGE_SIZE)
            ->limit(static::PAGE_SIZE)
            ->get();
        $a_row = array(
            'currentPage' => $i_page,
            'currentCount' => count($o_legmodels),
            'pageSize' => static::PAGE_SIZE,
            'totalCount' => $i_count,
            'legmodels' => $o_legmodels
        );

        return $this->returnView('shadow.legmodels.manage', $a_row);
    }
}
