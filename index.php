<?php
/**
 * Index template. Page redirects user to root path in the actual web pag
 * 
 * @package kunta-api-redirect-theme
 * @since 1.0
 * @version 1.0
 */
global $kuntaApiRedirectSettings;
wp_redirect($kuntaApiRedirectSettings->getRootPath());
exit;
?>