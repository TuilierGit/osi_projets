<?php
if (!defined('_ECRIRE_INC_VERSION')) {
    return;
}






function balise_BOUTON_AJOUTER_AUTEUR_PROJET_dist($p) {
    // Récupérer les arguments passés à la balise
    $id_projet = interprete_argument_balise(1, $p);
    if (!$id_projet) {
        $id_projet = "''";
    }
    $p->code = "calculer_balise_dynamique('BOUTON_AJOUTER_AUTEUR_PROJET', array($id_projet))";
    $p->interdire_scripts = false;
    return $p;
}

function balise_BOUTON_AJOUTER_AUTEUR_PROJET_stat($args, $context_compil) {
    return $args;
}

function balise_BOUTON_AJOUTER_AUTEUR_PROJET_dyn($id_projet) {
    if (!$id_projet) {
        return '';
    }

    // Construire l'URL de l'action avec le paramètre id_projet
    $url_action = generer_url_action('ajouter_auteur_projet', "id_projet=$id_projet");

    // Créer le bouton
    $bouton = bouton_action(
        _T('osi_projets:ajouter_auteur_projet:libelle_bouton'),
        $url_action,
        'ajax',
        '',
        '',
        "return confirm('" . _T('osi_projets:ajouter_auteur_projet:message_confirmation') . "')"
    );

    return $bouton;
}
?>
