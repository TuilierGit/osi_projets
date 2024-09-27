<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}

function action_activer_role() {
    $securiser_action = charger_fonction('securiser_action', 'inc');
    $arg = $securiser_action();
    list($id_role, $ancien_etat) = explode(',', $arg); // Extraire les arguments

    if ($ancien_etat == 0) {
        sql_updateq('spip_osip_roles', array('etat' => 1), 'id_role=' . intval($id_role));
    }
    if ($ancien_etat == 1) {
        sql_updateq('spip_osip_roles', array('etat' => 0), 'id_role=' . intval($id_role));
    }
    

}
?>
