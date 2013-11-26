<?php
class AjaxController extends Zend_Controller_Action
{
    public $DbTool;
    public $Tool;
    public function init ()
    {
        //載入library
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        Zend_Loader::loadFile('DbTool.php', APPLICATION_PATH . '/../library');
        $this->DbTool = new DbTool();
        Zend_Loader::loadFile('Tool.php', APPLICATION_PATH . '/../library');
        $this->Tool = new Library_Tool();
        $action = $this->_getParam('action');
        $auth_action_ary = array('addpostcategory', 'deletepoststatus', 
        'deletepost', 'addposttag', 'deletetag', 'addpost', 'editpost', 
        'uploadfile');
        if (in_array($action, $auth_action_ary) &&
         ! isset(Zend_Auth::getInstance()->getStorage()->read()->mm_id)) {
            echo Zend_Json::encode(
            array('success' => false, 
            'msg' => 'Error:You have to login before you can use'));
            exit();
        }
    }
    public function loginAction ()
    {
        $email = $this->_getParam('email', null);
        $password = $this->_getParam('password', null);
        $check_me = $this->_getParam('check_me', null);
        $authAdapter = new Zend_Auth_Adapter_DbTable(
        Zend_Db_Table::getDefaultAdapter());
        $authAdapter->setTableName('member_main')
            ->setIdentityColumn('mm_email')
            ->setCredentialColumn('mm_password')
            ->setCredentialTreatment('md5(?)');
        $authAdapter->getDbSelect();
        $authAdapter->setIdentity($email)->setCredential($password);
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($authAdapter);
        $user = $authAdapter->getResultRowObject();
        if (! $result->isValid()) {
            echo Zend_Json::encode(
            array('success' => false, 'msg' => 'Error:Email or password error'));
            exit();
        }
        if ($user->mm_status == 3) {
            echo Zend_Json::encode(
            array('success' => false, 'msg' => 'Error:Email disabled'));
            exit();
        }
        $auth->getStorage()->write('');
        $auth->getStorage()->write($user);
        if (isset($check_me)) {
            setcookie('check_email', $user->mm_email, time() + 3600 * 24, '/');
        } else {
            setcookie('check_email', null, time() - 3600 * 24, '/');
        }
        echo Zend_Json::encode(array('success' => true));
        exit();
    }
    public function signupAction ()
    {
        //post 的值
        $input = $this->_getAllParams();
        //新增攔位值
        $input = $this->addMemberCol($input);
        //宣告model
        $member_main_model = new Application_Model_MemberMain();
        //圖片上傳
        $result = $this->Tool->upload($input);
        if (!$result['success']) {
            echo Zend_Json::encode(array('success' => false, 'msg' => $result['msg']));exit();
        }
        //確定圖片是否存在
        if (! empty($result['files'])) {
            foreach ($result['files'] as $index => $val) {
                $input[$index] = $val;
            }
        }
        $member_data = $this->DbTool->intersectionArray(null, $input, 
        $member_main_model->info('cols'));
        $id = $member_main_model->insert($member_data);
        if (! $id) {
            echo Zend_Json::encode(
            array('success' => false, 
            'msg' => 'Error: New process occurs wrong thing'));
            exit();
        }
        $auth = Zend_Auth::getInstance();
        $auth->getStorage()->write('');
        $auth->getStorage()->write($member_main_model->fetchRow('mm_id=' . $id));
        echo Zend_Json::encode(array('success' => true));
        exit();
    }
    function addMemberCol ($input)
    {
        $input = array_filter($input);
        $input['mm_password'] = md5($input['mm_password']);
        $input['mm_created'] = Zend_Date::now()->toString('YYYY-MM-dd HH:mm:ss');
        $input['mm_status'] = 1;
        $input['path'] = 'images/member_avatar';
        return $input;
    }
    public function logoutAction ()
    {
        $auth = Zend_Auth::getInstance();
        if (isset($auth->getStorage()->read()->mm_id)) {
            $auth->clearIdentity();
            $auth->getStorage()->write(array());
        }
        session_destroy();
        echo Zend_Json::encode(array('success' => true));
        exit();
    }
    public function getsessionAction ()
    {
        $auth = Zend_Auth::getInstance();
        if (isset($auth->getStorage()->read()->mm_id)) {
            echo Zend_Json::encode(array('success' => true,'auth'=>$auth->getStorage()->read()));exit();
        }
        echo Zend_Json::encode(array('success' => false));exit();
    }
    public function addpostcategoryAction ()
    {
        $blog_category_model = new Application_Model_MicroBlogCategory();
        $input['category_val'] = $this->_getParam('category_val', null);
        if (empty($input['category_val'])) {
            echo Zend_Json::encode(
            array('success' => false, 'msg' => 'Error: System error'));
            exit();
        }
        $input = $this->DbTool->trmpXss($input);
        $category_data = $blog_category_model->fetchRow(
        'mbc_name = "' . $input['category_val'] . '"');
        if (! empty($category_data)) {
            echo Zend_Json::encode(
            array('success' => false, 'msg' => 'Error: Empty Category'));
            exit();
        }
        if (mb_strlen($input['category_val']) > 10) {
            echo Zend_Json::encode(
            array('success' => false, 
            'msg' => 'Error: String length not greater than 10 characters'));
            exit();
        }
        $data = array('mbc_name' => $input['category_val'], 'mbc_status' => 1);
        $id = $blog_category_model->insert($data);
        if ($id) {
            $category_all_data = $blog_category_model->fetchAll('mbc_id > 0')->toArray();
            echo Zend_Json::encode(
            array('success' => true, 
            'msg' => 'Success: add post category Success!', 
            'returndata' => $category_all_data));
            exit();
        }
        echo Zend_Json::encode(
        array('success' => false, 'msg' => 'Error: System error'));
        exit();
    }
    public function deletepoststatusAction ()
    {
        $mb_id = Zend_Json::decode($this->_getParam('mb_id', null));
        $blog_model = new Application_Model_MicroBlog();
        $blog_model->update(array('mb_status' => 4), 'mb_id=' . $mb_id);
        echo Zend_Json::encode(
        array('success' => true, 'msg' => 'Success: Delete Success!'));
        exit();
    }
    public function deletepostAction ()
    {
        $ids = Zend_Json::decode($this->_getParam('ids', null));
        $blog_category_model = new Application_Model_MicroBlogCategory();
        foreach ($ids as $val) {
            $blog_category_model->delete('mbc_id = ' . $val);
        }
        $category_data = $blog_category_model->fetchAll('mbc_id > 0')->toArray();
        echo Zend_Json::encode(
        array('success' => true, 'msg' => 'Success: Delete Success!', 
        'returndata' => $category_data));
        exit();
    }
    public function addposttagAction ()
    {
        $tag_main_model = new Application_Model_TagMain();
        $input['tag_val'] = $this->_getParam('tag_val', null);
        if (empty($input['tag_val'])) {
            echo Zend_Json::encode(
            array('success' => false, 'msg' => 'Error: System error'));
            exit();
        }
        $input = $this->DbTool->trmpXss($input);
        $tag_data = $tag_main_model->fetchRow(
        'tm_name = "' . $input['tag_val'] . '"');
        if (mb_strlen($input['tag_val']) > 10) {
            echo Zend_Json::encode(
            array('success' => false, 
            'msg' => 'Error: String length not greater than 10 characters'));
            exit();
        }
        if (empty($tag_data)) {
            $data = array('tm_name' => $input['tag_val']);
            $id = $tag_main_model->insert($data);
        }
        if ($id || $tag_data) {
            $tag_all_data = $tag_main_model->fetchAll('tm_id > 0')->toArray();
            echo Zend_Json::encode(
            array('success' => true, 'msg' => 'Success: Add post tag Success!', 
            'returndata' => $tag_all_data));
            exit();
        }
        echo Zend_Json::encode(
        array('success' => false, 'msg' => 'Error: System error'));
        exit();
    }
    public function postAction ()
    {
        $input = $this->_getAllParams();
        $input['mb_body'] = stripslashes($input['mb_body']);
        $input = array_filter($input);
        $success_mas = 'Success: Edit post Success!';
        if (! isset($input['mb_id'])) {
            $success_mas = 'Success: Add post Success!';
            // 處理ck
            $input['mb_created'] = Zend_Date::now()->toString('YYYY-MM-dd');
            $input['mb_author'] = Zend_Auth::getInstance()->getStorage()->read()->mm_id;
        }
        $input['mb_status'] = ($input['mb_status'] !='undefined') ? $input['mb_status'] : 3;
        $success_mas = (isset($input['mb_status'])) ? 'Success: Change post Status Success!' : $success_mas;
        $data = $this->DbTool->intersectionArray('Application_Model_MicroBlog', $input, null);
        $data = $this->DbTool->trmpXss($data);
        $blog_model = new Application_Model_MicroBlog();
        if (! isset($input['mb_id'])) {
            unset($data['mb_id']);
            $input['mb_id'] = $blog_model->insert($data);
            $blog_ca_model = new Application_Model_MicroBlogCategory();
            $blog_ca_data = $blog_ca_model->fetchRow('mbc_id='.$input['mbc_id']);
            $blog_ca_data->mbc_count_nub = $blog_ca_data->mbc_count_nub+1;
            $blog_ca_data->save();  
        }else{
        	$blog_model->update($data, 'mb_id=' . $input['mb_id']);
        }
        $tag_model = new Application_Model_TagArticleRel();
        $tag_model->delete('mb_id = ' . $input['mb_id']);
        if (! empty($input['ids'])) {
            foreach ($input['ids'] as $val) {
                $tag_data = array('tm_id' => $val, 'mb_id' => $input['mb_id']);
                $tag_model->insert($tag_data);
            }
            $tag_main_model = new Application_Model_TagMain();
            $tag_list = $tag_main_model->fetchAll('tm_id>0')->toArray();
            $tag_list = (! empty($tag_list)) ? $tag_list : '';
            $tag_empty_list = $tag_model->getObj(
            array('mb_id' => $input['mb_id'], 'join' => true, 'all' => true, 'group' => true))->toArray();
            $tag_empty_list = (! empty($tag_empty_list)) ? $tag_empty_list : '';
            echo Zend_Json::encode(array('success' => true, 'msg' => $success_mas, 'tag_list' => $tag_list, 'tag_empty_list' => $tag_empty_list, 'mb_id' => $input['mb_id']));
            exit();
        }
        echo Zend_Json::encode(array('success' => false, 'msg' => 'Error: System error'));exit();
    }
    public function uploadfileAction ()
    {
        $input['path'] = 'images/blog_cover';
        $result = $this->Tool->upload($input, 600000);
        if ($result['success']) {
            $t_filename = explode('.', $result['files']['fileBtn']);
            $t_filename = strtolower(end($t_filename));
            $new_cover_name = time() . '.' . $t_filename;
            copy($input['path'] . '/' . $result['files']['fileBtn'], 
            $input['path'] . '/' . $new_cover_name);
            @chmod('images/blog_cover/', 0777);
            if (isset($rs)) {
                unlink($input['path'] . '/' . $result['files']['fileBtn']);
            }
            echo Zend_Json::encode(
            array('success' => true, 'path' => $input['path'] . '/', 
            'img' => $new_cover_name));
        } else {
            echo Zend_Json::encode(
            array('success' => false, 'msg' => $result['msg']));
        }
    }
    public function addreplyAction(){
    	$input = $this->_getAllParams();
    	$auth = Zend_Auth::getInstance();
    	if($input['member'] == 1 && !isset($auth->getStorage()->read()->mm_id)){
    		echo Zend_Json::encode(array('success' => false, 'msg' => 'Error: Please try again in Login'));exit();
        }
        $success_mas = 'Success: Edit reply Success!';
        if(empty($input['mbp_id'])){
        	$success_mas = 'Success: Add reply Success!';
	        $input['mm_id'] = ($input['member'] == 1)?$auth->getStorage()->read()->mm_id:0;
	        $input['mbp_created'] = Zend_Date::now()->toString('YYYY-MM-dd HH:mm:ss');
	        $input['mbp_status'] = 1;
        }else{
        	$blog_post_model = new Application_Model_MicroBlogPost();
        	$blog_post_data = $blog_post_model->fetchRow('mbp_id=' . $input['mbp_id']);
        	if($blog_post_data -> mm_id == 0 || isset($auth->getStorage()->read()->mm_id) && $blog_post_data ->mm_id != $auth->getStorage()->read()->mm_id){
        		echo Zend_Json::encode(array('success' => false, 'msg' => 'Error: Visitors may not modify articles or non-Article I'));exit();
        	}
        }
        $input['mbp_body'] = stripslashes($input['mbp_body']);
        $data = $this->DbTool->intersectionArray('Application_Model_MicroBlogPost',$input, null);
        $data = $this->DbTool->trmpXss($data);
        $blog_post_model = new Application_Model_MicroBlogPost();
    	if ($input['mbp_id'] == '') {
            $input['mbp_id'] = $blog_post_model->insert($data);
            $blog_main_model = new Application_Model_MicroBlog();
        	$blog_data = $blog_main_model -> fetchRow('mb_id='.$input['mb_id']);
        	$blog_data->mb_reply_nub = $blog_data->mb_reply_nub+1;
        	$blog_data->save();
        }else{
        	unset($data['mbp_id']);
        	$blog_post_model->update($data, 'mbp_id=' . $input['mbp_id']);
        }
        if($input['mbp_id']){
        	echo Zend_Json::encode(array('success' => true, 'msg' => $success_mas,'mbp_id'=>$input['mbp_id']));exit();
        }
        echo Zend_Json::encode(array('success' => false, 'msg' => 'Error: System error'));exit();
        
    	
    }
}

