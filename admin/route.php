<?php
    require_once "controllers/Route.php";
    $route = new Route("ViewController@getIndex");

    $route->post("action", "loginAct", "ActionController@login");
    $route->get("action", "loginAct", "ViewController@getIndex");
    $route->get("action", "logout", "ActionController@logout");
    
    // Examinations
    $route->get("link", "exams", "ViewController@getExamsManage");
    $route->post("action", "addExamAct", "ActionController@addExamAct");
    $route->post("action", "add_exam_id_act", "ActionController@addExamIdAct");
    $route->post("action", "update_status_exam_act", "ActionController@updateStatusExamAct");
    $route->post("action", "get_exam_act", "ActionController@getExamsAct");
    $route->post("action", "check_files_exist_act", "ActionController@checkFilesExistAct");

    // Accounts Admin
    $route->get("link", "accounts", "ViewController@getAccountsManage");
    

    // Password
    $route->post("action", "changePassAct", "ActionController@changePassAct");

    //Add user
    $route->get("link", "users", "ViewController@addUser");
    // upload users
    $route->post("action", "uploadUsersAct", "ActionController@uploadUsersAct");

    //upload file
    $route->post("action", "uploadFilesAct", "ActionController@uploadFilesAct");

    $route->process();
?>

