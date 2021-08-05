@extends('home')
@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Manage Loan Sechdule
        </h1>
        <a href="{{ route('add.mg.schdule',$id) }}" class="btn btn-primary waves-effect waves-themed text-white"><i
            class="fal fa-plus-circle"></i> Add Loan Sechdule
        </a>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Loan Schdule <span class="fw-300"><i>info</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                            <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example">
                                <thead>
                                    <tr>

                                        <th>Principal Payment</th>
                                        <th>Interest Payment</th>
                                        <th>Expected Payment</th>
                                        <th>Expated Payment Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)

                                        <tr>
                                            <td>{{ $item->principal_payment }}</td>
                                            <td>{{ $item->interest_payment }}</td>
                                            <td>{{ $item->expected_payment }}</td>
                                            <td>{{ $item->expected_payment_date }}</td>
                                            <td>
                                                <a href="{{ route('show.schdule',$item->id) }}" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('edit.mg.schdul',$item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <a href="{{ route('delete.mg.schdule',$item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Principal Payment</th>
                                        <th>Interest Payment</th>
                                        <th>Expected Payment</th>
                                        <th>Expated Payment Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

