<?php

class Controller
{
    public function printJson($dataToJson)
    {
        extract($dataToJson);
        echo json_encode($dataToJson);
    }

    public function printEmptyFieldJson($fieldName)
    {
        $message = [
            'success' => false,
            'message' => 'Missing field: ' . $fieldName
        ];
        echo json_encode($message);
        exit;
    }

    public function printErrorJson($errorMessage)
    {
        $message = [
            'success' => false,
            'message' => 'Error: ' . $errorMessage
        ];
        echo json_encode($message);
        exit;
    }
}
