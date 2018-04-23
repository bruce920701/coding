<!--短信验证码-->
<style type="text/css">
    .form-item{
        padding: 0.5rem;
    }
    .form-item .form-box-text{
        position: relative;
        padding: 10px 0;
        width: 100%;
        display: -webkit-flex;
        display: flex; 
        -webkit-justify-content: space-between;
        justify-content: space-between;
    }
    .form-box-text input{
        color: #8C8C8C;
        flex:1;
    }
    .form-box-text .batch{
        color:#E45152;
        cursor:pointer;
    }
    .form-box-icon{
        display: -webkit-flex;
        display: flex; 
        -webkit-justify-content: space-around;
        justify-content: space-around;
    }
    .icon-list{
        text-align: center;
        box-sizing: border-box;
        border: 1px solid rgba(255, 255, 255, 0);
        padding: 0.27rem 0.2rem 0.13rem;
    }
    .icon-list.active{
        border: 1px solid #E45152;
        border-radius: 6px;
        color: #E45152;
    }
    .icon-list i{
        display: block;
        font-size: 1.4rem;
        color: #8C8C8C;
        height: 1.4rem;
        line-height: 1.4rem;
    }
    .icon-list span{
        color: #8C8C8C
    }
    .form-item .v_btn_box{

        text-align: center;
        padding: 8px;
        margin: 0 auto;
    }
    .form-item .v_btn_box .v_btn{
        padding: 8px;
        width: 130px;
        text-align: center;
        background-color: #E45152;
        color: #fff;
        border: 1px solid #E45152;
        border-radius: 6px;
        word-wrap: break-word;
        word-break: break-all;
        -webkit-appearance: none;
    }
    .form-item .v_input_box{
        display: -webkit-flex;
	    display: flex;
	    -webkit-justify-content: center;
	    justify-content: center;
	    -webkit-align-items: center;
	    align-items: center;
    }
    .form-item .v_txt{
	    border: 1px solid #eee;
	    padding: 0 0.5rem;
	    width: 4rem;
	    margin-right: 0.5rem;
	    line-height: 1.2rem;
	    height: 1.2rem;
    }
</style>
<div id="verify_image_box">
   <div class="verify_form_box">
       <div class="verify_title">图形验证码<div class="iconfont verify_close_btn">&#xe634;</div></div>
        <div class="blank20"> </div>
       <div class="form-item" >
       </div>
       <div class="blank20"> </div>
   </div>
</div>
<!--end 短信验证码-->
