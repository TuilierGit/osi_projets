<?php
if (!defined("_ECRIRE_INC_VERSION")) {
	return;
}


function balise_OSIP_SOUS_PROJETS($p) {
    return calculer_balise_dynamique($p, 'OSIP_SOUS_PROJETS', array('id_rubrique'));
}

function balise_OSIP_SOUS_PROJETS_stat($args, $context_compil) {
    $id_rubrique = isset($args[0]) ? $args[0] : '';
    return array($id_rubrique);
}


function balise_OSIP_SOUS_PROJETS_dyn($id_rubrique) {
    return recuperer_fond('prive/objets/liste/pr_sous_projets', array('id_rubrique' => $id_rubrique));
}

?>
