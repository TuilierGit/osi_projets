<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function calculer_bouton_supprimer_role($id_role) {
    include_spip('inc/filtres');

    $label = _T('osi_projets:supprimer_role');
    $url_action = generer_action_auteur('supprimer_role', $id_role, self());
    $class = 'btn btn-danger';
    $confirm = _T('osi_projets:message_suppression_role');
    $title = _T('osi_projets:supprimer_role');
    $fond = '';

    return bouton_action($label, $url_action, $class, $confirm, $title, $fond);
}

// Déclaration de la balise
function balise_supprimer_role($p) {
    $id_role = interprete_argument_balise(1, $p); 
    $p->code = "calculer_bouton_supprimer_role($id_role)";
    $p->interdire_scripts = false;
    return $p;
}

?>


