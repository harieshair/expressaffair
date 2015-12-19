<div class="home-left-sidebar">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".affair-quick-nav" 
                aria-expanded="false" aria-controls=".home-left-sidebar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>        
        </button>
        <a class="navbar-brand" href="#">Quick Links</a>
    </div>
    <div class="navbar-collapse collapse in affair-quick-nav" aria-expanded="true">
        <ul class="nav navbar-nav" id="navbar-quickinfo">
            <li class="active" id="quick-event"><a href="javascript:void()" class="btn-block btn-leftbar" 
                   onclick="listoutentity('events');changenavstatus('navbar-quickinfo', 'quick-event')">Events (<?php echo $entityCounts['events']; ?>)</a></li>
            <li id="quick-activity"><a href="javascript:void()" class="btn-block btn-leftbar" 
                   onclick="listoutentity('activities');changenavstatus('navbar-quickinfo', 'quick-activity')">Activities (<?php echo $entityCounts['activities']; ?>)</a></li>
            <li id="quick-service"><a href="javascript:void()" class="btn-block btn-leftbar" 
                   onclick="listoutentity('services');changenavstatus('navbar-quickinfo', 'quick-service')">Services (<?php echo $entityCounts['services']; ?>)</a></li>
            <li id="quick-package"><a href="javascript:void()" class="btn-block btn-leftbar" 
                   onclick="listoutentity('packages');changenavstatus('navbar-quickinfo', 'quick-package')">Packages (<?php echo $entityCounts['packages']; ?>)</a></li>        
            <li id="quick-partner"><a href="javascript:void()" class="btn-block btn-leftbar" 
                   onclick="listoutentity('partners');changenavstatus('navbar-quickinfo', 'quick-partner')">Partners (<?php echo $entityCounts['partners']; ?>)</a></li>
            <li id="quick-location"><a href="javascript:void()" class="btn-block btn-leftbar" 
                   onclick="listoutentity('locations');changenavstatus('navbar-quickinfo', 'quick-location')">Service Locations (<?php echo $entityCounts['locations']; ?>)</a></li>

        </ul>  
    </div>
</div>
