<?php

use App\Weather;

require __DIR__.'/../bootstrap/application.php';

$response = ['success' => false, 'message' => '', 'data' => ''];

try {

    $city = 'London'; 

    if (! empty($city)) {

        $weather = new Weather($city);
        $details = $weather->getCurrentData();

        if ( ! empty($details) && isset($details->current) ) {
            $data = [
                'city' => $city,
                'date' => date('Y-m-d'),
                'value' => $details->current->temp_c,
                'time' => date('h:i:s'),
                'added_on' => date('Y-m-d h:i:s')
            ];
            $id = $weatherRepositery->addRecord($data);
            if ($id) {
                $response['success'] = true;
                $response['message'] = MSG_RECORD_ADDED;
            } else {
                $response['message'] = MSG_RECORD_ADD_FAILED;
            }
        } else {
            $response['message'] = MSG_NO_DETAIL_FOUND;
        }
    }

} catch (\Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);


