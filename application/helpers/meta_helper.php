<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('build_path')) {

    function home_meta()
    {
        $url = base_url();
        $title = "BookOnBoard - Get started your online travel agency";
        $desc = "BookOnBoard cloud travel platform helps you to start your travel portal within 5 minutes integrated with major travel companies such as expedia booking sabre travelport galileo amadues travelpayouts hotelscombined flyin tajawal cartrawler hotelsbeds";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."travel.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function demo_meta()
    {
        $url = base_url();
        $title = "BookOnBoard - Demo";
        $desc = "Test drive our online demo platform it will help you to understand how your travel agency will operate we offer b2c b2b and b2e platforms as well for demo just try our our clouad based online travel agency test platform. it is very easy to understand.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."travel.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function features_meta()
    {
        $url = base_url();
        $title = "BookOnBoard - Features";
        $desc = "At BookOnBoard cloud booking engine we offer various kind of services and feautures which helps your travel booking and reservation system to operate as a cloud based platform and it is very easy to understand and to manage it's modules.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."travel.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function documentation_meta()
    {
        $url = base_url();
        $title = "BookOnBoard - Documentation";
        $desc = "All technical and general information available here to manage your portal. once you get started you need user manual to understand the about how to configure yuor portal and that is why our documentation will help you on each step you need.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."travel.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function contact_meta()
    {
        $url = base_url('contact');
        $title = "BookOnBoard - Contact Us";
        $desc = "Contact us and let us help you to innovate new ideas to grow your potential in market. we are a team of highly skilled and professional people around the globe. we use latest technology to improve and automate and  digitalize any business.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."contact.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function newsletter_meta()
    {
        $url = base_url('newsletter');
        $title = "BookOnBoard - Newsletter";
        $desc = "Thank you for joining our newsletter we will soon update you. please update your email and re-subscribe to our newseltter if you moved or changed your old email to new one. and it will be very pleasure for us to have you in touch with us.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."newsletter.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function terms_meta()
    {
        $url = base_url('terms');
        $title = "BookOnBoard - terms and conditions";
        $desc = "Please take your time to read our business terms and conditions completely before you order or hire any of our services.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."travel.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function policy_meta()
    {
        $url = base_url('policy');
        $title = "BookOnBoard - Policy";
        $desc = "Read our policy before buying or hiring any services from BookOnBoard.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."travel.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function team_meta()
    {
        $url = base_url('team');
        $title = "BookOnBoard - Our Team";
        $desc = "We are made of a highly professional and passionate people. all of us have a new story to tell in a very unique style. We're engineers, designers, owners, hotel managers, big data experts, and avid travelers. Made up of more than 40 people in 4 different countries.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."team.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function error_meta()
    {
        $url = base_url('404');
        $title = "BookOnBoard - ERROR 404";
        $desc = "Error 404 no page found johny! go back home";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."404.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function about_meta()
    {
        $url = base_url('about');
        $title = "BookOnBoard - About Us";
        $desc = "BookOnBoard is a software company build with aim to empower the local IT industry and people.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."about.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function media_meta()
    {
        $url = base_url('media-kit');
        $title = "BookOnBoard - Media Kit";
        $desc = "Use mainly the color logo whenever possible to represent BookOnBoard we have a complete media kit to represent our brand at every size and platoform.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."about.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function activation_meta()
    {
        $url = base_url('activation');
        $title = "BookOnBoard - Activation";
        $desc = "Activating account.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."account.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function adconfirmation_meta()
    {
        $url = base_url('training/admission/confirmation');
        $title = "BookOnBoard - Confirmation";
        $desc = "Admission confirmation.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."account.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function verify_meta()
    {
        $url = base_url('email_verify');
        $title = "BookOnBoard - Verification";
        $desc = "Please check your mailbox to activate account. and if there was not email please try to check your spam folder or contact our support team in case if you have received no email or confirmation from our accounts and signup systems.";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."account.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function signup_meta()
    {
        $url = base_url('signup');
        $title = "BookOnBoard - OTA Signup";
        $desc = "Signup with and start using our portal with different platforms from mobile apps to web and desktop applications. our cloud white-label technology helps you to start build your travel portal with travel companies such as expedia booking sabre travelport";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."account.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function login_meta()
    {
        $url = base_url('login');
        $title = "BookOnBoard - OTA login";
        $desc = "Login to your account as a OTA online travel agency and start managing your portal through our smart and cloud based system";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."account.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function pricing_meta()
    {
        $url = base_url('pricing');
        $title = "BookOnBoard - Pricing";
        $desc = "Simple pricing no surprices just subscribe today and get start your online travel portal within 5 minutes";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."travel.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function dash_meta()
    {
        $url = base_url('dashboard');
        $title = "BookOnBoard - OTA Dashboard";
        $desc = "OTA Dashboard";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."account.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function settings_meta()
    {
        $url = base_url('settings');
        $title = "BookOnBoard - OTA Settings";
        $desc = "OTA Settings";
        $author = "BookOnBoard";
        $img = PAGES_META_IMG."account.png";
        return global_meta($title,$desc,$url,$img,$author);
    }

    function global_meta($title,$desc,$url,$img,$author)
    {
        // general
        $final_array = [];

        // facebook
        array_push($final_array,add_meta('property',"og:title",$title));
        array_push($final_array,add_meta('property',"og:description",$desc));
        array_push($final_array,add_meta('property',"og:url",$url));
        array_push($final_array,add_meta('property',"og:image",$img));
        array_push($final_array,add_meta('property',"og:site_name",$author));

        // twitter
        array_push($final_array,add_meta('name',"title",$title));
        array_push($final_array,add_meta('name',"description",$desc));
        array_push($final_array,add_meta('name',"twitter:url",$url));
        array_push($final_array,add_meta('name',"twitter:site",$author));
        array_push($final_array,add_meta('name',"twitter:description",$desc));
        array_push($final_array,add_meta('name',"twitter:image",$img));

        return $final_array;
    }

    function add_meta($pname,$pavlue,$pcontent)
    {
     return (object)["pname"=>$pname,"pvalue"=>$pavlue,"pcontent"=>$pcontent];
    }

    function site_map()
    {
        return [
            "login/",
            "demo/",
            "signup/",
            "pricing/",
            "about/",
            "contact/",
            "team/",
            "terms/",
            "policy/",
            "media-kit/",
            "features/",
            "documentation/"
        ];
    }
}