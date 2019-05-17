<?php

namespace App\Http\Helpers;

class SortHelper
{
    const ALLOWED_ORDER = ['asc', 'desc'];
    public static $sorting;

    public static function getSortAndOrder($allowed_sort, $d_sort, $d_order = 'desc')
    {
        $res['sort'] = $d_sort;
        $res['order'] = $d_order;
        self::$sorting = request()->sorting;
        if(!empty(self::$sorting )) {
            $sorting = explode('+', self::$sorting, 2);
            if(in_array($sorting[0], $allowed_sort)) {
                $res['sort'] = $sorting[0];
            } else $res['sort'] = $d_sort;
            if(in_array($sorting[1] ?? NULL, self::ALLOWED_ORDER)) {
                $res['order'] = $sorting[1];
            } else $res['order'] = $d_order;
        }

        return $res;
    }
}
