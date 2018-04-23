<?php
/**
 * @desc      
 * @author    郑雄
 * @since     2017-8-28  
 */

namespace App\Controllers;
use App\Library\Common\CommonRequest;
use App\Models\YouhuiModel;
use App\Library\Common\CommonSession;
use App\Library\Err\ErrMap;
use App\Library\Common\CommonPage;

class UcCenter
{
    public function index(){
        $user_info=CommonSession::get('user_info');

        $user_data['userName']=$user_info['user_name'];
        $user_data['userAvatar']=self::get_user_avatar($user_info['id'],"big")?:'';
        $root=array();
        $root['user_info']=$user_data;
        CommonRequest::reponse(YouhuiModel::$errno,YouhuiModel::$errmsg,$root);
    }

    //获取用户头像的文件名
    private function get_user_avatar($id,$type)
    {
        $uid = sprintf("%09d", $id);
        $dir1 = substr($uid, 0, 3);
        $dir2 = substr($uid, 3, 2);
        $dir3 = substr($uid, 5, 2);
        $path = $dir1.'/'.$dir2.'/'.$dir3;

        $id = str_pad($id, 2, "0", STR_PAD_LEFT);
        $id = substr($id,-2);
        $avatar_file = format_image_path("./public/avatar/".$path."/".$id."virtual_avatar_".$type.".jpg");
        $avatar_check_file = APP_ROOT_PATH."public/avatar/".$path."/".$id."virtual_avatar_".$type.".jpg";
        if($GLOBALS['distribution_cfg']['OSS_TYPE']&&$GLOBALS['distribution_cfg']['OSS_TYPE']!="NONE")
        {
            //system\common
            if(!check_remote_file_exists($avatar_file))
                $avatar_file =  SITE_DOMAIN.APP_ROOT."/public/avatar/noavatar_".$type.".gif";
        }
        else
        {
            if(!file_exists($avatar_check_file))
                $avatar_file =  SITE_DOMAIN.APP_ROOT."/public/avatar/noavatar_".$type.".gif";
        }

        return  $avatar_file;
        //@file_put_contents($avatar_check_file,@file_get_contents(APP_ROOT_PATH."public/avatar/noavatar_".$type.".gif"));
    }
} 