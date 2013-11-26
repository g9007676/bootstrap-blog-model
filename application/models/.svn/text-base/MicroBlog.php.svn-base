<?php
class Application_Model_MicroBlog extends Application_Model_DbTable_MicroBlog
{
	public $DATAITEMS;
    public function getObj ($params)
    {
        $select = $this->select(true)->setIntegrityCheck(false);
    	if (isset($params['joinmember'])) {
            $select->joinRight('member_main','micro_blog.mb_author=member_main.mm_id');
        }
        if (isset($params['join'])) {
            $select->joinInner('micro_blog_category','micro_blog.mbc_id=micro_blog_category.mbc_id');
        }
     	if (isset($params['tag'])) {
            $select->joinInner('tag_article_rel','tag_article_rel.mb_id=micro_blog.mb_id');
            $select->where('tag_article_rel.tm_id='.$params['tag']);
        }
    	if (isset($params['ca'])) {
            $select->where('micro_blog.mbc_id='.$params['ca']);
        }
     	if (isset($params['keyword'])) {
            $select->where('mb_title like ?', '%'. $params['keyword'].'%');
        }
        if (isset($params['mb_author'])) {
            $select->where('mb_author = ' . $params['mb_author']);
        }
        if (isset($params['mb_status'])) {
            $select->where('mb_status = ' . $params['mb_status']);
        }
        if (isset($params['mb_id'])) {
            $select->where('micro_blog.mb_id = ' . $params['mb_id']);
        }
    	if (isset($params['order'])) {
            $select->order('mb_created DESC');
            $select->order('micro_blog.mb_id DESC');
        }
    	if (isset($params['viewd'])) {
            $select->order('mb_viewed DESC');
        }
    	if (isset($params['limit'])) {
            $select->limit($params['limit']);
        }
        if (isset($params['row'])) {
            $result = $this->fetchRow($select);
        }
        if (isset($params['all'])) {
            $result = $this->fetchAll($select);
        }
        if(isset($params['page'])){
    		$currentpage = (isset($params['page'])) ?$params['page'] : 1;
        	$rows = (isset($params['pagCount'])) ? $params['pagCount'] : 10;
        	$paginator = Zend_Paginator::factory($select);
        	$paginator->setItemCountPerPage($rows)->setCurrentPageNumber($currentpage);
        	$result['success'] = true;
        	$result["total"] = $paginator->getTotalItemCount();
        	$result['rows'] = $paginator;
        	$datas =$paginator->getItemsByPage($currentpage)->toArray();
        	$this->DATAITEMS =$datas;
    	}
    	return $result;
    }
}

