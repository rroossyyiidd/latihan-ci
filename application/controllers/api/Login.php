<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Login extends REST_Controller
{
    // http://localhost/appkaryawan/api/login/login
    public function login_post()
    {
        if ($this->ion_auth->login($this->input->post('username'),
            $this->input->post('password'))) {
            //dapet info user
            $user = $this->ion_auth->user()->row();
            //sample random token
            $token = md5(rand(0, 100000));
            //update token di kolom user
            $this->ion_auth->update($user->id, ['token' => $token]);
            $data = [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'token' => $token
            ];
            //data sukses yg di response
            $this->response($data);
        } else {
            $error_messages = $this->ion_auth->errors();
            //data gagal yg di response
            $this->response($error_messages, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function logout_post()
    {
        $this->ion_auth->logout();
        $this->response('logout');
    }
}
