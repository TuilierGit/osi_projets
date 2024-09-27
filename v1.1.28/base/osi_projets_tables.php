<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     osi_projets
 * @copyright  2024
 * @author     Tuilier Thomas
 * @licence    GNU/GPL
 * @package    SPIP\osi_projets\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}



/**
 * Déclaration des alias de tables et filtres automatiques de champs.
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
 */
function osi_projets_declarer_tables_interfaces($interfaces) {

    $interfaces['table_des_tables']['projets'] = 'projets';
    $interfaces['table_des_tables']['osip_roles'] = 'osip_roles';

    // Jointures existantes
    $interfaces['tables_jointures']['spip_projets'][] = 'rubriques';
    $interfaces['tables_jointures']['spip_rubriques'][] = 'projets';

    // Jointure pour mots-clés
    $interfaces['tables_jointures']['spip_osip_roles'][] = 'mots_liens';
    $interfaces['tables_jointures']['spip_mots'][] = 'osip_roles';

    // Exceptions
    $interfaces['exceptions_des_tables']['projets']['id_secteur'] = 'id_rubrique';

    return $interfaces;
}




/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function osi_projets_declarer_tables_objets_sql($tables) {

	// Déclarer la table spip_projets

	$tables['spip_projets'] = array(
		'type' => 'projet',
		'principale' => 'oui',
		'texte_objets' => 'osi_projets:projets',
		'texte_objet' => 'osi_projets:projet',
		'field'=> array(
			'id_projet'          => 'bigint(21) NOT NULL AUTO_INCREMENT',
			'id_rubrique'        => 'bigint(21) NOT NULL',
			'titre'              => "text NOT NULL DEFAULT ''",
			'descriptif'         => "text NOT NULL DEFAULT ''",
			'texte'              => "longtext NOT NULL DEFAULT ''",
			'statut'             => 'varchar(20) NOT NULL DEFAULT "0"',
			'niveau'			 => 'varchar(20) NOT NULL DEFAULT "0"',
			'taille'             => 'varchar(20) NOT NULL DEFAULT "0"',
			'date_debut'         => 'TIMESTAMP',
			'date_fin'			 => 'TIMESTAMP',
			'date'			     => 'TIMESTAMP',
			'maj'                => 'TIMESTAMP',
			'liste-roles'         => "text NOT NULL DEFAULT ''",
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_projet',
			'KEY id_rubrique'    => 'id_rubrique',
		),
		'join'   => array("id_projet"=>"id_projet","id_rubrique"=>"id_rubrique"),

		'champs_editables' => array('titre', 'descriptif', 'texte', 'niveau', 'statut', 'taille'),
    	'champs_versionnes' => array('titre', 'descriptif', 'texte','niveau', 'statut', 'taille'),
    	'rechercher_champs' => array('niveau' => 9  ,'statut' => 8, 'taille' => 5, 'titre'=> 4, 'descriptif'=> 2, 'texte'=> 1),

		'statut_textes_instituer' => array(
			'prepa' => 'texte_statut_en_cours_redaction',
			'prop' => 'texte_statut_propose_evaluation',
			'publie' => 'texte_statut_publie',
			'refuse' => 'texte_statut_refuse',
			'poubelle' => 'texte_statut_poubelle',
		),

		'statut' => array(
			array(
				'champ' => 'statut',
				'publie' => 'publie',
				'previsu' => 'publie,prop,prepa',
				'post_date' => 'date',
				'exception' => array('statut', 'tout')
			)
		),

		'niveau_textes_instituer' => array(
			'0'   => 'osi_projets:info_statut_aucun',
			'1'   => 'osi_projets:info_statut_valide',
			'2'   => 'osi_projets:info_statut_actif',
		),

		'taille_textes_instituer' => array(
			'0'   => 'osi_projets:info_taille_petit',
			'1'   => 'osi_projets:info_taille_moyen',
			'2'   => 'osi_projets:info_taille_grand',
    	),

		'texte_changer_statut' => 'osi_projets:info_statut',
		'texte_changer_taille' => 'osi_projets:info_taille',
	);



	$tables['spip_osip_roles'] = array(
        'type' => 'osip_role',
        'table_objet' => 'osip_role', 
		'texte_objets' => 'osi_projets:roles',
		'texte_objet' => 'osi_projets:role',
        'principale' => 'oui',
        'field'=> array(
            'id_role'            => 'bigint(21) NOT NULL AUTO_INCREMENT',
            'statut'             => 'varchar(20) NOT NULL DEFAULT "0"',
            'etat'               => 'varchar(20) NOT NULL DEFAULT "0"',
            'titre'              => "text NOT NULL DEFAULT ''",
            'descriptif'         => "text NOT NULL DEFAULT ''",
            'question'           => "text NOT NULL DEFAULT ''",
            'texte'              => "longtext NOT NULL DEFAULT ''",
        ),
        'key' => array(
            'PRIMARY KEY'        => 'id_role',
        ),
        'join' => array("id_role"=>"id_role"),

        'champs_editables' => array('statut', 'etat', 'titre', 'descriptif', 'question', 'texte'),
        'champs_versionnes' => array('statut', 'etat', 'titre', 'descriptif', 'question', 'texte'),
        'rechercher_champs' => array('etat' => 10, 'statut'=> 8, 'titre' => 6, 'descriptif' => 3, 'question' => 2, 'texte' => 1),

        'tables_jointures' => array(
            'mots' => 'spip_mots_liens',
        ),
    );


	
	$tables['spip_rubriques']['field']['id_projet'] = "bigint(21) NOT NULL DEFAULT '0'";
	return $tables;
}


