<?php
/**
 * Plugin observatorio
 * © 2014 severo (severo@rednegra.net)
 * Licencia LPG Bolivia (http://www.softwarelibre.gob.bo/licencia.php)
 *
 * Crédito: kent1 (http://zone.spip.org/trac/spip-zone/browser/_squelettes_/mediaspip/mediaspip_init/)
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/config');

/**
 * Inicializacion
 */
function configurar_identidad_dist(){
	ecrire_meta('slogan_site', _T('observatorio:identidad_titulo_sitio'));
	ecrire_meta('nom_site', _T('observatorio:identidad_eslogan_sitio'));
	ecrire_meta('descriptif_site', _T('observatorio:identidad_descripcion_sitio'));

}

?>
