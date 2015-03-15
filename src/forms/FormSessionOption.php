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
 * Class FormSessionOption
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class FormSessionOption extends \FormSelectMenu
{
    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'form_session_option';

    /**
     * @param string $strKey
     * @return mixed|string
     */
    public function __get($strKey)
    {
        switch ($strKey)
        {

            case 'fieldname':
                return str_replace("[]", "", $this->name);

            default:
                return parent::__get($strKey);
        }
    }

    /**
     * @return string
     */
    public function generate()
    {
        if (!is_array($this->getOptionsValues()))
        {
            return sprintf('<input type="hidden" name="%s" value="%s"%s<div class="sessionformfield%s">%s</div>',
                $this->fieldname,
                specialchars($this->getOptionsValues()),
                $this->strTagEnding,
                $this->class == "" ? "" : " " . $this->class,
                $this->getFormatedOptions('<span>%s, </span>'));
        }
        else
        {
            $strBuffer = '';

            foreach ($this->getOptionsValues() as $k => $v)
            {
                $strBuffer .= sprintf('<input type="hidden" name="%s[%s]" value="%s"%s',
                    $this->fieldname,
                    $k,
                    specialchars($v),
                    $this->strTagEnding);
            }

            return $strBuffer . sprintf('<div class="sessionformfield%s">%s</div>',
                $this->class == "" ? "" : " " . $this->class,
                $this->getFormatedOptions('<span>%s, </span>'));
        }
    }

    /**
     * @param string $strFormat
     * @return string
     */
    public function getFormatedOptions($strFormat = '%s')
    {
        $strBuffer = '';
        foreach ($this->getOptionsLabels() as $v)
        {
            $strBuffer .= sprintf($strFormat, $v);
        }

        return $strBuffer;
    }

    /**
     * @return array
     */
    public function getOptionsLabels()
    {
        $arrOptions = array();
        $fieldname = $this->fieldname;
        foreach ($this->arrOptions as $option)
        {
            if (is_array($_SESSION['FORM_DATA'][$fieldname]) && in_array($option['value'], $_SESSION['FORM_DATA'][$fieldname]))
            {
                $arrOptions[] = $option['label'];
            }
            elseif (!is_array($_SESSION['FORM_DATA'][$fieldname]) && $_SESSION['FORM_DATA'][$fieldname] == $option['value'])
            {
                $arrOptions[] = $option['label'];
            }
        }

        return $arrOptions;
    }

    /**
     * Get options values from session
     * @return mixed
     */
    public function getOptionsValues()
    {
        return $_SESSION['FORM_DATA'][$this->fieldname];
    }

}

