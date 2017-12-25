<?php
/**
 * Created by PhpStorm.
 * User: beyondwin
 * Date: 17/11/26
 * Time: 下午7:37
 */

class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_news($slug = FALSE)
    {
        if ($slug === FALSE) {
            $query = $this->db->get('news');
            return $query->result_array();
        }
        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->result_array();
    }


    /**
     * 通过某个条件查询单条数据(第一条)
     * @param $select 查询的字段
     * @param $condition 条件, 传递数字时, 当id使用
     * @param $table 表名
     */
    function select($select, $condition, $table = null)
    {
        if ($table == null) {
            $table = 'user';
        }
        //$condition为数字, 则表示是通过id进行查询
        if (is_numeric($condition)) {
            $condition = ['id' => $condition];
        }
        $this->db->select($select);
        $result = $this->db->get_where($table, $condition);
        return $result->row_array();
    }

    function get_user_info($phone, $passworld){

        $where = 'where phone='.$phone.' and passworld='.$passworld;

        $info_array = $this->db->query("select id as user_id, name, phone from user $where;");
        return $info_array->result_array();
    }

    public function register($param)
    {
        $data = array(
            'name' => $param['name'],
            'phone' => $param['phone'],
            'passworld' => $param['passworld'],
            'creat_time' => time()
        );

        return $this->db->insert('user', $data);
    }
}
