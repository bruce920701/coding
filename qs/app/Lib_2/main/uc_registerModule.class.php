<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/16 0016
 * Time: 11:50
 */


class uc_registerModule extends MainBaseModule
{

    public  function  index()
    {
        global_run();
        init_app_page();
        $GLOBALS['tmpl']->assign("sms_lesstime",load_sms_lesstime());
        $GLOBALS['tmpl']->assign("sms_ipcount",load_sms_ipcount());
        $GLOBALS['tmpl']->assign("form_prefix","page");

        $GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉

        assign_uc_nav_list();

        $GLOBALS['tmpl']->assign("page_title","会员注册");
        $GLOBALS['tmpl']->display("uc/uc_register.html");
    }
    public function doregister()
    {
        global_run();

        //验证码
        /*
        $verify = strim($_REQUEST['verify_code']);
        $data = check_field("verify_code",$verify,0);

        if(!$data['status'])
        {
            ajax_return($data);
        }
        es_session::delete("verify");
        */
        //ip限制
        $ip = CLIENT_IP;
        $ip_nums = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."uc_members where login_ip = '".$ip."'");
        if($ip_nums>intval(app_conf("IP_LIMIT_NUM"))&&intval(app_conf("IP_LIMIT_NUM"))>0)
        {
            $data['status'] = false;
            $data['info'] = $GLOBALS['lang']['IP_LIMIT_ERROR'];
            ajax_return($data);
        }

        $p_user_info = $GLOBALS['user_info'];
        //$user_id =  95;
        //$p_user_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".$user_id);
        $post_data = $_POST;
        foreach($post_data as $k=>$v)
        {
            $post_data[$k] = strim($v);
        }


        $user_data['user_name'] = $post_data['user_name'];
        $user_data['mobile'] = $post_data['mobile'];
        $user_data['user_pwd'] = $post_data['user_pwd'];
        $user_data['user_pwd_confirm'] = $post_data['user_pwd_confirm'];
        $user_data['pid'] = $p_user_info['id'];
        $user_data['s_id'] = $post_data['s_id'];

        $user_data['active'] = false;

        if($user_data['user_pwd']!=$user_data['user_pwd_confirm'])
        {
            $data['status'] = false;
            $data['info'] = "您两次输入的密码不匹配";
            $data['field'] = "user_pwd_confirm";
            ajax_return($data);
        }

        if($user_data['user_pwd']=='')
        {
            $data['status'] = false;
            $data['info'] = "请输入密码";
            $data['field'] = "user_pwd";
            ajax_return($data);
        }

