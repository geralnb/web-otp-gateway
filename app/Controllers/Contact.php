<?php

namespace App\Controllers;

use App\Models\ContactModel;
use App\Models\UserModel;

class Contact extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
        $this->contactModel = new ContactModel();
    }

    public function index()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
    
        $username = $this->session->get('username');
        $userData = $this->userModel->where('username', $username)->first();
        
        if ($userData) {
            $userId = $userData['id'];
        } else {
          return redirect()->to('/auth/login');
        }
        
         $data['content'] = $this->contactModel->first();
         $settings = $this->getSettingsData();
         $currentSegment = $this->request->uri->getSegment(1);
         
         $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'web_author' => $settings['web_author'],
            'web_description' => $settings['web_description'],
            'web_keywords' => $settings['web_keywords'],
            'content' => $data['content'],
            'currentSegment' => $currentSegment,
        ];
         

        return view('user/contact', $data);
    }

}