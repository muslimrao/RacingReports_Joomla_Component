<?php
mysqli_query(UtilHelper::getMySql_Connection(), "update`incidentes` set Resolucion = '" . $_REQUEST["Resolucion"] . "' where 1=1 and id = " . $_REQUEST['incident_id']);

$_data = array(
    "status"     => "success",
    "message"   => "Resolucion Updated."
);

echo json_encode($_data);
