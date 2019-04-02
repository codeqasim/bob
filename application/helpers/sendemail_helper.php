<?php

defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('send_custom_semail')) {

    function send_custom_semail($to, $subject, $message, $bcc=null) {
        
        $ci = & get_instance();
        $ci->load->library('phpmailer');
        $ci->phpmailer->CharSet = "utf-8";
        $ci->phpmailer->IsSMTP();
        $ci->phpmailer->Host = "ssl://smtp.googlemail.com";
        $ci->phpmailer->SMTPDebug = 0;
        $ci->phpmailer->SMTPAuth = true;
        $ci->phpmailer->Port = 465;
        $ci->phpmailer->Username = "info@phptravels.com";
        $ci->phpmailer->Password = "Allah4me";
        $ci->phpmailer->SetFrom('info@phptravels.com', 'TravelHope');
        if(is_array($to)){
            foreach($to as $email){
                $ci->phpmailer->AddAddress($email);
            }
        }else{
            $ci->phpmailer->AddAddress($to);
        }
        if($bcc!=null){
            foreach($bcc as $email){
                $ci->phpmailer->AddBcc($email);
            }
        }
        $ci->phpmailer->Subject = $subject;
        $ci->phpmailer->IsHTML(true);
        $ci->phpmailer->MsgHTML($message);
         if(!$ci->phpmailer->Send()) {
            return "Mailer Error: " . $ci->phpmailer->ErrorInfo;
         } else {
            return "Message has been sent";
         }
    }

}