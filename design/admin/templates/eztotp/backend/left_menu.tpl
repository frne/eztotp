{$node|attribute(show,1)}

<div class="well sidebar-nav totp-left-menu">
    <ul class="nav nav-list">
        <li rel="dashboard">
            <a href="{'eztotpadmin/dashboard'|ezurl('no')}">
                Dashboard
            </a>
        </li>
        <li class="nav-header"
                >User management
        </li>
        <li rel="users/active">
            <a href="{'eztotpadmin/users/active'|ezurl('no')}">
                Active Users
            </a>
        </li>
        <li rel="users/blocked">
            <a href="{'eztotpadmin/users/blocked'|ezurl('no')}">
                Blocked Users
            </a>
        </li>
        <li class="nav-header">
            Logs
        </li>
        <li rel="log/error">
            <a href="#">
                Error Log</a></li>
        <li rel="log/access">
            <a href="#">
                Access Log</a></li>
        <li class="nav-header">
            Settings
        </li>
        <li rel="settings">
            <a href="#">
                TOTP Settings
            </a>
        </li>
        <li rel="setup">
            <a href="#">
                Setup
            </a>
        </li>
    </ul>
</div>
