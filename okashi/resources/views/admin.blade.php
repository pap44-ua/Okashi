@extends('layouts.master')
@section('title', __('titles.admin'))
@section('content')
<div class="container my-5">
    <div id="upperAdmin" class="row bg-light p-3">
        <div id="listLinks" class="col-12 mb-4">
            <h5>{{ __('labels.list') }}</h5>
            <div class="d-flex flex-row justify-content-around flex-wrap">
                <a href="/admin/Product" class="btn btn-outline-primary m-1">{{ __('labels.products') }}</a>
                <a href="/admin/User" class="btn btn-outline-primary m-1">{{ __('labels.users') }}</a>
                <a href="/admin/Address" class="btn btn-outline-primary m-1">{{ __('labels.addresses') }}</a>
                <a href="/admin/ShoppingCart" class="btn btn-outline-primary m-1">{{ __('labels.shopping_carts') }}</a>
                <a href="/admin/Purchase" class="btn btn-outline-primary m-1">{{ __('labels.purchases') }}</a>
                <a href="/admin/PurchaseLine" class="btn btn-outline-primary m-1">{{ __('labels.purchase_lines') }}</a>
                <a href="/admin/Card" class="btn btn-outline-primary m-1">{{ __('labels.cards') }}</a>
            </div>
            <form action="{{ '/admin/' . $table }}" method="get" class="form-inline mt-3">
                @csrf
                <div class="form-group">
                    <select id="idOrder" name="idOrder" class="form-control" onchange="this.form.submit()">
                        <option value="asc">{{ __('labels.ascending') }}</option>
                        <option value="desc">{{ __('labels.descending') }}</option>
                    </select>
                </div>
            </form>
        </div>
        <div id="createLinks" class="col-12 mb-4">
            <h5>{{ __('labels.create') }}</h5>
            <div class="d-flex flex-row justify-content-around flex-wrap">
                <a href="/admin/create/Product" class="btn btn-outline-success m-1">{{ __('labels.products') }}</a>
                <a href="/admin/create/User" class="btn btn-outline-success m-1">{{ __('labels.users') }}</a>
                <a href="/admin/create/Address" class="btn btn-outline-success m-1">{{ __('labels.addresses') }}</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="adminTable" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    @foreach ($headers as $h)
                        <th>{{ $h }}</th>
                    @endforeach
                    <th>{{ __('labels.delete') }}</th>
                    <th>{{ __('labels.modify') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        @foreach ($headers as $h)
                            <td>{{ $d->$h }}</td>
                        @endforeach
                        <td>
                            <form action="{{ route( $table . '.delete', $d->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('buttons.delete') }}</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route( $table . '.modify', $d->id) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-warning">{{ __('buttons.modify') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $data->appends(request()->input())->links() }}
</div>

<script type="text/javascript">
    document.getElementById("idOrder").value = "{{ $order }}";
</script>
@endsection
