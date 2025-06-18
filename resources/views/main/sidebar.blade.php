<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <!-- Dashboard -->
            <li><a href="{{ route('dashboard') }}">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a></li>


            @can(\App\Enum\Permissions::ClientShow)
                <!-- Client Management Section -->
                <li class="has-arrow">
                    <a href="#" aria-expanded="false">
                        <i class="mdi mdi-account-circle"></i>
                        <span class="nav-text">Clients</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('users.index') }}">All Clients</a></li>
                        {{-- <li><a href="{{ route('user.register') }}">Add Client</a></li> --}}

                    </ul>
                </li>
            @endcan

            @canany([\App\Enum\Permissions::ProductShow, \App\Enum\Permissions::ProductCategoryShow,
                \App\Enum\Permissions::BillingCycleShow, \App\Enum\Permissions::ProductCreate])
                <!-- Product Management Section -->
                <li class="has-arrow">
                    <a href="#" aria-expanded="false">
                        <i class="mdi mdi-cube"></i>
                        <span class="nav-text">Products & Orders</span>
                    </a>
                    <ul aria-expanded="false">
                        @canany([\App\Enum\Permissions::ProductShow, \App\Enum\Permissions::ProductCategoryShow,
                            \App\Enum\Permissions::BillingCycleShow])
                            <li><a href="{{ route('products.index') }}">Products</a></li>
                        @endcanany
                        @can(\App\Enum\Permissions::ProductCreate)
                            <li><a href="{{ route('products.create') }}">Add Product</a></li>
                        @endcan
                        @can(\App\Enum\Permissions::ProductCategoryShow)
                            <li><a href="{{ route('products.categories.index') }}">Product Categories</a></li>
                        @endcan
                        @can(\App\Enum\Permissions::BillingCycleShow)
                            <li><a href="{{ route('billing-cycles.index') }}">Billing Cycle</a></li>
                        @endcan
                        {{-- <li><a href="{{ route('orders.index') }}">Orders</a></li> --}}
                    </ul>
                </li>
            @endcanany

            @can(\App\Enum\Permissions::OrderIndex)
                <!-- Separate Orders Section -->
                <li>
                    <a href="{{ route('orders.index') }}" aria-expanded="false">
                        <i class="mdi mdi-cart"></i>
                        <span class="nav-text">Orders</span>
                    </a>
                </li>
            @endcan

            <!-- Invoice & Payment Management Section -->
            <li class="has-arrow">
                <a href="#" aria-expanded="false">
                    <i class="mdi mdi-cash"></i>
                    <span class="nav-text">Invoices</span>
                </a>
                <ul aria-expanded="false">
                    {{-- Invoice Actions --}}
                    {{-- <li><a href="{{ route('invoice.index') }}">Invoices</a></li>
                    <li><a href="{{ route('invoice.create') }}">Create Invoice</a></li> --}}
                    {{-- <li><a href="{{ route('invoices.download', $invoice->id) }}">Download Invoice PDF</a></li> --}}

                    {{-- Invoice Status Filters --}}
                    {{-- <li><a href="{{ route('invoice.filterByStatus', 'paid') }}">Paid Invoices</a></li>
                    <li><a href="{{ route('invoice.filterByStatus', 'due') }}">Due Invoices</a></li>
                    <li><a href="{{ route('invoice.filterByStatus', 'overdue') }}">Overdue Invoices</a></li>
                    <li><a href="{{ route('invoice.filterByStatus', 'refunded') }}">Refunded Invoices</a></li>
                    <li><a href="{{ route('invoice.filterByStatus', 'canceled') }}">Canceled Invoices</a></li> --}}
                </ul>
            </li>

            <!-- Payments Management Section -->
            <li class="has-arrow">
                <a href="#" aria-expanded="false">
                    <i class="mdi mdi-cash"></i>
                    <span class="nav-text">Payments</span>
                </a>
                <ul aria-expanded="false">
                    {{-- Payments --}}
                    <li><a href="{{ route('payments.index') }}">Payments</a></li>
                    <li><a href="{{ route('payments.create') }}">Record Payment</a></li>
                    @can(\App\Enum\Permissions::PaymentReport)
                        <li><a href="{{ route('payments.report') }}">Payment Report</a></li>
                    @endcan

                    {{-- Manual Gateways & Accounts --}}
                    {{-- <li><a href="{{ route('payment-gateways.index') }}">Payment Gateways</a></li> --}}
                    {{-- <li><a href="{{ route('payment-accounts.index') }}">Payment Accounts</a></li> --}}

                    {{-- Cash Management --}}
                    @can(\App\Enum\Permissions::CashTransactionIndex)
                        <li><a href="{{ route('cash-transactions.index') }}">Cash Transactions</a></li>
                    @endcan
                    @can(\App\Enum\Permissions::CashTransactionReport)
                        <li><a href="{{ route('cash-transactions.report') }}">Cash Report</a></li>
                    @endcan
                </ul>
            </li>


            @can(\App\Enum\Permissions::RoleShow)
                <!-- Role & Permission Section -->
                <li class="has-arrow">
                    <a href="#" aria-expanded="false">
                        <i class="mdi mdi-key"></i>
                        <span class="nav-text">Role</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('roles.index') }}">Role</a></li>
                        <li><a href="{{ route('roles.admins') }}">Admins</a></li>
                        <li><a href="{{ route('roles.users') }}">Users</a></li>
                    </ul>
                </li>
            @endcan

            @canany([\App\Enum\Permissions::TicketShow, \App\Enum\Permissions::TicketCreate])
                <!-- Support & Ticket System Section -->
                <li class="has-arrow">
                    <a href="#" aria-expanded="false">
                        <i class="mdi mdi-help-circle"></i>
                        <span class="nav-text">Support</span>
                    </a>
                    <ul aria-expanded="false">
                        @can(\App\Enum\Permissions::TicketShow)
                            <li><a href="{{ route('tickets.index') }}">Support Tickets</a></li>
                        @endcan
                        @can(\App\Enum\Permissions::TicketCreate)
                            <li><a href="{{ route('tickets.create') }}">Raise Ticket</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

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

            <!-- Backup Section This also for admin -->
            <li><a href="{{ route('backup.index') }}">
                    <i class="mdi mdi-chart-line"></i>
                    <span class="nav-text">Backup</span>
                </a></li>

        </ul>
    </div>
</div>
