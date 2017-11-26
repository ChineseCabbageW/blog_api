<?php
/**
 * Created by PhpStorm.
 * User: beyondwin
 * Date: 17/11/26
 * Time: 下午7:39
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/REST_Controller.php';

class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function register_post()
    {
        $params = $this->post();
        $is_userid = $this->user_model->select('id', ['phone' => $params['phone']], 'user');

        if ($is_userid) {
            $this->response([
                'message' => '该手机号码已注册用户',
                'status' => false
            ]);
            return;
        }

        $data = $this->user_model->register($params);
        if ($data) {
            $this->response(
                [
                    'data' => [
                        'name' => $params['name'],
                        'phone' => $params['phone']
                    ],
                    'message' => '注册成功',
                    'status' => true
                ]
            );
        }
        $this->response($data);
    }

    public function aaaa_get()
    {
        $this->response(1);
    }
}