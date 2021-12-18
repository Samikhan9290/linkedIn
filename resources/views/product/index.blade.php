@extends('product_layout.app')
    @section('title','product')
    @section('content')
        <div class="container my-4">
            <div class="card">
                <div class="card-header">
                    <h5>Total Product</h5>
                    <a href="" data-bs-toggle="modal" data-bs-target="#AddProductModel" class="btn btn-sm btn-primary float-end">Add Product</a>
                </div>
                <!--add product  Modal -->
                <div class="modal fade" id="AddProductModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <ul id="errors"></ul>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">title</label>
                                        <input type="text" class="form-control title" id="title" aria-describedby="title" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="text" class="form-control description" id="description">
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" class="form-control price" id="price">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary AddProduct">Add Product</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!--Edit product Modal -->
                <div class="modal fade" id="edit_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit & update Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <ul id="edit_errors"></ul>
                            <div class="modal-body">
                                <form>
                                    <input type="hidden" class="form-control title"  id="edit_product_id" aria-describedby="title" name="title">

                                    <div class="mb-3">
                                        <label for="title" class="form-label">title</label>
                                        <input type="text" class="form-control edit_title" id="edit_title" aria-describedby="title" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="text" class="form-control edit_description" id="edit_description">
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" class="form-control edit_price" id="edit_price">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary update_product">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end  Edit product Modal -->


                <!-- delete Modal -->
                <div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <h4>Are you sure to delete product</h4>

                                        <input type="hidden" class="form-control title"  id="delete_product_id" aria-describedby="title" name="title">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary delete_student_btn">Delete product</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end delete Modal -->

                <div class="my-2" id="successMessage"></div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>description</th>

                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            fetchProduct();
            //fetch All product
            function fetchProduct(){
                $.ajax({
                    type: 'GET',
                    url: '/fetchData',
                    dataType: 'json',
                    success:function (response) {
                        $('tbody').html('');
                        $.each(response.products,function (key,item) {
                            $('tbody').append(`<tr>
                                <td>${item.id}</td>
                                <td>${item.title}</td>
                                <td>${item.description}</td>
                                <td><button type="button" value="${item.id}" class="edit_product btn btn-primary btn-sm">Edit</button></td>
                                <td><button type="button" value="${item.id}" class="delete_product btn btn-danger btn-sm">Delete</button></td>
                            </tr>`)

                        })

                    }
                });
            }
            //Add product
            $(document).on('click','.AddProduct',function (e) {
                e.preventDefault();
                let data= {
                    'title': $('.title').val(),
                    'description': $('.description').val(),
                    'price': $('.price').val(),
                }
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'/Add_product',
                    data:data,
                    dataType:'json',
                    success:function (response) {
                        if(response.status==400){
                            $('#errors').html('');
                            $('#errors').addClass('alert alert-danger');
                            $.each(response.errors,function (key,err_values) {
                                $('#errors').append('<li>'+err_values+'</li>');

                            });


                        }
                        else {
                            $('#errors').html('');

                            $('#successMessage').addClass('alert alert-success');
                            $('#successMessage').text(response.message);
                            $('#AddProductModel').modal('hide');
                            $('#AddProductModel').find('input').val('');
                            fetchProduct();


                        }


                    }
                });
            });

            //delete Product
            $(document).on('click','.delete_product',function (e) {
                e.preventDefault();
                let product_id=$(this).val()
                // alert(student_id);
                $('#delete_product_id').val(product_id);
                $('#deleteProduct').modal('show');
                $(document).on('click','.delete_student_btn',function (e) {
                    e.preventDefault();
                    $(this).text('deleting');
                    let product_id=$('#delete_product_id').val();


                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:'DELETE',
                        url:'/delete_product/'+product_id, success:function (response) {
                            // console.log(response)
                            $('#successMessage').addClass('alert alert-success');
                            $('#successMessage').text(response.message);
                            $('#deleteProduct').modal('hide');
                            $('.delete_student_btn').text('Delete');

                            fetchProduct();



                        }
                    });
                });


            });
            //Edit Product
            $(document).on('click','.edit_product',function (e) {
                e.preventDefault();
                let product_id=$(this).val();
                $('#edit_product').modal('show')
                $.ajax({
                    type:'GET',
                    url:'edit_product/'+product_id,
                    success:function (response) {
                        if(response.status==404){
                            $('#successMessage').html("")
                            $('#successMessage').addClass("alert alert-danger")
                            $('#successMessage').text(response.message)

                        }
                        else{
                            $('#edit_title').val(response.product.title);
                            $('#edit_product_id').val(response.product.id);
                            $('#edit_description').val(response.product.description);
                            $('#edit_price').val(response.product.price);

                        }


                    }
                });

            });
            //update Product
            $(document).on('click','.update_product',function (e) {
                e.preventDefault();
                $(this).text('updating');
                let product_id=$('#edit_product_id').val();
                let data={
                    'title':$('#edit_title').val(),
                    'description':$('#edit_description').val(),
                    'price':$('#edit_price').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"PUT",
                    url:'update_product/'+product_id,
                    data:data,
                    dataType:'json',
                    success:function (response) {
                        // console.log(response)
                        if (response.status==400){
                            $('#edit_errors').html("");
                            $('#edit_errors').addClass("alert alert-danger");
                            $.each(response.errors,function (key,err_values) {
                                $('#edit_errors').append('<li>'+err_values+'</li>');

                            });
                            $('.update_student').text('update')

                        }
                        else if(response.status==404){
                            $('#edit_errors').html("");
                            $("#successMessage").addClass('alert alert-success');
                            $("#successMessage").text(response.message);
                            $('.update_product').text('update')


                        }
                        else{
                            $('#edit_errors').html("");
                            $('#successMessage').html("");
                            $("#successMessage").addClass('alert alert-success');
                            $("#successMessage").text(response.message);
                            $("#edit_product").modal('hide');
                            $('.update_product').text('update')

                            fetchProduct();



                        }

                    }
                })

            })

        });

    </script>
@endsection

