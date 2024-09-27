<?php
if (!defined("_ECRIRE_INC_VERSION")) {
	return;
} 

// Fonction pour calculer le nombre de projets
function calculer_nb_projets() {
    include_spip('base/abstract_sql');
    $nb_projets = sql_countsel('spip_projets');
    return $nb_projets;
}


// Déclaration de la balise
function balise_OSIP_DEBUG_NB_PROJETS_dist($p) {
    $p->code = "calculer_nb_projets()";
    $p->interdire_scripts = false;
    return $p;
}


?>