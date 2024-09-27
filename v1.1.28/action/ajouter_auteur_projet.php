<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}

function action_ajouter_auteur_projet_dist() {
    include_spip('inc/session');
    $id_auteur = session_get('id_auteur');
    $id_projet = _request('id_projet'); // Assurez-vous que l'ID du projet est passé en paramètre

    if ($id_auteur && $id_projet) {
        // Vérifier si l'auteur n'est pas déjà associé au projet
        $deja_present = sql_getfetsel('id_auteur_projet', 'spip_auteur_projet', 'id_auteur='.intval($id_auteur).' AND id_projet='.intval($id_projet));

        if (!$deja_present) {
            // Ajouter l'auteur au projet
            $id_auteur_projet = sql_insertq('spip_auteur_projet', array(
                'id_auteur' => $id_auteur,
                'id_projet' => $id_projet,
                'date' => date('Y-m-d H:i:s'),
                'maj' => date('Y-m-d H:i:s')
            ));
            if ($id_auteur_projet) {
                spip_log("Auteur $id_auteur ajouté au projet $id_projet", 'auteur_projet');
                redirige_par_entete(parametre_url(self(), 'ajout', 'success'));
            } else {
                spip_log("Erreur lors de l'ajout de l'auteur $id_auteur au projet $id_projet", 'auteur_projet');
                redirige_par_entete(parametre_url(self(), 'ajout', 'failure'));
            }
        } else {
            spip_log("Auteur $id_auteur déjà associé au projet $id_projet", 'auteur_projet');
            redirige_par_entete(parametre_url(self(), 'ajout', 'already_present'));
        }
    } else {
        redirige_par_entete(parametre_url(self(), 'ajout', 'missing_data'));
    }
}

?>