<?php
function validate_input($name, $feedback) {
    return !empty($name) && !empty($feedback);
}

function save_feedback($name, $feedback) {
    $file = 'data.json';
    $data = [];

    if (file_exists($file)) {
        $content = file_get_contents($file);
        $data = json_decode($content, true) ?? [];
    }

    $entry = [
        "name" => $name,
        "feedback" => $feedback,
        "timestamp" => date("Y-m-d H:i:s")
    ];

    $data[] = $entry;

    return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT)) !== false;
}

function read_feedback() {
    $file = 'data.json';
    if (!file_exists($file)) {
        return [];
    }
    $content = file_get_contents($file);
    return json_decode($content, true) ?? [];
}
?>
