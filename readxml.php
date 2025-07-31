<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/xml');

include_once('../core/initialize.php');

$result = $post->read();

function array_to_xml($data, &$xml_data) {
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            if (is_numeric($key)) {
                $key = 'item'; // dealing with <0/>..<n/> issues
            }
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key", htmlspecialchars("$value"));
        }
    }
}

if ($result) {
    $num = $result->num_rows;

    if ($num > 0) {
        $post_arr = array();
        while ($row = $result->fetch_assoc()) {
            extract($row);
            $post_item = array(
                'id' => $id,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'gender' => $gender,
                'email' => $email,
                'number' => $number,
                'message' => $message
            );
            array_push($post_arr, $post_item);
        }

        $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
        array_to_xml($post_arr, $xml_data);
        echo $xml_data->asXML();
    } else {
        $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
        $xml_data->addChild('message', 'No Messages found');
        echo $xml_data->asXML();
    }
} else {
    $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
    $xml_data->addChild('message', 'Error executing query');
    echo $xml_data->asXML();
}
?>
