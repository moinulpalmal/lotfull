<!-- BEGIN: Main Menu-->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <!-- include ../../../includes/mixins-->
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}" data-menu="dropdown"><a class="nav-link" href="{{route('home')}}" data-toggle="dropdown"><i class="feather icon-home"></i><span data-i18n="Home">Home</span></a></li>
            @if(Auth::user()->hasPermission('administrator', Auth::user()->id))
            <li class="dropdown nav-item {{ (request()->is('admin*')) ? 'active' : '' }}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-monitor"></i><span data-i18n="Administration">Administration</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown dropdown-submenu {{ (request()->is('admin/user*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Software Users" data-toggle="dropdown">Software Users</a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->hasTaskPermission('createuser', Auth::user()->id))
                                <li class="{{ (request()->is('admin/user/active')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('admin.user.active')}}" data-i18n="Active Users" data-toggle="dropdown">Active Users</a></li>
                            @endif
                            @if(Auth::user()->hasTaskPermission('restoreuser', Auth::user()->id))
                                <li class="{{ (request()->is('admin/user/historical')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('admin.user.historical')}}" data-i18n="Historical Users" data-toggle="dropdown">Historical Users</a></li>
                                @endif
                                @if(Auth::user()->id == 1)
                                <li class="{{ (request()->is('admin/user/role')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('admin.user.role')}}" data-i18n="Roles" data-toggle="dropdown">Roles</a></li>
                                <li class="{{ (request()->is('admin/user/task')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('admin.user.task')}}" data-i18n="Tasks" data-toggle="dropdown">Tasks</a></li>
                                @endif
                        </ul>
                    </li>
                    <li class="{{ (request()->is('admin/location/setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('admin.location.setup')}}" data-i18n="Location" data-toggle="dropdown">Location Setup</a></li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->hasPermission('settings', Auth::user()->id))
            <li class="dropdown nav-item {{ (request()->is('settings*')) ? 'active' : '' }}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-settings"></i><span data-i18n="Settings">Settings</span></a>
                <ul class="dropdown-menu">
                    @if(Auth::user()->hasTaskPermission('factory_department', Auth::user()->id))
                    <li class="dropdown dropdown-submenu {{ (request()->is('settings/factory*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Factory & Department" data-toggle="dropdown">Factory & Department</a>
                        <ul class="dropdown-menu">
                            <li class="{{ (request()->is('settings/factory/setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.factory.setup')}}" data-i18n="Factory Setup" data-toggle="dropdown">Factory Setup</a></li>
                            <li class="{{ (request()->is('settings/factory/department-setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.factory.department-setup')}}" data-i18n="Department IT Setup" data-toggle="dropdown">Department Setup</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->hasTaskPermission('buyer', Auth::user()->id))
                    <li class="dropdown dropdown-submenu {{ (request()->is('settings/buyer*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Buyer & Style" data-toggle="dropdown">Buyer & Style</a>
                        <ul class="dropdown-menu">
                            <li class="{{ (request()->is('settings/buyer/setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.buyer.setup')}}" data-i18n="Buyer" data-toggle="dropdown">Buyer</a></li>
                            <li class="{{ (request()->is('settings/buyer/style')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.buyer.style')}}" data-i18n="Buyer" data-toggle="dropdown">Buyer Style</a></li>
                        </ul>
                    </li>
                    @endif
                        @if(Auth::user()->hasTaskPermission('unit', Auth::user()->id))
                        <li class="{{ (request()->is('settings/unit/setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.unit.setup')}}" data-i18n="Unit" data-toggle="dropdown">Unit Setup</a></li>
                    @endif
                    @if(Auth::user()->hasTaskPermission('garments_type', Auth::user()->id))
                        <li class="{{ (request()->is('settings/garments-type/setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.garments-type.setup')}}" data-i18n="GarmentsType" data-toggle="dropdown">Garments Type Setup</a></li>
                    @endif
                    @if(Auth::user()->hasTaskPermission('stock_threshold', Auth::user()->id))
                        <li class="{{ (request()->is('settings/stock-threshold/setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.stock-threshold.setup')}}" data-i18n="StockThreshold" data-toggle="dropdown">Stock Threshold Setup</a></li>
                        @endif
                        @if(Auth::user()->hasTaskPermission('vendor', Auth::user()->id))
                            <li class="{{ (request()->is('settings/vendor/setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.vendor.setup')}}" data-i18n="Vendor" data-toggle="dropdown">Vendor Setup</a></li>
                            @endif
                            @if(Auth::user()->hasTaskPermission('designation', Auth::user()->id))
                    <li class="{{ (request()->is('settings/designation')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.designation')}}" data-i18n="Designation" data-toggle="dropdown">Designation</a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if(Auth::user()->hasPermission('receive', Auth::user()->id))
                <li class="dropdown nav-item {{ (request()->is('receive*')) ? 'active' : '' }}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-download"></i><span data-i18n="Settings">Receive</span></a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->hasTaskPermission('receive_insert', Auth::user()->id))
                        <li class="{{ (request()->is('receive/new')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('receive.new')}}" data-i18n="New" data-toggle="dropdown">New</a></li>
                        @endif
                            @if(Auth::user()->hasTaskPermission('image_access', Auth::user()->id))
                            <li class="{{ (request()->is('receive/image-upload')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('receive.image-upload')}}" data-i18n="ImageUpload" data-toggle="dropdown">Image Upload</a></li>
                            @endif
                                <li class="dropdown dropdown-submenu {{ (request()->is('receive/list*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="List" data-toggle="dropdown">List</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown dropdown-submenu {{ (request()->is('receive/list/master*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="RCMaster" data-toggle="dropdown">Master</a>
                                    <ul class="dropdown-menu">
                                        <li class="{{ (request()->is('receive/list/master/inserted')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('receive.list.master.inserted')}}" data-i18n="ListMasterInserted" data-toggle="dropdown">Inserted</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown dropdown-submenu {{ (request()->is('receive/list/detail*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="RCDetail" data-toggle="dropdown">Detail</a>
                                    <ul class="dropdown-menu">
                                        <li class="{{ (request()->is('receive/list/detail/inserted')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('receive.list.detail.inserted')}}" data-i18n="ListDetailInserted" data-toggle="dropdown">Inserted</a></li>
                                        <li class="{{ (request()->is('receive/list/detail/qc-inserted')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('receive.list.detail.qc-inserted')}}" data-i18n="ListDetailQCInserted" data-toggle="dropdown">QC-Inserted</a></li>
                                        <li class="{{ (request()->is('receive/list/detail/qc-finished')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('receive.list.detail.qc-finished')}}" data-i18n="ListDetailQCFinished" data-toggle="dropdown">QC-Finished</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown dropdown-submenu {{ (request()->is('receive/list/transfer*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="TransferDetail" data-toggle="dropdown">Transfer</a>
                                    <ul class="dropdown-menu">
                                        <li class="{{ (request()->is('receive/list/transfer/inserted')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('receive.list.transfer.inserted')}}" data-i18n="TransferDetailInserted" data-toggle="dropdown">Inserted</a></li>
                                        <li class="{{ (request()->is('receive/list/transfer/approved')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('receive.list.transfer.approved')}}" data-i18n="TransferDetailApproved" data-toggle="dropdown">Approved</a></li></ul>
                                </li>
                            </ul>
                        </li>
                        {{--<li class="{{ (request()->is('receive/search')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('receive.search')}}" data-i18n="Search" data-toggle="dropdown">Search</a></li>
                    --}}</ul>
                </li>
            @endif
            @if(Auth::user()->hasPermission('issue', Auth::user()->id))
                <li class="dropdown nav-item {{ (request()->is('issue*')) ? 'active' : '' }}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-upload"></i><span data-i18n="Issue">Issue</span></a>
                    <ul class="dropdown-menu">
                       {{-- <li class="{{ (request()->is('receive/new')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('receive.new')}}" data-i18n="New" data-toggle="dropdown">New</a></li>
                       --}} <li class="dropdown dropdown-submenu {{ (request()->is('issue/stock*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Stock" data-toggle="dropdown">Stock</a>
                            <ul class="dropdown-menu">
                                <li class="{{ (request()->is('issue/stock/current')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('issue.stock.current')}}" data-i18n="CurrentStock" data-toggle="dropdown">Current Stock</a></li>
                                <li class="{{ (request()->is('issue/stock/in-active')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('issue.stock.in-active')}}" data-i18n="In-ActiveStock" data-toggle="dropdown">In-Active Stock</a></li>
                                <li class="{{ (request()->is('issue/stock/old')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('issue.stock.old')}}" data-i18n="OldStock" data-toggle="dropdown">Old Stock</a></li>
                            </ul>
                            <li class="dropdown dropdown-submenu {{ (request()->is('issue/detail*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="IssueDetail" data-toggle="dropdown">Detail</a>
                                <ul class="dropdown-menu">
                                    @if(Auth::user()->hasTaskPermission('issue_update', Auth::user()->id))
                                        <li class="{{ (request()->is('issue/detail/issued')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('issue.detail.issued')}}" data-i18n="VendorIssued" data-toggle="dropdown">Vendor Issued</a></li>
                                    @endif
                                    @if(Auth::user()->hasTaskPermission('transfer_update', Auth::user()->id))
                                            <li class="{{ (request()->is('issue/detail/transferred')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('issue.detail.transferred')}}" data-i18n="TransferIssued" data-toggle="dropdown">Transferred</a></li>
                                        @endif
                                </ul>
                            </li>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->hasPermission('report', Auth::user()->id))
                <li class="dropdown nav-item {{ (request()->is('report*')) ? 'active' : '' }}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-file"></i><span data-i18n="Report">Report</span></a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->hasTaskPermission('top-management', Auth::user()->id))
                            <li class="dropdown dropdown-submenu {{ (request()->is('report/top-management*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Top-Management" data-toggle="dropdown">Top-Management</a>
                                <ul class="dropdown-menu">
                                    <li class="{{ (request()->is('report/top-management/receive*')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('report.top-management.receive.form')}}" data-i18n="ReceiveReport" data-toggle="dropdown">Receive</a></li>
                                    <li class="{{ (request()->is('report/top-management/issue*')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('report.top-management.issue.form')}}" data-i18n="IssueReport" data-toggle="dropdown">Issue</a></li>
                                    <li class="{{ (request()->is('report/top-management/stock*')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('report.top-management.stock.form')}}" data-i18n="CurrentStock" data-toggle="dropdown">Current Stock</a></li>
                                </ul>
                            </li>
                        @endif
                            @if(Auth::user()->hasTaskPermission('management', Auth::user()->id))
                                <li class="dropdown dropdown-submenu {{ (request()->is('report/management*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Management" data-toggle="dropdown">Management</a>
                                    <ul class="dropdown-menu">
                                        <li class="{{ (request()->is('report/management/receive*')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('report.management.receive.form')}}" data-i18n="MReceiveReport" data-toggle="dropdown">Receive</a></li>
                                        <li class="{{ (request()->is('report/management/issue*')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('report.management.issue.form')}}" data-i18n="MIssueReport" data-toggle="dropdown">Issue</a></li>
                                        <li class="{{ (request()->is('report/management/stock*')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('report.management.stock.form')}}" data-i18n="MCurrentStock" data-toggle="dropdown">Current Stock</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(Auth::user()->hasTaskPermission('location', Auth::user()->id))
                                <li class="dropdown dropdown-submenu {{ (request()->is('report/location*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Location" data-toggle="dropdown">Location</a>
                                    <ul class="dropdown-menu">
                                        <li class="{{ (request()->is('report/location/receive*')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('report.location.receive.form')}}" data-i18n="LReceiveReport" data-toggle="dropdown">Receive</a></li>
                                        <li class="{{ (request()->is('report/location/issue*')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('report.location.issue.form')}}" data-i18n="LIssueReport" data-toggle="dropdown">Issue</a></li>
                                        <li class="{{ (request()->is('report/location/stock*')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('report.location.stock.form')}}" data-i18n="LCurrentStock" data-toggle="dropdown">Current Stock</a></li>
                                    </ul>
                                </li>
                            @endif
                    </ul>
                </li>
            @endif
        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
<!-- END: Main Menu-->


