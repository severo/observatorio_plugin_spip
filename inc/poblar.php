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
include_spip('action/editer_article');
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
 * Crear una página única
 */
function crear_pagina($referencia, $nombre){
	$observatorio = lire_config('observatorio');
	if(!isset($observatorio['paginas'][$referencia]) OR
		($observatorio['paginas'][$referencia] != sql_getfetsel('id_article','spip_articles','id_article='.$observatorio['paginas'][$referencia]))){
		$observatorio['paginas'][$referencia] = article_inserer(-1);
		article_modifier($observatorio['paginas'][$referencia], array('page' => $referencia, 'titre' => $nombre));
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

/**
 * Crear las páginas únicas
 */
function poblar_paginas(){
	crear_pagina('colaborar', 'Como colaborar');
	crear_pagina('quienes', 'Quienes somos');
	crear_pagina('biblioteca', 'Biblioteca');
	crear_pagina('contacto', 'Contacto');
	crear_pagina('caricaturas', 'Caricaturas Neutrin');
	crear_pagina('imagen', 'Logotipo');
}
?>

