<?php

namespace App\Controllers\Admin;

use App\Models\SettingsWebModel;
use App\Controllers\BaseController;

class SettingsWeb extends BaseController
{
    protected $settingsWebModel;

    public function __construct()
    {
        $this->session = session();
        
        $this->settingsWebModel = new SettingsWebModel();
    }

    public function index()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('/auth/login');
        }
        if($this->session->get('role') != 1){
            return redirect()->to('/user');
        }
        
         $data['settings'] = $this->settingsWebModel->first();
         $settings = $this->getSettingsData();
         $currentSegment = $this->request->uri->getSegment(1);
         
         $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'settings' => $data['settings'],
            'currentSegment' => $currentSegment,
            ];
         

        return view('admin/setings', $data);
    }

    public function update()
    {
        $validationRules = [
            'web_title' => 'required',
            'web_author' => 'required',
            'web_keywords' => 'required',
            'web_description' => 'required',
            'profit' => 'required',
            'web_icon' => 'max_size[web_icon,1024]|ext_in[web_icon,png]',
            'web_logo' => 'max_size[web_logo,1024]|ext_in[web_logo,png,jpg,jpeg,gif]',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->to(base_url('admin/settings-web'))->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $settings = $this->settingsWebModel->first();
    
        $webIcon = $this->request->getFile('web_icon');
        if ($webIcon->isValid()) {
            $webIconName = $webIcon->getRandomName();
            $webIcon->move(ROOTPATH . 'public/img/web/', $webIconName);
    
            if (!empty($settings['web_icon'])) {
                $oldWebIconPath = ROOTPATH . 'public/img/web/' . $settings['web_icon'];
                if (file_exists($oldWebIconPath)) {
                    unlink($oldWebIconPath);
                }
            }
    
            $this->settingsWebModel->update($settings['id'], ['web_icon' => $webIconName]);
        }
    
        $webLogo = $this->request->getFile('web_logo');
        if ($webLogo->isValid()) {
            $webLogoName = $webLogo->getRandomName();
            $webLogo->move(ROOTPATH . 'public/img/web/', $webLogoName);
    
            if (!empty($settings['web_logo'])) {
                $oldWebLogoPath = ROOTPATH . 'public/img/web/' . $settings['web_logo'];
                if (file_exists($oldWebLogoPath)) {
                    unlink($oldWebLogoPath);
                }
            }
            
            $this->settingsWebModel->update($settings['id'], ['web_logo' => $webLogoName]);
        }
    
        $this->settingsWebModel->update($settings['id'], [
            'web_title' => $this->request->getPost('web_title'),
            'web_author' => $this->request->getPost('web_author'),
            'web_keywords' => $this->request->getPost('web_keywords'),
            'web_description' => $this->request->getPost('web_description'),
            'profit' => $this->request->getPost('profit'),
            'turbootp_apikey' => $this->request->getPost('turbootp_apikey'),
            'fonnte_apikey' => $this->request->getPost('fonnte_apikey'),
            'paydisini_apikey' => $this->request->getPost('paydisini_apikey'),
        ]);
    
        return redirect()->to(base_url('admin/settings-web'))->with('success', 'Data berhasil diperbarui.');
    }
    
}