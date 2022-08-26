@extends('home')
@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-home'></i> Dashboard
        </h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--Table bordered-->
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Late <span class="fw-300"><i>Payment Schedules</i></span>
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>Borrower Name</th>
                                    <th>Loan ID</th>
                                    <th>OutStanding Payment</th>
                                    <th>Initial Amount</th>
                                    <th>Principal Payment</th>
                                    <th>Interest Payment</th>
                                    <th>Expected Payment</th>
                                    <th>Expected Payment Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($late_payment as $item)
                                    <tr>
                                        <td>{{ $item->loan->borrower->name }}</td>
                                        <td>{{ $item->loan->legal_loan_id }}</td>
                                        <td>{{ number_format($item->loan->outstanding_payment(),2,',','.') }}</td>
                                        <td>{{ number_format($item->loan->initial_amount,2,',','.') }}</td>
                                        <td>{{number_format( $item->principal_payment, 2, ',', '.') }}</td>
                                        <td>{{ number_format( $item->interest_payment , 2, ',', '.') }}</td>
                                        <td>{{ number_format( $item->expected_payment , 2, ',', '.') }}</td>
                                        <td>{{ date('d-m-Y', strtotime( $item->expected_payment_date )) }}</td>
                                        <td>
                                            {!! $item->getStatus() !!}
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <!--Table bordered-->
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                       Latest <span class="fw-300"><i>Message</i></span>
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                        <div class="col-md-12" style="overflow: hidden"><p>{!! getMessage() !!}</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2 class="js-get-date"></h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/dependency/moment/moment.js') }}"></script>
<script src="{{ asset('js/miscellaneous/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function()
    {


        //$('#js-page-content').smartPanel();

        //
        //
        /*calendar */
        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');

        // console.log({!! json_encode($data) !!});
        var events = [];
        $({!! json_encode($data) !!}).each(function(i,v){
                    events.push({
                        title: "Loan ID "+v.loan.legal_loan_id+"\rPayment "+v.expected_payment,
                        start: v.expected_payment_date,
                        className: "bg-primary border-primary text-white",
                        url: "/loan/schedule/"+v.loan_id
                    });
            })
            // console.log(events);
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl,
        {
            initialView: 'dayGridMonth',
            initialDate: '2021-07-12',
            plugins: ['dayGrid', 'list', 'timeGrid', 'interaction', 'bootstrap'],
            themeSystem: 'bootstrap',
            timeZone: 'UTC',
            //dateAlignment: "month", //week, month
            buttonText:
            {
                today: 'today',
                list: 'list'
            },
            eventTimeFormat:
            {
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short'
            },
            header:
            {
                left: 'title',
                center: '',
                right: 'today prev,next'
            },
            // editable: true,
            eventLimit: true, // allow "more" link when too many events
            eventDidMount: function(info) {
              var tooltip = new Tooltip(info.el, {
                title: info.event.extendedProps.description,
                placement: 'top',
                trigger: 'hover',
                container: 'body'
              });
            },
            events: events,
            viewSkeletonRender: function()
            {
                $('.fc-toolbar .btn-default').addClass('btn-sm');
                $('.fc-header-toolbar h2').addClass('fs-md');
                $('#calendar').addClass('fc-reset-order')
            },

        });

        calendar.render();
    });

</script>
@endsection
