<?php
$get_victim_video  = mysqli_query(UtilHelper::getMySql_Connection(), "select * FROM `incidentes` where id = '" . $_REQUEST['incident_id'] . "' ");
if (mysqli_num_rows($get_victim_video) > 0) {


    $get_victim_video   = mysqli_fetch_assoc($get_victim_video);
    $get_victim_video   = UtilHelper::utf8_wrap($get_victim_video);



    $get_victim_video['victim_video_ID']               = UtilHelper::convertYoutube($get_victim_video["videop"], TRUE);
    $get_victim_video['victim_video_STARTTIME']        = $get_victim_video["Tiempo"];


    $get_victim_video['guilty_dropdown']                = DropdownHelper::guilty_dropdowns_HTML($_REQUEST['incident_id'], $get_victim_video["Reportado"]);
    $get_victim_video['victim_dropdown']                = DropdownHelper::victim_dropdowns_HTML($_REQUEST['incident_id'], $get_victim_video["Afectado"]);

    $get_victim_video['Fecha']                          = date("Y-m-d G:i:s", strtotime($get_victim_video["Fecha"]));

    $_data = array(
        "status"     => "success",
        "message"   => array("data" =>  $get_victim_video)
    );
} else {
    $_data = array(
        "status"     => "error",
        "message"   => '<img src="' . UtilHelper::getReportIncidentAssetUrl() . 'images/video-placeholder.png" />'
    );
}
echo json_encode($_data);
