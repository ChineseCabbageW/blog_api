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

    public function     register_post()
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
        $user_id = $this->db->insert_id();
        if ($data) {
            $this->response(
                [
                    'data' => [
                        'name' => $params['name'],
                        'phone' => $params['phone'],
                        'id' => $user_id
                    ],
                    'message' => '注册成功',
                    'status' => true
                ]
            );
        }
        $this->response($data);
    }


    public function     login_post()
    {
        $params = $this->post();

        $user_info_array = $this->user_model->get_user_info($params['phone'],$params['passworld']);
        if ($user_info_array) {
            $user_info = $user_info_array[0];
            $this->response([
                'data'=> [
                    'name' => $user_info['name'],
                    'phone' =>  $user_info['phone'],
                    'id' => $user_info['user_id']
                ],
                'message' => '登陆成功',
                'status' => true
            ]);
        } else {
            $this->response([
                'data'=>null,
                'message' => '用户名或密码错误',
                'status' => false
            ]);
        }

//        $data = $this->user_model->register($params);
//        if ($data) {
//            $this->response(
//                [
//                    'data' => [
//                        'name' => $params['name'],
//                        'phone' => $params['phone']
//                    ],
//                    'message' => '注册成功',
//                    'status' => true
//                ]
//            );
//        }
//        $this->response($data);
    }

    public function aaaa_get()
    {
        $this->response(1);
    }
}