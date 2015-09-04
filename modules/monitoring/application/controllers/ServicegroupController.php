<?php
/* Icinga Web 2 | (c) 2013-2015 Icinga Development Team | GPLv2+ */

use Icinga\Module\Monitoring\Controller;

class Monitoring_ServicegroupController extends Controller
{
    public function gridAction()
    {
        $this->addTitleTab(
            'servicegroupgrid',
            $this->translate('Servicegroup Grid'),
            $this->translate('List all service groups')
        );
        $this->setAutorefreshInterval(12);

        $query = $this->backend->select()->from('servicegroupsummary', array(
            'servicegroup_alias',
            'servicegroup_name',
            'services_ok',
            'services_critical_handled',
            'services_critical_unhandled',
            'services_pending',
            'services_unknown_handled',
            'services_unknown_unhandled',
            'services_warning_handled',
            'services_warning_unhandled'
        ));
        $this->setupFilterControl($query);
        $this->handleFormatRequest($query);
        $this->view->servicegroups = $query;

        $this->setupLimitControl();
        $this->setupPaginationControl($this->view->servicegroups, 100);
        $this->setupSortControl(array(
            'servicegroup_alias'   => $this->translate('Servicegroup Name')
        ), $query);
    }
}
