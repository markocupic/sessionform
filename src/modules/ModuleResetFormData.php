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
class ModuleResetFormData extends \Module
{

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'mod_message';


    /**
     * Reset session data
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### FORM DATA RESET ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=modules&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        $_SESSION['FORM_DATA'] = array();

        return '';
    }


    /**
     * Not used but parent class is abstract
     *
     * @access protected
     * @return void
     */
    protected function compile() {}
}

