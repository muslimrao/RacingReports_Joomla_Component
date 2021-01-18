<?php
require_once JPATH_COMPONENT . DIRECTORY_SEPARATOR .  'views/vendor/autoload.php';


$TMP_where = "";
if (UtilHelper::isRequestExists('category') !== FALSE) {
    $TMP_where .= " and LOWER( Categoria ) = '" .  strtolower($_REQUEST['category']) . "' ";
}

if (UtilHelper::isRequestExists('track') !== FALSE) {
    $TMP_where .= " and LOWER( Pista ) = '" .  strtolower($_REQUEST['track']) . "' ";
}



$get_list  = mysqli_query(UtilHelper::getMySql_Connection(), "select * FROM `incidentes` where 1=1 " . $TMP_where . " ORDER BY id DESC");


$get_categories_list    = mysqli_query(UtilHelper::getMySql_Connection(), " select DISTINCT( Categoria ) from incidentes where 1=1 " . $TMP_where . " ");
$array_category      = [];
foreach ($get_categories_list as $gcl) {
    $array_category[] = $gcl["Categoria"];
}


$get_tracks_list    = mysqli_query(UtilHelper::getMySql_Connection(), " select DISTINCT( Pista ) from incidentes where 1=1 " . $TMP_where . " ");
$array_track      = [];
foreach ($get_tracks_list as $gtl) {
    $array_track[] = $gtl["Pista"];
}


$get_20grids_list    = mysqli_query(UtilHelper::getMySql_Connection(), " select * from incidentes where 1=1 " . $TMP_where . " and LOWER(Resolucion) like '%20 grid%'  ORDER BY id DESC");
$array_20grids      = [];
foreach ($get_20grids_list as $a20grids) {

    if (!in_array($a20grids["Reportado"], $array_20grids)) {
        $array_20grids[] = $a20grids["Reportado"];
    }
}



$get_raceban_list    = mysqli_query(UtilHelper::getMySql_Connection(), " select * from incidentes where 1=1 " . $TMP_where . " and LOWER(Resolucion) like '%race ban%'  ORDER BY id DESC");
$array_raceban      = [];
foreach ($get_raceban_list as $grbl) {

    if (!in_array($grbl["Reportado"], $array_raceban)) {
        $array_raceban[] = $grbl["Reportado"];
    }
}



$get_tiempo_list    = mysqli_query(UtilHelper::getMySql_Connection(), " select * from incidentes where 1=1 " . $TMP_where . " and ( LOWER(Resolucion) like '%seg%' or LOWER(Resolucion) like '%sec%' )  ORDER BY id DESC");
$array_tiemp      = [];
foreach ($get_tiempo_list as $gtpl) {
    if (!in_array($gtpl["Reportado"], $array_tiemp)) {
        $array_tiemp[] = $gtpl["Reportado"];
    }
}



$load_html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="Content-Type" content="charset=utf-8" />
  <style type="text/css">
    
    @page { margin: 5px; }
    body { margin: 5px; }

  </style>
</head>

<body>
<table cellpadding="0" cellspacing="0"
    style="font-size: 20px; width: 100%; background-color: black; font-family: Arial, Helvetica, sans-serif;;">
    
     <tr style="height:5px; font-size:10px;">
        <td colspan="2" style="background-color: black;">.  </td>
    </tr>
    <tr>
		<td colspan="2" class="warning" style="color:#FEFE56; text-align: center;">
		<img src="' . UtilHelper::getReportIncidentAssetUrl() . 'images/warningthumb.png" />
		<img src="' . UtilHelper::getReportIncidentAssetUrl() . 'images/warningthumb.png" /> 
		<img src="' . UtilHelper::getReportIncidentAssetUrl() . 'images/warningthumb.png" /> 
		Race Director 
		<img src="' . UtilHelper::getReportIncidentAssetUrl() . 'images/warningthumb.png" />
		<img src="' . UtilHelper::getReportIncidentAssetUrl() . 'images/warningthumb.png" /> 
		<img src="' . UtilHelper::getReportIncidentAssetUrl() . 'images/warningthumb.png" />
		</td>
    </tr>

    
    <tr>
        <td style="width: 167px; text-align:center;">
            <img width="120px" src="' . UtilHelper::getReportIncidentAssetUrl() . 'images/gpe-logo.png">
        </td>

        <td>
            <table style="color: white; font-size: 22px;">
                <tr>
                    <td>Categoria:       </td>
                    <td>' . implode(", ", $array_category) . '</td>
                </tr>

                <tr>
                    <td>Pista:</td>
                    <td>' . implode(", ", $array_track) . '</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="2" style="background-color: black;">
             
        </td>
    </tr>

    <tr>
        <td colspan=" 2" style=" ">
            <table style="color:white; background-color: #666666; width: 100%; text-align:left;">
                <tr>
                    <td style="font-weight:bold; width: 167px;">
                        20 GRID:
                    </td>
                    <td>' . implode(", ", $array_20grids) . '</td>
                </tr>

                
                <tr>
                    <td colspan="2" style="height:5px;"></td>
                </tr>
                
                <tr>
                    <td style="font-weight:bold">
                        RACE BAN:
                    </td>
                     <td>' . implode(", ", $array_raceban) . '</td>
                </tr>

                <tr>
                    <td colspan="2" style=" height:5px;"></td>
                </tr>
                <tr>
                    <td style="font-weight:bold">
                        Tiempo:
                    </td>
                    <td>' . implode(", ", $array_tiemp) . '</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="2" style="background-color:#434343;">
             
        </td>
    </tr>
    ';

$i = 0;
foreach ($get_list as $gl) {
    $i++;
    $a = $i % 2;
    $color = "#434343";
    if ($a) {
        $color = "#666666";
    }
    $load_html .= '<tr>
        <td colspan=" 2" style="">
            <table style="color:white; background-color: ' . $color . '; width: 100%; text-align:left;">
                <tr>
                    <td>
                        ' . $gl["Categoria"] . ' ' .  $gl["Pista"] . '   (' . $gl["Reportado"] . ' | ' . $gl["Afectado"] . ')

                    </td>
                </tr>
                <tr>

                    <td>
                        Incidente: ' . $gl["Incidente"] . '

                    </td>
                </tr>
                <tr>

                    <td>
                        Resolución: ' . $gl["Resolucion"] . ' (' . $gl["Reportado"] . ')

                    </td>
                </tr>
                <tr style="height:15px;">

                    <td></td>
                </tr>
            </table>
        </td>
    </tr>
';
}

$load_html .= '
</table>
</body>
	</html>

    ';



use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);



// instantiate and use the dompdf class
$dompdf = new Dompdf($options);
$dompdf->loadHtml($load_html);


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'letter');

// Render the HTML as PDF
$dompdf->render();


$file_name = implode(", ", $array_category) . ' ' . implode(", ", $array_track) . ' (' . date("d-M") . ').pdf';


if (UtilHelper::isRequestExists('pdf')) {
    echo $load_html;
} else {
    // Output the generated PDF to Browser

    $dompdf->stream($file_name);
}
