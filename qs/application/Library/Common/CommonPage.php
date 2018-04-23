<?php
/**
 * @desc      
 * @author    郑雄 <不填>
 * @since     2014-11-25  
 */

namespace APP\Library\Common;


class CommonPage
{
    /**
     * 分页下发参数整合
     * @param int $page_size 页容量
     * @param $page_index   偏移量
     * @return array    分页数组
     */
    public static function page($page_size=0,$page_index){
        $arr=array('page_size'=>$page_size,'page_index'=>$page_index,'page_has_next'=>0);
        if($page_index>0&&$page_index%$page_size==0){
            $arr['page_has_next']=1;
        }
        return $arr;
    }
} 