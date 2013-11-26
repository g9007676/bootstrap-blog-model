<?php
class Application_Model_MicroBlogCategory extends Application_Model_DbTable_MicroBlogCategory
{
    public function getObj ($params)
    {
        $select = $this->select(true)->setIntegrityCheck(false);
        
        if (isset($params['order'])) {
            $select->order('mbc_count_nub DESC');
        }
    	if (isset($params['mbc_status'])) {
            $select->where('mbc_status = '.$params['mbc_status']);
        }
        if (isset($params['row'])) {
            $result = $this->fetchRow($select);
        }
        if (isset($params['all'])) {
            $result = $this->fetchAll($select);
        }
        return $result;
    }
}

