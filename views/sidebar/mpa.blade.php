<div data-kt-menu-trigger="click" class="menu-item menu-accordion  show show">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas fas fa-cogs fs-3" aria-hidden="true"></i>
        </span>
        <span class="menu-title">Dashboards</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">

        <?php
        
        MenuItem($link = route('Dashboard'), $label = 'Admin Dashboard');
        MenuItem($link = route('IndicatorWarning'), $label = 'Regional Dashboard');
        MenuItem($link = route('IndicatorWarning'), $label = 'Country Dashboard');
        ?>


    </div>
</div>
<div data-kt-menu-trigger="click" class="menu-item menu-accordion  show ">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas fas fa-cogs fs-3" aria-hidden="true"></i>
        </span>
        <span class="menu-title">Data Settings</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">

        <?php
        
        MenuItem($link = route('IndicatorWarning'), $label = 'Admin Dashboard');
        MenuItem($link = route('MgtEntities'), $label = 'Manage Entities');
        
        MenuItem($link = route('SelectEntity'), $label = 'Manage Indicators');
        MenuItem($link = route('MgtReportingTimelines'), $label = 'Set Reporting Timelines');
        MenuItem($link = route('IndicatorWarning'), $label = 'User Accounts');
        MenuItem($link = route('ReportSelectEntity'), $label = 'File a Report');
        ?>


    </div>
</div>
<div data-kt-menu-trigger="click" class="menu-item menu-accordion  show ">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas fas fa-cogs fs-3" aria-hidden="true"></i>
        </span>
        <span class="menu-title">Entity Reports</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">

        <?php
        
        MenuItem($link = route('PendingReportEntities'), $label = 'Pending Reports');
        MenuItem($link = route('ApprovedIndicatorsSelectEntity'), $label = 'Approved Reports');
        MenuItem($link = route('ReturnedSelectEntity'), $label = 'Returned Reports');
        MenuItem($link = route('ReportSelectEntity'), $label = 'File a Report');
        ?>


    </div>
</div>
<div data-kt-menu-trigger="click" class="menu-item menu-accordion  show ">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas fas fa-cogs fs-3" aria-hidden="true"></i>
        </span>
        <span class="menu-title">Settings</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">

        <?php
        
        MenuItem($link = '#', $label = 'User Accounts');
        MenuItem($link = '#', $label = 'Admin Accounts');
        MenuItem($link = route('IndicatorWarning'), $label = 'Get Help');
        MenuItem($link = route('ReportSelectEntity'), $label = 'File a Report');
        ?>


    </div>
</div>
