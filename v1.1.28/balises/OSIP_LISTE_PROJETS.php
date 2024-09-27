<?php
if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Renvoie la liste des projets d'un auteur
 * 
 * @param int $id_auteur
 *      L'identifiant de l'auteur.
 *
 * @return array
 */
function balise_OSIP_LISTE_PROJETS($p) {
    return calculer_balise_dynamique($p, 'OSIP_LISTE_PROJETS', array('id_auteur'));
}



function balise_OSIP_LISTE_PROJETS_stat($args, $context_compil) {
    
    $id_auteur = isset($args[0]) ? $args[0] : '';
    return array($id_auteur);
}



function balise_OSIP_LISTE_PROJETS_dyn($id_auteur) {

    if (!$id_auteur) {
        include_spip('inc/session');
        $id_auteur = session_get('id_auteur');
    }

    if (empty($id_auteur)) {
        return "<p>Aucun auteur spécifié.</p>";
    }

    $contexte = array(
        'id_auteur' => $id_auteur,
        'nb' => 30,
        'titre' => _T('osi_projets:titre_tous_les_projets'),
        'sinon' => _T('osi_projets:aucun_projet'),
    );

    return recuperer_fond('prive/objets/liste/pr_projets', $contexte );
}
?>