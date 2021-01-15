<?php
class UtilHelper
{
    static $abc = "fa";
    static $juez_array = array("Juez1", "Juez2", "Juez3", "Juez4", "Juez5", "Juez6");
    /*static $penalties_images = array(
        "3 Seg"        => "images/3-seg.png",
        "10 Seg"        => "images/10-seg.png",
        "5 Seg"     => "images/5-seg.png",
        "20 Seg"        => "images/20-seg.png",
        "Race Ban"      => "images/race-ban.png",
        "20 Grid"       => "images/20-grid.png",
        "NFA"       => "images/nfa.png",
        "SWAP"          => "images/swap-icon.png",
        "Race Incident" => "images/red-icon.png",
        "Warning"   => "images/orange-icon.png",
        "Victim"   => "images/victim.png",
    );
    */
    static function penalties_images()
    {
        $path   = self::getReportIncidentAssetUrl();
        return
            $penalties_images = array(
                "3 Seg"        => $path . "images/3-seg.png",
                "10 Seg"        => $path . "images/10-seg.png",
                "5 Seg"     => $path . "images/5-seg.png",
                "20 Seg"        => $path . "images/20-seg.png",
                "Race Ban"      => $path .  "images/race-ban.png",
                "20 Grid"       => $path . "images/20-grid.png",
                "NFA"       => $path . "images/nfa.png",
                "SWAP"          => $path . "images/swap-icon.png",
                "Race Incident" => $path . "images/red-icon.png",
                "Warning"   => $path . "images/orange-icon.png",
                "Victim"   => $path .  "images/victim.png",
            );
    }

    static function utf8_wrap($data)
    {
        foreach ($data as $_key => $_value) {
            $data[$_key] = utf8_encode($_value);
        }

        return $data;
    }

    static function convertYoutube($string, $only_id = FALSE)
    {
        $youtube_addr = "//www.youtube.com/embed/";
        if ($only_id) {
            $youtube_addr = "";
        }

        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            $youtube_addr . "$2",
            $string
        );
    }

    static  function isRequestExists($name)
    {
        if (isset($_REQUEST[$name])) {
            if ($_REQUEST[$name] != "") {
                return $_REQUEST[$name];
            }
        }

        return FALSE;
    }

    static function getMySql_Connection()
    {
        $config  = new JConfig();

        $app = JFactory::getApplication();
        $getDBConnection = $app->get('mysqli_connect');


        if ($getDBConnection != NULL) {
            if (mysqli_ping($getDBConnection)) {
                return $getDBConnection;
            }
        }

        $mysqli_connect = mysqli_connect($config->host, $config->user, $config->password, $config->db);
        $app->set('mysqli_connect', $mysqli_connect);

        return $mysqli_connect;
    }

    static function getReportIncidentAssetUrl()
    {
        $app    = JFactory::getApplication();
        $path   = JURI::base() . '/templates/' . $app->getTemplate() . '/assets_reportincidents/';
        return $path;
    }

    static function load_assets()
    {
        $path   = self::getReportIncidentAssetUrl();


        $tmp_array["css"]       = array(
            #"//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css",
            "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css",
            $path . "style.css?t=" . strtotime("now"),
            $path . "alerts.css?t=" . strtotime("now"),
        );




        $tmp_array["js"]        = array(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js",
            "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
            $path . "youtube.js?t=" . strtotime("now"),
            $path . "site.js?t=" . strtotime("now"),
            $path . "blockui.js"
        );

        $tmp_array['inline_js'] = 'var availableTags = [];';


        foreach (self::penalties_images() as $juez_key => $juez_image) {
            $tmp_array['inline_js'] .= 'availableTags.push("' . $juez_key . '");';
        }

        return $tmp_array;
    }
}
