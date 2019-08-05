<table class="table table-sm table-striped table-bordered small" id="table">
    <thead class="thead-default">
        <tr>
            <th><?php $this->fnSortCol($this->pageUri, 'Server', GA_ServerList::SORT_SERVER);?></th>
            <th><?php $this->fnSortCol($this->pageUri, 'Function', GA_ServerList::SORT_NAME);?></th>
            <th><?php $this->fnSortCol($this->pageUri, 'Jobs in queue', GA_ServerList::SORT_JOBS_IN_QUEUE);?></th>
            <th><?php $this->fnSortCol($this->pageUri, 'Jobs running', GA_ServerList::SORT_JOBS_RUNNING);?></th>
            <th><?php $this->fnSortCol($this->pageUri, 'Workers registered', GA_ServerList::SORT_WORKERS);?></th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
