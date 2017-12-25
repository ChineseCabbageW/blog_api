<?php
/**
 * Created by PhpStorm.
 * User: beyondwin
 * Date: 17/12/10
 * Time: 下午10:09
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/REST_Controller.php';

class Article extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
    }

    /**
     * article/release
     * 发布文章
     */
    public function release_post()
    {
        $params = $this->post();

        $data = $this->article_model->release($params);
        if ($data) {
            $this->response(
                [
                    'data' => null,
                    'message' => '发布成功',
                    'status' => true
                ]
            );
        } else {
            $this->response(
                [
                    'data' => null,
                    'message' => '发布失败，请稍后重新发布',
                    'status' => false
                ]
            );
        }
    }


    /**
     * article/release
     * 得到文章列表
     */
    public function release_get()
    {
        $params = $this->get();

        $data = $this->article_model->article_list($params["user_id"]);
        if ($data) {
            $this->response(
                [
                    'data' => $data,
                    'message' => '查询文章列表成功',
                    'status' => true
                ]
            );
        } else {
            $this->response(
                [
                    'data' => null,
                    'message' => '查询失败，请稍后再试',
                    'status' => false
                ]
            );
        }
    }





}