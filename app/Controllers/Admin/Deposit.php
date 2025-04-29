<?php

namespace App\Controllers\Admin;

use App\Models\DepositModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\Session\Session;

class Deposit extends BaseController
{
    protected $session;
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->depositModel = new DepositModel();
    }
    
    public function index()
    {
      if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
      
      if ($this->session->get('role') != 1) {
            return redirect()->to('/user');
        }
      
      $userSudahLogin = $this->session->has('isLogin');
      
        $depositModel = new DepositModel();
        $deposit = $depositModel->findAll();
        
        $settings = $this->getSettingsData();
        $currentSegment = $this->request->uri->getSegment(1);

        $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'deposit' => $deposit,
            'currentSegment' => $currentSegment,
        ];

        return view('admin/deposit', $data);
    }
    
    public function delete($id)
    {
        $deposit = $this->depositModel->find($id);

        if ($deposit) {
            $this->depositModel->delete($id);
            session()->setFlashdata('success', 'Data deposit berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Data deposit tidak ditemukan.');
        }

        return redirect()->to('admin/deposit');
    }
    
}