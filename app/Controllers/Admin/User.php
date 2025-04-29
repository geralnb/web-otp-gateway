<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\Session\Session;

class User extends BaseController
{
    protected $session;
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
    }
    
    public function index()
    {
      if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
      
      if ($this->session->get('role') != 1) {
        return redirect()->to('/');
      }
      
      $userSudahLogin = $this->session->has('isLogin');
      
        $userModel = new UserModel();
        $users = $userModel->findAll();

        $settings = $this->getSettingsData();
        $currentSegment = $this->request->uri->getSegment(1);

        $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'users' => $users,
            'currentSegment' => $currentSegment,
        ];

        return view('admin/user', $data);
    }
    
    public function edit($id)
    {
        $userModel = new UserModel();

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();

            $validationRules = [
                'username' => 'required|min_length[3]|max_length[255]',
                'no_wa' => 'required|min_length[8]|max_length[255]',
                'role' => 'required|numeric',
                'password' => 'permit_empty|min_length[6]|max_length[255]',
                'confirm_password' => 'matches[password]',
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('validation', $validation);
            }

            $data = [
                'username' => $this->request->getPost('username'),
                'balance' => $this->request->getPost('balance'),
                'no_wa' => $this->request->getPost('no_wa'),
                'role' => $this->request->getPost('role'),
            ];

            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $userModel->update($id, $data);

            return redirect()->to('admin/user')->with('success', 'User berhasil diupdate');
        }

        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('admin/user')->with('error', 'User tidak ditemukan');
        }

    }
    
    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if ($user) {
            $this->userModel->delete($id);
            session()->setFlashdata('success', 'User berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'User tidak ditemukan.');
        }

        return redirect()->to('admin/user');
    }
    
}