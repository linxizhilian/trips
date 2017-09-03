<?php

/**
 * A base model with a series of CURD functions,
 * validation-in-model support, event callbacks and more.
 *
 * @package CI_Model
 * @author
 * @since version V1.0
 */
class Base_Model extends CI_Model {

    /**
     * This model's default database table
     * @var string
     */
    protected $_table = '';

    /**
     * The database connection object. Will be set to the default connection.
     * @var object 
     */
    public $_db;

    /**
     * This model's default primary key or unique identifier.
     * @var string
     */
    protected $primary_key = 'id';

    /**
     * 默认排序字段
     * @var string
     */
    protected $order_by = '';

    /**
     * 默认排序方向
     * @var string
     */
    protected $direction = 'desc';

    /**
     * 默认显示行数
     * @var integer
     */
    protected $limit = 10;

    /**
     * 数据表字段
     * @var array
     */
    protected $_fields = array();

    /**
     * 查询字段
     * @var array 
     */
    protected $_select_fields = array();

    /**
     * Support for soft delete
     * @var boolean
     */
    protected $soft_delete = FALSE;

    /**
     * This model's 'deleted' key for soft deletes
     * @var string
     */
    protected $soft_delete_key = '';

    /**
     * 假删除中表示删除的字段值
     * @var string|integer
     */
    protected $soft_delete_value;

    /**
     * 在查询中，是否查询已经标记为被删除的记录
     * @var boolean
     */
    protected $_temp_with_deleted = FALSE;

    /**
     * 验证规则
     * @var array
     */
    protected $validate = array();

    /**
     * 跳过验证
     * @var boolean
     */
    protected $skip_validation = FALSE;

    /**
     * 设置查询结果集的返回类型为数组
     * @var string
     */
    protected $return_type = 'array';

    /**
     * 改变查询结果集的返回类型
     * @var string
     */
    protected $_temp_return_type = NULL;

    /**
     * 初始化当前Model
     */
    public function __construct() {
        parent::__construct();

        // $this->_db = $this->db;
        $this->_db = $this->load->database('default', TRUE);
        $this->_fetch_table();

        $this->_temp_return_type = $this->return_type;
    }

    /* --------------------------------------------------------------
     * CRUD 接口 
     * ------------------------------------------------------------ */

    /**
     * 基于主键查询单条记录
     * @param  integer  $primary_value  主键值
     * @param  string   $fields         查询字段
     * @param  boolean  $filter         是否过滤查询字段
     * @param  boolean  $escape         是否转义
     * @return array|object  
     */
    public function get($primary_value, $fields = '', $filter = TRUE, $escape = TRUE) {
        $where = array($this->primary_key, $primary_value);
        return $this->get_by($where, $fields, $filter, $escape);
    }

    /**
     * 基于WHERE条件查询单条记录
     * @param  array    $where   WHERE条件
     * @param  string   $fields  查询字段
     * @param  boolean  $filter  是否过滤查询字段
     * @param  boolean  $escape  是否转义
     * @return array|object
     */
    public function get_by($where, $fields = '', $filter = TRUE, $escape = TRUE) {
        $this->_set_select($fields, $filter, $escape);

        if ($this->soft_delete && TRUE !== $this->_temp_with_deleted) {
            $this->_db->where("{$this->soft_delete_key} !=", $this->soft_delete_value);
        }

        $this->_set_where($where);

        $row = $this->_db->get($this->_table)
                ->{$this->_return_type()}();
        $this->_temp_return_type = $this->return_type;
        //echo $this->_db->last_query();
        return $row;
    }

    /**
     * 基于主键数组，查询多条记录
     * @param  array   $values  主键值数组
     * @param  string  $fields  查询字段
     * @param  boolean $filter  是否过滤查询字段
     * @param  boolean $escape  是否转义
     * @return array|object
     */
    public function get_many($values, $fields = '', $filter = TRUE, $escape = TRUE) {
        $this->_db->where_in($this->primary_key, $values);
        return $this->get_all($fields, $filter, $escape);
    }

    /**
     * 基于WHERE条件，查询多条记录
     * @param  array    $where     WHERE条件数组
     * @param  string   $fields    查询字段
     * @param  array    $order_by  排序
     * @param  boolean  $filter    是否过滤查询字段
     * @param  boolean  $escape    是否转义
     */
    public function get_many_by($where, $fields = '', $order_by = array(), $filter = TRUE, $escape = TRUE) {
        $this->_set_where($where);

        if (!empty($order_by)) {
            $this->_set_order_by($order_by);
        }

        return $this->get_all($fields, $order_by, $filter, $escape);
    }

