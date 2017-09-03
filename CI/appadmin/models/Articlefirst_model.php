<?php
/* 
 * Articlefirst_model
 */
class Articlefirst_model extends Base_Model
{
    protected $_table = 'article_first';
    protected $primary_key = 'article_first.id';

    protected $order_by = 'article_first.id';

    /**
     * 取数据条数，0表示不限制
     */
    protected $limit = 0;
    
    /**
     * 初始化当前model
     */
    public function __construct()
    {
        parent::__construct();
        $this->_fetch_fields();
    }
}

