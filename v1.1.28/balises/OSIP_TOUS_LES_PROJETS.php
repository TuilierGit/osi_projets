<?php
if (!defined("_ECRIRE_INC_VERSION")) {
	return;
}

/**
 * Define the OSIP_TOUS_LES_PROJETS balise.
 */
function balise_OSIP_TOUS_LES_PROJETS($p) {
    return calculer_balise_dynamique($p, 'OSIP_TOUS_LES_PROJETS', array());
}

/**
 * Handle the stat function for the balise.
 * 
 * @param array $args The arguments passed to the balise.
 * @param array $context_compil The compilation context.
 * @return array The arguments to pass to the dynamic function.
 */
function balise_OSIP_TOUS_LES_PROJETS_stat($args, $context_compil) {
    return $args; // No special handling needed for now.
}

/**
 * The dynamic function that generates the content for the balise.
 * 
 * @return string The rendered template content.
 */
function balise_OSIP_TOUS_LES_PROJETS_dyn() {
    return recuperer_fond('prive/objets/liste/pr_tous_les_projets');
}






?>