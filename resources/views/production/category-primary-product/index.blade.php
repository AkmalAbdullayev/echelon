@extends('layouts.master')

@section('content')
    <section id="basic-datatable" class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Category Primary Products</h3>
                        <button type="button" class="btn btn-outline-success bx-pull-right" data-toggle="modal" data-target="#category-primary-product-create-modal">
                            Add Category
                        </button>
                    </div>
                </div>
                <hr>
                <div class="card-content">
                    <div class="card-body">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th width="100">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categoryPrimaryProducts as $category)
                                    <tr>
                                        <td class="name">{{ $category->name }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button data-id="{{ $category->id }}" data-toggle="modal" data-target="#category-primary-product-edit-modal" class="btn btn-outline-primary edit-btn">
                                                    <i class="bx bxs-pencil"></i>
                                                </button>
                                                <button data-id="{{ $category->id }}" class="btn btn-outline-danger delete-btn">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="category-primary-product-create-modal" tabindex="-1" role="dialog" aria-labelledby="category-primary-product-create-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="{{ route('category-primary-product.store') }}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="category-primary-product-create-title">Create Category Primary Products</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>
                    @csrf
                    <div class="modal-body">
                        <fieldset class="form-group">
                            <label for="roundText">Category name</label>
                            <input type="text" id="roundText" name="name" class="form-control round" placeholder="Category Primary Products" required>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Accept</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="category-primary-product-edit-modal" tabindex="-1" role="dialog" aria-labelledby="category-primary-product-edit-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="" id="edit-form" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="category-primary-product-edit-title">Edit Category Primary Products</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-body">
                        <fieldset class="form-group">
                            <label for="input-name">Category name</label>
                            <input type="text" id="input-name" name="name" class="form-control round" placeholder="Category Primary Products" required>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Accept</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <form action="{{ route('category-primary-product.destroy', 1) }}" id="delete-form" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="id" id="delete-input-id">
    </form>
@endsection
@push('js')
    <script src="{{ asset('frest/app-assets/js/scripts/datatables/datatable.js') }}"></script>
    <script>
        $('.edit-btn').on('click', function () {
            var url = "{{ url('/') }}";
            var id = $(this).data('id');
            var name = $(this).parents('td').siblings('.name').text();
            $('#edit-form').attr('action', url+'/category-primary-product/'+id);
            $('#input-name').val(name);
        });
        $('.delete-btn').on('click', function () {
            $('#delete-input-id').val($(this).data('id'));
            alertify.confirm("Are you sure?", function () {
                $('#delete-form').submit();
            }).set({title:"Confirmation"}).set({labels:{ok:'Yes', cancel: 'No'}});
        });
    </script>
@endpush
