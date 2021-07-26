<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Simfy CRM<sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Products</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="{{route('products.index')}}">All Products</a>
                @if(Auth::user()->hasPermissionTo('create-product') == 1)
                <a class="collapse-item" href="{{route('products.create')}}">Add a Product</a>
                @endif
                @if(Auth::user()->hasPermissionTo('delete') == 1)
                <a class="collapse-item" href="{{route('products.trashed')}}">Trashed Products</a>
                @endif
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customers" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Customers</span>
        </a>
        <div id="customers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="{{route('customers.index')}}">All Customers</a>
                <a class="collapse-item" href="{{route('customers.create')}}">Add a Customer</a>
                @if(Auth::user()->hasPermissionTo('delete') == 1)
                <a class="collapse-item" href="{{route('customers.trashed')}}">Trashed Customers</a>
                @endif
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#invoices-sidebar"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Invoices</span>
        </a>
        <div id="invoices-sidebar" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="{{route('invoices.index')}}">All invoices</a>
                <a class="collapse-item" href="{{route('invoices.create')}}">Create Invoice</a>
                @if(Auth::user()->hasPermissionTo('delete') == 1)
                <a class="collapse-item" href="{{route('invoices.trashed')}}">Trashed Invoices</a>
                @endif
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="/settings" aria-expanded="true" aria-controls="collapseCategories">
            <i class="fas fa-fw fa-cog"></i>
            <span>Settings</span>
        </a>
        <div id="collapseCategories" class="collapse" aria-labelledby="collapseCategories"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="{{route('categories.index')}}">All Categories</a>
                <a class="collapse-item" href="{{route('categories.create')}}">Add a Category</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories"
            aria-expanded="true" aria-controls="collapseCategories">
            <i class="fas fa-fw fa-cog"></i>
            <span>Categories</span>
        </a>
        <div id="collapseCategories" class="collapse" aria-labelledby="collapseCategories"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="{{route('categories.index')}}">All Categories</a>
                <a class="collapse-item" href="{{route('categories.create')}}">Add a Category</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCouriers"
            aria-expanded="true" aria-controls="collapseCategories">
            <i class="fas fa-fw fa-cog"></i>
            <span>Couriers</span>
        </a>
        <div id="collapseCouriers" class="collapse" aria-labelledby="collapseCategories"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="{{route('couriers.index')}}">All Couriers</a>
                <a class="collapse-item" href="{{route('couriers.create')}}">Add a Courier</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShippingStatus"
            aria-expanded="true" aria-controls="collapseCategories">
            <i class="fas fa-fw fa-cog"></i>
            <span>Shipping Status</span>
        </a>
        <div id="collapseShippingStatus" class="collapse" aria-labelledby="collapseShippingStatus"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded" id="shipping-status">

            </div>
        </div>
    </li>
    {{-- @if(Auth::user()->hasPermissionTo('create-product') != 0) --}}
    @if(Auth::user()->hasPermissionTo('delete') == 1)
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseexpenses"
            aria-expanded="true" aria-controls="collapseCategories">
            <i class="fas fa-fw fa-cog"></i>
            <span>Expenses</span>
        </a>
        <div id="collapseexpenses" class="collapse" aria-labelledby="collapseCategories"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="{{route('expenses.index')}}">All Expenses</a>
                <a class="collapse-item" href="{{route('expenses.create')}}">Add an Expense</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsereports"
            aria-expanded="true" aria-controls="collapsereports">
            <i class="fas fa-fw fa-cog"></i>
            <span>Reports</span>
        </a>
        <div id="collapsereports" class="collapse" aria-labelledby="collapsereports" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="{{route('reports.index')}}">View Reports</a>
                <a class="collapse-item" href="{{route('reports.profit_loss')}}">Profile/Loss</a>

            </div>
        </div>
    </li>
    {{-- @endif
    @if(Auth::user()->hasPermissionTo('delete') == 1) --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true"
            aria-controls="collapseCategories">
            <i class="fas fa-fw fa-cog"></i>
            <span>Users</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="collapseCategories" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="{{route('users.index')}}">All Users</a>
                <a class="collapse-item" href="{{route('users.create')}}">Add a User</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepurchases"
            aria-expanded="true" aria-controls="collapseCategories">
            <i class="fas fa-fw fa-cog"></i>
            <span>Purchases</span>
        </a>
        <div id="collapsepurchases" class="collapse" aria-labelledby="collapseCategories"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="{{route('purchases.index')}}">All Purchases</a>
                <a class="collapse-item" href="{{route('purchases.create')}}">Purchase a Product</a>
            </div>
        </div>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
