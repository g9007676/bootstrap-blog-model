<?php
class DbTool
{
    function _paginator ($input, $select)
    {
        $currentpage = (isset($input['page'])) ? $input['page'] : 1;
        $rows = (isset($input['limit'])) ? $input['limit'] : 1;
        $paginator = Zend_Paginator::factory($select);
        $paginator->setItemCountPerPage($rows)->setCurrentPageNumber(
        $currentpage);
        $result['success'] = true;
        $result["total"] = $paginator->getTotalItemCount();
        $result['rows'] = $paginator->getItemsByPage($currentpage)->toArray();
        return $result;
    }
 	/*
     * 去除html標籤or<script>
     */
    function trmpXss ($input)
    {
    	foreach ($input as $val){
    		$val = strip_tags($val);
    		$val = htmlentities($val);
    	}    	
        return $input; 
    }
    /*
     * 刪掉圖片
     */
    function deleteimg ($path, $img_name)
    {
        if (file_exists($path . '/' . $img_name)) {
            @chmod($path, 0777);
            @unlink($path . '/' . $img_name);
        }
    }
    /*
     * 交集陣列,取正確陣列
     */
    function intersectionArray ($model = null, $input, $db_cols)
    {
        if (isset($model)) {
            $table = new $model();
        }
        $db = (isset($model)) ? $table->info('cols') : $db_cols;
        $tmps = array_flip($db);
        $data = array_intersect_key($input, $tmps);
        return $data;
    }
    function getIp(){
		if (!empty($_SERVER["HTTP_CLIENT_IP"])){
    		$ip = $_SERVER["HTTP_CLIENT_IP"];
		}elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
    		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}else{
    		$ip = $_SERVER["REMOTE_ADDR"];
		}
		return  $ip;
    }
    /*
     * json decode
     */
    function getIdAry ($input)
    {
        return Zend_Json::decode($input['id']);
    }
    function getSuccess ($val)
    {
        $rs['success'] = TRUE;
        if (! $val) {
            $rs['success'] = FALSE;
        }
        return $rs;
    }
	//亂數密碼產生器
	function randPassword($nub){
		$password="";
		$str="0123456789abcdefghijklmnopqrstuvwxyz";
		$str_len=strlen($str);
		for ($i=1;$i<=$nub;$i++){	
			$rg=rand()%$str_len;
			$password.=$str{$rg};
		}
	return $password;
	}
 	function filterString($lenght,$str){
	  	$str_len =  mb_strlen($str,'UTF8');;
	  	$totle = 0; 
	  	//總共大小
	    for($i =0;$i<$str_len;$i++){
	    	$totle +=(strlen(mb_substr($str,$i,1,'UTF8')) >= 3)?2:1;
	    }    
	    if($totle < $lenght){
	        	return false;
	    }
        $totle=0;
        $sub_totle = 0;
        for($i =0;$i<$str_len;$i++){			
        	$totle += strlen(mb_substr($str,$i,1,'UTF8'));
        	$sub_totle += (ord(mb_substr($str,$i,1,'UTF8')) > 0xA0)?2:1;
        	if($sub_totle > $lenght){
        		$totle = (ord(mb_substr($str,$i,1,'UTF8')) > 0xA0)?$totle -3:$totle -1;
        		break;
        	}
        }
        return $totle;
    }
}