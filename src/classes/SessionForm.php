<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao;


/**
 * Class SessionForm
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class SessionForm extends \Frontend
{
    /**
     * Load input values from post
     * @param Widget $objWidget
     * @param $intForm
     * @return Widget
     */
	public function loadFormData(Widget $objWidget, $intForm)
	{
		$varValue = $this->Input->post($objWidget->name);
		if ($objWidget->loadSession && !empty($varValue))
		{
			$objWidget->value = $varValue;
		}
		
		return $objWidget;
	}

    /**
     * @param $arrPost
     * @param $arrForm
     * @param $arrFiles
     */
	public function storeFiles(&$arrPost, $arrForm, $arrFiles)
	{
		if (is_array($arrFiles) && count($arrFiles))
		{
			foreach ($arrFiles as $fieldName => $file)
			{
				// Store only the file, which has been saved in Contao folder
				if ($file['uploaded'] && strpos($file['tmp_name'], $GLOBALS['TL_CONFIG']['uploadPath']) !== false)
				{
					$arrPost[$fieldName] = $this->Environment->base . str_replace(TL_ROOT . '/', '', $file['tmp_name']);
				}
			}
		}
	}
}

