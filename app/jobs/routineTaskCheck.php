<?php

require __DIR__.'/../bootstrap/application.php';

$response = ['success' => false, 'message' => '', 'data' => ''];

try {
    $tasks = $scheduleRepositery->findAllAvailableTasks();

    if (!empty($tasks)) {
        
    }

} catch (\Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);


