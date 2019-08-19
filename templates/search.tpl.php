<form class="small" action="<?php echo $this->action; ?>.php" id="search">
    <input type="hidden" name="sort" id="filterSort" value="<?php echo $this->sort ? $this->sort : 'name' ?>" />
    <input type="hidden" name="dir" id="filterDir" value="<?php echo $this->dir ? $this->dir : 'asc' ?>" />
    <input type="hidden" name="groupby" id="filterGroupby" value="none" />
    <input type="hidden" name="tableTime" id="tableTime" value="<?php echo $this->tableTime; ?>" />
    <input type="hidden" name="graphTime" id="graphTime" value="<?php echo $this->graphTime; ?>" />
    <?php if (count($this->servers) > 1): ?>
        <div class="form-group">
        	<label for="filterServers">Servers: </label>
            <select class="form-control form-control-sm custom-select" multiple name="filterServers[]" id="filterServers">
                <?php foreach ($this->servers as $serverIndex => $server): ?>
                    <option value="<?php echo $serverIndex; ?>" <?php if (in_array($serverIndex, $this->filterServers)): ?>selected<?php endif?>><?php echo htmlspecialchars($server['name']); ?></option>
                <?php endforeach;?>
            </select>
        </div>
    <?php else: ?>
        <?php foreach ($this->servers as $serverIndex => $server): ?>
            <input type="hidden" name="flt_servers" value="<?php echo $serverIndex; ?>" />
        <?php endforeach;?>
    <?php endif;?>
    <div class="form-group">
    	<!-- <label for="filterServers">Name filter: </label> -->
    	<input class="form-control form-control-sm mr-sm-2" type="text" id="filterName" name="filterName" placeholder="Name filter..." aria-label="Name filter..." value="<?php echo $this->filterName ?>">
    	</div>
        <div class="form-group">
            <label for="staticEmail">Group By: </label>
            <div class="form-check"><?php $this->fnGroupRadio($this->pageUri, 'None', GA_ServerList::GROUP_NONE);?></div>
            <div class="form-check"><?php $this->fnGroupRadio($this->pageUri, 'Server', GA_ServerList::GROUP_SERVER);?></div>
            <div class="form-check"><?php $this->fnGroupRadio($this->pageUri, 'Function', GA_ServerList::GROUP_NAME);?></div>
        </div>
    <button class="btn btn-outline-success btn-block btn-sm my-2 my-sm-0" type="submit">Search</button>
</form>