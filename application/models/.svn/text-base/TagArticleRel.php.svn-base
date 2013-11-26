<?php
class Application_Model_TagArticleRel extends Application_Model_DbTable_TagArticleRel
{
    public function getObj ($params)
    {
    	
        $select = $this->select(true)->setIntegrityCheck(false);
        if (isset($params['join'])) {
            $select->joinInner('tag_main', 
            'tag_main.tm_id=tag_article_rel.tm_id');
        }
        if (isset($params['mb_id'])) {
            $select->where('mb_id = ' . $params['mb_id']);
        }
        if (isset($params['group'])) {
            $select->group('tag_article_rel.tm_id');
        }
        if (isset($params['row'])) {
            $data = $this->fetchRow($select);
        }
        if (isset($params['all'])) {
            $data = $this->fetchAll($select);
        }
        return $data;
    }
}

