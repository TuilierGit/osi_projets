<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function calculer_bouton_exemple_roles() {
    include_spip('inc/filtres');

    $label = _T('osi_projets:exemple_roles');
    $url_action = generer_action_auteur('exemple_roles','', self());
    $class = 'btn btn-danger';
    $confirm = _T('osi_projets:message_exemple_roles');
    $title = _T('osi_projets:exemple_roles');
    $fond = '';

    return bouton_action($label, $url_action, $class, $confirm, $title, $fond);
}

// Déclaration de la balise
function balise_EXEMPLE_ROLES($p) {
    $p->code = "calculer_bouton_exemple_roles()";
    $p->interdire_scripts = false;
    return $p;
}

?>


