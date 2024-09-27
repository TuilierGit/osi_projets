<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function calculer_bouton_activer_role($id_role, $ancien_etat) {
    include_spip('inc/filtres');

    if ($ancien_etat == 0){
        $message = _T('osi_projets:choix_role_actif'); 
    }
    if ($ancien_etat == 1){
        $message = _T('osi_projets:choix_role_inactif');
    }

    $label = $message ;
    $url_action = generer_action_auteur('activer_role', "$id_role,$ancien_etat", self());
    $class = 'btn btn-danger';
    $confirm = $message;
    $title = $message;
    $fond = '';

    return bouton_action($label, $url_action, $class, $confirm, $title, $fond);
}

// Déclaration de la balise
function balise_ACTIVER_ROLE($p) {
    $id_projet = interprete_argument_balise(1, $p);
    $ancien_etat = interprete_argument_balise(2, $p); 
    $p->code = "calculer_bouton_activer_role($id_projet, $ancien_etat)";
    $p->interdire_scripts = false;
    return $p;
}

?>