    /**
     * 查询数据表中所有记录
     * @param  string   $fields  查询字段
     * @param  boolean  $filter  是否过滤查询字段
     * @param  boolean  $escape  是否转义
     * @return array|object
     */
    public function get_all($fields = '', $order_by = array(), $filter = TRUE, $escape = TRUE) {
        $this->_set_select($fields, $filter, $escape);

        if ($this->soft_delete && TRUE !== $this->_temp_with_deleted) {
            $this->_db->where("{$this->soft_delete_key} !=", $this->soft_delete_value);
        }

        if (!empty($order_by)) {
            $this->_set_order_by($order_by);
        }

        $result = $this->_db->get($this->_table)
                ->{$this->_return_type(1)}();
        $this->_temp_return_type = $this->return_type;

        return $result;
    }

    /**
     * 检查数据记录字段值唯一性
     * @param  array $data
     * @return boolean
     */
    public function is_unique($data) {
        foreach ($data as $key => $val) {
            $this->_db->or_where($key, $val);
        }
        
        if ($this->soft_delete && TRUE !== $this->_temp_with_deleted) {
            $this->_db->where("{$this->soft_delete_key} !=", $this->soft_delete_value);
        }

        $result = $this->_db->get($this->_table)
                ->{$this->_return_type(1)}();

        $is_unique = TRUE;
        if ($result && !empty($result)) {
            $is_unique = FALSE;
        }

        return $is_unique;
    }
    
    /**
     * 检查数据记录字段唯一性，如果数据记录已存在，返回此记录ID（Primary Key）
     * @param array $data
     * @return boolean|integer
     */
    public function is_unique1($data) {
        $this->_db->select('id');
        
        foreach ($data as $key => $val) {
            $this->_db->or_where($key, $val);
        }
        
        if ($this->soft_delete && TRUE !== $this->_temp_with_deleted) {
            $this->_db->where("{$this->soft_delete_key} !=", $this->soft_delete_value);
        }

        $result = $this->_db->get($this->_table)
                ->{$this->_return_type(1)}();
        
        $is_unique = FALSE;
        
        if ($result && !empty($result)) {
            $is_unique = $result[0]['id'];
        }

        return $is_unique;
    }
    
        /**
     * 检查数据记录字段值唯一性
     * @param  array $data
     * @return boolean
     */
    public function is_unique2($data) {
        foreach ($data as $key => $val) {
            $this->_db->where($key, $val);
        }
        
        if ($this->soft_delete && TRUE !== $this->_temp_with_deleted) {
            $this->_db->where("{$this->soft_delete_key} !=", $this->soft_delete_value);
        }

        $result = $this->_db->get($this->_table)
                ->{$this->_return_type(1)}();
        //echo $this->_db->last_query();
        //var_dump($result);
        $is_unique = TRUE;
        if ($result && !empty($result)) {
            $is_unique = FALSE;
        }

        return $is_unique;
    }

    /**
     * 单表数据查询
     * $params 是查询条件数组，可包含字段及描述如下：
     * $params['fields']   string  查询的字段
     * $params['join']     array   联合查询
     * $params['where']    array   WHERE    子句
     * $params['order_by'] array   ORDER_BY 子句
     * $params['or_like']  array   OR_LIKE  子句
     * $params['group_by'] array   GROUP_BY 子句
     * $params['limit']    array   LIMIT    子句
     * @param  array         $params  查询条件数组
     * @param  string|array  $key     查询主键键值对数组 或 查询主键值 
     * @param  boolean       $filter  是否过滤查询字段 
     * @param  boolean       $escape  是否转义
     * @return array|object
     */
    public function get_list($params = array(), $key = NULL, $filter = TRUE, $escape = TRUE) {
        // 查询字段
        if (isset($params['fields'])) {
            $this->_set_select($params['fields'], $filter, $escape);
        }
        // 联合查询
        if (isset($params['join'])) {
            $this->_set_join($params['join']);
        }
        // WHERE 子句
        if (isset($params['where'])) {
            $this->_set_where($params['where']);
        }
        // ORDER_BY 子句
        if (isset($params['order_by'])) {
            $this->_set_order_by($params['order_by']);
        } else {
            if (NULL != $this->order_by && NULL != $this->direction) {
                $order_by = array($this->order_by => $this->direction);
                $this->_set_order_by($order_by);
            }
        }
        // OR_LIKE 子句
        if (isset($params['or_like'])) {
            $this->_set_or_like($params['or_like']);
        }
        // GROUP_BY 子句
        if (isset($params['group_by'])) {
            $this->_set_group_by($params['group_by']);
        }
        // LIMIT 子句
        if (isset($params['limit'])) {
            $this->_set_limit($params['limit']);
        } elseif ($this->limit > 0) {
            $limit = array($this->limit, 0);
            $this->_set_limit($limit);
        }
        // 查询主键
        if (NULL != $key) {
            $this->_set_query_key($key);
        }
        // 是否查询已标记为假删除的数据
        if ($this->soft_delete && TRUE !== $this->_temp_with_deleted) {
            $this->_db->where("{$this->soft_delete_key} !=", $this->soft_delete_value);
        }
        // 获取数据
        $result = $this->_db->get($this->_table)
                ->{$this->_return_type(1)}();
        $this->_temp_return_type = $this->return_type;
        //echo $this->_db->last_query();
        return $result;
    }
    
