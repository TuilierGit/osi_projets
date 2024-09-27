<?php
if (!defined("_ECRIRE_INC_VERSION")) {
	return;
} 






// Fonction pour calculer le nombre de rubriques associés à des projets visibles sur le front
function calculer_nb_tous_pr_rubriques_publiques() {
    include_spip('base/abstract_sql');
    $nb_projets = sql_countsel('spip_rubriques', 'id_projet > 0 AND statut="publie"');
    return $nb_projets;
}



// Déclaration de la balise
function balise_OSIP_NB_TOUS_LES_PROJETS_dist($p) {
    $p->code = "calculer_nb_tous_pr_rubriques_publiques()";
    $p->interdire_scripts = false;
    return $p;
}


?>