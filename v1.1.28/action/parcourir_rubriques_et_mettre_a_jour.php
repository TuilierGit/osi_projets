<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}



function action_parcourir_rubriques_et_mettre_a_jour() {
    spip_log("Appel de l'action parcourir_rubriques_et_mettre_a_jour", 'osi_projets');
    
    include_spip('osi_projets_fonctions');
    parcourir_rubriques_et_mettre_a_jour();

    // Redirection ou message de confirmation
    spip_log("Redirection après traitement", 'osi_projets');
    #redirige_par_entete(generer_url_ecrire('rubriques', '', true));
}

?>