    /**
     * 基于WHERE条件的查询去重
     * @param  array    $where   WHERE条件
     * @param  string   $fields  查询字段
     * @param  boolean  $filter  是否过滤查询字段
     * @param  boolean  $escape  是否转义
     * @return array|object
     */
    public function select_unique_by($where, $fields = '', $filter = TRUE, $escape = TRUE) {
        $this->_db->distinct();
        $this->_set_select($fields, $filter, $escape);

        if ($this->soft_delete && TRUE !== $this->_temp_with_deleted) {
            $this->_db->where("{$this->soft_delete_key} !=", $this->soft_delete_value);
        }

        $this->_set_where($where);

        $row = $this->_db->get($this->_table)
                ->{$this->_return_type(1)}();
        $this->_temp_return_type = $this->return_type;

        return $row;
    }

    /**
     * 按父类ID获取子分类列表
     * @param  integer  $pid  父类ID
     * @return array
     */
    public function get_list_by_pid($pid = 0) {
        $query = $this->_db->select('catid,pid,name')
                ->from($this->_table)
                ->where('pid', $pid)
                ->order_by('catid', 'asc')
                ->get();
        $list = array();
        foreach ($query->result_array() as $row) {
            $list[] = $row;
        }

        return $list;
    }

    /**
     * 向表中插入一条新记录；成功时，返回插入ID
     * @param  array    $data  一维数组
     * @param  boolean  $filter           插入前，是否对字段进行过滤       
     * @param  boolean  $skip_validation  是否进行数据验证
     * @return integer|string  返回插入ID或出错信息 
     */
    public function insert($data, $filter = TRUE, $skip_validation = FALSE) {
        if (TRUE == $filter) {
            $data = $this->_filter_data($data);
        }

        if (FALSE == $skip_validation) {
            $data = $this->validate($data);
        }

        if (FALSE !== $data) {
            $this->_db->insert($this->_table, $data);
            $insert_id = $this->_db->insert_id();
            return $insert_id;
        } else {
            return FALSE;
        }
    }

    /**
     * 向表中插入一条新记录；成功时，返回插入ID
     * @param  array    $data
     * @param  boolean  $skip_validation
     * @return array    $ids  插入ID数组
     */
    public function insert_many($data, $filter = TRUE, $skip_validation = FALSE) {
        $ids = array();

        foreach ($data as $key => $row) {
            if (TRUE == $filter) {
                $row = $this->_filter_data($row);
            }

            $ids[] = $this->insert($row, $filter, $skip_validation, ($key == count($data) - 1));
        }

        return $ids;
    }

    /**
     * 基于主键值更新数据表记录
     * @param  integer  $primary_value  主键值
     * @param  array    $data            
     * @param  boolean  $skip_validation
     * @return boolean|string  
     */
    public function update($primary_value, $data, $skip_validation = TRUE) {
        $data = $this->_filter_data($data);
        if (FALSE === $skip_validation) {
            $data = $this->validate($data);
        }

        if (FALSE !== $data) {
            $result = $this->_db->where($this->primary_key, $primary_value)
                    ->set($data)
                    ->update($this->_table);

            return $result;
        } else {
            return FALSE;
        }
    }

    /**
     * 基于一组主键值，更新数据表记录
     * @param  integer  $primary_values  主键值数组
     * @param  array    $data            
     * @param  boolean  $skip_validation
     * @return boolean|string
     */
    public function update_many($primary_values, $data, $skip_validation = TRUE) {
        $data = $this->_filter_data($data);

        if (FALSE === $skip_validation) {
            $data = $this->validate($data);
        }

        if (FALSE !== $data) {
            $result = $this->_db->where_in($this->primary_key, $primary_values)
                    ->set($data)
                    ->update($this->_table);
            return $result;
        } else {
            return FALSE;
        }
    }

