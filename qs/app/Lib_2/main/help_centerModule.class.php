<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------


class help_centerModule extends MainBaseModule
{

	public function __construct()
	{
		parent::__construct();
		$page_title = $this->getPageTitle();
		$GLOBALS['tmpl']->assign('help_page_title', $page_title);
	}

	public function index()
	{
		global_run();
		init_app_page();	
		$GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
		
		$cateId = intval($_REQUEST['cate_id']);

		$cateList = $this->getCateList();

		reset($cateList);
		$activeCateId = key($cateList);

		if (array_key_exists($cateId, $cateList)) {
			$activeCateId = $cateId;
		}

		$articleList = array();

		$keyword = strim($_REQUEST['keyword']);
		if (!empty($keyword)) {
			foreach ($cateList as $cate) {
				foreach ($cate['list'] as $art) {
					if (stripos($art['title'], $keyword) !== false) {
						$articleList[] = $art;
					}
				}
			}
			if (empty($articleList)) {
				$articleList[]['title'] = '没有找到相应帮助问题，请换个关键字试试';
			}
			$GLOBALS['tmpl']->assign('keyword', $keyword);
		} else {
			$articleList = $cateList[$activeCateId]['list'];
		}

		$GLOBALS['tmpl']->assign('articleList', $articleList);

		$GLOBALS['tmpl']->assign('activeCateId', $activeCateId);

        $GLOBALS['tmpl']->assign('cateList', $cateList);

		$GLOBALS['tmpl']->display("help_center_index.html");
	}

	public function search()
	{
		
	}

	public function getPageTitle()
	{
		$sql = 'SELECT name FROM '.DB_PREFIX.'nav WHERE u_module="help_center"';
		$title = $GLOBALS['db']->getOne($sql);
		return $title;
	}


	public function detail()
	{
		global_run();
		init_app_page();	
		$GLOBALS['tmpl']->assign("no_nav",true); //无分类下拉
		
		$id = intval($_REQUEST['id']);
		$cateId = intval($_REQUEST['cate_id']);

		$cateList = $this->getCateList();
		$content = '';
		if ($cateList) {
			foreach ($cateList as $cates) {
				foreach ($cates['list'] as $item) {
					if ($item['id'] == $id) {
						$content = $item['content'];
						
						break 2;
					}
				}
			}
		}

		$activeCateId = key($cateList);

		if (array_key_exists($cateId, $cateList)) {
			$activeCateId = $cateId;
		}

		$GLOBALS['tmpl']->assign('activeCateId', $activeCateId);
		$GLOBALS['tmpl']->assign('content', $content);
        $GLOBALS['tmpl']->assign('cateList', $cateList);

		$GLOBALS['tmpl']->display("help_center_detail.html");
	}
	
	private function getCateList()
	{
		$cateList = $GLOBALS['cache']->get('PC_HELP_CENTER_INDEX');
		if (empty($cateList)) {
			$cateSql = 'SELECT * FROM '.DB_PREFIX.'help_cate WHERE is_effect=1 AND is_delete=0 ORDER BY sort';
	    	$db_cateList = $GLOBALS['db']->getAll($cateSql);

	    	$cateIds = array();
	    	$cateList = array();
	    	foreach ($db_cateList as $cate) {
	    		$cateIds[] = $cate['id'];
	    		$cateList[$cate['id']] = $cate;
	    	}
	    	$articleSql = 'SELECT * FROM '.DB_PREFIX.'help_article WHERE cate_id in ('.implode(',', $cateIds).') AND content != "" AND is_effect=1 AND is_delete=0 ORDER BY sort';
	    	$articleList = $GLOBALS['db']->getAll($articleSql);
	    	foreach ($articleList as $art) {
	            $art['url'] = wap_url('index', 'help#detail', array('id' => $art['id']));
	    		$cateList[$art['cate_id']]['list'][] = $art;
	    	}
	        foreach ($cateList as $key => $value) {
	            if (empty($value['list'])) {
	                unset($cateList[$key]);
	            }
	        }
			$GLOBALS['cache']->set('PC_HELP_CENTER_INDEX', $cateList, 3600 * 24);
		}
		return $cateList;
	}

}