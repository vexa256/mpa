<div data-kt-menu-trigger="click" class="menu-item menu-accordion show">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas fas fa-cogs fs-3" aria-hidden="true"></i>
        </span>
        <span class="menu-title">Indicator Settings</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">

        <?php
        
        MenuItem($link = route('IndicatorWarning'), $label = 'Admin Dashboard');
        MenuItem($link = route('IndicatorWarning'), $label = 'Country Dashboard');
        MenuItem($link = route('SelectEntity'), $label = 'Manage Indicators');
        MenuItem($link = route('MgtReportingTimelines'), $label = 'Set Reporting Timelines');
        MenuItem($link = route('IndicatorWarning'), $label = 'User Accounts');
        MenuItem($link = route('ReportSelectEntity'), $label = 'File a Report');
        
        ?>


    </div>
</div>
