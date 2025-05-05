<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <!-- Dashboard -->
            <li><a href="{{ route('dashboard') }}">
                <i class="mdi mdi-view-dashboard"></i>
                <span class="nav-text">Dashboard</span>
            </a></li>

            <!-- Client Management Section -->
            <li class="has-arrow">
                <a href="#" aria-expanded="false">
                    <i class="mdi mdi-account-circle"></i>
                    <span class="nav-text">Clients</span>
                </a>
                <ul aria-expanded="false">
                    {{-- <li><a href="{{ route('users.index') }}">Client List</a></li>
                    <li><a href="{{ route('user.register') }}">Add Client</a></li> --}}
                </ul>
            </li>

            <!-- Product & Order Management Section -->
            <li class="has-arrow">
                <a href="#" aria-expanded="false">
                    <i class="mdi mdi-cube"></i>
                    <span class="nav-text">Products & Orders</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    <li><a href="{{ route('products.create') }}">Add Product</a></li>
                    {{-- <li><a href="{{ route('product.categories.index') }}">Product Categories</a></li>
                    <li><a href="{{ route('orders.index') }}">Orders</a></li> --}}
                </ul>
            </li>

            <!-- Invoice & Payment Management Section -->
            <li class="has-arrow">
                <a href="#" aria-expanded="false">
                    <i class="mdi mdi-cash"></i>
                    <span class="nav-text">Invoices & Payments</span>
                </a>
                <ul aria-expanded="false">
                    {{-- <li><a href="{{ route('invoice.index') }}">Invoices</a></li>
                    <li><a href="{{ route('payments.index') }}">Payments</a></li> --}}
                </ul>
            </li>

            <!-- Support & Ticket System Section -->
            <li class="has-arrow">
                <a href="#" aria-expanded="false">
                    <i class="mdi mdi-help-circle"></i>
                    <span class="nav-text">Support</span>
                </a>
                <ul aria-expanded="false">
                    {{-- <li><a href="{{ route('tickets.index') }}">Support Tickets</a></li>
                    <li><a href="{{ route('tickets.create') }}">Raise Ticket</a></li> --}}
                </ul>
            </li>

            <!-- Financial Reports Section -->
            {{-- <li><a href="{{ route('reports.index') }}">
                <i class="mdi mdi-chart-line"></i>
                <span class="nav-text">Reports</span>
            </a></li> --}}

            {{-- <!-- System Settings Section (Admin) -->
            @role('admin')
                <li><a href="{{ route('settings.index') }}">
                    <i class="mdi mdi-settings"></i>
                    <span class="nav-text">System Settings</span>
                </a></li>
            @endrole --}}
        </ul>
    </div>
</div>
