<?php

namespace App\Controllers;

use \App\Models\UserModel;

class User extends BaseController
{
    private $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();

        if (empty($this->session->get('username'))) {
            return redirect()->to('user/login');
        }
    }

    public function index()
    {
        if (!$this->session->get('is_admin')) {
            return redirect()->to('home');
        }
        $data['title'] = 'Data User';
        $data['session'] =  $this->session;
        $model = new UserModel();
        $data['data'] = $model->loadAll();
        return view('user/index', $data);
    }

    public function profile()
    {
        if ($this->request->getMethod() === 'post') {
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'nama' => 'required',
                'password' => 'required'
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();
            if ($isDataValid) {
                $model = new UserModel();
                $post = (object)$this->request->getPost();
                $user = $model->login($this->session->get('username'), $post->password);
                if ($user !== null) {
                    if (!empty($post->password_baru)) {
                        $model
                            ->where('username', $user->username)
                            ->set([
                                "nama" => $post->nama,
                                "password" => md5($post->password_baru),
                            ])
                            ->update();
                        $data_session = [
                            "username" => '',
                            "nama" => '',
                            "role" => '',
                        ];
                        $this->session->set($data_session);
                        return redirect()->to('user/login');
                    } else {
                        $model
                            ->where('username', $user->username)
                            ->set([
                                "nama" => $post->nama,
                            ])
                            ->update();
                        $data_session = [
                            "username" => $user->username,
                            "nama" => $post->nama,
                            "role" => $user->role,
                        ];
                        $this->session->set($data_session);
                    }
                    $this->session->setFlashdata('success', 'Berhasil mengubah!');
                } else {
                    $this->session->setFlashdata('error', 'Password salah!');
                }
            } else {
                $this->session->setFlashdata('error', 'User tidak ditemukan!');
            }
        }
        $data['session'] =  $this->session;
        $data['title'] = 'Profile User';
        return view('user/profile', $data);
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'username' => 'required',
                'password' => 'required'
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();
            if ($isDataValid) {
                $model = new UserModel();
                $post = (object)$this->request->getPost();
                $user = $model->login($post->username, $post->password);
                if ($user !== null) {
                    $data_session = [
                        "username" => $user->username,
                        "nama" => $user->nama,
                        "role" => $user->role,
                        "is_admin" => $user->role == 2,
                    ];
                    $this->session->set($data_session);
                    if (isset($post->remember) && $post->remember === 'on') {
                        $this->session->sess_expiration = 0;
                    }
                    return redirect()->to('home/index');
                } else {
                    $this->session->setFlashdata('error', 'User tidak ditemukan!');
                }
            } else {
                $this->session->setFlashdata('error', 'User tidak ditemukan!');
            }
        }
        $this->session->set([]);
        $data['session'] =  $this->session;
        $data['title'] = 'Sign in User';
        return view('user/login', $data);
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'username' => 'required|is_unique[user.username]',
                'nama' => 'required',
                'password' => 'required',
                're_password' => 'required|matches[password]',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();
            $post = (object)$this->request->getPost();
            if ($isDataValid) {
                $model = new UserModel();
                $model->save([
                    "username" => $post->username,
                    "nama" => $post->nama,
                    "password" => md5($post->password),
                    "role" => 1,
                ]);
                return redirect()->to('user/login');
            } else {
                $this->session->setFlashdata('error', 'Masukkan salah!' .  $validation->getErrors());
            }
        }
        $this->session->set([]);
        $data['session'] =  $this->session;
        $data['title'] = 'Sign in User';
        return view('user/register', $data);
    }

    public function logout()
    {
        $data_session = [
            "username" => '',
            "nama" => '',
            "role" => '',
        ];
        $this->session->set($data_session);
        return redirect()->to('home');
    }

    public function change($username)
    {
        if (empty($this->session->get('username'))) {
            return redirect()->to('user/login');
        }
        if (!$this->session->get('is_admin')) {
            return redirect()->to('home');
        }
        $model = new UserModel();

        if (($user = $model->findOne($username)) !== null)
            $model
                ->where('username', $username)
                ->set([
                    "role" => $user->role == 2 ? 1 : 2,
                ])
                ->update();
        $this->session->setFlashdata('success', 'Berhasil mengubah!');
        return redirect()->to('user/index');
    }
}
