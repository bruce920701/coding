<?php
/**
 * Created by PhpStorm.
 * User: linzhibin
 * Date: 2017/8/11
 * Time: 16:19
 */

namespace App\Library\DB;
use App\Library\Err\ErrMap;
/**
 * Class DB_Base
 * @package DB
 */
class DB
{
    public static $errno = 0;
    public static $errmsg = '';

    public static $dbo = null;
    public static $readDbo = null;
    public static $lastsql = '';
    public static $openSqlLog = false;
    public static $prefix = '';

    public static $fetchType = \PDO::FETCH_ASSOC;

    /**
     * 获取PDO对象
     * @param bool $useReadPdo 使用只读PDO
     * @return null|\PDO
     */
    public static function getDb($useReadPdo = true){
        if(self::$dbo==null){
            $db_info = require APP_ROOT_PATH.'./public/db_config.php';
            try{
                self::$dbo = new \PDO("mysql:host=".$db_info['DB_HOST'].";port=".$db_info['DB_PORT'].";dbname=".$db_info['DB_NAME'].";",
                    $db_info['DB_USER'],
                    $db_info['DB_PWD']);
                self::$prefix = $db_info['DB_PREFIX'];
                self::$dbo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                list(self::$errno,self::$errmsg) = ErrMap::get(1000);
                return false;
            }


        }
        return self::$dbo;
    }

    /**
     * 插入数据
     * @param string $table 表名
     * @param array $field_data 插入的数据数组
     * @return int 返回插入的ID
     */
    public static function insert($table='',$field_data=array()){
        $id = 0;
        $sql = '';
        $field_name = array();
        $field_value = array();

        //预处理插入数据
        foreach ($field_data as $key=>$value){
            $field_name[] = stripslashes($key);//去除反斜杠
            $field_value[] = addslashes($value);
            $field_mode[] = '?';
        }

        self::saveLastSql($sql,$field_value);
        //预编译sql 语句
        $sql = "insert into $table (".implode(',',$field_name).") value(".implode(',',$field_mode).")";

        if (self::$openSqlLog){ //判断开启记录SQL最后一条查询日志
            self::$lastsql = self::parms($sql,$field_value);
        }

        self::getDb();
        $sth = self::$dbo->prepare($sql);

        //执行并检查错误
        try{
            $res = $sth->execute($field_value);
            $id = intval(self::getDb()->lastinsertid());
        }catch(\PDOException $e){
            list(self::$errno,self::$errmsg) = ErrMap::get(1001);
            return false;
        }
        return $id;

    }

    /**
     * 更新数据表
     * @param string $sql 要更新的sql
     * @param array $param sql中的参数数组
     * @return int 影响的条数
     */
    public static function update($sql='',$param=array()){
        //处理特殊字符
        if ($param){
            foreach ($param as $k=>$v){
                $param[$k] = addslashes($v);
            }
        }

        self::saveLastSql($sql,$param);

        self::getDb();
        $sth = self::$dbo->prepare($sql);
        try{
            $lrows = $sth->execute($param);
        }catch(\PDOException $e){
            list(self::$errno,self::$errmsg) = ErrMap::get(1002);
            return false;
        }

        return $lrows;
    }

    /**
     * 执行sql
     * @param $sql
     * @return object
     */
    public static function query($sql){
        self::saveLastSql($sql);
        self::getDb();
        try{
            $res = self::$dbo->query($sql);
        }catch (\PDOException $e){
            list(self::$errno,self::$errmsg) = ErrMap::get(1003);
            return false;
        }
        return $res;
    }

    /**
     * 查询多条记录数组
     * @param string $sql  查询语句
     * @param array $param  查询条件参数
     * @return string
     */
    public static function fetchAll($sql='',$param=array()){
        self::saveLastSql($sql,$param);
        self::getDb();
        $sth = self::$dbo->prepare($sql);
        try{
            $sth->execute($param);
            $res = $sth->fetchAll(self::$fetchType);
        }catch(\PDOException $e){
            list(self::$errno,self::$errmsg) = ErrMap::get(1004);
            return false;
        }

        return $res;
    }

