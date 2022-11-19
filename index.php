<?php
    /**
     * Controller of the ad site.
     */
    require('./model/database.php');
    require('./model/user_db.php');
    require('./model/type_db.php');
    require('./model/category_db.php');
    require('./model/city_db.php');
    require('./model/ad_db.php');
    require('./model/time_utilities.php');
    require('./model/paymentType_db.php');
    /* Initialise the action parameter */
    $action = filter_input(INPUT_POST, 'action');       //Check $_POST
    if($action === null) {
        $action = filter_input(INPUT_GET, 'action');    //Check $_GET
        if($action === null) {
            $action = 'home';                          //set default value if $action is unspecified
        }
    }
     /* Switch statement to control website based on $action */
    switch($action) {
        case 'dashboard':
            /* Initate session with client browser */
            session_start();
            if(!isset($_SESSION['user_id'])) {
                session_write_close();
                $title = 'AdSite | Sign-In';
                $heading = 'Sign-In';
                $webpageSector = 'postAd';
                $next_login_page_action = "dashboard";
                include('./view/view_header.php');
                include('./view/view_body/login_view.php');
                include('./view/view_footer.php');
            }
            else {
                /* Users dashboard */
                $title = 'AdSite | My Ads';
                $heading = 'My&nbsp;Ads';
                $webpageSector = 'postAd';
                $stylesheets = '<link rel="stylesheet" type="text/css" href="./view/view_body/css/display_view.css">';
                include('./view/view_header.php');
                include('./view/view_body/dashboard_view.php');
                include('./view/view_footer.php');
            }
            break;

        case 'login':
            /* Logs in the user, and fowards them to the dashboard */
            /* Check if the phone number already exits in database, if not adds new entry. Then $_SESSION variable is set. */
            $user_phone_number = filter_input(INPUT_POST, 'user_phone_number');
            $next_page_action = filter_input(INPUT_POST, 'next_page_action');


            if(!empty($user_phone_number) || !empty($next_page_action)) {
               //Register or login
               if(!check_user_exist($user_phone_number)) {
                   insert_user($user_phone_number);                        
               }
               session_start();
               $_SESSION['user_id'] = get_user_id_from_phone_no($user_phone_number);
               session_write_close();
               header('location:./index.php?action='.$next_page_action);
            }
            else {
                $title = 'AdSite | Sign-In';
                $heading = 'Sign-In';
                $webpageSector = 'postAd';
                $next_login_page_action = "adtype";
                $login_message = 'Please enter a valid phone number.';
                include('./view/view_header.php');
                include('./view/view_body/login_view.php');
                include('./view/view_footer.php'); 
            }
            break;
        
        case 'adtype':
        /* Initiates session with client browser */
        session_start();
            if(!isset($_SESSION['user_id'])) {
                session_write_close();
                $title = 'AdSite | Sign-In';
                $heading = 'Sign-In';
                $webpageSector = 'postAd';
                $next_login_page_action = "adtype";
                include('./view/view_header.php');
                include('./view/view_body/login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $error_message = '';
                $isValid = filter_input(INPUT_GET, 'isValid');
                if($isValid==='false') {
                    $error_message = 'An error occured while creating your ad. Please verify your data and try again.';
                }
                $title = 'AdSite | Select Ad Type';
                $heading = 'Select&nbsp;an&nbsp;Ad&nbsp;Type';
                $webpageSector = 'postAd';
                $all_type_records = get_all_type_records();
                include('./view/view_header.php');
                include('./view/view_body/adSelect_view.php');
                include('./view/view_footer.php');
            }
            break;

        case 'newad':
            /* Initiates session with client browser */
            session_start();
            if(!isset($_SESSION['user_id'])) {
                session_write_close();
                $title = 'AdSite | Sign-In';
                $heading = 'Sign-In';
                $webpageSector = 'postAd';
                $next_login_page_action = "adtype";
                include('./view/view_header.php');
                include('./view/view_body/login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $adType = filter_input(INPUT_GET, 'adType');
                switch($adType) {
                    case 'normal':
                    case 'top1':
                    case 'top2':
                        $title = 'AdSite | Post an Ad';
                        $heading = 'Post&nbsp;an&nbsp;Ad';
                        $webpageSector = 'postAd';
                        $stylesheets = '<link rel="stylesheet" type="text/css" href="./view/view_body/css/newad_view.css">';
                        $user_phone_no = get_phone_no_from_user_id($_SESSION['user_id']);
                        $all_category_records = get_all_category_records();
                        $all_city_records = get_all_city_records();
                        include('./view/view_header.php');
                        include('./view/view_body/newAd_view.php');
                        include('./view/view_footer.php');
                        break;
                    default:
                        session_write_close();
                        header('location:./index.php?action=adtype');
                        exit();
                }
            }
            break;

        case 'insertnewad':
            session_start();
            if(!isset($_SESSION['user_id'])) {
                session_write_close();
                $title = 'AdSite | Sign-In';
                $heading = 'Sign-In';
                $webpageSector = 'postAd';
                $next_login_page_action = "adtype";
                include('./view/view_header.php');
                include('./view/view_body/login_view.php');
                include('./view/view_footer.php');
            }
            else {
                //Validator
                $isValid = true;
                //User ID
                $ad_user_id = $_SESSION['user_id'];
                //Category ID
                $ad_category_id = filter_input(INPUT_POST, 'ad_category_id', FILTER_VALIDATE_INT);
                if(empty($ad_category_id) || $ad_category_id===false) {
                    $isValid = false;
                }
                //City ID
                $ad_city_id = filter_input(INPUT_POST, 'ad_city_id', FILTER_VALIDATE_INT);
                if(empty($ad_city_id) || $ad_city_id===false) {
                    $isValid = false;
                }
                //Ad Price
                $ad_price = filter_input(INPUT_POST, 'ad_price', FILTER_VALIDATE_FLOAT);
                if(!is_numeric($ad_price)) {
                    $isValid = false;
                }
                //Ad Heading
                $ad_heading = filter_input(INPUT_POST, 'ad_heading');
                if(empty($ad_heading)) {
                    $isValid = false;
                }
                else {
                    $ad_heading = trim($ad_heading);
                    if(strlen($ad_heading) === 0) {
                        $isValid = false;
                    }
                    else {
                        $ad_heading = htmlspecialchars($ad_heading);
                    }
                }
                //Ad Description
                $ad_description = filter_input(INPUT_POST, 'ad_description');
                if(empty($ad_description)) {
                    $ad_description = "No description.";
                }
                else {
                    $ad_description = trim($ad_description);
                    if(strlen($ad_description === 0)) {
                        $ad_description = "No description.";
                    }
                    else {
                        $ad_description = htmlspecialchars($ad_description);
                    }
                }
                //Ad Type
                $ad_type = filter_input(INPUT_POST, 'ad_type');
                $ad_type_id = null;
                if(empty($ad_type)) {
                    $isValid = false;
                }
                else {
                    $ad_type_id = get_type_id_from_name($ad_type);
                    if($ad_type_id === false) {
                        $isValid = false;
                    }
                    else {
                        $ad_type_id = $ad_type_id['type_id'];
                    }
                }
                //Ad Image
                $next_ad_id = get_next_ad_id()['AUTO_INCREMENT'];
                $ad_image_path_absolute = getcwd() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
                $ad_image_path = '.' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
                $ad_image_temp_name = $_FILES['ad_image']['tmp_name'] ?? null;
                $image_type = $_FILES['ad_image']['type'] ?? null;
                if(empty($ad_image_temp_name)) {
                    $ad_image_path_absolute .= 'default-placeholder.png';
                    $ad_image_path .= 'default-placeholder.png';
                }
                else if($image_type!=='image/jpeg' && $image_type!=='image/gif' && $image_type!=='image/png' && $image_type!=='image/webp' && $image_type!=='image/bmp') {
                    $isValid = false;
                }
                else {
                    $ad_image_path_absolute .= $ad_user_id;
                    $ad_image_path .= $ad_user_id;
                    if(!is_dir($ad_image_path_absolute)) {
                        mkdir($ad_image_path_absolute);
                    }
                    $ad_image_path_absolute .= DIRECTORY_SEPARATOR . $next_ad_id;
                    $ad_image_path .= DIRECTORY_SEPARATOR . $next_ad_id;
                    mkdir($ad_image_path_absolute);
                    $ad_image_path_absolute .= DIRECTORY_SEPARATOR . $_FILES['ad_image']['name'];
                    $ad_image_path .= DIRECTORY_SEPARATOR . $_FILES['ad_image']['name'];
                    move_uploaded_file($ad_image_temp_name, $ad_image_path_absolute);
                }
                //Ad Status
                $ad_status = 'PENDING';
                $current_time = new DateTime();
                //Date created, last modified, expired
                $ad_created = $ad_last_modified = $ad_expired = $current_time->format('Y-m-d H:i:s');
                //Ad Expiration Offset
                $ad_expiration_offset = '+P0Y0M0DT0H0M0S';
                if($isValid) {
                    insert_new_ad($ad_category_id, $ad_heading, $ad_description, $ad_image_path, $ad_price, $ad_status, $ad_city_id, $ad_created, $ad_last_modified, $ad_user_id, $ad_type_id, $ad_expired, $ad_expiration_offset);
                    header('location:./index.php?action=dashboard');
                }
                else {
                    //Error Handling
                    header('location:./index.php?action=adtype&isValid=false');
                }
            }
            break;
        
        case 'updatead':
            session_start();
            if(!isset($_SESSION['user_id'])) {
                session_write_close();
                $title = 'AdSite | Sign-In';
                $heading = 'Sign-In';
                $webpageSector = 'postAd';
                $next_login_page_action = "dashboard";
                include('./view/view_header.php');
                include('./view/view_body/login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $ad_id = filter_input(INPUT_GET, 'adid', FILTER_VALIDATE_INT);
                if(!empty($ad_id) && $ad_id!==false) {
                    $ad_record = get_ad_record($ad_id, $_SESSION['user_id']);
                    if($ad_record === false) {
                        header('location:./index.php?action=dashboard');
                        exit();
                    }
                    $error_message = '';
                    $isValid = filter_input(INPUT_GET, 'isValid');
                    if($isValid==='false') {
                        $error_message = 'An error occured while creating your ad. Please verify your data and try again.';
                    }
                    $title = 'AdSite | Update Ad';
                    $heading = 'Update&nbsp;Ad';
                    $webpageSector = 'postAd';
                    $stylesheets = '<link rel="stylesheet" type="text/css" href="./view/view_body/css/newad_view.css">';
                    $user_phone_no = get_phone_no_from_user_id($_SESSION['user_id']);
                    $all_category_records = get_all_category_records();
                    $all_city_records = get_all_city_records();
                    include('./view/view_header.php');
                    include('./view/view_body/update_view.php');
                    include('./view/view_footer.php');    
                }
                else {
                    header('location:./index.php?action=dashboard');
                }           
            }
            break;
        case 'updateadrecord':
            session_start();
            if(!isset($_SESSION['user_id'])) {
                session_write_close();
                $title = 'AdSite | Sign-In';
                $heading = 'Sign-In';
                $webpageSector = 'postAd';
                $next_login_page_action = "dashboard";
                include('./view/view_header.php');
                include('./view/view_body/login_view.php');
                include('./view/view_footer.php');
            }
            else {
                //Validator
                $isValid = true;
                //User ID
                $ad_user_id = $_SESSION['user_id'];
                //Ad_ID
                $ad_id = filter_input(INPUT_POST, 'ad_id', FILTER_VALIDATE_INT);
                if(empty($ad_id) || $ad_id===false) {
                    $isValid = false;
                }
                //Category ID
                $ad_category_id = filter_input(INPUT_POST, 'ad_category_id', FILTER_VALIDATE_INT);
                if(empty($ad_category_id) || $ad_category_id===false) {
                    $isValid = false;
                }
                //City ID
                $ad_city_id = filter_input(INPUT_POST, 'ad_city_id', FILTER_VALIDATE_INT);
                if(empty($ad_city_id) || $ad_city_id===false) {
                    $isValid = false;
                }
                //Ad Price
                $ad_price = filter_input(INPUT_POST, 'ad_price', FILTER_VALIDATE_FLOAT);
                if(!is_numeric($ad_price)) {
                    $isValid = false;
                }
                //Ad Heading
                $ad_heading = filter_input(INPUT_POST, 'ad_heading');
                if(empty($ad_heading)) {
                    $isValid = false;
                }
                else {
                    $ad_heading = trim($ad_heading);
                    if(strlen($ad_heading) === 0) {
                        $isValid = false;
                    }
                    else {
                        $ad_heading = htmlspecialchars($ad_heading);
                    }
                }
                //Ad Description
                $ad_description = filter_input(INPUT_POST, 'ad_description');
                if(empty($ad_description)) {
                    $ad_description = "No description.";
                }
                else {
                    $ad_description = trim($ad_description);
                    if(strlen($ad_description === 0)) {
                        $ad_description = "No description.";
                    }
                    else {
                        $ad_description = htmlspecialchars($ad_description);
                    }
                }
                //Ad Type
                $ad_type_id = filter_input(INPUT_POST, 'ad_type_id', FILTER_VALIDATE_INT);
                if(empty($ad_type_id) || $ad_type_id===false) {
                    $isValid = false;
                }
                //Ad Image
                $ad_image_path;
                $ad_image_temp_name = $_FILES['ad_image']['tmp_name'] ?? null;
                $image_type = $_FILES['ad_image']['type'] ?? null;
                if(!empty($ad_image_temp_name)) {
                    if($image_type!=='image/jpeg' && $image_type!=='image/gif' && $image_type!=='image/png' && $image_type!=='image/webp' && $image_type!=='image/bmp') {
                        $isValid = false;
                    }
                    else {
                        $ad_image_path_absolute = getcwd() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
                        $ad_image_path = '.' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
                        $ad_image_path_absolute .= $ad_user_id;
                        $ad_image_path .= $ad_user_id;
                        if(!is_dir($ad_image_path_absolute)) {
                            mkdir($ad_image_path_absolute);
                        }
                        $ad_image_path_absolute .= DIRECTORY_SEPARATOR . $ad_id;
                        $ad_image_path .= DIRECTORY_SEPARATOR . $ad_id;
                        if(is_dir($ad_image_path_absolute)) {
                            $files = scandir($ad_image_path_absolute);
                            foreach($files as $file) {
                                $file_path = $ad_image_path_absolute . DIRECTORY_SEPARATOR . $file;
                                if(is_file($file_path)) {
                                    unlink($file_path);
                                }
                            }
                        }
                        else {
                            mkdir($ad_image_path_absolute);
                        }
                        $ad_image_path_absolute .= DIRECTORY_SEPARATOR . $_FILES['ad_image']['name'];
                        $ad_image_path .= DIRECTORY_SEPARATOR . $_FILES['ad_image']['name'];
                        move_uploaded_file($ad_image_temp_name, $ad_image_path_absolute);
                    }
                }
                else {
                    $ad_image_path = get_ad_image_path($ad_id)['ad_image_path'];
                }
                //Date last modified
                $current_time = new DateTime();
                $ad_last_modified = $current_time->format('Y-m-d H:i:s');
                //Ad status
                $ad_status = 'PENDING';
                //Ad expiration offset
                $ad_expiration_offset;
                $current_ad_status = get_ad_status($ad_id);
                if(($ad_type_id===2 || $ad_type_id===3) && $current_ad_status ==='VERIFIED') {
                    $ad_expired = get_expiration_date($ad_id);
                    $ad_expired_date = new DateTime($ad_expired);
                    $ad_expiration_offset_obj = date_diff($current_time, $ad_expired_date);
                    $ad_expiration_offset = $ad_expiration_offset_obj->format('%RP%yY%mM%dDT%hH%iM%sS');
                }
                else {
                    //Current offset
                    $ad_expiration_offset = get_ad_exp_offset($ad_id)['ad_expiration_offset'];
                }
                if($isValid) {
                    if(empty($ad_image_path)) {
                        update_ad_no_image($ad_id, $ad_user_id, $ad_category_id, $ad_heading, $ad_description, $ad_price, $ad_status, $ad_city_id, $ad_last_modified, $ad_expiration_offset);
                    }
                    else {
                        update_ad($ad_id, $ad_user_id, $ad_category_id, $ad_heading, $ad_description, $ad_image_path, $ad_price, $ad_status, $ad_city_id, $ad_last_modified, $ad_expiration_offset);
                    }
                    header('location:./index.php?action=dashboard');
                }
                else {
                   //Error handling
                   if(empty($ad_id) || $ad_id===false) {
                       header('location:./index.php?action=dashboard');
                   }
                   else {
                       header('location:./index.php?action=updatead&adid=' . $ad_id . '&isValid=false');
                   }
                }
            }
            break;
        case 'deletead':
            session_start();
            if(!isset($_SESSION['user_id'])) {
                session_write_close();
                $title = 'AdSite | Sign-In';
                $heading = 'Sign-In';
                $webpageSector = 'postAd';
                $next_login_page_action = "dashboard";
                include('./view/view_header.php');
                include('./view/view_body/login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $ad_id = filter_input(INPUT_GET, 'adid', FILTER_VALIDATE_INT);
                if(!empty($ad_id) && $ad_id!==false) {
                    $user_id = get_user_from_ad($ad_id)['ad_user_id'] ?? null;
                    if(!empty($user_id)) {
                        if($user_id === $_SESSION['user_id']) {
                            $title = 'AdSite | Delete Ad';
                            $heading = 'Delete&nbsp;Ad';
                            $webpageSector = 'postAd';
                            include('./view/view_header.php');
                            include('./view/view_body/deleteAd_view.php');
                            include('./view/view_footer.php');
                        }
                        else {
                            header('location:./index.php?action=dashboard');
                        }
                    }
                    else {
                        header('location:./index.php?action=dashboard');
                    }
                }
                else {
                    header('location:./index.php?action=dashboard');
                }
            }
            break;
        case 'deleteadrecord':
            session_start();
            if(!isset($_SESSION['user_id'])) {
                session_write_close();
                $title = 'AdSite | Sign-In';
                $heading = 'Sign-In';
                $webpageSector = 'postAd';
                $next_login_page_action = "dashboard";
                include('./view/view_header.php');
                include('./view/view_body/login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $ad_user_id = $_SESSION['user_id'];
                $ad_id = filter_input(INPUT_POST, 'ad_id', FILTER_VALIDATE_INT);
                if(!empty($ad_id) && $ad_id!==false) {
                    //Delete any image fom file system
                    $image_dir_path = getcwd() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $ad_user_id . DIRECTORY_SEPARATOR . $ad_id;
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
                    //Delete ad record from database
                    delete_ad_record($ad_id, $ad_user_id);
                }
                header('location:./index.php?action=dashboard');
            }
            break;
        case 'displayad':
            session_start();
            if(!isset($_SESSION['user_id'])) {
                session_write_close();
                $title = 'AdSite | Sign-In';
                $heading = 'Sign-In';
                $webpageSector = 'postAd';
                $next_login_page_action = "dashboard";
                include('./view/view_header.php');
                include('./view/view_body/login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $ad_id = filter_input(INPUT_GET, 'adid', FILTER_VALIDATE_INT);
                if(!empty($ad_id) && $ad_id!==false) {
                    $ad_record = get_ad_record($ad_id, $_SESSION['user_id']);
                    if($ad_record === false) {
                        header('location:./index.php?action=dashboard');
                        exit();
                    }
                    $title = $ad_record['ad_title'];
                    $webpageSector = 'postAd';
                    $stylesheets = '<link rel="stylesheet" type="text/css" href="./view/view_body/css/adDisplay_view.css">';
                    $user_phone_no = get_phone_no_from_user_id($_SESSION['user_id']);
                    $ad_city_name = get_city_name_from_id($ad_record['ad_city_id']);
                    $ad_category_name = get_category_name_from_id($ad_record['ad_category_id']);
                    $current_time_obj = new DateTime();
                    $ad_created_obj = new DateTime($ad_record['ad_created']);
                    $interval = get_time_diff($ad_created_obj, $current_time_obj) . ' ago';
                    include('./view/view_header.php');
                    include('./view/view_body/adDisplay_view.php');
                    include('./view/view_footer.php');    
                }
                else {
                    header('location:./index.php?action=dashboard');
                }           
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
        case 'maketopadselect':
            session_start();
            if(!isset($_SESSION['user_id'])) {
                session_write_close();
                $title = 'AdSite | Sign-In';
                $heading = 'Sign-In';
                $webpageSector = 'postAd';
                $next_login_page_action = "dashboard";
                include('./view/view_header.php');
                include('./view/view_body/login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $ad_id = filter_input(INPUT_GET, 'adid', FILTER_VALIDATE_INT);
                if(!empty($ad_id) && $ad_id!==false) {
                    $user_id = get_user_from_norm_ad($ad_id)['ad_user_id'] ?? null;
                    if(!empty($user_id)) {
                        if($user_id === $_SESSION['user_id']) {
                            $title = 'AdSite | Make Top Ad';
                            $heading = 'Select&nbsp;an&nbsp;Ad&nbsp;Type';
                            $webpageSector = 'postAd';
                            $all_type_records = get_all_type_records();
                            include('./view/view_header.php');
                            include('./view/view_body/makeTopAd_view.php');
                            include('./view/view_footer.php');
                        }
                        else {
                            header('location:./index.php?action=dashboard');
                        }
                    }
                    else {
                        header('location:./index.php?action=dashboard');
                    }
                }
                else {
                    header('location:./index.php?action=dashboard');
                }     
            }
            break;
        case 'maketopad':
            session_start();
            if(!isset($_SESSION['user_id'])) {
                session_write_close();
                $title = 'AdSite | Sign-In';
                $heading = 'Sign-In';
                $webpageSector = 'postAd';
                $next_login_page_action = "dashboard";
                include('./view/view_header.php');
                include('./view/view_body/login_view.php');
                include('./view/view_footer.php');
            }
            else {
                $isValid = true;
                $ad_user_id = $_SESSION['user_id'];
                $ad_id = filter_input(INPUT_POST, 'ad_id', FILTER_VALIDATE_INT);
                if(empty($ad_id) || $ad_id===false) {
                    $isValid = false;
                }
                $ad_type_id = filter_input(INPUT_POST, 'ad_type_id', FILTER_VALIDATE_INT);
                if(empty($ad_type_id) || $ad_type_id===false) {
                    $isValid = false;
                }
                $ad_status = 'PENDING';
                $current_time = new DateTime();
                $ad_last_modified = $current_time->format('Y-m-d H:i:s');
                if($isValid) {
                    update_to_top($ad_id, $ad_type_id, $ad_status, $ad_last_modified, $ad_user_id);
                }
                header('location:./index.php?action=dashboard');
            }
            break;
        
        case 'home':
            $cat_id = filter_input(INPUT_GET, 'cat', FILTER_VALIDATE_INT);
            $q = filter_input(INPUT_GET, 'q');
            $q = trim($q);

            if(empty($cat_id) || $cat_id===false) {
                $cat_id = -1;
            }

            $hasCat = false;
            $hasSearch = false;
            $query = 'select * from ad_table';
            $cat_query = '';

            if($cat_id !== -1) {
                $hasCat = true;
                $cat_query .= 'ad_category_id = :ad_category_id';
            }
            $search_query = '';
            if(!empty($q)) {
                $hasSearch = true;
                $search_query = '(ad_title like :search or ad_description like :search)'; 
            }

            if (!$hasCat && !$hasSearch) {
                $query .= ' where ad_status=\'VERIFIED\' order by ad_created desc;';
            }
            else if ($hasCat && !$hasSearch) {
                $query .= ' where ' . $cat_query . ' and ad_status=\'VERIFIED\' order by ad_created desc;';
            }
            else if (!$hasCat && $hasSearch) {
                $query .= ' where ' . $search_query . ' and ad_status=\'VERIFIED\' order by ad_created desc;';
            }
            else {
                $query .= ' where ' . $cat_query . ' and ' .  $search_query . ' and ad_status=\'VERIFIED\' order by ad_created desc;';
            }

            $normal_ad_array = array();
            $top_ad_array = array();
            try {
                $statement = $db->prepare($query);
                if ($hasCat && $hasSearch) {
                    $statement->bindValue(':ad_category_id', $cat_id);
                    $statement->bindValue(':search', '%'.$q.'%');
                }
                else if ($hasCat && !$hasSearch) {
                    $statement->bindValue(':ad_category_id', $cat_id);
                }
                else if (!$hasCat && $hasSearch) {
                    $statement->bindValue(':search', '%'.$q.'%');
                    //echo $query;
                }
                $statement->execute();
                $result = $statement->fetch();
                while($result != null) {
                    if($result['ad_type_id'] == 1) {
                        $normal_ad_array[] = $result;
                    }
                    else {
                        $top_ad_array[] = $result;
                    }
                    $result = $statement->fetch();
                }
                $statement->closeCursor();
            }
            catch(Exception $e) {
                //Handle Exception
            }
            $current_time_obj = new DateTime();
            $webpageSector = 'browseAds';
            $title = 'Adsite | Home';
            $stylesheets = '<link rel="stylesheet" type="text/css" href="./view/view_body/css/home_view.css">';
            include('./view/view_header.php');
            include('./view/view_body/home_view.php');
            include('./view/view_footer.php');
            break;
        
        case 'viewAd':
            $ad_id = filter_input(INPUT_GET, 'adid', FILTER_VALIDATE_INT);
            if(!empty($ad_id) && $ad_id!==false) {
                $ad_record = get_verified_ad_record($ad_id);
                if($ad_record === false) {
                    header('location:./index.php?action=home');
                    exit();
                }
                $title = $ad_record['ad_title'];
                $webpageSector = 'browseAds';
                $stylesheets = '<link rel="stylesheet" type="text/css" href="./view/view_body/css/adDisplay_view.css">';
                $user_phone_no = get_phone_no_from_user_id($ad_record['ad_user_id']);
                $ad_city_name = get_city_name_from_id($ad_record['ad_city_id']);
                $ad_category_name = get_category_name_from_id($ad_record['ad_category_id']);
                $current_time_obj = new DateTime();
                $ad_created_obj = new DateTime($ad_record['ad_created']);
                $interval = get_time_diff($ad_created_obj, $current_time_obj) . ' ago';
                include('./view/view_header.php');
                include('./view/view_body/view_ad_view.php');
                include('./view/view_footer.php');    
            }
            else {
                header('location:./index.php?action=home');
            }           
            break;

        default:
            header('./index.php?action=home');
    }
?>