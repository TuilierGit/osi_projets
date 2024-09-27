<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function action_recursivite_projet_dist() {
    $securiser_action = charger_fonction('securiser_action', 'inc');
    $sens = $securiser_action();

    include_spip('osi_projets_fonctions'); // Inclure les fonctions du plugin

    $message = "";
    if (recursivite_projet($sens) == true) {
        $message .= _T("osi_projets:message_succes_action");
    } else {
        $message .= _T("osi_projets:message_erreur_action");
    }

    // Afficher le message
    echo $message;

    // Redirection ou message de confirmation
    redirige_par_entete(generer_url_ecrire('editer_osi_projets', '', true));
    exit;
}
?>
