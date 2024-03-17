<?php

function printResult($status, $message, $data)
{
    $result = [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];
    echo json_encode($result);
}

function printError($message)
{
    printResult(0, $message, null);
}

function printSuccess($message, $data)
{
    printResult(1, $message, $data);
}
