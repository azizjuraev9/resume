<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 14.08.2019
 * Time: 18:55
 */

namespace app\enums;

class Nations extends BaseEnum
{


    protected function init()
    {
        $this->_items = [
            'Uzbek',
            'Russian',
        ];
    }

}