<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index()
    {
      $settings = $this->getSettingsData();
      $currentSegment = $this->request->uri->getSegment(1);
      
      $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'web_author' => $settings['web_author'],
            'web_description' => $settings['web_description'],
            'web_keywords' => $settings['web_keywords'],
            'currentSegment' => $currentSegment,
        ];
    
        return view('index', $data);
    }
    
}