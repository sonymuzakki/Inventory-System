@extends('admin.admin_master')
@section('admin')


 <div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Purchases All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('purchases.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">Add Purchases </a><br></br>

                        <h4 class="card-title">Purchases All Data </h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th width= "5%">Sl</th>
                                <th>Purchases No</th>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th>Category</th>
                                <th>Qty</th>
                                <th>Product Name</th>
                                <th>Status</th>
                                <th width= "10%">Action</th>

                            </thead>

                            <tbody>
                                @foreach($purchases as $key => $item)
                            <tr>
                                <td> {{ $key+1}} </td>
                                <td> {{ $item->purchases_no }} </td>
                                <td> {{ $item->date }} </td>
                                <td> {{ $item['supplier']['name'] }} </td>
                                <td> {{ $item['category']['name'] }} </td>
                                <td> {{ $item->qty }} </td>
                                <td> {{ $item['product']['name'] }} </td>
                                <td> {{ $item->status }} </td>
                                <td>
                                    <a href="{{ route('purchases.edit', $item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>

                                    <a href="{{ route('purchases.delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
                                </td>

                            </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->



    </div> <!-- container-fluid -->
</div>


@endsection
