<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function calculer_bouton_recursivite_projet($sens) {
    include_spip('inc/filtres');

    $label = _T('osi_projets:recursivite_projet');
    $url_action = generer_action_auteur('recursivite_projet', $sens, self());
    $class = 'btn btn-danger';
    $confirm = _T('osi_projets:recursivite_projet');
    $title = _T('osi_projets:recursivite_projet');
    $fond = '';

    return bouton_action($label, $url_action, $class, $confirm, $title, $fond);
}

// Déclaration de la balise
function balise_RECURSIVITE_PROJET($p) {
    $sens = interprete_argument_balise(1, $p);
    $p->code = "calculer_bouton_recursivite_projet($sens)";
    $p->interdire_scripts = false;
    return $p;
}

?>