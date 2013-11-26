<?php
class Application_Model_MicroBlogPost extends Application_Model_DbTable_MicroBlogPost
{
	public $DATAITEMS;
    public function getObj ($params)
    {
        $select = $this->select(true)->setIntegrityCheck(false);
        if (isset($params['joinmember'])) {
            $select->joinLeft('member_main', 'micro_blog_post.mm_id=member_main.mm_id');
        }
    	if (isset($params['joinmb'])) {
            $select->joinLeft('micro_blog', 'micro_blog.mb_id=micro_blog_post.mb_id');
        }
        if (isset($params['mb_id'])) {
            $select->where('micro_blog_post.mb_id = ' . $params['mb_id']);
        }
    	if (isset($params['mbp_status'])) {
            $select->where('mbp_status = ' . $params['mbp_status']);
        }
    	if (isset($params['mm_id'])) {
            $select->where('micro_blog_post.mm_id = ' . $params['mm_id']);
        }
    	if (isset($params['mbp_created'])) {
            $select->order('mbp_created DESC');
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

