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
class FormSessionCalculator extends \Widget
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
    protected $strTemplate = 'form_session_calculator';

    /**
     * @param string $strKey
     * @return mixed|string
     */
    public function __get($strKey)
    {
        switch ($strKey)
        {

            case 'amount':

                if ($this->varValue){
                    return $this->varValue;
                }
                else
                {
                    $fields = preg_split('/{([^}]+)}/', $this->calculation, -1, PREG_SPLIT_DELIM_CAPTURE);

                    $strFormula = '';

                    for($_rit=0; $_rit<count($fields); $_rit=$_rit+2)
                    {
                        $strFormula .= $fields[$_rit];
                        $strField = $fields[$_rit+1];

                        // Skip empty tags
                        if (!strlen($strField))
                        {
                            continue;
                        }

                        $strFormula .= (float)$_SESSION['FORM_DATA'][$strField];
                    }
                    $this->varValue = eval('return ('.$strFormula.');');
                    return  $this->varValue;
                }

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
        $amount =  $this->currencyPosition == 'right' ? $this->amount . ' ' . $this->currency : $this->currency . ' ' .  $this->amount;
        return sprintf('<input type="hidden" name="%s" value="%s"%s<div class="sessionformfield%s"><span>%s</span></div>',
            $this->strName,
            specialchars($this->varValue),
            $this->strTagEnding,
            $this->class == "" ? "" : " " . $this->class,
            $amount);
    }

}

