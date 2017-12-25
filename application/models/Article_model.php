<?php
/**
 * Created by PhpStorm.
 * User: beyondwin
 * Date: 17/12/10
 * Time: 下午10:27
 */


class Article_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function release($param)
    {

        $data = array(
            'user_id' => $param['user_id'],
            'article' => $param['article'],
            'creat_time' => time()
        );

        return $this->db->insert('article', $data);
    }

    /*
     * @param $id 用户id
     */
    public function article_list($id)
    {
        $info_array = $this->db->query("select * from article where user_id=".$id);
        return $info_array->result_array();
    }

}
