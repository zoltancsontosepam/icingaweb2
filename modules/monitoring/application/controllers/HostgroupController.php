<?php
/* Icinga Web 2 | (c) 2013-2015 Icinga Development Team | GPLv2+ */

use Icinga\Module\Monitoring\Controller;

class Monitoring_HostgroupController extends Controller
{
    public function gridAction()
    {
        $this->addTitleTab(
            'hostgroupgrid',
            $this->translate('Hostgroup Grid'),
            $this->translate('List all host groups')
        );
        $this->setAutorefreshInterval(12);

        $query = $this->backend->select()->from('hostgroupsummary', array(
            'hostgroup_alias',
            'hostgroup_name',
            'hosts_down_handled',
            'hosts_down_unhandled',
            'hosts_pending',
            'hosts_unreachable_handled',
            'hosts_unreachable_unhandled',
            'hosts_up'
        ));
        $this->setupFilterControl($query);
        $this->handleFormatRequest($query);
        $this->view->hostgroups = $query;

        $this->setupLimitControl();
        $this->setupPaginationControl($this->view->hostgroups, 100);
        $this->setupSortControl(array(
            'hostgroup_alias'   => $this->translate('Hostgroup Name')
        ), $query);
    }
}
