<?php
class AuthtodoController extends Zend_Controller_Action
{

    public function init()
    {
        $mm_id = (isset(Zend_Auth::getInstance()->getStorage()->read()->mm_id)) ? Zend_Auth::getInstance()->getStorage()->read()->mm_id : '';
        if ($mm_id == '') {
            $this->view->headScript()->appendScript(
            "alert('Error: No Information');location.href = ''");
        }
        if ($mm_id == 2) {
            $this->view->headScript()->appendScript(
            "alert('Error: Account not opened');location.href = ''");
        }
        if ($mm_id == 3) {
            $this->view->headScript()->appendScript(
            "alert('Error: Account has been disabled');location.href = ''");
        }
    }

    public function postAction()
    {
        $blog_category_model = new Application_Model_MicroBlogCategory();
        $category_data = $blog_category_model->fetchAll('mbc_id > 0')->toArray();
        $this->view->category_data = $category_data;
        $tag_main_model = new Application_Model_TagMain();
        $tag_data = $tag_main_model->fetchAll('tm_id > 0')->toArray();
        $this->view->tag_data = $tag_data;
        // get post_main data
        $blog_model = new Application_Model_MicroBlog();
        $mb_id = $this->_getParam('blog', null);
        if (! empty($mb_id)) {
            $blog_data = $blog_model->fetchRow('mb_id=' . $mb_id);
            $this->view->blog_data = $blog_data;
            $this->view->headScript()->appendScript(
            "var ck_re_val ='" . str_replace("\n", "", $blog_data->mb_body) . "'");
            // get tag
            $tag_rel_model = new Application_Model_TagArticleRel();
            $tag_rel_data = $tag_rel_model->getObj(
            array('mb_id' => $mb_id, 'join' => true, 'all' => true));
            $this->view->tag_rel_data = $tag_rel_data;
        }
    }

    public function postlistAction()
    {
        $blog_model = new Application_Model_MicroBlog();
        $blog_data = $blog_model->getObj(array('join' => true, 'all' => true,'mb_author'=>Zend_Auth::getInstance()->getStorage()->read()->mm_id));
        Zend_Loader::loadFile('DbTool.php', APPLICATION_PATH . '/../library');
        $DbTool = new DbTool();
        foreach ($blog_data as $val) {
            $str_title = $DbTool->filterString(120, $val['mb_title']);
            if (! empty($str_title)) {
                $val['mb_title'] = substr($val['mb_title'], 0, $str_title) .
                 '...';
            }
        }
        $this->view->blog_data = $blog_data;
    }

    public function previewAction()
    {
        $blog_id = $this->_getParam('blog', null);
        if (empty($blog_id)) {
            $this->view->headScript()->appendScript(
            "alert('Error: System error');location.href = ''");
        }
        $blog_main_model = new Application_Model_MicroBlog();
        $param['mb_id'] = $blog_id;
        $param['mb_status'] = 3;
        $param['row'] = true;
        $param['join'] = true;
        $blog_data = $blog_main_model->getObj($param);
        if (empty($blog_data)) {
            $this->view->headScript()->appendScript(
            "alert('Error: System error');location.href = ''");
        }
        // transform date to unix timestamp
        $date = $blog_data->mb_created;
        $unix_timestamp = strtotime($date);
        $format_date = date('M d D  Y', $unix_timestamp);
        $this->view->format_date = $format_date;
        //地址 
        $this->view->blog_data = $blog_data;
    }

    public function replylistAction()
    {
    	Zend_Loader::loadFile('DbTool.php', APPLICATION_PATH . '/../library');
        $DbTool = new DbTool();
		$blog_reply_model = new Application_Model_MicroBlogPost();
		$params['mm_id'] = Zend_Auth::getInstance()->getStorage()->read()->mm_id;
		$params['joinmb'] = true;
		$params['mbp_created'] = true;
		$params['all'] = true;
		$reply_data  = $blog_reply_model->getObj($params);
		
		if(!empty($reply_data)){
			foreach ($reply_data as $val){
				$val['mbp_body'] = strip_tags($val['mbp_body']);
				$str_title = $DbTool->filterString(120, $val['mbp_body']);
				 if (! empty($str_title)) {
	                $val['mbp_body'] = substr($val['mbp_body'], 0, $str_title) .
	                 '...';
	            }
			}
			$this->view->reply_data = $reply_data;
		}
    }
}











