<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function action_supprimer_auteur_projet_dist() {
    $securiser_action = charger_fonction('securiser_action', 'inc');
    $arg = $securiser_action();
    list($id_projet, $id_auteur) = explode(',', $arg); // Extraire les arguments

    include_spip('action/tables/supprimer_dans_tables'); 
    supprimer_auteur_projet( $id_projet, $id_auteur);
    
    redirige_par_entete(generer_url_public('sommaire'));
    exit;
}
?>
