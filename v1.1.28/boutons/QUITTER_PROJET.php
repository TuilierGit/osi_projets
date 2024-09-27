<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function calculer_bouton_quitter_projet( $id_projet, $id_auteur) {
    include_spip('inc/filtres');

    $label = _T('osi_projets:quitter_projet');
    $url_action = generer_action_auteur('supprimer_auteur_projet', $id_projet .','.  $id_auteur  , self());
    $class = 'btn btn-danger';
    $confirm = _T('osi_projets:message_quitter_projet');
    $title = _T('osi_projets:quitter_projet');
    $fond = '';

    return bouton_action($label, $url_action, $class, $confirm, $title, $fond);
}

// Déclaration de la balise
function balise_QUITTER_PROJET($p) {
    $id_projet = interprete_argument_balise(1, $p);
    $id_auteur = interprete_argument_balise(2, $p);
    $p->code = "calculer_bouton_quitter_projet($id_projet, $id_auteur)";
    $p->interdire_scripts = false;
    return $p;
}

?>


