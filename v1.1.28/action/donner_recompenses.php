<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

function action_donner_recompenses_dist($id_auteur, $id_projet) {
    // Sécurité : s'assurer que les IDs sont bien des entiers
    $id_auteur = intval($id_auteur);
    $id_projet = intval($id_projet);

    // Vérifier que l'auteur existe
    $auteur_existe = sql_countsel('spip_auteurs', 'id_auteur=' . $id_auteur);
    if (!$auteur_existe) {
        return _T('osi_projets:erreur_auteur_inexistant');
    }

    // Récupérer les mots-clés associés au projet avec lien_projet = 3
    $mots = sql_allfetsel(
        'id_mot', 
        'spip_mots_liens', 
        'objet="projet" AND id_objet=' . $id_projet . ' AND lien_projet=3'
    );

    // Associer ces mots-clés à l'auteur
    foreach ($mots as $mot) {
        // Vérifier si l'association n'existe pas déjà
        $deja_associe = sql_countsel(
            'spip_mots_liens',
            'id_mot=' . intval($mot['id_mot']) . ' AND objet="auteur" AND id_objet=' . $id_auteur
        );

        if (!$deja_associe) {
            // Associer le mot-clé à l'auteur
            sql_insertq('spip_mots_liens', array(
                'id_mot' => intval($mot['id_mot']),
                'objet' => "auteur",
                'id_objet' => $id_auteur,
            ));
        }
    }  

    return _T('osi_projets:message_succes_associer_mots');
}