/**
 * Déclaration des tables auxiliaires (tables qui ne sont pas des objets)
 *
 * @pipeline declarer_tables_auxiliaires
 * @param array $tables_auxiliaires
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function osi_projets_declarer_tables_auxiliaires($tables_auxiliaires) {

	// Déclarer la table spip_auteur_projet
	$tables_auxiliaires['spip_auteur_projet'] = array(
		'type' => 'auteur_projet',
		'principale' => 'oui',
		'field'=> array(
			'id_auteur_projet'   => 'bigint(21) NOT NULL AUTO_INCREMENT',
			'id_auteur'          => 'bigint(21) NOT NULL',
			'id_projet'          => 'bigint(21) NOT NULL',
			'etat'				 => 'varchar(20) NOT NULL DEFAULT "0"',
			'texte'              => "longtext NOT NULL DEFAULT ''",
			'date'               => 'TIMESTAMP',
			'maj'                => 'TIMESTAMP',
			'debug_demande'		 => 'varchar(20) NOT NULL DEFAULT "0"'

		),
		'key' => array(
			'PRIMARY KEY'        => 'id_auteur_projet',
			'KEY id_auteur'      => 'id_auteur',
			'KEY id_projet'      => 'id_projet',
		),
		'join'   => array("id_auteur"=>"id_auteur","id_projet"=>"id_projet"),

		'champs_editables' => array('etat','texte','debug_demande' ),
    	'champs_versionnes' => array('etat','texte','debug_demande'),
    	'rechercher_champs' => array('etat' => 10 , 'texte'=> 2, 'debug_demande'=> 1),

	);


	// Déclarer la table spip_osip_roles_liens
	$tables_auxiliaires['spip_osip_roles_liens'] = array(
		'type' => 'osip_roles_liens',
		'principale' => 'oui',
		'field'=> array(
			'id_role_lien'      => 'bigint(21) NOT NULL AUTO_INCREMENT',
			'id_role'            => 'bigint(21) NOT NULL',
			'id_auteur_projet'   => 'bigint(21) NOT NULL',
			'valeur'             => 'varchar(20) NOT NULL DEFAULT "0"',
			'demande'            => 'varchar(20) NOT NULL DEFAULT "0"',
		),
		'key' => array(
			'PRIMARY KEY'          => 'id_role_lien',
			'KEY id_role'          => 'id_role',
			'KEY id_auteur_projet' => 'id_auteur_projet',
		),
		'join'   => array("id_role"=>"id_role","id_auteur_projet"=>"id_auteur_projet"),

		'champs_editables' => array('valeur', 'demande'),
    	'champs_versionnes' => array('valeur', 'demande'),
    	'rechercher_champs' => array('valeur' => 6 ,'demande' => 4),
	);


	// Modification de la table spip_mots_liens
	$tables_auxiliaires['spip_mots_liens']['field']['lien_projet'] = "bigint(21) NOT NULL DEFAULT '0'";
	$tables_auxiliaires['spip_mots_liens']['field']['niveau_projet'] = "bigint(21) NOT NULL DEFAULT '0'";

	return $tables_auxiliaires;
}





?>
