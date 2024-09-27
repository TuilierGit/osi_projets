<?php
if (!defined("_ECRIRE_INC_VERSION")) {
	return;
} 


// Fonction pour calculer le nombre de projets
function calculer_nb_pr_rubriques() {
    include_spip('base/abstract_sql');
    $nb_projets = sql_countsel('spip_rubriques', 'id_projet>0');
    return $nb_projets;
}


// Déclaration de la balise
function balise_OSIP_DEBUG_NB_RUBRIQUES_dist($p) {
    $p->code = "calculer_nb_pr_rubriques()";
    $p->interdire_scripts = false;
    return $p;
}



?>