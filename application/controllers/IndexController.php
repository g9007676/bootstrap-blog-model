<?php
class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $blog_model = new Application_Model_MicroBlog();
        $blog_data = $blog_model->getObj(array('join' => true, 'all' => true, 'mb_status' => 3,'order'=>true));
        if ($blog_data) {
            Zend_Loader::loadFile('DbTool.php', 
            APPLICATION_PATH . '/../library');
            $DbTool = new DbTool();
            foreach ($blog_data as $val) {
                $val['mb_body'] = strip_tags($val['mb_body']);
                $str_title = $DbTool->filterString(24, $val['mb_title']);
                if (! empty($str_title)) {
                    $val['mb_title'] = substr($val['mb_title'], 0, $str_title) .
                     '...';
                }
                $str_body = $DbTool->filterString(150, $val['mb_body']);
                if (! empty($str_body)) {
                    $val['mb_body'] = substr($val['mb_body'], 0, $str_body) .
                     '...';
                }
            }
        }
        $this->view->blog_data = $blog_data;
        //recent
        $reply_model = new Application_Model_MicroBlogPost();
        $recent_data = $reply_model->getObj(array('joinmb' => true, 'all' => true, 'mbp_status' => 1,'limit'=>5,'mbp_created'=>true));
        foreach ($recent_data as $val) {
        	$val['mbp_body'] = strip_tags($val['mbp_body']);
         	$str_title1 = $DbTool->filterString(24, $val['mbp_body']);
         	$str_title4 = $DbTool->filterString(35, $val['mb_title']);
                if (! empty($str_title1)) {
                    $val['mbp_body'] = substr($val['mbp_body'], 0, $str_title1) .
                     '...';
                }
        	if (! empty($str_title4)) {
                    $val['mb_title'] = substr($val['mb_title'], 0, $str_title4) .
                     '...';
                }
        }
        $this->view->recent_data = $recent_data;
	    $hot_data = $blog_model->getObj(array('join' => true, 'all' => true, 'mb_status' => 3,'limit'=>5,'viewd'=>true));
	        foreach ($hot_data as $val) {
	         $str_title2 = $DbTool->filterString(24, $val['mb_title']);
	                if (! empty($str_title2)) {
	                    $val['mb_title'] = substr($val['mb_title'], 0, $str_title2) .
	                     '...';
	                }
	        }
	    $this->view->hot_data = $hot_data;
	    //category
	    $blog_ca_model = new Application_Model_MicroBlogCategory();
	    $blog_ca_data = $blog_ca_model->getObj(array('all'=>true,'order'=>true,'mbc_status'=>1));
	    $this->view->blog_ca_data = $blog_ca_data;
        //tag
        $tag_model = new Application_Model_TagMain();
	    $tag_data = $tag_model->fetchAll('tm_id>0');
	    $this->view->tag_data = $tag_data;
    }

    public function registerAction()
    {
        // action body
    }

    public function viewAction()
    {
        $blog_id = $this->_getParam('blog', null);
        if (empty($blog_id)) {
            $this->view->headScript()->appendScript("alert('Error: System error');location.href = ''");
        }
        $blog_main_model = new Application_Model_MicroBlog();
        $param['mb_id'] = $blog_id;
        $param['mb_status'] = 3;
        $param['row'] = true;
        $param['joinmember'] = true;
        $param['join'] = true;
        $blog_data = $blog_main_model->getObj($param);
        if (empty($blog_data)) {
            $this->view->headScript()->appendScript("alert('Error: System error');location.href = ''");
        }
        // transform date to unix timestamp
        $date = $blog_data->mb_created;
        $unix_timestamp = strtotime($date);
        $format_date = date('M d D  Y', $unix_timestamp);
        $this->view->format_date = $format_date;
        $this->view->blog_data = $blog_data;
        
        //add viewd
      	$blog_main_model->update(array('mb_viewed'=>$blog_data->mb_viewed+1),'mb_id='.$blog_data->mb_id);
      	//get reply
      	$blog_reply_model = new Application_Model_MicroBlogPost();
      	$postparam['mb_id'] = $blog_id;
        $postparam['mbp_created'] = true;
        $postparam['joinmember'] = true;
        $postparam['page'] = $this->_getParam('page',1);
        $this->view->page = $postparam['page']; 
        $postparam['pagCount'] = 5;
        $blog_reply = $blog_reply_model->getObj($postparam);
        $this->view->blog_reply = $blog_reply_model->DATAITEMS;
        $this->view->blog_reply_pagnater = $blog_reply;
        
        $tag_model = new Application_Model_TagArticleRel();
        $tag_data = $tag_model->getObj(array('mb_id'=>$blog_id,'all'=>true,'join'=>true));
        $this->view->tag_data = $tag_data;
        
        Zend_Loader::loadFile('DbTool.php', APPLICATION_PATH . '/../library');
        $DbTool = new DbTool();
        $recent_data = $blog_reply_model->getObj(array('joinmb' => true, 'all' => true, 'mbp_status' => 1,'limit'=>5,'mbp_created'=>true));
        foreach ($recent_data as $val) {
        	$val['mbp_body'] = strip_tags($val['mbp_body']);
         	$str_title1 = $DbTool->filterString(24, $val['mbp_body']);
         	$str_title4 = $DbTool->filterString(35, $val['mb_title']);
                if (! empty($str_title1)) {
                    $val['mbp_body'] = substr($val['mbp_body'], 0, $str_title1) .
                     '...';
                }
        	if (! empty($str_title4)) {
                    $val['mb_title'] = substr($val['mb_title'], 0, $str_title4) .
                     '...';
                }
        }
        $this->view->recent_data = $recent_data;
        
        $hot_data = $blog_main_model->getObj(array('join' => true, 'all' => true, 'mb_status' => 3,'limit'=>5,'viewd'=>true));
	        foreach ($hot_data as $val) {
	         $str_title2 = $DbTool->filterString(24, $val['mb_title']);
	                if (! empty($str_title2)) {
	                    $val['mb_title'] = substr($val['mb_title'], 0, $str_title2) .
	                     '...';
	                }
	        }
	    $this->view->hot_data = $hot_data;
	    
	    $blog_ca_model = new Application_Model_MicroBlogCategory();
	    $blog_ca_data = $blog_ca_model->getObj(array('all'=>true,'order'=>true,'mbc_status'=>1));
	    $this->view->blog_ca_data = $blog_ca_data;
        //tag
        $tag_main_model = new Application_Model_TagMain();
	    $tag_main_data = $tag_main_model->fetchAll('tm_id>0');
	    $this->view->tag_main_data = $tag_main_data;

        
    }

    public function replyAction()
    {
        $blog_id = $this->_getParam('blog', null);
        $page = $this->_getParam('page',1);
        $post  = $this->_getParam('post', null);
        if (empty($blog_id)) {
            $this->view->headScript()->appendScript("alert('Error: System error');location.href = ''");
        }
        $blog_post_model = new Application_Model_MicroBlogPost();
     	if(!empty($post)){
        	$blog_post_data = $blog_post_model->fetchRow('mbp_id=' . $post);
            $this->view->blog_post_data = $blog_post_data;
            $this->view->headScript()->appendScript("var ck_re_val ='" . str_replace("\n", "", $blog_post_data->mbp_body) . "'");
        }
	        $blog_main_model = new Application_Model_MicroBlog();
	        $param['mb_id'] = $blog_id;
//	        $param['mb_status'] = 3;
	        $param['row'] = true;
	        $blog_data = $blog_main_model->getObj($param);
	        if (empty($blog_data)) {
	            $this->view->headScript()->appendScript("alert('Error: System error');location.href = ''");
	        }
	        $blog_data->mb_body = strip_tags($blog_data->mb_body,'<body>,<br>,<p>,<span>,<ul>,<li>,<input>,<select>,<ol>,<div>,<pre>,<font>,<a>');  
	        $this->view->blog_data = $blog_data;
        $postparam['mb_id'] = $blog_id;
        $postparam['mbp_created'] = true;
        $postparam['joinmember'] = true;
        $postparam['page'] = $page;
        $postparam['pagCount'] = 5;
        $this->view->page = $page;
        $blog_reply = $blog_post_model->getObj($postparam);
        foreach ($blog_post_model->DATAITEMS as $val){
        	$val['mbp_body'] = strip_tags($val['mbp_body'],'<body>,<br>,<p>,<span>,<ul>,<li>,<input>,<select>,<ol>,,<div>,<pre>,<font>,<a>');
        }
        $this->view->blog_reply = $blog_post_model->DATAITEMS;
        
        Zend_Loader::loadFile('DbTool.php', APPLICATION_PATH . '/../library');
		$DbTool = new DbTool();
        $recent_data = $blog_post_model->getObj(array('joinmb' => true, 'all' => true, 'mbp_status' => 1,'limit'=>5,'mbp_created'=>true));
        foreach ($recent_data as $val) {
        	$val['mbp_body'] = strip_tags($val['mbp_body']);
         	$str_title1 = $DbTool->filterString(24, $val['mbp_body']);
         	$str_title4 = $DbTool->filterString(35, $val['mb_title']);
                if (! empty($str_title1)) {
                    $val['mbp_body'] = substr($val['mbp_body'], 0, $str_title1) .
                     '...';
                }
        	if (! empty($str_title4)) {
                    $val['mb_title'] = substr($val['mb_title'], 0, $str_title4) .
                     '...';
                }
        }
        $this->view->recent_data = $recent_data;
	    $hot_data = $blog_main_model->getObj(array('join' => true, 'all' => true, 'mb_status' => 3,'limit'=>5,'viewd'=>true));
	        foreach ($hot_data as $val) {
	         $str_title2 = $DbTool->filterString(24, $val['mb_title']);
	                if (! empty($str_title2)) {
	                    $val['mb_title'] = substr($val['mb_title'], 0, $str_title2) .
	                     '...';
	                }
	        }
	    $this->view->hot_data = $hot_data;
         //category
	    $blog_ca_model = new Application_Model_MicroBlogCategory();
	    $blog_ca_data = $blog_ca_model->getObj(array('all'=>true,'order'=>true,'mbc_status'=>1));
	    $this->view->blog_ca_data = $blog_ca_data;
        //tag
        $tag_model = new Application_Model_TagMain();
	    $tag_data = $tag_model->fetchAll('tm_id>0');
	    $this->view->tag_data = $tag_data;
    }
    public function searchAction()
    {
    	$blog_model = new Application_Model_MicroBlog();
    	$input = $this->_getAllParams();
    	$search['keyword'] = (isset($input['keyword']))?strip_tags($input['keyword']):null;
    	$search['tag'] = (isset($input['tag']))?strip_tags($input['tag']):null;
    	$search['ca'] = (isset($input['ca']))?strip_tags($input['ca']):null;
    	
    	$search['page'] = $this->_getParam('page',1);
    	$search['pagCount'] = 10; 
    	$search['mb_status'] =3 ;
    	$search['order'] = true;
    	$search = array_filter($search);
        $blog_data = $blog_model->getObj($search);
        if ($blog_data) {
            Zend_Loader::loadFile('DbTool.php', APPLICATION_PATH . '/../library');
            $DbTool = new DbTool();
            foreach ($blog_model-> DATAITEMS as $key=>$val) {
                $blog_model-> DATAITEMS[$key]['mb_body'] = strip_tags($blog_model-> DATAITEMS[$key]['mb_body']);
                $str_title = $DbTool->filterString(50, $blog_model-> DATAITEMS[$key]['mb_title']);
                if (! empty($str_title)) {
                    $blog_model-> DATAITEMS[$key]['mb_title'] = substr($blog_model-> DATAITEMS[$key]['mb_title'], 0, $str_title) .
                     '...';
                }
                $str_body = $DbTool->filterString(350, $blog_model-> DATAITEMS[$key]['mb_body']);
                if (! empty($str_body)) {
                    $blog_model-> DATAITEMS[$key]['mb_body'] = substr($blog_model-> DATAITEMS[$key]['mb_body'], 0, $str_body) .
                     '...';
                }
            }
        }
        $this->view->blog_data = $blog_model-> DATAITEMS;
        $this->view->blog_pagnater = $blog_data;
        //recent
        $reply_model = new Application_Model_MicroBlogPost();
        $recent_data = $reply_model->getObj(array('joinmb' => true, 'all' => true, 'mbp_status' => 1,'limit'=>5,'mbp_created'=>true));
        foreach ($recent_data as $val) {
        	$val['mbp_body'] = strip_tags($val['mbp_body']);
         	$str_title1 = $DbTool->filterString(24, $val['mbp_body']);
         	$str_title4 = $DbTool->filterString(35, $val['mb_title']);
                if (! empty($str_title1)) {
                    $val['mbp_body'] = substr($val['mbp_body'], 0, $str_title1) .
                     '...';
                }
        	if (! empty($str_title4)) {
                    $val['mb_title'] = substr($val['mb_title'], 0, $str_title4) .
                     '...';
                }
        }
        $this->view->recent_data = $recent_data;
	    $hot_data = $blog_model->getObj(array('join' => true, 'all' => true, 'mb_status' => 3,'limit'=>5,'viewd'=>true));
	        foreach ($hot_data as $val) {
	         $str_title2 = $DbTool->filterString(24, $val['mb_title']);
	                if (! empty($str_title2)) {
	                    $val['mb_title'] = substr($val['mb_title'], 0, $str_title2) .
	                     '...';
	                }
	        }
	    $this->view->hot_data = $hot_data;
	    //category
	    $blog_ca_model = new Application_Model_MicroBlogCategory();
	    $blog_ca_data = $blog_ca_model->getObj(array('all'=>true,'order'=>true,'mbc_status'=>1));
	    $this->view->blog_ca_data = $blog_ca_data;
        //tag
        $tag_model = new Application_Model_TagMain();
	    $tag_data = $tag_model->fetchAll('tm_id>0');
	    $this->view->tag_data = $tag_data;
    }
}







