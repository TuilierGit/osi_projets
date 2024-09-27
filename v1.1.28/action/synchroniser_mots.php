<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}

function action_synchroniser_mots() {
    $securiser_action = charger_fonction('securiser_action', 'inc');
    $arg = $securiser_action();
    list($id_projet, $sens) = explode(',', $arg); // Extraire les arguments

    include_spip('osi_projets_fonctions');
    $message = '';

    if ($sens == 1) {
        // Copier les mots-clés de la rubrique vers le projet
        $message = copier_mots_cle_rubrique_vers_projet($id_projet);
    } else {
        // Copier les mots-clés du projet vers la rubrique
        $message = copier_mots_cle_projet_vers_rubrique($id_projet);
    }

    // Rediriger avec un message
    // $redirect = _request('redirect') ? _request('redirect') : generer_url_ecrire('projets', 'id_projet=' . $id_projet);
    // $redirect = parametre_url($redirect, 'message', $message);
    // redirige_par_entete($redirect);

    $redirect = _request('redirect') ? _request('redirect') : generer_url_ecrire('projet', 'id_projet=' . $id_projet);
    $redirect = str_replace('&amp;', '&', $redirect);
    // $redirect .= '&sens=' . $sens; 
    // $redirect .= '&arg=' . $arg; 

    redirige_par_entete($redirect);

}
?>
