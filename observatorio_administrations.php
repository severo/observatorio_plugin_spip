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
	include_spip('inc/configurar');
	include_spip('inc/poblar');
	include_spip('observatorio_pipelines');
	$maj['create'] = array(
		/* Configuración */
		array('configurar_identidad'),
		array('configurar_idioma'),
		array('configurar_multilinguismo'),
		array('configurar_contenido'),
		array('configurar_interactividad'),
		array('configurar_funciones_avanzadas'),
		array('configurar_foros'),
		array('configurar_revisiones'),
		array('configurar_urls'),
		array('configurar_lapices'),
		array('configurar_socialtags'),
		array('configurar_agenda'),
		array('configurar_minicalendario'),
		/* Creación de las secciones, artículos, páginas, menús */
		array('poblar_secciones'),
		array('poblar_articulos'),
		array('poblar_paginas'),
		array('poblar_menus'),
		array('poblar_mots'),
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
