@extends('main.master')

@section('content')
<div class="content-body">
    <div class="container">
        <!-- Page Title & Breadcrumb -->
        <div class="row page-titles">
            <div class="col p-0">
                <h4>Hello, <span>Welcome to Admin Panel</span></h4>
            </div>
            <div class="col p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>

        <!-- Clock -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Current Time: <span id="clock" class="text-primary"></span></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metrics Row -->
        <div class="row">
            <!-- Total Clients -->
            <div class="col-lg-3 col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h4>Total Clients <i class="pull-right ion-person text-primary f-s-30"></i></h4>
                        <h6 class="m-t-20 f-s-16">1200 Registered</h6>
                        <div class="progress m-t-0 h-7px">
                            <div class="progress-bar bg-primary w-75pc"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Orders -->
            <div class="col-lg-3 col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h4>Active Orders <i class="pull-right ion-android-cart text-success f-s-30"></i></h4>
                        <h6 class="m-t-20 f-s-16">320 Orders</h6>
                        <div class="progress m-t-0 h-7px">
                            <div class="progress-bar bg-success w-50pc"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Invoices -->
            <div class="col-lg-3 col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h4>Pending Invoices <i class="pull-right ion-document text-warning f-s-30"></i></h4>
                        <h6 class="m-t-20 f-s-16">45 Invoices</h6>
                        <div class="progress m-t-0 h-7px">
                            <div class="progress-bar bg-warning w-30pc"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support Tickets -->
            <div class="col-lg-3 col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h4>Support Tickets <i class="pull-right ion-help-buoy text-danger f-s-30"></i></h4>
                        <h6 class="m-t-20 f-s-16">12 New</h6>
                        <div class="progress m-t-0 h-7px">
                            <div class="progress-bar bg-danger w-20pc"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-white">
                    <div class="card-body">
                        <h5>Latest Notifications</h5>
                        <ul class="list-unstyled m-t-20">
                            <li>📧 Invoice #1004 due in 3 days</li>
                            <li>🆕 New Product Request from Client #452</li>
                            <li>🔐 User #231 failed OTP verification</li>
                            <li>📨 Support Ticket #3901 replied</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- System Stats -->
            <div class="col-lg-6">
                <div class="card bg-white">
                    <div class="card-body">
                        <h5>System Overview</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                Registered Companies <span>980</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                Registered Individuals <span>220</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                Categories <span>35</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                Products <span>180</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Clock Script -->
<script>
    function updateClock() {
        const clock = document.getElementById("clock");
        const now = new Date();
        const time = now.toLocaleTimeString();
        clock.textContent = time;
    }
    updateClock();
    setInterval(updateClock, 1000);
</script>
@endsection
