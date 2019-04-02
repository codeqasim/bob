<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cms extends MY_Controller
{
    
    public function invalidAuth()
    {
        $this->load->view('errors/html/error_404');
    }

    
    public function index()
    {
        $ota_cms = $this->getOTAdata()->ota_cms;
        $ota_pages = (array)$this->getOTAdata()->ota_pages;
        if(!empty($ota_pages[$this->uri->segment(1)]))
        {
            $data["title"] = $ota_pages[$this->uri->segment(1)]->title;
            $data["meta"] = $ota_pages[$this->uri->segment(1)];
        }else{
            $data["title"] = $this->uri->segment(1);
        }
        foreach ($ota_cms as $cm)
        {
            if($cm->slug == $this->uri->segment(1))
            $data["cms"] = $cm;
        }
        $this->theme->view('cms',$data);
    }
}
