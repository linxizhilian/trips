<?php
/* 
 * user_model
 */
class User_model extends Base_Model
{
    protected $_table = 'users';
    protected $primary_key = 'users.id';

    protected $order_by = 'users.id';

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

