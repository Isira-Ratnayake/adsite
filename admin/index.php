<?php
    /**
     * Controller of the ad site.
     */
    require('../model/database.php');
    require('../model/user_db.php');
    require('../model/type_db.php');
    require('../model/category_db.php');
    require('../model/city_db.php');
    require('../model/ad_db.php');
    require('../model/time_utilities.php');
    require('../model/paymentType_db.php');

    require('./model/admin_db.php');
    require('./model/ad_db.php');
    require('./model/ad_type_db.php');
    /* Initialise the action parameter */
    $action = filter_input(INPUT_POST, 'action');       //Check $_POST
    if($action === null) {
        $action = filter_input(INPUT_GET, 'action');    //Check $_GET
        if($action === null) {
            $action = 'verification';                          //set default value if $action is unspecified
        }
    }
     /* Switch statement to control website based on $action */
     switch($action) {
        case 'verification':
            session_start();
            if(!isset($_SESSION['admin_id'])) {
                session_write_close();
                $errStat = filter_input(INPUT_GET, 'errStat', FILTER_VALIDATE_INT);
                if(!is_numeric($errStat)) {
                    $errStat = 0;
                }
                $err_msg = "";
                switch($errStat) {
                    case 1:
                        $err_msg = 'Invalid username or password.';
                        break;
                    case 2:
                        $err_msg = 'Administrator not found. Please try again.';
                        break;
                    default:
                        $errStat = 0;
                }
                $title = 'Administration | Log-In';
                $heading = 'Administration';
                $webpageSector = $action;
                $next_login_page_action = $action;
                include('./view/view_header.php');
                include('./view/view_body/admin_login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $title = 'Administration | Verification';
                $heading = 'Verify&nbsp;Pending&nbsp;Ads';
                $webpageSector = $action;
                include('./view/view_header.php');
                include('./view/view_body/admin_verification_view.php');
                include('./view/view_footer.php');
            }
            break;
            
        case 'adminLogin':
            $admin_username = filter_input(INPUT_POST, 'adminUsername');
            $admin_password = filter_input(INPUT_POST, 'adminPassword');
            $next_login_action = filter_input(INPUT_POST, 'nextLoginAction');
            $admin_username = trim($admin_username);
            $admin_password = trim($admin_password);
            if(!empty($admin_username) && !empty($admin_password)) {
                $result = get_admin_record($admin_username);
                if($result !== false && password_verify($admin_password, $result['admin_password'])) {
                    session_start();
                    $_SESSION['admin_id'] = $result['admin_id'];
                    session_write_close();
                    header('location: ./index.php?action=' . $next_login_action);
                }
                else {
                    header('location: ./index.php?action=' . $next_login_action . '&errStat=2');
                }
            }
            else {
                header('location: ./index.php?action=' . $next_login_action . '&errStat=1');
            }
            break;
        
        case 'logout':
            session_start();
            $_SESSION = array();
            $name = session_name();
            $expire = strtotime('-1 year');
            $params = session_get_cookie_params();
            $path = $params['path'];
            $domain = $params['secure'];
            $httponly = $params['httponly'];
            setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
            header('location:./index.php');
            break;
        
        case 'adminDisplayAd':
            session_start();
            if(!isset($_SESSION['admin_id'])) {
                session_write_close();
                $errStat = filter_input(INPUT_GET, 'errStat', FILTER_VALIDATE_INT);
                if(!is_numeric($errStat)) {
                    $errStat = 0;
                }
                $err_msg = "";
                switch($errStat) {
                    case 1:
                        $err_msg = 'Invalid username or password.';
                        break;
                    case 2:
                        $err_msg = 'Administrator not found. Please try again.';
                        break;
                    default:
                        $errStat = 0;
                }
                $title = 'Administration | Log-In';
                $heading = 'Administration';
                $webpageSector = 'verification';
                $next_login_page_action = 'verification';
                include('./view/view_header.php');
                include('./view/view_body/admin_login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $ad_id = filter_input(INPUT_GET, 'adId', FILTER_VALIDATE_INT);
                if(!empty($ad_id) && $ad_id!==false) {
                    $ad_record = get_pending_ad_record($ad_id);
                    if($ad_record === false) {
                        header('location:./index.php?action=verification');
                        exit();
                    }
                    $title = $ad_record['ad_title'];
                    $webpageSector = 'verification';
                    $stylesheets = '<link rel="stylesheet" type="text/css" href="./view/view_body/css/adDisplay_view.css">';
                    $user_phone_no = get_phone_no_from_user_id($ad_record['ad_user_id']);
                    $ad_city_name = get_city_name_from_id($ad_record['ad_city_id']);
                    $ad_category_name = get_category_name_from_id($ad_record['ad_category_id']);
                    $current_time_obj = new DateTime();
                    $ad_created_obj = new DateTime($ad_record['ad_created']);
                    $interval = get_time_diff($ad_created_obj, $current_time_obj) . ' ago';
                    include('./view/view_header.php');
                    include('./view/view_body/admin_display_ad_view.php');
                    include('./view/view_footer.php');    
                }
                else {
                    header('location:./index.php?action=verification');
                } 
            }
            break;
        
        case 'verifyAd':
            session_start();
            if(!isset($_SESSION['admin_id'])) {
                session_write_close();
                $errStat = filter_input(INPUT_GET, 'errStat', FILTER_VALIDATE_INT);
                if(!is_numeric($errStat)) {
                    $errStat = 0;
                }
                $err_msg = "";
                switch($errStat) {
                    case 1:
                        $err_msg = 'Invalid username or password.';
                        break;
                    case 2:
                        $err_msg = 'Administrator not found. Please try again.';
                        break;
                    default:
                        $errStat = 0;
                }
                $title = 'Administration | Log-In';
                $heading = 'Administration';
                $webpageSector = 'verification';
                $next_login_page_action = 'verification';
                include('./view/view_header.php');
                include('./view/view_body/admin_login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $ad_id = filter_input(INPUT_POST, 'adId', FILTER_VALIDATE_INT); 
                if(!empty($ad_id) && $ad_id!==false) {
                    $ad_verification_record = get_verification_ad_record($ad_id);
                    if($ad_verification_record === false) {
                        header('location:./index.php?action=verification');
                        exit();
                    }
                    else {
                        if($ad_verification_record['ad_type_id']===2 || $ad_verification_record['ad_type_id']===3) {
                            //top ad
                            if($ad_verification_record['ad_expiration_offset'] === '+P0Y0M0DT0H0M0S') {
                                //First cycle - Update status and expiration date
                                $ad_type_record = get_type_record($ad_verification_record['ad_type_id']);
                                $current_time_obj = new DateTime();
                                $offset_str = 'P0Y0M' . $ad_type_record['type_valid_days'] . 'DT0H0M0S';
                                $offset_interval_obj = new DateInterval($offset_str);
                                $current_time_obj->add($offset_interval_obj);
                                $expiration_date = $current_time_obj->format('Y-m-d H:i:s');
                                update_ad_status_expiration_date('VERIFIED', $expiration_date, $ad_id);
                            }
                            else {
                                //Later cycles - Update status, expiration date and offset
                                $current_time_obj = new DateTime();
                                $offset_str = $ad_verification_record['ad_expiration_offset'];
                                $sign = substr($offset_str, 0, 1);
                                $offset_str = substr($offset_str, 1);
                                $offset_interval_obj = new DateInterval($offset_str);
                                if($sign === '-') {
                                    $offset_interval_obj->invert = 1;
                                }
                                $current_time_obj->add($offset_interval_obj);
                                $expiration_date = $current_time_obj->format('Y-m-d H:i:s');
                                update_ad_status_expiration_date_offset('VERIFIED', $expiration_date, '+P0Y0M0DT0H0M0S', $ad_id);
                            }
                        }
                        else {
                            //normal ad
                            update_ad_status('VERIFIED', $ad_id);
                        }
                        update_date_modified($ad_id);
                        header('location:./index.php?action=verification');
                    }
                }
                else {
                    header('location:./index.php?action=verification');
                }
            }
            break;
        
        case 'declineAd':
            session_start();
            if(!isset($_SESSION['admin_id'])) {
                session_write_close();
                $errStat = filter_input(INPUT_GET, 'errStat', FILTER_VALIDATE_INT);
                if(!is_numeric($errStat)) {
                    $errStat = 0;
                }
                $err_msg = "";
                switch($errStat) {
                    case 1:
                        $err_msg = 'Invalid username or password.';
                        break;
                    case 2:
                        $err_msg = 'Administrator not found. Please try again.';
                        break;
                    default:
                        $errStat = 0;
                }
                $title = 'Administration | Log-In';
                $heading = 'Administration';
                $webpageSector = 'verification';
                $next_login_page_action = 'verification';
                include('./view/view_header.php');
                include('./view/view_body/admin_login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $ad_id = filter_input(INPUT_POST, 'adId', FILTER_VALIDATE_INT);
                if(!empty($ad_id) && $ad_id!==false) {
                    $ad_verification_record = get_verification_ad_record($ad_id);
                    if($ad_verification_record === false) {
                        header('location:./index.php?action=verification');
                        exit();
                    }
                    else {
                        update_ad_status('DECLINED', $ad_id);
                        update_date_modified($ad_id);
                        header('location:./index.php?action=verification');
                    }
                }
                else {
                    header('location:./index.php?action=verification');
                }
            }
            break;
        
        case 'topads':
            session_start();
            if(!isset($_SESSION['admin_id'])) {
                session_write_close();
                $errStat = filter_input(INPUT_GET, 'errStat', FILTER_VALIDATE_INT);
                if(!is_numeric($errStat)) {
                    $errStat = 0;
                }
                $err_msg = "";
                switch($errStat) {
                    case 1:
                        $err_msg = 'Invalid username or password.';
                        break;
                    case 2:
                        $err_msg = 'Administrator not found. Please try again.';
                        break;
                    default:
                        $errStat = 0;
                }
                $title = 'Administration | Log-In';
                $heading = 'Administration';
                $webpageSector = $action;
                $next_login_page_action = $action;
                include('./view/view_header.php');
                include('./view/view_body/admin_login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $title = 'Administration | Manage Top Ads';
                $heading = 'Expire&nbsp;Top&nbsp;Ads';
                $webpageSector = $action;
                include('./view/view_header.php');
                include('./view/view_body/admin_top_ads_view.php');
                include('./view/view_footer.php');
            }
            break;
        
        case 'expireTopAd':
            session_start();
            if(!isset($_SESSION['admin_id'])) {
                session_write_close();
                $errStat = filter_input(INPUT_GET, 'errStat', FILTER_VALIDATE_INT);
                if(!is_numeric($errStat)) {
                    $errStat = 0;
                }
                $err_msg = "";
                switch($errStat) {
                    case 1:
                        $err_msg = 'Invalid username or password.';
                        break;
                    case 2:
                        $err_msg = 'Administrator not found. Please try again.';
                        break;
                    default:
                        $errStat = 0;
                }
                $title = 'Administration | Log-In';
                $heading = 'Administration';
                $webpageSector = 'topads';
                $next_login_page_action = 'topads';
                include('./view/view_header.php');
                include('./view/view_body/admin_login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $ad_id = filter_input(INPUT_POST, 'adId', FILTER_VALIDATE_INT);
                if(!empty($ad_id) && $ad_id!==false) {
                    $ad_record = get_verified_top_ad_created($ad_id);
                    if($ad_record === false) {
                        header('location:./index.php?action=topads');
                        exit();
                    }
                    else {
                        //convert to normal ad. Set expiration date to default.
                        $ad_type_id = 1;
                        $ad_expired = $ad_record['ad_created'];
                        update_to_normal($ad_type_id, $ad_expired, $ad_id);
                        update_date_modified($ad_id);
                        header('location:./index.php?action=topads');
                        exit();
                    }
                }
                else {
                    header('location:./index.php?action=topads');
                }
            }
            break;

        case 'deleteads':
            session_start();
            if(!isset($_SESSION['admin_id'])) {
                session_write_close();
                $errStat = filter_input(INPUT_GET, 'errStat', FILTER_VALIDATE_INT);
                if(!is_numeric($errStat)) {
                    $errStat = 0;
                }
                $err_msg = "";
                switch($errStat) {
                    case 1:
                        $err_msg = 'Invalid username or password.';
                        break;
                    case 2:
                        $err_msg = 'Administrator not found. Please try again.';
                        break;
                    default:
                        $errStat = 0;
                }
                $title = 'Administration | Log-In';
                $heading = 'Administration';
                $webpageSector = $action;
                $next_login_page_action = $action;
                include('./view/view_header.php');
                include('./view/view_body/admin_login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $title = 'Administration | Manage Top Ads';
                $heading = 'Expire&nbsp;Top&nbsp;Ads';
                $webpageSector = $action;
                include('./view/view_header.php');
                include('./view/view_body/admin_delete_ad_view.php');
                include('./view/view_footer.php');
            }
            break;
        
        case 'deleteadrecord':
            session_start();
            if(!isset($_SESSION['admin_id'])) {
                session_write_close();
                $errStat = filter_input(INPUT_GET, 'errStat', FILTER_VALIDATE_INT);
                if(!is_numeric($errStat)) {
                    $errStat = 0;
                }
                $err_msg = "";
                switch($errStat) {
                    case 1:
                        $err_msg = 'Invalid username or password.';
                        break;
                    case 2:
                        $err_msg = 'Administrator not found. Please try again.';
                        break;
                    default:
                        $errStat = 0;
                }
                $title = 'Administration | Log-In';
                $heading = 'Administration';
                $webpageSector = 'deleteads';
                $next_login_page_action = 'deleteads';
                include('./view/view_header.php');
                include('./view/view_body/admin_login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $ad_id = filter_input(INPUT_POST, 'adId', FILTER_VALIDATE_INT);
                if(!empty($ad_id) && $ad_id!==false) {
                    $ad_record = get_delete_ad_record_admin($ad_id);
                    if($ad_record === false) {
                        header('location:./index.php?action=deleteads');
                        exit();
                    }
                    else {
                        //Delete ad image
                        $ad_user_id = $ad_record['ad_user_id'];
                        $current_dir = getcwd();
                        $current_dir = substr($current_dir, 0, (strlen($current_dir) - 6));
                        $image_dir_path = $current_dir . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $ad_user_id . DIRECTORY_SEPARATOR . $ad_id;
                        if(is_dir($image_dir_path)) {
                            $files = scandir($image_dir_path);
                            foreach($files as $file) {
                                $file_path = $image_dir_path . DIRECTORY_SEPARATOR . $file;
                                if(is_file($file_path)) {
                                    unlink($file_path);
                                }
                            }
                            rmdir($image_dir_path);
                        }
                        //Delete Ad record
                        delete_ad_record_admin($ad_id);
                        header('location: ./index.php?action=deleteads');
                    }
                }
                else {
                    header('location: ./index.php?action=deleteads');
                }
            }
            break;

        case 'restoread':
            session_start();
            if(!isset($_SESSION['admin_id'])) {
                session_write_close();
                $errStat = filter_input(INPUT_GET, 'errStat', FILTER_VALIDATE_INT);
                if(!is_numeric($errStat)) {
                    $errStat = 0;
                }
                $err_msg = "";
                switch($errStat) {
                    case 1:
                        $err_msg = 'Invalid username or password.';
                        break;
                    case 2:
                        $err_msg = 'Administrator not found. Please try again.';
                        break;
                    default:
                        $errStat = 0;
                }
                $title = 'Administration | Log-In';
                $heading = 'Administration';
                $webpageSector = 'deleteads';
                $next_login_page_action = 'deleteads';
                include('./view/view_header.php');
                include('./view/view_body/admin_login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $ad_id = filter_input(INPUT_POST, 'adId', FILTER_VALIDATE_INT);
                if(!empty($ad_id) && $ad_id!==false) {
                    $ad_restoration_record = get_restoration_ad_record($ad_id);
                    if($ad_restoration_record === false) {
                        header('location:./index.php?action=deleteads');
                        exit();
                    }
                    else {
                        update_ad_status('PENDING', $ad_id);
                        update_date_modified($ad_id);
                        header('location:./index.php?action=deleteads');
                    }
                }
                else {
                    header('location:./index.php?action=deleteads');
                }
            }
            break;

        default:
            $errStat = filter_input(INPUT_GET, 'errStat');
            header('location: ./index.php?action=verification&errStat=' . $errStat);
     }