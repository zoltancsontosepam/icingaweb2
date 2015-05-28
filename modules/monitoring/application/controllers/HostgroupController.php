<?php
/* Icinga Web 2 | (c) 2013-2015 Icinga Development Team | GPLv2+ */

use Icinga\Module\Monitoring\Controller;

class Monitoring_HostgroupController extends Controller
{
    public function gridAction()
    {
        $this->addTitleTab(
            'hostgroupgrid',
            $this->translate('Host Group Grid'),
            $this->translate('List host groups\' states as grid')
        );
        $this->setAutorefreshInterval(12);

        $query = $this->backend->select()->from('hostgroupsummary', array(
            'hostgroup_alias',
            'hostgroup_name',
            'hosts_down_handled',
            'hosts_down_unhandled',
            'hosts_pending',
            'hosts_total',
            'hosts_unreachable_handled',
            'hosts_unreachable_unhandled',
            'hosts_up'
        ));
        $this->filterQuery($query);
        $this->view->hostgroups = $query;

        $this->setupLimitControl();
        $this->setupPaginationControl($this->view->hostgroups);
        $this->setupSortControl(array(
            'hosts_severity'    => $this->translate('Severity'),
            'hostgroup_alias'   => $this->translate('Host Group Name'),
            'hosts_total'       => $this->translate('Total Hosts')
        ), $query);
    }
}
