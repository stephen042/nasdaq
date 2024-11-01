<!doctype html>
<html lang="en" dir="ltr">

<head>

    @include('includes.user-head')

</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    @include('includes.loader')
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- APP-NAv -->
            @include('includes.user-nav')
            <!-- /APP-NAv -->

            <!--APP-SIDEBAR-->
            @include('includes.user-sidebar')
            <!--/APP-SIDEBAR-->

            <!-- APP-CONTENT OPEN -->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <div>
                                <h1 class="page-title">Bank Withdraw History</h1>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('user_dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bank Withdraw History</li>
                                </ol>
                            </div>
                        </div>

                        <!-- ROW -->
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">ALL Bank Withdraw History </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom w-100 "
                                                id="responsive-datatable">
                                                <thead>
                                                    <tr>
                                                        <td class="wd-15p border-bottom-0">#</td>
                                                        <td class="wd-15p border-bottom-0">Date</td>
                                                        <td class="wd-15p border-bottom-0">Account Name</td>
                                                        <td class="wd-15p border-bottom-0">Account Number</td>
                                                        <td class="wd-15p border-bottom-0">Amount</td>
                                                        <td class="wd-15p border-bottom-0">Bank Name</td>
                                                        <td class="wd-15p border-bottom-0">Account Type</td>
                                                        <td class="wd-15p border-bottom-0">Status</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($withdrawals as $count => $withdrawal)
                                                    <tr>
                                                        <td>{{ $count + 1 }}</td>
                                                        <td>{{ date('Y/M/d h:i a', strtotime($withdrawal->created_at))}}
                                                        </td>
                                                        <td style="overflow-x: auto;max-width: 200px;">
                                                            {{ $withdrawal->account_name }}
                                                        </td>
                                                        <td>{{ $withdrawal->account_number }}</td>
                                                        <td>${{ number_format($withdrawal->amount, 2) }}
                                                        </td>
                                                        <td>{{ $withdrawal->bank_name }}</td>
                                                        <td>{{ $withdrawal->account_type }}</td>

                                                        @if ($withdrawal->status == 2)
                                                        <td class="text-success fs-15 fw-semibold">
                                                            {{
                                                            config('app.transaction_status')[$withdrawal->status]
                                                            }}
                                                        </td>
                                                        @elseif ($withdrawal->status == 3)
                                                        <td class="text-danger fs-15 fw-semibold">
                                                            {{
                                                            config('app.transaction_status')[$withdrawal->status]
                                                            }}
                                                        </td>
                                                        @else
                                                        <td class="text-info fs-15 fw-semibold">
                                                            {{
                                                            config('app.transaction_status')[$withdrawal->status]
                                                            }}
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    @empty
                                                    <tr></tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END ROW -->
                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!-- APP-CONTENT END -->
        </div>

        <!-- FOOTER -->
        @include('includes.user-footer')
        <!-- FOOTER END -->
        <!-- APP-NAv -->
        @include('includes.user-nav-down')
        <!-- /APP-NAv -->

    </div>
    <!-- CONTAINER END -->

    @include('includes.user-scripts')

</body>

</html>