    /**
     * 基于WHERE条件，更新数据表记录
     * @param type $where 
     * @param type $data
     * @param type $skip_validation
     * @return boolean|string
     */
    public function update_by($where, $data, $skip_validation = TRUE) {
        $data = $this->_filter_data($data);

        if (FALSE === $skip_validation) {
            $data = $this->validate($data);
        }

        if (FALSE !== $data) {
            $this->_set_where($where);

            $result = $this->_db->set($data)
                    ->update($this->_table);

            return $result;
        } else {
            return FALSE;
        }
    }

    /**
     * 更新数据表中所有记录
     * @param  array  $data
     * @return boolean
     */
    public function update_all($data, $skip_validation = TRUE) {
        $data = $this->_filter_data($data);

        if (FALSE !== $skip_validation) {
            $data = $this->validate($data);
        }

        if (FALSE !== $data) {
            $result = $this->_db->set($data)
                    ->update($this->_table);
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 更新键值对数据表数据
     * @param  array    $data
     * @param  boolean  $skip_validation
     * @return boolean
     */
    public function replace($data, $skip_validation = TRUE) {
        if (FALSE !== $skip_validation) {
            $data = $this->validate($data);
        }

        if (FALSE !== $data) {
            $result = $this->_db->replace($this->_table, $data);

            return $result;
        } else {
            return false;
        }
    }

    /**
     * 基于主键值，从数据表中删除一条记录
     * @param  integer  $primary_value
     * @return boolean
     */
    public function delete($primary_value) {
        $this->_db->where($this->primary_key, $primary_value);

        if ($this->soft_delete) {
            $result = $this->_db->update($this->_table, array($this->soft_delete_key => $this->soft_delete_value));
        } else {
            $result = $this->_db->delete($this->_table);
        }

        return $result;
    }

    /**
     * 基于WHERE条件，从数据表删除记录
     * @param  array $where
     * @return boolean
     */
    public function delete_by($where) {
        $this->_set_where($where);

        if ($this->soft_delete) {
            $result = $this->_db->update($this->_table, array($this->soft_delete_key => $this->soft_delete_value));
        } else {
            $result = $this->_db->delete($this->_table);
        }

        return $result;
    }

    /**
     * 基于主键值数组，从数据表中删除多条记录
     * @param  array  $primary_values
     * @return boolean
     */
    public function delete_many($primary_values) {
        $this->_db->where_in($this->primary_key, $primary_values);

        if ($this->soft_delete) {
            $result = $this->_db->update($this->_table, array($this->soft_delete_key => $this->soft_delete_value));
        } else {
            $result = $this->_db->delete($this->_table);
        }

        return $result;
    }

    /* --------------------------------------------------------------
     * 工具方法
     * ------------------------------------------------------------ */
    /**
     * 获取查询记录数
     * @param  array   $params
     * @return integer
     */
    public function count_by($params = array(), $key = NULL, $filter = TRUE, $escape = TRUE) {
        // 查询字段
        if (isset($params['fields'])) {
            $this->_set_select($params['fields'], $filter, $escape);
        }
        // 联合查询
        if (isset($params['join'])) {
            $this->_set_join($params['join']);
        }
        // WHERE 子句
        if (isset($params['where'])) {
            $this->_set_where($params['where']);
        }
        // OR_LIKE 子句
        if (isset($params['or_like'])) {
            $this->_set_or_like($params['or_like']);
        }
        // GROUP_BY 子句
        if (isset($params['group_by'])) {
            $this->_set_group_by($params['group_by']);
        }
        // 查询主键
        if (NULL != $key) {
            $this->_set_query_key($key);
        }
        // 是否查询已标记为假删除的数据
        if ($this->soft_delete && TRUE !== $this->_temp_with_deleted) {
            $this->_db->where("{$this->soft_delete_key} !=", $this->soft_delete_value);
        }
        // 获取数据
        $query = $this->_db->get($this->_table);
        return $query->num_rows();
    }

    /**
     * 基于WHERE条件，获取查询记录数
     * @param array $where WHERE条件
     * @return integer
     */
    public function count_by_where($where) {
        if ($this->soft_delete && TRUE !== $this->_temp_with_deleted) {
            $this->_db->where("{$this->soft_delete_key} !=", $this->soft_delete_value);
        }

        $this->_set_where($where);

        $query = $this->_db->get($this->_table);
        return $query->num_rows();
    }

    /**
     * 获取表中全部记录数
     * @return integer
     */
    public function count_all() {
        if ($this->soft_delete && TRUE !== $this->_temp_with_deleted) {
            $this->_db->where("{$this->soft_delete_key} !=", $this->soft_delete_value);
        }

        $query = $this->_db->get($this->_table);
        return $query->num_rows();
    }

    /**
     * 获取当前数据表下一个自增ID值
     * @return integer
     */
    public function get_next_id() {
        return (int) $this->_db->select('AUTO_INCREMENT')
                        ->from('information_schema.TABLES')
                        ->where('TABLE_NAME', $this->_table)
                        ->where('TABLE_SCHEMA', $this->_db->database)
                        ->get()->row()->AUTO_INCREMENT;
    }

    /**
     * 在执行插入或更新操作时，跳过数据验证
     * @return \General_Model
     */
    public function skip_validation() {
        $this->skip_validation = TRUE;
        return $this;
    }

    /**
     * 获取当前验证状态（是否需要验证）
     * @return boolean
     */
    public function get_skip_validation() {
        return $this->skip_validation;
    }

    /* --------------------------------------------------------------
     * 全局方法
     * ------------------------------------------------------------ */

    /**
     * 设置结果集返回类型为数组
     * @return \General_Model
     */
    public function as_array() {
        $this->_temp_return_type = 'array';
        return $this;
    }

    /**
     * 设置结果集返回类型为对象
     * @return \General_Model
     */
    public function as_object() {
        $this->_temp_return_type = 'object';
        return $this;
    }

    /**
     * Don't care about soft deleted rows on the next call
     * @return \General_Model
     */
    public function with_deleted() {
        $this->_temp_with_deleted = TRUE;
        return $this;
    }

    /**
     * 改变当前数据表的删除类型，用于同时有真、假删除的数据表，如订单表
     * @return \General_Model
     */
    public function change_delete_type() {
        $this->soft_delete = (!$this->soft_delete );
        return $this;
    }

    /* --------------------------------------------------------------
     * 内部方法
     * ------------------------------------------------------------ */

    /**
     * 添加、更新前数据验证
     * @param  array         $data
     * @return array|boolean 通过验证时，返回原数组；未通过验证时，返回FALSE
     */
    protected function validate($data) {
        if ($this->skip_validation) {
            return $data;
        }

        if (!empty($this->validate)) {
            foreach ($data as $key => $val) {
                $_POST[$key] = $val;
            }

            $this->load->library('form_validation');

            if (is_array($this->validate)) {
                $this->form_validation->set_rules($this->validate);

                if (TRUE === $this->form_validation->run()) {
                    return $data;
                } else {
                    return FALSE;
                }
            } else {
                if ($this->form_validation->run($this->validate)) {
                    return $data;
                } else {
                    return FALSE;
                }
            }
        } else {
            return $data;
        }
    }

    /**
     * 通过继承类的类名获取数据表名
     */
    protected function _fetch_table() {
        if (NULL == $this->_table) {
            $this->_table = preg_replace('/(_m|_model|_base_model)?$/', '', strtolower(get_class($this)));
        }
    }

    /**
     * 获取当前数据表字段
     */
    protected function _fetch_fields() {
        $this->_fields = $this->_db->list_fields($this->_table);
    }

    /**
     * 查询前，过滤查询字段
     * @param  string  $fields
     * @return string
     */
    protected function _filter_fields($fields) {
        if (!empty($this->_select_fields)) {
            $fields_array = explode(',', $fields);
            $filter = array_intersect($fields_array, $this->_select_fields);
            $fields = implode(',', $filter);
        }
        return $fields;
    }

    /**
     * 在插入、更新一条数据前对数组进行字段过滤，数组为一维数组
     * @param  array  $datas 
     * @return array  $data
     */
    protected function _filter_data($datas) {
        $keys = array_keys($datas);
        $valid_keys = array_intersect($this->_fields, $keys);

        $data = array();
        foreach ($valid_keys as $value) {
            $data[$value] = $datas[$value];
        }

        return $data;
    }

    /**
     * A wrapper to $this->_db->join
     * @param  array  $join   
     * @return $this
     */
    protected function _set_join($join) {
        foreach ($join as $row) {
            if (2 == count($row)) {
                $this->_db->join($row[0], $row[1]);
            } elseif (3 == count($row)) {
                $this->_db->join($row[0], $row[1], $row[2]);
            }
        }
        return $this;
    }

    /**
     * A wrapper to $this->_db->select()
     * @param  string   $fields     查询字段
     * @param  boolean  $filter     是否过滤查询字段
     * @param  boolean  $escape     是否转义
     * @return object   $this
     */
    protected function _set_select($fields = '', $filter = TRUE, $escape = TRUE) {
        if ($filter) {
            $fields = $this->_filter_fields($fields);
        }
        $select = ( NULL != $fields ) ? $fields : '*';
        $this->_db->select($select, $escape);
        return $this;
    }

    /**
     * A wrapper to $this->_db->where()
     * @param  array  $where
     * @return object $this
     */
    protected function _set_where($where) {
        if (1 == count($where) && is_array($where[0])) {
            foreach ($where[0] as $field => $filter) {
                if (is_array($filter)) {
                    $this->_db->where_in($field, $filter);
                } else {
                    if (is_int($field)) {
                        $this->_db->where($filter);
                    } else {
                        $this->_db->where($field, $filter);
                    }
                }
            }
        } else if (1 == count($where)) {
            $this->_db->where($where[0]);
        } else if (2 == count($where)) {
            if (is_array($where[1])) {
                $this->_db->where_in($where[0], $where[1]);
            } else {
                $this->_db->where($where[0], $where[1]);
            }
        } else if (3 == count($where)) {
            $this->_db->where($where[0], $where[1], $where[2]);
        } else {
            if (is_array($where[1])) {
                $this->_db->where_in($where[0], $where[1]);
            } else {
                $this->_db->where($where[0], $where[1]);
            }
        }

        return $this;
    }

    /**
     * A wrapper to $this->_db->order_by()
     * @param  array|string  $order_by
     * @return object        $this
     */
    protected function _set_order_by($order_by) {
        if (is_array($order_by)) {
            foreach ($order_by as $key => $value) {
                $this->_db->order_by($key, $value);
            }
        } else {
            $this->_db->order_by($order_by, $this->direction);
        }
        return $this;
    }

    /**
     * A wrapper to $this->_db->or_like()
     * @param  array  $or_like
     * @return object $this
     */
    protected function _set_or_like($or_like) {
        $like = array();
        foreach ($or_like as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    $like[] = "{$key} LIKE '%{$v}%'"; 
                }
            } else {
                $like[] = "{$key} LIKE '%{$value}%'";
            }
        }
        $str = implode(" OR ", $like);
        $where = "(" . $str . ")";
        $this->_db->where($where);
        return $this;
    }

