<?php

class VerificationCodeAction extends CommonAction{
    
    
    public function index(){
        if(strim($_REQUEST['iconname'])!='')
        {
            $map['iconname'] = array('like','%'.strim($_REQUEST['iconname']).'%');
        }
        $name=$this->getActionName();
        $model = D ($name);
        if (! empty ( $model )) {
            $this->_list ( $model, $map );
        }
        $this->display ();
    }
    
    public function add(){
        $data = M(MODULE_NAME)->create ();
        $this->display ();
    }
    
    public function insert(){
        $data = M(MODULE_NAME)->create ();
        if( $data['iconfont']==''){
            $this->error("请选择一个图标");
        }
        if($data['iconname']==''){
            $this->error("请填写图标的名字");
        }
        $code = "&#x".$_REQUEST['icon-font'].";";
        $data['iconcode']=$_REQUEST['icon-font'];
        $data['iconfont']=$code;
        $res=M('VerificationCode')->add($data);
        if($res){
            $this->success("添加图标成功");
        }else{
            $this->error("添加图标失败");
        }
        $this->display ();
    }
    public function edit(){
        $id = $_REQUEST['id'];
        $vo = M('VerificationCode')->where('id = '.$id)->find();
        $this->assign("vo",$vo);
        $this->display ();
    }
    public function update(){
        $id = $_REQUEST['id'];
        $data['iconname']= $_REQUEST['iconname'];
        $res=M('VerificationCode')->where('id='.$id)->save($data);
        if($res){
            $this->success("添加图标成功");
        }else{
            $this->error("添加图标失败");
        }
        $this->display ();
    }
    public function delete(){
        $id = $_REQUEST['id'];
        if($id==''){
            $this->error ("请选择要删除的项");
        }else{
            $deal=M('VerificationCode')->where('id in'.'('. $id.')')->delete();
            if($deal){
                $this->success(L("UPDATE_SUCCESS"));
            }else {
                $this->error (l("UPDATE_FAILED"));
            }
        }
    }
    
    public function do_upload_icon()
    {
        require_once(APP_ROOT_PATH."system/utils/zip.php");
        $archive  = new PHPZip();
        $font_dir = APP_ROOT_PATH."public/verificationcode";
    
        $result = $archive->unZip($_FILES['file']['tmp_name'], $font_dir);
        if(empty($result)||$result==-1)
        {
            ajax_return(array("status"=>false,"info"=>"图标库更新失败，请手动解压后上传文件到".$font_dir));
        }
    
    
        if ( $dir = opendir( $font_dir."/" ) )
        {
            while ( $file = readdir( $dir ) )
            {
                $check = is_dir( $font_dir."/". $file );
                if ( !$check )
                {
                    @unlink( $font_dir ."/". $file );
                }
            }
        }
    
    
    
    
        $result = $archive->unZip($_FILES['file']['tmp_name'], $font_dir);
        //清空原文件
    
    
        foreach($result as $k=>$v)
        {
            $file = APP_ROOT_PATH."public/verificationcode/".$k;
            $file_arr = explode("/", $file);
            	
            foreach($file_arr as $f)
            {
                if($f=="iconfont.css"||$f=="iconfont.eot"||$f=="iconfont.svg"||$f=="iconfont.ttf"||$f=="iconfont.woff")
                {
                    //echo APP_ROOT_PATH."public/iconfont/".$f;
                    @rename($file,APP_ROOT_PATH."public/verificationcode/".$f);
                    if($GLOBALS['distribution_cfg']['CSS_JS_OSS']&&$GLOBALS['distribution_cfg']['OSS_TYPE']&&$GLOBALS['distribution_cfg']['OSS_TYPE']!="NONE")
                    {
                        syn_to_remote_file_server("public/verificationcode/".$f);
                    }
                }
            }
            	
        }
    
        foreach($result as $k=>$v)
        {
            $file = APP_ROOT_PATH."public/verificationcode/".$k;
            @unlink($file);
        }
        foreach($result as $k=>$v)
        {
            $file = APP_ROOT_PATH."public/verificationcode/".$k;
            @rmdir($file);
        }
        ajax_return(array("status"=>true,"info"=>""));
    }
    
    public function fetch_icon()
    {
        $file = APP_ROOT_PATH."public/verificationcode/iconfont.css";
        $cnt = file_get_contents($file);
    
        preg_match_all("/content[^\da-zA-Z]+([\da-zA-Z]+)/", $cnt, $matches);
        $iconfont=M('VerificationCode')->field("iconfont")->findAll();
        if($matches)
        {
            $html = "";
            foreach($matches[1] as $v)
            {
                foreach ($iconfont as $kk =>$vv){
                    $code = "&#x".$v.";";
                    if($code == $vv['iconfont']){
                        unset($v);
                    }
                    
                }
                if($v!=''){
                    $codes = "&#x".$v.";";
                    $html.="<a href='javascript:void(0);' class='iconcode pickfont' rel=".$codes." data=".$v.">".$codes."</a>";
                }
            }
        }
        $html.="<a href='javascript:void(0);' class='iconcode pickfont' rel=''>清除</a>";
        $data['html'] =$html;
        ajax_return($data);
    }
    
}


?>