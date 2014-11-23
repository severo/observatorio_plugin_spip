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
		article_instituer($observatorio['paginas'][$referencia], array('statut' => 'publie'));
	}
	ecrire_meta('observatorio',serialize($observatorio));
}

/**
 * Crear una entrada de menú
 */
function crear_entrada_menu($id_menu, $infos){
	$id_entrada = sql_getfetsel('id_menus_entree','spip_menus_entrees','type_entree="'.$infos['type_entree'].'" AND rang="'.$infos['rang'].'" AND id_menu='.$id_menu);
	if(!intval($id_entrada)){
		$id_entrada = insert_menus_entree($id_menu);
		menus_entree_set($id_entrada, $infos);
	}
}

/**
 * Crear la jerarquía de observatorio
 */
function poblar_secciones(){
	crear_seccion_raiz('areas', 'Áreas de trabajo');
	crear_seccion_raiz('accion', 'Acción política');
	crear_seccion_raiz('noticias', 'Noticias');
}

/**
 * Crear las páginas únicas
 */
function poblar_paginas(){
	crear_pagina('colaborar', 'Como colaborar');
	crear_pagina('quienes', 'Quiénes somos');
	crear_pagina('biblioteca', 'Biblioteca');
	crear_pagina('contacto', 'Contacto');
	crear_pagina('caricaturas', 'Caricaturas Neutrin');
	crear_pagina('imagen', 'Logotipo');
}

/**
 * Crear el menú
 */
function poblar_menus(){
	if(defined('_DIR_PLUGIN_MENUS')){
		include_spip('action/editer_menu');
		include_spip('action/editer_menus_entree');
		include_spip('inc/filtres');

		/* Creación del menú "barrenav" */
		$identifiant = 'barrenav';
		$id_barrenav = sql_getfetsel('id_menu','spip_menus','identifiant="'.$identifiant.'"');
		if (!intval($id_barrenav)) {
			$id_barrenav = insert_menu();
		}
		if (intval($id_barrenav)) {
			$infos_menu = array('id_menus_entree' => 0, 'titre' => 'Menú principal','identifiant' => $identifiant);
			$err = menu_set($id_barrenav, $infos_menu);
		}
		
		/* Creación de las entradas del menú barrenav */
		if (intval($id_barrenav)) {
			crear_entrada_menu($id_barrenav, array('rang' => 1, 'type_entree' => 'accueil', 'parametres' => array()));
			crear_entrada_menu($id_barrenav, array('rang' => 2, 'type_entree' => 'objet', 'parametres' => array('type_objet' => 'article', 'id_objet' => lire_config('observatorio/paginas/quienes'))));
			crear_entrada_menu($id_barrenav, array('rang' => 3, 'type_entree' => 'articles_rubrique', 'parametres' => array('id_rubrique' => lire_config('observatorio/secciones/areas'))));
			crear_entrada_menu($id_barrenav, array('rang' => 4, 'type_entree' => 'objet', 'parametres' => array('type_objet' => 'article', 'id_objet' => lire_config('observatorio/paginas/biblioteca'))));
			crear_entrada_menu($id_barrenav, array('rang' => 5, 'type_entree' => 'articles_rubrique', 'parametres' => array('id_rubrique' => lire_config('observatorio/secciones/accion'))));
			crear_entrada_menu($id_barrenav, array('rang' => 6, 'type_entree' => 'rubriques_completes', 'parametres' => array('id_rubrique' => lire_config('observatorio/secciones/noticias'), 'niveau' => 1, 'afficher_articles' => 'non')));
			crear_entrada_menu($id_barrenav, array('rang' => 7, 'type_entree' => 'objet', 'parametres' => array('type_objet' => 'article', 'id_objet' => lire_config('observatorio/paginas/contacto'))));
		}
	}
}
?>

