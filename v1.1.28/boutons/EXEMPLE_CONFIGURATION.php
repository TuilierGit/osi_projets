<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function calculer_bouton_exemple_configuration() {
    include_spip('inc/filtres');

    $label = _T('osi_projets:exemple_configuration');
    $url_action = generer_action_auteur('exemple_configuration','', self());
    $class = 'btn btn-danger';
    $confirm = _T('osi_projets:message_exemple_configuration');
    $title = _T('osi_projets:exemple_configuration');
    $fond = '';

    return bouton_action($label, $url_action, $class, $confirm, $title, $fond);
}

// Déclaration de la balise
function balise_EXEMPLE_CONFIGURATION($p) {
    $p->code = "calculer_bouton_exemple_configuration()";
    $p->interdire_scripts = false;
    return $p;
}

?>


