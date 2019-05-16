<?php

namespace App\Http\Helpers;

class SortHelper
{
    const ALLOWED_SORT = ['created_at', 'user_name', 'email'];
    const ALLOWED_ORDER = ['asc', 'desc'];
    const DEFAULT_SORT = 'created_at';
    const DEFAULT_ORDER = 'desc';
    public static $sorting;

    public static function getSortAndOrder()
    {
        $res['sort'] = self::DEFAULT_SORT;
        $res['order'] = self::DEFAULT_ORDER;
        self::$sorting = request()->sorting;
        if(!empty(self::$sorting )) {
            $sorting = explode('+', self::$sorting, 2);
            $res['sort'] = in_array($sorting[0], self::ALLOWED_SORT) ? $sorting[0] : NULL ?? self::DEFAULT_SORT;
            $res['order'] = in_array($sorting[1] ?? NULL, self::ALLOWED_ORDER) ? $sorting[1] : NULL ?? self::DEFAULT_ORDER;
        }
        return $res;
    }
}
