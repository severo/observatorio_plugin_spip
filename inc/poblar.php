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
include_spip('action/editer_rubrique');

/**
 * Crear una sección raíz
 */
function crear_seccion_raiz($referencia, $nombre){
	$observatorio = lire_config('observatorio');
	if(!isset($observatorio['secciones'][$referencia]) OR
		($observatorio['secciones'][$referencia] != sql_getfetsel('id_rubrique','spip_rubriques','id_parent=0 AND id_rubrique='.$observatorio['secciones'][$referencia]))){
		$observatorio['secciones'][$referencia] = rubrique_inserer(0);
		rubrique_modifier($observatorio['secciones'][$referencia], array('titre' => $nombre));
	}
	ecrire_meta('observatorio',serialize($observatorio));
}

/**
 * Crear la jerarquía de observatorio
 */
function poblar_sessiones(){
	crear_seccion_raiz('areas', 'Áreas de trabajo');
	crear_seccion_raiz('accion', 'Acción política');
	crear_seccion_raiz('noticias', 'Noticias');
}
?>

