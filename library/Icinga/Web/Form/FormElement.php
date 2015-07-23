<?php
/* Icinga Web 2 | (c) 2013-2015 Icinga Development Team | GPLv2+ */

namespace Icinga\Web\Form;

use Zend_Form_Element;
use Icinga\Exception\NotImplementedError;
use Icinga\Web\Form;
use Icinga\Web\Wizard;

/**
 * Base class for Icinga Web 2 form elements
 */
class FormElement extends Zend_Form_Element
{
    /**
     * Whether this is a guided form element
     *
     * @var bool
     */
    protected $_guided;

    /**
     * Whether loading default decorators is disabled
     *
     * Icinga Web 2 loads its own default element decorators. For loading Zend's default element decorators set this
     * property to false.
     *
     * @var null|bool
     */
    protected $_disableLoadDefaultDecorators;

    /**
     * Set whether this form element is guided
     *
     * @param   bool    $state
     *
     * @return  $this
     */
    public function setGuided($state = true)
    {
        $this->_guided = (bool) $state;
        return $this;
    }

    /**
     * Return whether this form element is guided
     *
     * @return  bool
     */
    public function isGuided()
    {
        if ($this->_guided === null) {
            return false;
        }

        return $this->_guided;
    }

    /**
     * Whether loading default decorators is disabled
     *
     * @return bool
     */
    public function loadDefaultDecoratorsIsDisabled()
    {
        return $this->_disableLoadDefaultDecorators === true;
    }

    /**
     * Load default decorators
     *
     * Icinga Web 2 loads its own default element decorators. For loading Zend's default element decorators set
     * FormElement::$_disableLoadDefaultDecorators to false.
     *
     * @return  this
     * @see     Form::$defaultElementDecorators For Icinga Web 2's default element decorators.
     */
    public function loadDefaultDecorators()
    {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }

        if (! isset($this->_disableLoadDefaultDecorators)) {
            $decorators = $this->getDecorators();
            if (empty($decorators)) {
                // Load Icinga Web 2's default element decorators
                $this->addDecorators(Form::$defaultElementDecorators);
            }
        } else {
            // Load Zend's default decorators
            parent::loadDefaultDecorators();
        }
        return $this;
    }

    /**
     * Return the guide for this form element
     *
     * This can be a entire wizard or just a single wizard page to guide the user through some preparation required
     * to display this element. Guided form elements MUST implement this in their concrete implementation.
     *
     * @return  Wizard|Form
     *
     * @throws  NotImplementedError
     */
    public function getGuide()
    {
        throw new NotImplementedError('You are required to implement this for guided form elements');
    }
}
