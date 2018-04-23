/*目录结构*/

Lib
    /Common         ------用户自定义通用类
    /controller     ------控制类
    /core           ------核心代码文件(入口引入文件,初始化)
index.php           ------API 入口文件


/*代码编写规范*/
类名              -命名规则:首字母大写(Common_Request)
方法名            -命名规则:骆驼命名规则(getUser)
私有变量          -命名规则:首字母前加上下划线($_user_info)
私有方法          -命名规则:首字母前加上下划线(_getUserInfo)
常量              -命名规则:全部字母大写(USER)


/*注释要求*/
如下:

/**
 *  用户相关处理类
 */
class User{
    /**
     * 获取request 请求连接内容
     * @param string $key 变量名称
     * @param null $default 变量默认值
     * @param null $type 额外参数获取请求类型
     * @return null|string
     */
     public static function getRequest($key = '',$default = null,$type = null){
        $result = array();
        return $result;
     }
}

/*微信小程序说明*/
svn地址:
https://192.168.1.250/svn/o2o_project/o2o_wxapp_v1.0

/*接口列表*/
用户登录接口
首页接口
搜索门店接口
优惠券列表接口
优惠券领券页面接口
用户中心接口






