<?php
/**
 * @desc      
 * @author    吴庆祥
 * @since     2017-09-11 20:18  
 */
class PtCateAction extends CommonAction{
    function __construct()
    {
        parent::__construct();
        if (!IS_PT) {
            $this->error("拼团模块未开放");
        }
    }
}