<?php
if (!defined('_ECRIRE_INC_VERSION')) return;

function action_publier_projet_dist() {
    // Sécuriser l'action
    $securiser_action = charger_fonction('securiser_action', 'inc');
    $arg = $securiser_action();

    // Récupérer les paramètres depuis l'URL
    list($id_rubrique, $option) = explode(':', $arg);    

    // Vérifier le statut actuel
    $test_rubrique = sql_getfetsel("statut", "spip_rubriques", "id_rubrique=" . intval($id_rubrique));
    $test_projet = sql_getfetsel("statut", "spip_projets", "id_rubrique=" . intval($id_rubrique));

    if ($test_rubrique != $option) {
        // Mise à jour du statut
        $res = sql_updateq('spip_rubriques', ['statut' => $option], 'id_rubrique=' . intval($id_rubrique));
        sql_updateq('spip_projets', ['statut' => $option], 'id_rubrique=' . intval($id_rubrique));


        // Vérifier si la mise à jour a réussi
        if ($res > 0) {
            include_spip('inc/headers');
            echo _T('osi_projets:message_succes_action');
        } else {
            include_spip('inc/headers');
            echo _T('osi_projets:message_erreur_action') . " (Statut inchangé)";
        }
    } else {
        include_spip('inc/headers');
        echo _T('osi_projets:message_erreur_action') . " (Statut inchangé)";
    }
}
