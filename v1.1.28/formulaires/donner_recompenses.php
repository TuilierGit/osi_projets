<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

function formulaires_donner_recompenses_charger_dist($id_projet) {
    $valeurs = array(
        'id_projet' => intval($id_projet),
        'id_auteur' => '',
    );

    return $valeurs;
}

function formulaires_donner_recompenses_verifier_dist($id_projet) {
    $erreurs = array();

    if (!_request('id_auteur')) {
        $erreurs['id_auteur'] = _T('osi_projets:erreur_aucun_auteur_selectionne');
    }

    if (count($erreurs)) {
        $erreurs['message_erreur'] = _T('osi_projets:message_erreur_recompenses');
    }

    return $erreurs;
}

function formulaires_donner_recompenses_traiter_dist($id_projet) {
    $id_auteur = _request('id_auteur');

    if ($id_auteur) {
        include_spip('action/donner_recompenses');
        $message = action_donner_recompenses_dist($id_auteur, $id_projet);

        return array(
            'message_ok' => $message,
        );
    }

    return array(
        'message_erreur' => _T('osi_projets:message_erreur_recompenses'),
    );
}
