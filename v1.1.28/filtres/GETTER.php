<?php
if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('filtres/getter_aux');


// Configuration


function filtre_get_configuration($nom_configuration){
    $valeur = lire_config($nom_configuration);
    return $valeur;
}



/**
 * Renvoie la valeur de lien_projet de la table SQL spip_mots_liens
 *
 * @param string $table Nom de la table SQL
 * @param string $nom_info Nom de la colonne à récupérer
 * @return string La valeur de la colonne demandée
 */
function filtre_get_lien_projet($id_mot, $id_objet, $nom_objet, $nom_colonne = "lien_projet") {
    return sql_getfetsel($nom_colonne, "spip_mots_liens", "id_mot=" .$id_mot . " AND id_objet=" . $id_objet . " AND objet='" .  $nom_objet . "'");
}





/**
 * Renvoie la valeur d'une colonne d'une table SQL
 *
 * @example [(#VAL{'spip_osip_roles'}|get_info_table{'titre','id_role',#ENV{id_role}})]
 * 
 * @param string $table Nom de la table SQL
 * @param string $nom_info Nom de la colonne à récupérer
 * @return string La valeur de la colonne demandée
 */
function filtre_get_info_table($table, $nom_info, $nom_id = "", $valeur_id = "") {
    if ($nom_id == "") {
        return sql_getfetsel($nom_info, $table);
    }
    return sql_getfetsel($nom_info, $table, $nom_id . "=" .$valeur_id );
}





/**
 * Renvoie la valeur d'une colonne d'une table SQL
 * 
 * @param string $table Nom de la table SQL
 * @param string $nom_info Nom de la colonne à récupérer
 * @return string La valeur de la colonne demandée
 */
function filtre_get_info_auteur_projet($nom_info, $id_auteur, $id_projet) {
    $val = sql_getfetsel($nom_info, 'spip_auteur_projet', "id_auteur=" . $id_auteur . " AND id_projet=" . $id_projet);
    if ($val == null || $val == '' || $val == ' '){
        return null;
    }
    else {
        return $val;
    }

}




/**
 * Renvoie la valeur d'une colonne de la table spip_osip_roles_liens
 *
 * @param int $id_projet 
 * @param int $role 
 * @param string $nom_info Nom de la colonne à récupérer
 * 
 * @return string La valeur de la colonne demandée
 */
function filtre_get_info_role( $id_role, $id_projet , $id_auteur, $colonne) {
    $id_auteur_projet = sql_getfetsel('id_auteur_projet', 'spip_auteur_projet', "id_auteur=" .$id_auteur . " AND id_projet=" . $id_projet);

    if ($id_auteur_projet){
        $res = sql_getfetsel($colonne, 'spip_osip_roles_liens', "id_role=" .$id_role . " AND id_auteur_projet=" . $id_auteur_projet);
        if ($res){
            return $res;
        }
    } 
    return 0;
}









?>