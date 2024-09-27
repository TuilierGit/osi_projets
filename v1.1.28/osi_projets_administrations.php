<?php


/**
 * Fichier gérant l'installation et désinstallation du plugin Osi Projets
 *
 * @plugin     osi_projets
 * @copyright  2024
 * @author     Tuilier Thomas
 * @licence    GNU/GPL
 * @package    SPIP\osi_projets\Installation
 */


 if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Fonction d'installation et de mise à jour du plugin
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @param string $version_cible
 *     Version du schéma de données dans ce plugin (déclaré dans paquet.xml)
 * @return void
**/
function osi_projets_upgrade($nom_meta_base_version, $version_cible) {

	$maj = array();

	// On dit les tables sur lesquels on va agir
	$maj['create'] = array(
		array('maj_tables', array('spip_rubriques','spip_mots_liens','spip_projets', 'spip_auteur_projet', 'spip_osip_roles' , 'spip_osip_roles_liens')),
	);


    $maj['1.0.1'] = array(
		array('maj_tables', array('spip_rubriques','spip_mots_liens')),
    );


	$maj['1.1.1'] = array(
		array('maj_tables', array('spip_auteur_projet','spip_osip_roles','spip_osip_roles_liens')),
    );

	$maj['1.1.17'] = array(
		array('maj_tables', array('spip_auteur_projet')),
    );

	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}



/**
 * Fonction de désinstallation du plugin
 * Supprimer les modifications sur la base du plugin
 *
 * 
 * 
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @return void
**/
function osi_projets_vider_tables($nom_meta_base_version) {

	include_spip('base/abstract_sql');

	// Supprimer les tables du plugin 
	sql_drop_table('spip_projets');
	sql_drop_table('spip_auteur_projet');
	sql_drop_table('spip_osip_roles');
	sql_drop_table('spip_osip_roles_liens');
	


	// Supprimer les éléments des tables qui ne devraient plus exister 
	//TODO: Il faudrait aussi supprimer les objets comme les articles qui ont pour parent une rubrique de projet ?
	if (lire_config('osi_projets/desinstallation_rubriques') == '1'){
		//sql_delete('spip_rubriques', 'id_projet > 0'); 
	}
	

	// Suppression des mots clés
	$id_groupe = sql_getfetsel('id_groupe', 'spip_groupes_mots', 'titre="osi_projets"');
	sql_delete('spip_mots_liens', 'objet="projet"');
	sql_delete('spip_mots', 'id_groupe='. $id_groupe);
	
	sql_delete('spip_mots', 'titre LIKE "projet_%"');  // debug

	sql_delete('spip_groupes_mots', 'titre="osi_projets"');


	// Supprimer les colonnes qui ne devrait pas exister sans le plugin
	sql_alter('TABLE spip_rubriques DROP id_projet');
	sql_alter('TABLE spip_mots_liens DROP lien_projet');


	effacer_meta($nom_meta_base_version);
}

?>