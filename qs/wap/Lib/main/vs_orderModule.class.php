<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class vs_orderModule extends MainBaseModule
{
	public function index()
	{
		$GLOBALS['tmpl']->display('vs_order.html');
	}

	public function view()
	{
		$GLOBALS['tmpl']->display('vs_order_view.html');
	}

	public function cancel()
	{
		# code...
	}

	public function dp()
	{
		# code...
	}

	public function do_dp()
	{
		# code...
	}
}