<?php
/* 
 * Category_model
 */
class Other_model extends Base_Model
{
    protected $_table = 'others';
    protected $primary_key = 'others.id';

    protected $order_by = 'others.id';

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

