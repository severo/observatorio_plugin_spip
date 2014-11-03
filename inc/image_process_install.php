<?php
/**
 * Plugin observatorio
 * © 2014 severo (severo@rednegra.net)
 * Licencia LPG Bolivia (http://www.softwarelibre.gob.bo/licencia.php)
 *
 * Crédito: kent1 (http://zone.spip.org/trac/spip-zone/browser/_squelettes_/mediaspip/mediaspip_init/)
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Gestión de la configuración del procesamiento de imágenes
 * Activamos GD2 si es posible
 */
function inc_image_process_install_dist(){

	include_spip('inc/distant');

	/**
	 * Probamos los formatos y llenamos las métas
	 */
	if (
		function_exists('ImageGif')
		OR function_exists('ImageJpeg')
		OR function_exists('ImagePng')){
		$url_gd1 = recuperer_page(generer_url_action("tester", "arg=gd1&time=".time(),true));
		if (function_exists("ImageCreateTrueColor"))
			$url_gd2 = recuperer_page(generer_url_action("tester", "arg=gd2&time=".time(),true));
	}

	if (_PNMSCALE_COMMAND!='')
		$url_netpbm = recuperer_page(generer_url_action("tester", "arg=netpbm&time=".time(),true));

	if (function_exists('imagick_readimage'))
		$url_imagick = recuperer_page(generer_url_action("tester", "arg=imagick&time=".time(),true));

	if (_CONVERT_COMMAND!='')
		$url_convert = recuperer_page(generer_url_action("tester", "arg=convert&time=".time(),true));

	/**
	 * Activación de gd2 et de las miniaturas de documentos
	 */
	if (function_exists("ImageCreateTrueColor")) {
		ecrire_meta("image_process", "gd2");
		ecrire_meta('formats_graphiques','gif,jpg,png','non');
		ecrire_meta("creer_preview", "oui");
		ecrire_meta("taille_preview", "300");
		$url = generer_url_action("tester_taille", "arg=3000&time=".time(),true);
		$tester_taille = recuperer_page($url);
	}
}

?>
