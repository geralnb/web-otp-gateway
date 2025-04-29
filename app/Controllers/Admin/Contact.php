<?php

namespace App\Controllers\Admin;

use App\Models\ContactModel;
use App\Controllers\BaseController;

class Contact extends BaseController
{
    protected $settingsWebModel;

    public function __construct()
    {
        $this->session = session();
        
        $this->contactModel = new ContactModel();
    }

    public function index()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('/auth/login');
        }
        if($this->session->get('role') != 1){
            return redirect()->to('/user');
        }
        
         $data['content'] = $this->contactModel->first();
         $settings = $this->getSettingsData();
         $currentSegment = $this->request->uri->getSegment(1);
         
         $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'content' => $data['content'],
            'currentSegment' => $currentSegment,
            ];
         

        return view('admin/contact', $data);
    }

    public function update()
    {
        $validationRules = [
            'content' => 'required',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->to(base_url('admin/contact'))->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $content = $this->contactModel->first();
    
        $this->contactModel->update($content['id'], [
            'content' => $this->request->getPost('content')
        ]);
    
        return redirect()->to(base_url('admin/contact'))->with('success', 'Data berhasil diperbarui.');
    }
    
}