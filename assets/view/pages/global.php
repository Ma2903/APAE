<?php
function converterDataParaBR($data) {
    $dataArray = explode('-', $data);
    return $dataArray[2] . '/' . $dataArray[1] . '/' . $dataArray[0];
}

?>