<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function calculer_bouton_supprimer_projet($id_projet) {
    include_spip('inc/filtres');

    $label = _T('osi_projets:supprimer_projet');
    $url_action = generer_action_auteur('supprimer_projet', $id_projet, self());
    $class = 'btn btn-danger';
    $confirm = _T('osi_projets:message_suppression_projet');
    $title = _T('osi_projets:supprimer_projet');
    $fond = '';

    return bouton_action($label, $url_action, $class, $confirm, $title, $fond);
}

// Déclaration de la balise
function balise_SUPPRIMER_PROJET($p) {
    $id_projet = interprete_argument_balise(1, $p); // Récupère l'ID du projet passé en argument
    $p->code = "calculer_bouton_supprimer_projet($id_projet)";
    $p->interdire_scripts = false;
    return $p;
}

?>


