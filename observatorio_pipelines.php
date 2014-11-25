<?php
/**
 * Plugin observatorio
 * © 2014 severo (severo@rednegra.net)
 * Licencia LPG Bolivia (http://www.softwarelibre.gob.bo/licencia.php)
 * 
 * Crédito: kent1 (http://zone.spip.org/trac/spip-zone/browser/_squelettes_/mediaspip/mediaspip_init/)
 *
 * Definición de los pipelines utilizados por el plugin
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Creación de los campos extras en los artículos para las publicaciones
 * 
 * autor, edición, lugar, editorial, número de páginas
 */
function observatorio_declarer_champs_extras($champs = array()){
	include_spip('inc/config');
	if (intval($id_rubrique = lire_config('observatorio/secciones/biblioteca'))) {

		$champs['spip_articles']['autor'] = array(
			'saisie' => 'input',
			'options' => array(
				'nom' => 'autor',
				'label' => 'Autor(a)',
				'sql' => "varchar(255) NOT NULL DEFAULT ''",
				'rechercher' => true,
				'versionner' => true,
				'defaut' => '',
				'restrictions'=>array(
					'rubrique' => $id_rubrique
				),
			),
		);

		$champs['spip_articles']['edicion'] = array(
			'saisie' => 'input',
			'options' => array(
				'nom' => 'edicion',
				'label' => 'Edición',
				'sql' => "varchar(255) NOT NULL DEFAULT ''",
				'rechercher' => true,
				'versionner' => true,
				'defaut' => '',
				'restrictions'=>array(
					'rubrique' => $id_rubrique
				),
			),
		);

		$champs['spip_articles']['lugar'] = array(
			'saisie' => 'input',
			'options' => array(
				'nom' => 'lugar',
				'label' => 'Lugar',
				'sql' => "varchar(255) NOT NULL DEFAULT ''",
				'rechercher' => true,
				'versionner' => true,
				'defaut' => '',
				'restrictions'=>array(
					'rubrique' => $id_rubrique
				),
			),
		);

		$champs['spip_articles']['editorial'] = array(
			'saisie' => 'input',
			'options' => array(
				'nom' => 'editorial',
				'label' => 'Editorial',
				'sql' => "varchar(255) NOT NULL DEFAULT ''",
				'rechercher' => true,
				'versionner' => true,
				'defaut' => '',
				'restrictions'=>array(
					'rubrique' => $id_rubrique
				),
			),
		);

		$champs['spip_articles']['paginas'] = array(
			'saisie' => 'input',
			'options' => array(
				'nom' => 'paginas',
				'label' => 'Número de páginas',
				'sql' => "int(11) NOT NULL DEFAULT 0",
				'rechercher' => true,
				'versionner' => true,
				'defaut' => '',
				'restrictions'=>array(
					'rubrique' => $id_rubrique
				),
			),
		);
	}
	return $champs;
}

?>
