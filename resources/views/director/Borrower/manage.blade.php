@extends('home')
@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>Manage Borrower
        </h1>
        <a href="{{ route('add.borrower') }}" class="btn btn-primary waves-effect waves-themed text-white"><i
            class="fal fa-plus-circle"></i> Add New
        </a>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Borrowers <span class="fw-300"><i>data</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            Import <code>Borrower</code> Excel Sheet.
                            <hr/>
                            <form action="{{ route('import.borrower') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="excel_file">Select Borrower Sheet</label>
                                        <input id="excel_file" type="file" name="excel_file" class="form-control" required autocomplete="excel_file" autofocus>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary mt-4">
                                            Import
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <a download class="btn btn-success mt-4" href="{{ asset('excel_formates/borrowers.xlsx') }}">
                                           Sheet Example Format
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a class="btn btn-success mt-4" href="{{ route('export.borrower') }}">
                                           Export Data
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- datatable start -->
                            <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Identity No</th>
                                        <th>Nationality</th>
                                        <th>Borrower Type</th>
                                        <th>Contact</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)

                                        <tr>
                                            <td scope="row">{{ $item->name }}</td>
                                            <td>{{ $item->identity_no }}</td>
                                            <td>{{ $item->nationality }}</td>
                                            <td>{{ $item->borrower_type }}</td>
                                            <td>{{ $item->person_in_contact }}</td>
                                            <td>
                                                <a href="{{ route('view.borrower',$item->id) }}" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('edit.borrower',$item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <a href="{{ route('delete.borrower',$item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Identity No</th>
                                        <th>Nationality</th>
                                        <th>Borrower Type</th>
                                        <th>Contact</th>
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

