@extends('layouts.main')

@section('title')
Data Products
@endsection

@section('cssLibrary')
<link rel="stylesheet" href="{{asset('css/bootstrap-table.min.css')}}">
@endsection

@section("breadcrumb")
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item active">Products</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Data Products
    </div>
    <div class="card-body">
        <div id="toolbar">
            <div class="btn-group pr-1">
                <button type="button" id="btn-add" class="btn btn-app btn-dark" title="Add"
                    onclick="window.location.href='{{route('products.create')}}'"><i
                        class="fa fa-plus-circle"></i>Add</button>
                <button type="button" id="btn-remove" class="btn btn-app btn-dark is-disabled" title="Remove"
                    data-url="{{ route("products.destroySelected") }}" data-id-table="#table-products"
                    data-confirm="Are you sure remove this data?" disabled><i class="fa fa-trash"></i>Remove</button>
            </div>
        </div>

        <table id="table-products" data-url="{{url('/products/list')}}" data-advanced-search="true"
            data-id-table="advancedTable" data-sort-name="product_code" data-sort-order="asc">
            <thead>
                <tr>
                    <th data-field="check" data-checkbox="true"></th>
                    <th data-formatter="numRow" data-searchable="false" data-width="3">No</th>
                    <th data-field="product_code" data-sortable="true">Product Code</th>
                    <th data-field="product_name" data-sortable="true">Product Name</th>
                    <th data-field="qty" data-sortable="true">Qty</th>
                    <th data-field="price" data-sortable="true">Price</th>
                    <th data-field="action" data-searchable="false" data-align="center" data-width="5"
                        data-formatter="action">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!--modal detail-->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section("jsLibrary")
<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
<script src="{{asset('js/bootstrap-table.bundle.min.js')}}"></script>
@endsection

@section("scriptJS")
<script>
    /*
    Bootstrap-table
    */
    loadBootstrapTable('#table-products');

    function action(value, row, index) {
        let routeEdit = '{{ route("products.edit", ":id") }}';
        routeEdit = routeEdit.replace(':id', row.id);

        let routeDelete = '{{ route("products.destroy", ":id") }}';
        routeDelete = routeDelete.replace(':id', row.id);

        let button = [
            `<button class="dropdown-item" type="button" data-toggle="modal" onclick="showDetail(${row.id})" data-target="#detailModal"><i class="c-icon mfe-2 fa fa-bars"></i>Detail</button>`,
            `<button class="dropdown-item" type="button" onclick="window.location.href='${routeEdit}'"><i class="c-icon mfe-2 far fa-edit"></i>Edit</button>`,
            `<button class="dropdown-item" data-id-table="#table-products" data-url="${routeDelete}" data-confirm="Are you sure remove this data?"><i class="c-icon mfe-2 far fa-trash-alt"></i>Hapus</button>`
        ];

        return actLayout(button);
    }

    function numRow(value, row, index) {
        return getNumRow('#table-products') + index;
    }

    function showDetail(id) {
        let routeDetail = '{{ route("products.show", ":id") }}';
        routeDetail = routeDetail.replace(':id', id);
        
        $.ajax({
            type: 'GET',
            url: routeDetail,
            success: function (data) {
                $('#detailModal').find('.modal-body').html(data);
                $('#detailModal').modal({show: true});
            }
        });
    }

</script>
@endsection
