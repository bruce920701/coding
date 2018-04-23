<?php
/**
 * @desc      
 * @author    吴庆祥
 * @since     2017-09-11 14:56  
 */
class PtDealViewModel extends ViewModel{
    public $viewFields = array(
        "PtDeal"=>array("id","deal_id","is_effect"=>"pt_is_effect","create_time"=>"pt_create_time","end_time"=>"pt_end_time",'_type'=>'left'),
        "Deal"=>array("name","pt_money","pt_buy_count","_on"=>"PtDeal.deal_id=Deal.id"),
        "Brand"=>array("name"=>"brand_name","_on"=>"Deal.brand_id=Brand.id")
    );
}