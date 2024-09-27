<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}

function calculer_bouton_synchroniser_mots($id_projet, $sens) {
    include_spip('inc/filtres');

    $label = _T('osi_projets:synchroniser_mots');
    $url_action = generer_action_auteur('synchroniser_mots', "id_projet=$id_projet&sens=$sens", self());
    $class = 'btn btn-danger';
    $confirm = _T('osi_projets:message_synchroniser_mots');
    $title = _T('osi_projets:synchroniser_mots');
    $fond = '';

    return bouton_action($label, $url_action, $class, $confirm, $title, $fond);
}

function balise_SYNCHRONISER_MOTS($p) {
    $id_projet = interprete_argument_balise(1, $p);
    $sens = interprete_argument_balise(2, $p);

    $p->code = "calculer_bouton_synchroniser_mots($id_projet, $sens)";
    $p->interdire_scripts = false;
    return $p;
}
?>
