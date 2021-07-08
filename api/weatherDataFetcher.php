<?php

use App\Weather;

require __DIR__.'/../bootstrap/application.php';

$response = ['success' => false, 'message' => '', 'data' => ''];

try {

    if ( !isset($_GET['city']) ) {
        $response['message'] = "Error! Invalid data";
        echo json_encode($response); exit;
    }

    $city = htmlspecialchars($_GET['city']); 

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
                $response['message'] = "Record added succesfully";
            } else {
                $response['message'] = "Unable to save the record in database";
            }
        } else {
            $response['message'] = 'No details found for given city.';
        }
    }

} catch (\Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);


