<?php
/**
 * @desc      
 * @author    吴庆祥
 * @since     2017-09-12 08:39  
 */
class ptModule extends MainBaseModule{
    function __construct(){
        parent::__construct();
        global_run();
        if(!intval($_REQUEST['is_ajax'])){
            init_app_page();
        }
        if (!IS_PRESELL) {
            $this->error("预售模块未开放");
        }
    }
    public function  index(){
        $this->display("pt_index.html");
    }
    public function detail(){
        $this->display("pt_detail.html");
    }
    public function search(){
        $this->display("pt_search.html");
    }
    public function goods(){
        $this->display("pt_goods.html");
    }
}