@extends('home')
@section('pagesection')

<div class="container">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Manage Complaints
        </h1>
        <a href="{{ route('customer.create') }}"  class="btn btn-primary waves-effect waves-themed text-white"><i
                class="fal fa-plus-circle"></i> Create
        </a>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Customer <span class="fw-300"><i>Table</i></span>
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
                            <th>Sno</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)

                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->vehicle->customer->user->name }}</td>
                                <td>{{ $item->vehicle->customer->user->email }}</td>
                                <td>
                                    <div class="form-group">
                                        <select data-id="{{ $item->id }}" class="form-control" name="status">
                                        @foreach (complainStatus() as $i)
                                            <option {{ ($item->status == $i)?"selected":"" }} value="{{ $i }}">{{ $i }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                </td>
                                <td>
                                    <a href="{{ url('complains/'.$item->id) }}" class="btn btn-info">View</a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sno</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Active</th>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $(document).ready(function(){
        $("select[name=status]").change(function(){
            var id = $(this).data("id");
            var status = $(this).val();
            $.get("{{ url('api/customer/status/') }}/"+id+"/"+status,function(data){
                if(data){
                    swal({
                    title: "Status Updated!",
                    text: "Status updated successfully!",
                    icon: "success",
                    });
                }
            });
        });
    });

</script>
@endsection
