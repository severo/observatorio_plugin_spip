<?php
/**
 * Plugin observatorio
 * © 2014 severo (severo@rednegra.net)
 * Licencia LPG Bolivia (http://www.softwarelibre.gob.bo/licencia.php)
 * 
 * Crédito: kent1 (http://zone.spip.org/trac/spip-zone/browser/_squelettes_/mediaspip/mediaspip_init/)
 *
 * Archivo de instalación del plugin
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Instalación del plugin observatorio
 */
include_spip('inc/meta');
function observatorio_upgrade($nom_meta_base_version,$version_cible){

	$maj = array();
	include_spip('inc/inicializar');
	$maj['create'] = array(
		array('configurar_identidad'),
	);

	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

/**
 * Desinstalación del plugin
 */
function observatorio_vider_tables($nom_meta_version_base){
	effacer_meta($nom_meta_version_base);
}
?>
