@extends('home')

@section('pagesection')
<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Edit Borrower
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Borrower <span class="fw-300"><i>info</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.b.approve',$data->id) }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" placeholder="Full Name" name="name" value="{{ $data->name }}" required autocomplete="name" autofocus>


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="identity_no" class="col-md-4 col-form-label text-md-right">Identity No</label>

                                    <div class="col-md-6">
                                        <input id="identity_no" type="text" class="form-control" placeholder="Identity No" name="identity_no" value="{{ $data->identity_no }}" required autocomplete="identity_no">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="identity_type" class="col-md-4 col-form-label text-md-right">Identity Type</label>

                                    <div class="col-md-6">
                                        <input id="identity_type" type="text" class="form-control" placeholder="Identity Type" name="identity_type" value="{{ $data->identity_type }}" required autocomplete="identity_type">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nationality" class="col-md-4 col-form-label text-md-right">Nationality</label>

                                    <div class="col-md-6">
                                        <input id="nationality" type="text" class="form-control" placeholder="Nationality" name="nationality" value="{{ $data->nationality }}" required autocomplete="nationality">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="dob" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>

                                    <div class="col-md-6">
                                        <input id="dob" type="date" class="form-control" name="dob" value="{{ $data->dob }}" required autocomplete="dob">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tax_identity_no" class="col-md-4 col-form-label text-md-right">Tax Identity No</label>

                                    <div class="col-md-6">
                                        <input id="tax_identity_no" type="text" class="form-control" placeholder="Tax Identity No" name="tax_identity_no" value="{{ $data->tax_identity_no }}" required autocomplete="tax_identity_no">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="borrower_type" class="col-md-4 col-form-label text-md-right">Borrower Type</label>

                                    <div class="col-md-6">
                                        <input id="borrower_type" type="text" class="form-control" placeholder="Borrower Type" name="borrower_type" value="{{ $data->borrower_type }}" required autocomplete="borrower_type">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="person_in_contact" class="col-md-4 col-form-label text-md-right">Person in Contact</label>

                                    <div class="col-md-6">
                                        <input id="person_in_contact" type="text" class="form-control" placeholder="Person in Contact" name="person_in_contact" value="{{ $data->person_in_contact }}" required autocomplete="person_in_contact">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="reference" class="col-md-4 col-form-label text-md-right">Reference</label>

                                    <div class="col-md-6">
                                        <input id="reference" type="text" class="form-control" placeholder="Reference" name="reference" value="{{ $data->reference }}" required autocomplete="reference">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="identity_address" class="col-md-4 col-form-label text-md-right">Identity Address</label>

                                    <div class="col-md-6">
                                        <input id="identity_address" type="text" class="form-control" placeholder="Identity Address" name="identity_address" value="{{ $data->identity_address }}" required autocomplete="identity_address">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="domicile_address" class="col-md-4 col-form-label text-md-right">Domicile Address</label>

                                    <div class="col-md-6">
                                        <input id="domicile_address" type="text" class="form-control" placeholder="Domicile Address" name="domicile_address" value="{{ $data->domicile_address }}" required autocomplete="domicile_address">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="office_address" class="col-md-4 col-form-label text-md-right">Office Address</label>

                                    <div class="col-md-6">
                                        <input id="office_address" type="text" class="form-control" placeholder="Office Address" name="office_address" value="{{ $data->office_address }}" required autocomplete="office_address">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="occupation" class="col-md-4 col-form-label text-md-right">Occupation</label>

                                    <div class="col-md-6">
                                        <input id="occupation" type="text" class="form-control" placeholder="Occupation" name="occupation" value="{{ $data->occupation }}" required autocomplete="occupation">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="line_of_business" class="col-md-4 col-form-label text-md-right">Line of Business</label>

                                    <div class="col-md-6">
                                        <input id="line_of_business" type="text" class="form-control" placeholder="Line of Business" name="line_of_business" value="{{ $data->line_of_business }}" required autocomplete="line_of_business">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bank_account" class="col-md-4 col-form-label text-md-right">Bank Account</label>

                                    <div class="col-md-6">
                                        <input id="bank_account" type="text" class="form-control" placeholder="Bank Account" name="bank_account" value="{{ $data->bank_account }}" required autocomplete="bank_account">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bank_account" style="display: flex; align-items: center; justify-content: flex-end;" class="col-md-4 col-form-label text-md-right">Customer Field</label>
                                    <div class="col-md-6" id="fields">
                                        @if (count($data->fields) > 0)
                                            @foreach ($data->fields as $row)
                                                <div class="row mb-3">
                                                    <div class="col-md-5">
                                                        <input id="" type="text" value="{{ $row->name }}" class="form-control" placeholder="Field Name" name="field_name[]" required autocomplete="bank_account">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input id="bank_account" type="text" value="{{ $row->value }}" class="form-control" placeholder="Value" name="field_value[]" required autocomplete="bank_account">
                                                    </div>
                                                    <div class="col-sm-2 col-2" onclick="removeRow(this)">
                                                        <button class="btn btn-lg btn-danger btn-icon rounded-circle hover-effect-dot waves-effect waves-themed"><i style="font-weight: bold;" class="fal fa-trash"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (count($data->files) > 0)
                                                @foreach ($data->files as $frow)
                                                <div class="row mb-3">
                                                    <div class="col-md-5">
                                                        <input id="" type="text" class="form-control" value="{{ $frow->name }}" placeholder="File Name" name="file_name[]" required autocomplete="bank_account">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input id="file" type="file" class="form-control" value="{{ asset('BorrowerFiles/'.$frow->value) }}" name="file_value[]" autocomplete="bank_account">
                                                        <img src="{{ asset('public/BorrowerFiles/'.$frow->value) }}" style="height: 100px; width:100px"/>
                                                    </div>
                                                    <div class="col-sm-2 col-2" onclick="removeRow(this)">
                                                        <button class="btn btn-lg btn-danger btn-icon rounded-circle hover-effect-dot waves-effect waves-themed"><i style="font-weight: bold;" class="fal fa-trash"></i></button>
                                                    </div>
                                                </div>
                                                @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8 offset-2">
                                        <button type="button" id="new_field" class="btn btn-sm btn-success float-right mr-4">Add New Fields</button>
                                        <button type="button" id="new_file" class="btn btn-sm btn-success float-right mr-4">Add New File</button>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    function removeRow(input){
        input.parentNode.remove();
    }
    $(document).ready(function(){
        $('#new_field').on('click',function(){
            var fields = '<div class="row mb-3">'+
                            '<div class="col-md-5">'+
                                '<input id="" type="text" class="form-control" placeholder="Field Name" name="field_name[]" required autocomplete="bank_account">'+
                            '</div>'+
                            '<div class="col-md-5">'+
                                '<input id="bank_account" type="text" class="form-control" placeholder="Value" name="field_value[]" required autocomplete="bank_account">'+
                            '</div>'+
                            '<div class="col-sm-2 col-2" onclick="removeRow(this)">'+
                                '<button class="btn btn-lg btn-danger btn-icon rounded-circle hover-effect-dot waves-effect waves-themed"><i style="font-weight: bold;" class="fal fa-trash"></i></button>'+
                            '</div>'+
                        '</div>';
            $('#fields').append(fields);
        });
        //Add New file Start here
        $('#new_file').on('click',function(){
            var fields = '<div class="row mb-3">'+
                            '<div class="col-md-5">'+
                                '<input id="" type="text" class="form-control" placeholder="File Name" name="file_name[]" required autocomplete="bank_account">'+
                            '</div>'+
                            '<div class="col-md-5">'+
                                '<input id="bank_account" type="file" class="form-control" placeholder="Value" name="file_value[]" required autocomplete="bank_account">'+
                            '</div>'+
                            '<div class="col-sm-2 col-2" onclick="removeRow(this)">'+
                                '<button class="btn btn-lg btn-danger btn-icon rounded-circle hover-effect-dot waves-effect waves-themed"><i style="font-weight: bold;" class="fal fa-trash"></i></button>'+
                            '</div>'+
                        '</div>';
            $('#fields').append(fields);
        });
        // Add New files End here
    });
</script>
@endsection