    /**
     * A wrapper to $this->_db->group_by()
     * @param  array|string  $group_by
     * @return object        $this
     */
    protected function _set_group_by($group_by) {
        $this->_db->group_by($group_by);
        return $this;
    }

    /**
     * A wrapper to $this->_db->limit()
     * @param  array  $limit
     * @return object $this
     */
    protected function _set_limit($limit) {
        if (1 == count($limit)) {
            $this->_db->limit($limit[0]);
        } elseif (2 == count($limit)) {
            $this->_db->limit($limit[0], $limit[1]);
        }
        return $this;
    }

    /**
     * 基于一个主键值或键值对数组查询时，封装为一个WHERE条件
     * @param  string|array $key
     * @return object       $this
     */
    protected function _set_query_key($key) {
        if (is_array($key)) {
            $this->_db->where($key);
        } else {
            $this->_db->where($this->primary_key, $key);
        }
        return $this;
    }

    /**
     * 返回当前返回类型的方法名
     * @param  boolean  $multi
     * @return string
     */
    protected function _return_type($multi = FALSE) {
        $method = ($multi) ? 'result' : 'row';
        return $this->_temp_return_type == 'array' ? $method . '_array' : $method;
    }

    /********数据库的事务处理**************/
    /**
    * @开启数据库事务
    */
    public function start_transaction(){
        $this->_db->trans_begin();
        $this->db->trans_strict(TRUE);
    }

    /**
    * @desc 判断数据库执行是否成功
    */
    public function is_transaction_status(){
        if ($this->_db->trans_status() === FALSE){
            return false;
        }else{
            return true;
        }
    }

    /**
    * @提交事务中的sql语句
    * @return 无
    */
    public function transaction_commit(){
        $this->_db->trans_commit();
    }

    /**
    * @回滚事务中的sql语句
    * @return 无
    */
    public function transaction_rollback(){
        $this->_db->trans_rollback();
    }
}
