<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 14.08.2019
 * Time: 18:58
 */

namespace app\enums;

abstract class BaseEnum
{

    protected static $_instance;
    protected $_items;

    abstract protected function init();

    private function __construct()
    {
        $this->init();
    }

    public static function getInstance() : BaseEnum{
        if(!static::$_instance)
            static::$_instance = new static;
        return static::$_instance;
    }

    public static function getItem($id){
        return static::getInstance()->_getItem($id);
    }

    public static function getList(){
        return static::getInstance()->_getList();
    }

    public function _getItem($id){
        if(is_array($id))
            return array_map(function ($id){
                return @$this->_items[$id];
            },$id);
        return [@$this->_items[$id]];
    }

    public function _getList(){
        return $this->_items;
    }

}