<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function action_supprimer_projet_dist() {
    // Sécuriser l'action et récupérer l'ID du projet
    $securiser_action = charger_fonction('securiser_action', 'inc');
    $id_projet = $securiser_action();

    include_spip('action/tables/supprimer_dans_tables');

    $message = "";
    if (supprimer_un_projet($id_projet)) {
        $message .= _T("osi_projets:message_succes_suppression_projet");
    } else {
        $message .= _T("osi_projets:message_echec_suppression_projet");
    }

    // Afficher le message
    echo $message;

    // Redirection ou message de confirmation
    redirige_par_entete(generer_url_ecrire('editer_osi_projets', '', true));
    exit;
}
?>
