@extends('admin.admin_master')
@section('admin')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Add Product  </h4><br><br>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label">Date</label>
                                    <input class="form-control example-date-input" name="date" type="date"  id="date">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label">Purchase No</label>
                                    <input class="form-control example-date-input" name="purchase_no" type="text"  id="purchase_no">
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label">Supplier Name </label>
                                    <select id="supplier_id" name="supplier_id" class="form-select" aria-label="Default select example">
                                    <option selected="">Open this select menu</option>
                                    @foreach($supplier as $supp)
                                    <option value="{{ $supp->id }}">{{ $supp->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label">Category Name </label>
                                    <select name="category_id" id="category_id" class="form-select" aria-label="Default select example">
                                    <option selected="">Open this select menu</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label">Product Name </label>
                                    <select name="product_id" id="product_id" class="form-select" aria-label="Default select example">
                                    <option selected="">Open this select menu</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label" style="margin-top:43px;">  </label>
                                    <input type="submit" class="btn btn-secondary btn-rounded waves-effect waves-light" value="Add More">
                                </div>
                            </div>

                        </div> <!-- // end row  -->

                    </div> <!-- End card-body -->

                    <!-- Tabel -->
                    <div class="card-body">
                        <form method="" action="">
                            @csrf
                            <table class="table-sm table-bordered table" width=100px style="border-color: #ddd;">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Product</th>
                                        <th>PSC/KG</th>
                                        <th>Unit Price</th>
                                        <th>Description</th>
                                        <th>Total Price</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                                <tbody id="addRow" class="addRow">

                                </tbody>

                                <tbody>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td>
                                            <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated-amount" readonly style="background-color: #ddd
                                            ">
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info" id="storeButton">Purchases Store</button>
                            </div>

                        </form>
                    </div>
                </div>


            </div> <!-- end col -->
        </div>

    </div>
</div>

<!-- Get Category -->
<script type="text/javascript">
    $(function(){
        $(document).on('change','#supplier_id',function(){
            var supplier_id = $(this).val();
            $.ajax({
                url:"{{ route('get-category') }}",
                type: "GET",
                data:{supplier_id:supplier_id},
                success:function(data){
                    var html = '<option value="">Select Category</option>';
                    $.each(data,function(key,v){
                        html += '<option value=" '+v.category_id+' "> '+v.category.name+'</option>';
                    });
                    $('#category_id').html(html);
                }
            })
        });
    });
</script>

<!-- Get Product -->
<script type="text/javascript">
    $(function(){
        $(document).on('change','#category_id',function(){
            var category_id = $(this).val();
            $.ajax({
                url:"{{ route('get-product') }}",
                type: "GET",
                data:{category_id:category_id},
                success:function(data){
                    var html = '<option value="">Select Product</option>';
                    $.each(data,function(key,v){
                        html += '<option value=" '+v.id+' "> '+v.name+'</option>';
                    });
                    $('#product_id').html(html);
                }
            })
        });
    });
</script>

@endsection
