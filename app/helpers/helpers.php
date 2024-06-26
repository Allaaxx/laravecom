<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\GeneralSetting;
use App\Models\SocialNetwork;
use App\Models\Category;
use App\Models\SubCategory;

// Enviar emails

if (!function_exists('sendEmail')) {
    function sendEmail($mailConfig) {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = env('MAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('EMAIL_ENCRYPTION');
        $mail->Port = env('MAIL_PORT');
        $mail->setFrom(env('EMAIL_FROM_ADDRESS'), env('EMAIL_FROM_NAME'));
        $mail->addAddress($mailConfig['mail_recipient_email'], $mailConfig['mail_recipient_name']);
        $mail->isHTML(true);
        $mail->Subject = $mailConfig['mail_subject'];
        $mail->Body = $mailConfig['mail_body'];

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}


// get configuração geral
if (!function_exists('get_settings')) {
    function get_settings()
    {
        $settings = GeneralSetting::first();

        if ($settings) {
            return $settings;
        } else {
            $site_name = auth('admin')->check() ? auth('admin')->user()->name : 'Sense Party Loja';
            $new_settings_data = GeneralSetting::create([
                'site_name' => $site_name,
                'site_email' => $site_name.'@senseparty.com'
            ]);
            return $new_settings_data;
        }
    }
}

// get redes sociais

if(!function_exists('get_social_network')){
    function get_social_network(){
        $results = null;
        $social_network = new SocialNetwork();
        $social_network_data = $social_network->first();

        if($social_network_data){
            $results = $social_network_data;
    
        }else{
            $social_network->insert([
                'facebook_url' => null,
                'twitter_url' => null,
                'instagram_url' => null,
                'youtube_url' => null,
                'github_url' => null,
                'linkedin_url' => null 
            ]);
            $new_social_network_data = $social_network->first();
            $results = $new_social_network_data;
        }
        return $results;
    }
}

//FRONTEND::
// get FRONTEND CATEGORIES
if(!function_exists('get_categories')){
    function get_categories(){
        $categories = Category::with('subcategories')->orderBy('ordering', 'asc')->get();
        return !empty($categories) ? $categories : [];
    }
}