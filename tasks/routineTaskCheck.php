<?php

require __DIR__.'/../bootstrap/application.php';

$response = ['success' => false, 'message' => '', 'data' => ''];

try {
    // Check if there are any tasks available for trigger  
    if ( $scheduler->hasTasks() ) { 
        $response = $scheduler->run();
    } else {
        $response['message'] = MSG_NO_TASK_AVL;
    }

} catch (\Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);


