<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2009 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009-2010
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id$
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['sessionText']			= '{type_legend},type,name,label,doNotShowEmptyFields;{expert_legend:hide},value,class';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['sessionOption']		= '{type_legend},type,name,label,doNotShowEmptyFields;{options_legend},options;{fconfig_legend},multiple;{expert_legend:hide},class;{submit_legend},addSubmit';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['sessionCalculator']	= '{type_legend},type,name,label;{fconfig_legend},calculation,currency,currencyPosition;{expert_legend:hide},value,class';

foreach( $GLOBALS['TL_DCA']['tl_form_field']['palettes'] as $name => $palette )
{
	// Fields not to load session for
	$arrBlocked = array('__selector__', 'fancyupload', 'upload', 'submit', 'sessionText', 'sessionOption', 'sessionCalculator');
	if (in_array($name, $arrBlocked))
		continue;
	
	$palette = preg_replace('@([,|;]value)([,|;])@', '$1,loadSession$2', $palette, -1, $intCount);
	
	if ($intCount == 0)
	{
		$palette = preg_replace('@([,|;])(class[,|;])@', '$1loadSession,$2', $palette, -1, $intCount);
	}
	
	if ($intCount == 0)
	{
		$palette = preg_replace('@([,|;]{expert_legend(:hide)?})([,|;])@', '$1,loadSession$3', $palette, -1, $intCount);
	}
	
	if ($intCount == 0)
	{
		$palette .= ';{expert_legend:hide},loadSession';
	}
	 
	$GLOBALS['TL_DCA']['tl_form_field']['palettes'][$name] = $palette;
}


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_form_field']['fields']['loadSession'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_form_field']['loadSession'],
	'inputType'		=> 'checkbox',
	'exclude'		=> true,
    'sql'           => "char(1) NOT NULL default ''",
    'eval'			=> array('tl_class'=>'w50 m12'),
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['calculation'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_form_field']['calculation'],
	'inputType'		=> 'textarea',
	'exclude'		=> true,
    'sql'           => "text NULL",
	'eval'			=> array('tl_class'=>'long', 'style'=>'height: 80px'),
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['currency'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_form_field']['currency'],
	'inputType'		=> 'text',
	'exclude'		=> true,
    'sql'           => "varchar(10) NOT NULL default ''",
	'eval'			=> array('maxlength'=>10, 'tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['currencyPosition'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_form_field']['currencyPosition'],
	'inputType'		=> 'radio',
	'exclude'		=> true,
	'default'		=> 'right',
	'options'		=> array('left', 'right'),
	'reference'		=> &$GLOBALS['TL_LANG']['tl_form_field']['currencyPosition_ref'],
    'sql'           => "varchar(10) NOT NULL default ''",
	'eval'			=> array('tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['doNotShowEmptyFields'] = array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_form_field']['doNotShowEmptyFields'],
    'inputType'		=> 'checkbox',
    'exclude'		=> true,
    'sql'           => "char(1) NOT NULL default ''",
    'eval'			=> array('tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['value']['eval']['tl_class'] = 'w50';
$GLOBALS['TL_DCA']['tl_form_field']['fields']['class']['eval']['tl_class'] = 'w50 clr';

