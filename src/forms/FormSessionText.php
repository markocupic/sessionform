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
 * Class FormHidden
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class FormSessionText extends \Widget
{

    /**
     * Submit user input
     *
     * @var boolean
     */
    protected $blnSubmitInput = true;

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'form_session_text';
    /**
     * @param string $strKey
     * @return mixed|string
     */
    public function __get($strKey)
    {
        switch ($strKey)
        {

            case 'valueFromSession':
                return nl2br($_SESSION['FORM_DATA'][$this->name]);

            default:
                return parent::__get($strKey);
        }
    }

    /**
     * Generate the widget and return it as string
     *
     * @return string The widget markup
     */
    public function generate()
    {
        return sprintf('<input type="hidden" name="%s" value="%s"%s<div class="sessionformfield%s">%s</div>',
            $this->strName,
            specialchars($this->varValue),
            $this->strTagEnding,
            $this->class == "" ? "" : " " . $this->class,
            nl2br($_SESSION['FORM_DATA'][$this->strName]));
    }

}

