<?php
$get_victim_video  = mysqli_query(UtilHelper::getMySql_Connection(), "select * FROM `incidentes` where id = '" . $_REQUEST['incident_id'] . "' ");
if (mysqli_num_rows($get_victim_video) > 0) {


    $get_victim_video   = mysqli_fetch_assoc($get_victim_video);
    $get_victim_video   = UtilHelper::utf8_wrap($get_victim_video);

    $get_guilty_video   = mysqli_query(UtilHelper::getMySql_Connection(), "select * FROM `parc_ferme` where LOWER(Piloto) = '" . strtolower($_REQUEST['guilty_racer']) . "' AND Categoria = '" . $get_victim_video['Categoria'] . "' AND Pista = '" . $get_victim_video['Pista'] . "'");


    if (mysqli_num_rows($get_guilty_video) > 0) {
        $get_guilty_video                       = mysqli_fetch_assoc($get_guilty_video);
        $get_guilty_video['guilty_video_ID']    = UtilHelper::convertYoutube($get_guilty_video["Youtube1"], TRUE);
    }


    $_data = array(
        "status"     => "success",
        "message"   => array("data" =>  $get_guilty_video)
    );
} else {
    $_data = array(
        "status"     => "error",
        "message"   => '<img src="' . UtilHelper::getReportIncidentAssetUrl() . 'images/video-placeholder.png" />'
    );
}
echo json_encode($_data);
