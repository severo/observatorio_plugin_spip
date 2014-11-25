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
include_spip('action/editer_groupe_mots');
include_spip('action/editer_mot');

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
 * Crear un artículo
 */
function crear_articulo($referencia, $nombre, $referencia_seccion){
	$id_rubrique = lire_config('observatorio/secciones/'.$referencia_seccion);
	$observatorio = lire_config('observatorio');
	if(!isset($observatorio['articulos'][$referencia]) OR
		($observatorio['articulos'][$referencia] != sql_getfetsel('id_article','spip_articles','id_article='.$observatorio['articulos'][$referencia]))){
		$observatorio['articulos'][$referencia] = article_inserer($id_rubrique);
		article_modifier($observatorio['articulos'][$referencia], array('titre' => $nombre));
		article_instituer($observatorio['articulos'][$referencia], array('statut' => 'publie'));
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
 * Crear un menú
 */
function crear_menu($identifiant, $titre, $id_menus_entree = 0){
	$id_menu = sql_getfetsel('id_menu','spip_menus','identifiant="'.$identifiant.'"');
	if (!intval($id_menu)) {
		$id_menu = sql_insertq(
			'spip_menus',
			array(
				'id_menus_entree' => $id_menus_entree
			)
		);
	}
	if (intval($id_menu)) {
		$infos_menu = array('id_menus_entree' => $id_menus_entree, 'titre' => $titre, 'identifiant' => $identifiant);
		menu_set($id_menu, $infos_menu);
	}
	return $id_menu;
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
	return $id_entrada;
}

/**
 * Crear un grupo de palabras clave
 */
function crear_groupe_mots($referencia, $infos){
	$observatorio = lire_config('observatorio');
	if(!isset($observatorio['groupes_mots'][$referencia]) OR
		($observatorio['groupes_mots'][$referencia] != sql_getfetsel('id_groupe','spip_groupes_mots','id_groupe='.$observatorio['groupes_mots'][$referencia]))){
		$observatorio['groupes_mots'][$referencia] = groupe_mots_inserer();
		groupe_mots_modifier($observatorio['groupes_mots'][$referencia], $infos);
	}
	ecrire_meta('observatorio',serialize($observatorio));
	return $observatorio['groupes_mots'][$referencia];
}

/**
 * Crear una palabra clave
 */
function crear_mot($referencia, $id_groupe, $infos){
	$observatorio = lire_config('observatorio');
	if((!isset($observatorio['mots'][$referencia]) OR
		($observatorio['mots'][$referencia] != sql_getfetsel('id_mot','spip_mots','id_mot='.$observatorio['mots'][$referencia]))) AND
		intval($id_groupe)) {
		$observatorio['mots'][$referencia] = mot_inserer($id_groupe);
		mot_modifier($observatorio['mots'][$referencia], $infos);
	}
	ecrire_meta('observatorio',serialize($observatorio));
	return $observatorio['mots'][$referencia];
}

/**
 * Crear la jerarquía de observatorio
 */
function poblar_secciones(){
	crear_seccion_raiz('areas', 'Áreas de trabajo');
	crear_seccion_raiz('accion', 'Acción política');
	crear_seccion_raiz('noticias', 'Noticias');
	crear_seccion_raiz('biblioteca', 'Biblioteca');
}

/**
 * Crear los artículos
 */
function poblar_articulos(){
	crear_articulo('area_investigacion', 'Área de investigación', 'areas');
	crear_articulo('area_incidencia', 'Área de incidencia', 'areas');
	crear_articulo('area_comunicación', 'Área de comunicación y difusión', 'areas');
	crear_articulo('area_juridica', 'Área jurídica', 'areas');
	crear_articulo('area_relaciones', 'Área de relaciones internacionales', 'areas');
	crear_articulo('accion_principios', 'Principios del observatorio', 'accion');
	crear_articulo('accion_agenda', 'Agenda de activismo', 'accion');
	crear_articulo('accion_foro', 'Foro interactivo', 'accion');
	crear_articulo('accion_denunciar', 'Como denunciar', 'accion');
}

/**
 * Crear las páginas únicas
 */
function poblar_paginas(){
	crear_pagina('colaborar', 'Como colaborar');
	crear_pagina('quienes', 'Quiénes somos');
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
		$id_menu_barrenav = crear_menu('barrenav', 'Menú principal');
		/* Creación de las entradas del menú barrenav */
		if (intval($id_menu_barrenav)) {
			crear_entrada_menu($id_menu_barrenav, array('rang' => 1, 'type_entree' => 'accueil', 'parametres' => array()));
			crear_entrada_menu($id_menu_barrenav, array('rang' => 2, 'type_entree' => 'objet', 'parametres' => array('type_objet' => 'article', 'id_objet' => lire_config('observatorio/paginas/quienes'))));
			$id_entrada_areas = crear_entrada_menu($id_menu_barrenav, array('rang' => 3, 'type_entree' => 'objet', 'parametres' => array('type_objet' => 'rubrique', 'id_objet' => lire_config('observatorio/secciones/areas'))));
			if (intval($id_entrada_areas)) {
				/* Submenu de Áreas */
				$id_menu_areas = crear_menu('barre_areas', 'Áreas de trabajo', $id_entrada_areas);
				if (intval($id_menu_areas)) {
					crear_entrada_menu($id_menu_areas, array('rang' => 1, 'type_entree' => 'articles_rubrique', 'parametres' => array('id_rubrique' => lire_config('observatorio/secciones/areas'))));
				}
			}
			crear_entrada_menu($id_menu_barrenav, array('rang' => 4, 'type_entree' => 'objet', 'parametres' => array('type_objet' => 'article', 'id_objet' => lire_config('observatorio/paginas/biblioteca'))));
			$id_entrada_accion = crear_entrada_menu($id_menu_barrenav, array('rang' => 5, 'type_entree' => 'objet', 'parametres' => array('type_objet' => 'rubrique', 'id_objet' => lire_config('observatorio/secciones/accion'))));
			if (intval($id_entrada_accion)) {
				/* Submenu de Acción */
				$id_menu_accion = crear_menu('barre_accion', 'Acción política', $id_entrada_accion);
				if (intval($id_menu_accion)) {
					crear_entrada_menu($id_menu_accion, array('rang' => 1, 'type_entree' => 'articles_rubrique', 'parametres' => array('id_rubrique' => lire_config('observatorio/secciones/accion'))));
				}
			}
			crear_entrada_menu($id_menu_barrenav, array('rang' => 6, 'type_entree' => 'rubriques_completes', 'parametres' => array('id_rubrique' => lire_config('observatorio/secciones/noticias'), 'niveau' => 1, 'afficher_articles' => 'non')));
			crear_entrada_menu($id_menu_barrenav, array('rang' => 7, 'type_entree' => 'objet', 'parametres' => array('type_objet' => 'article', 'id_objet' => lire_config('observatorio/paginas/contacto'))));
		}
	}
}


/**
 * Crear las palabras clave
 */
function poblar_mots(){
	$id_grupo_categorias = crear_groupe_mots('noticias_categorias', array('titre' => 'Categorías de noticias', 'descriptif' => 'Categorías de las noticias'));
	crear_mot('observatorio', $id_grupo_categorias, array('titre' => 'Del observatorio', 'descriptif' => 'Noticia redactada por el observatorio'));
	crear_mot('nacional', $id_grupo_categorias, array('titre' => 'Nacional', 'descriptif' => 'Noticia redactada por un periódico nacional'));
	crear_mot('internacional', $id_grupo_categorias, array('titre' => 'Internacional', 'descriptif' => 'Noticia redactada por un periódico internacional'));

	$id_grupo_periodicos = crear_groupe_mots('noticias_periodicos', array('titre' => 'Periodicos', 'descriptif' => 'Periódico en el cual se publicó una noticia', 'unseul' => 'oui'));
}

?>
