<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Src
	'Contao\SessionForm'           => 'system/modules/sessionform/src/classes/SessionForm.php',
	'Contao\FormSessionOption'     => 'system/modules/sessionform/src/forms/FormSessionOption.php',
	'Contao\FormSessionText'       => 'system/modules/sessionform/src/forms/FormSessionText.php',
	'Contao\FormSessionCalculator' => 'system/modules/sessionform/src/forms/FormSessionCalculator.php',
	'Contao\ModuleResetFormData'   => 'system/modules/sessionform/src/modules/ModuleResetFormData.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'form_session_option'     => 'system/modules/sessionform/templates',
	'form_session_calculator' => 'system/modules/sessionform/templates',
	'form_session_text'       => 'system/modules/sessionform/templates',
));
