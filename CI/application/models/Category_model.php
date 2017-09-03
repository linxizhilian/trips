<?php
/* 
 * Category_model
 */
class Category_model extends Base_Model
{
    protected $_table = 'category';
    protected $primary_key = 'category.id';

    protected $order_by = 'category.id';

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
    public function get_all2()
    {
        return 222;
    }
}