    /**
     * 查询单条数据
     * @param string $sql
     * @param array $param
     * @return string
     */
    public static function fetch($sql='',$param=array()){
        self::saveLastSql($sql,$param);
        self::getDb();
        $sth = self::$dbo->prepare($sql);
        try{
            $sth->execute($param);
            $res = $sth->fetch(self::$fetchType);
        }catch(\PDOException $e){
            list(self::$errno,self::$errmsg) = ErrMap::get(1005);
            return false;
        }

        return $res;
    }


    public static function fetchOnly($sql,$param){
        self::saveLastSql($sql,$param);
        self::getDb();
        $sth = self::$dbo->prepare($sql);
        try{

            $sth->execute($param);
            $res = $sth->fetch(\PDO::FETCH_NUM);
        }catch(\PDOException $e){
            list(self::$errno,self::$errmsg) = ErrMap::get(1006);
            return false;
        }
        $res = $res[0];
        return $res;
    }

    /**
     * 删除操作
     * @param $sql
     */
    public static function delete($sql){
        self::exec($sql);
    }

    /**
     * 直接执行sql
     * @param string $sql
     * @return bool|int
     */
    public static function exec($sql=''){
        self::saveLastSql($sql);
        try{
            $res = self::getDb()->exec($sql);
        }catch(\PDOException $e){
            list(self::$errno,self::$errmsg) = ErrMap::get(1007);
            return false;
        }
        return $res;
    }

    /**
     * 设置是否打开保存最后一次执行的sql
     * @param bool $isOpen
     */
    public static function setOpenSqlLog($isOpen=false){
        self::$openSqlLog = $isOpen;
    }

    /**
     * 获取最后一次执行的sql
     * @return string
     */
    public static function getLastSql(){
        return self::$lastsql;
    }

    /**
     * 保存最后一次执行的sql语句
     * @param string $sql
     * @param array $param
     */
    public static function saveLastSql($sql='',$param=array()){
        if (self::$openSqlLog){ //判断开启记录SQL最后一条查询日志
            if (!empty($param)){
                self::$lastsql = self::parms($sql,$param);
            }else{
                self::$lastsql = $sql;
            }

        }
    }

    public static function getErrSql(){
        if (self::$errno){
            return self::getLastSql();
        }
        return false;

    }

    /**
     * 生成编译后的sql 语句
     * @param $string
     * @param $data
     * @return mixed
     */
    public static function parms($string,$data) {
        $indexed=$data==array_values($data);
            foreach($data as $k=>$v) {
                if(is_string($v)) $v="'$v'";
                if($indexed) $string=preg_replace('/\?/',$v,$string,1);
                else $string=str_replace(":$k",$v,$string);
            }
        return $string;
    }


    /**
     * 设置要取值的结果集
     * @param string $pdoType
     */
    public static function setFetchType($pdoType=''){
//        FETCH_ASSOC	关联数组形式
//        FETCH_NUM	数字索引数组形式
//        FETCH_BOTH	两者数组形式都有，这是默认的
//        FETCH_OBJ	按照对象的形式，类似于以前的mysql_fetch_object()
//        FETCH_BOUND	以布尔值的形式返回结果，同时将获取的列值赋给bindParam()方法中指定的变量
//        FETCH_LAZY	以关联数组、数字索引数组和对象3种形式返回结果。
        switch ($pdoType){
            case 'FETCH_NUM':self::$fetchType = \PDO::FETCH_NUM;break;
            case 'FETCH_BOTH':self::$fetchType = \PDO::FETCH_BOTH;break;
            case 'FETCH_OBJ':self::$fetchType = \PDO::FETCH_OBJ;break;
            case 'FETCH_BOUND':self::$fetchType = \PDO::FETCH_BOUND;break;
            case 'FETCH_LAZY':self::$fetchType = \PDO::FETCH_LAZY;break;
            default:self::$fetchType = \PDO::FETCH_ASSOC;break;
        }
    }
    public static function clearErr(){
        self::$errno=0;
        self::$errmsg='';
    }
}