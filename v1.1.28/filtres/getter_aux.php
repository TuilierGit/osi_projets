<?php
if (!defined('_ECRIRE_INC_VERSION')) return;


function get_lang($nom_lang){
    $valeur = lire_config($nom_lang);
    if ($valeur != '' && $valeur != null){
        return $valeur;
    } else {
        $path = 'osi_projets:' . $nom_lang;
        return _T($path);
    }
}


?>