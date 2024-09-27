<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function action_supprimer_role_dist() {
    // Sécuriser l'action et récupérer l'ID du projet
    $securiser_action = charger_fonction('securiser_action', 'inc');
    $id_role = $securiser_action();

    include_spip('action/tables/supprimer_dans_tables'); 
    supprimer_un_role( $id_role);

    // Redirection vers la page de configuration avec les variables SPIP
    $redirect_url = generer_url_ecrire('configurer_osi_projets', 'onglet=personnalisation');
    $redirect_url = str_replace('amp;', '&', $redirect_url);
    redirige_par_entete($redirect_url);
}
?>