        //保存被注册的用户信息
        $res = save_user($user_data);
        if($res['status'] == 1)
        {
            //自动订阅邮箱和手机
            if($GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."mail_list where mail_address = '".$user_data['email']."'")==0)
            {
                $mail_item['city_id'] = intval($GLOBALS['city']['id']);
                $mail_item['mail_address'] = $user_data['email'];
                $mail_item['is_effect'] = app_conf("USER_VERIFY");
                $GLOBALS['db']->autoExecute(DB_PREFIX."mail_list",$mail_item,'INSERT','','SILENT');
            }
            if($user_data['mobile']!=''&&$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."mobile_list where mobile = '".$user_data['mobile']."'")==0)
            {
                $mobile['city_id'] = intval($GLOBALS['city']['id']);
                $mobile['mobile'] = $user_data['mobile'];
                $mobile['is_effect'] = app_conf("USER_VERIFY");
                $GLOBALS['db']->autoExecute(DB_PREFIX."mobile_list",$mobile,'INSERT','','SILENT');
            }

            $user_id = intval($res['data']);

            //更新来路
            $GLOBALS['db']->query("update ".DB_PREFIX."user set referer = '".$GLOBALS['referer']."' where id = ".$user_id);
            $sql = "update ".DB_PREFIX."user set s_id =".$post_data['s_id']." where id =".$user_id;
            $GLOBALS['db']->query($sql);
            $user_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".$user_id);

            //更新推荐人用户下的直推人列表信息
            $p_user_data['id'] = $p_user_info['id'];
            $p_user_data['d_id'] = $user_id;
            $sql = "insert into ".DB_PREFIX."direct_user(id,d_id,time) values(".$p_user_data['id'].",".$p_user_data['d_id'].",".time().");";
            //$GLOBALS['db']->query("insert into ".DB_PREFIX."direct_user(id,d_id,time) values(".$p_user_data['id'].",".$p_user_data['d_id'].",".time().");" );
            $GLOBALS['db']->query($sql);

            //更新安置点用户名下的安置点信息
            $s_user_data['id'] = $post_data['s_id'];
            $s_user_data['m_id'] = $user_id;
            $s_user_data['s_id'] = $p_user_info['id'];
            $GLOBALS['db']->query("insert into ".DB_PREFIX."market_user(id,m_id,s_id,time) values(".$s_user_data['id'].",".$s_user_data['m_id'].",".$s_user_data['s_id'].",".time().");" );

            if($user_info['is_effect']==1)
            {
                //在此自动登录
                do_login_user($user_data['email'],$user_data['user_pwd']);
                //原来为直接挑战 现改为 完善资料
                showSuccess($GLOBALS['lang']['REGISTER_SUCCESS'],1,get_gopreview());
            }
            else
            {
                //以下代码不会再被运行，因为USER_VERIFY不可再配置，固定为1
                if(app_conf("MAIL_ON")==1)
                {
                    //发邮件
                    send_user_verify_mail($user_id);
                    $user_email = $GLOBALS['db']->getOne("select email from ".DB_PREFIX."user where id =".$user_id);
                    //开始关于跳转地址的解析
                    $domain = explode("@",$user_email);
                    $domain = $domain[1];
                    $gocheck_url = '';
                    switch($domain)
                    {
                        case '163.com':
                            $gocheck_url = 'http://mail.163.com';
                            break;
                        case '126.com':
                            $gocheck_url = 'http://www.126.com';
                            break;
                        case 'sina.com':
                            $gocheck_url = 'http://mail.sina.com';
                            break;
                        case 'sina.com.cn':
                            $gocheck_url = 'http://mail.sina.com.cn';
                            break;
                        case 'sina.cn':
                            $gocheck_url = 'http://mail.sina.cn';
                            break;
                        case 'qq.com':
                            $gocheck_url = 'http://mail.qq.com';
                            break;
                        case 'foxmail.com':
                            $gocheck_url = 'http://mail.foxmail.com';
                            break;
                        case 'gmail.com':
                            $gocheck_url = 'http://www.gmail.com';
                            break;
                        case 'yahoo.com':
                            $gocheck_url = 'http://mail.yahoo.com';
                            break;
                        case 'yahoo.com.cn':
                            $gocheck_url = 'http://mail.cn.yahoo.com';
                            break;
                        case 'hotmail.com':
                            $gocheck_url = 'http://www.hotmail.com';
                            break;
                        default:
                            $gocheck_url = "";
                            break;
                    } 
                    //更新用户注册ip防止多次注册
                    $GLOBALS['db']->query("update ".DB_PREFIX."user set login_ip = '".$ip."' where id =".$user_id);
                    $GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['REGISTER_MAIL_SEND_SUCCESS']);
                    $GLOBALS['tmpl']->assign("user_email",$user_email);
                    $GLOBALS['tmpl']->assign("gocheck_url",$gocheck_url);
                    //end

                    //$GLOBALS['tmpl']->display("user_register_email.html");
                    showSuccess($GLOBALS['lang']['WAIT_VERIFY_USER'],1,get_gopreview());
                }
                else
                    showSuccess($GLOBALS['lang']['WAIT_VERIFY_USER'],1,get_gopreview());
            }
        }
        else
        {
            $error = $res['data'];
            $data['status'] = false;
            if(!$error['field_show_name'])
            {
                $error['field_show_name'] = $GLOBALS['lang']['USER_TITLE_'.strtoupper($error['field_name'])];
                $data['field'] = $error['field_name'];
            }
            if($error['error']==EMPTY_ERROR)
            {
                $error_msg = sprintf($GLOBALS['lang']['EMPTY_ERROR_TIP'],$error['field_show_name']);
            }
            if($error['error']==FORMAT_ERROR)
            {
                $error_msg = sprintf($GLOBALS['lang']['FORMAT_ERROR_TIP'],$error['field_show_name']);
            }
            if($error['error']==EXIST_ERROR)
            {
                $error_msg = sprintf($GLOBALS['lang']['EXIST_ERROR_TIP'],$error['field_show_name']);
            }
            $data['info'] = $error_msg;
            ajax_return($data);
        }
    }
}