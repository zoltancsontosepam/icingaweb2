<?php
/* Icinga Web 2 | (c) 2013-2015 Icinga Development Team | GPLv2+ */

namespace Icinga\Web\Wizard;

use Icinga\Web\Request;
use Icinga\Web\Wizard;

/**
 * Interface for wizard pages
 */
interface Page
{
    /**
     * Setup this wizard page
     *
     * @param   Wizard      $wizard     This page's wizard
     * @param   Request     $request    The current request
     */
    public function setup(Wizard $wizard, Request $request);

    /**
     * Return whether this page is required to complete the wizard
     *
     * @param   Wizard      $wizard     This page's wizard
     *
     * @return  bool
     */
    public function isRequired(Wizard $wizard);

    /**
     * Add navigation buttons to this wizard page
     *
     * Return false if the default behaviour is desired.
     *
     * @param   Wizard      $wizard     This page's wizard
     *
     * @return  bool                    True if buttons were added, false if not
     */
    public function createNavigation(Wizard $wizard);
}
