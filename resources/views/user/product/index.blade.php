@extends('layouts.dash_master')
@section('title')
<title>{{__('dash.Dashboard')}}</title>
@endsection
@include('layouts.user_sidebar')
@section('dash-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('dash.Products')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('user.dashboard') }}">{{__('dash.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('dash.Products')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('user.product.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('dash.Add New')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th >{{__('dash.SN')}}</th>
                                    <th >{{__('dash.Name')}}</th>
                                    <th >{{__('dash.Icon')}}</th>
                                    <th >{{__('dash.Total Sale')}}</th>
                                    <th >{{__('dash.Status')}}</th>
                                    <th >{{__('dash.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $product)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td><a href="{{ route('user.product.edit',$product->id) }}">{{ $product->name }}</a></td>

                                        <td> <img src="{{asset('storage/files/'.($product->image))}}" width="80px" alt="{{$product->name}}"></td>
                                        <td> </td>
                                        <td>
                                            @if($product->status == 1)
                                                <span class="badge badge-success">{{__('dash.Active')}}</span>
                                            @else
                                                <span class="badge badge-danger">{{__('dash.Inactive')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                        <a href="{{ route('user.product.edit',$product->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $product->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>


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
        </section>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="canNotDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                        <div class="modal-body">
                            {{__('dash.You can not delete this product. Because there are one or more order has been created in this product.')}}
                        </div>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('dash.Close')}}</button>
                  </div>
              </div>
          </div>
      </div>
<script>
    "use strict";
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("user/product/") }}'+"/"+id)
    }
    function changeProductStatus(id){
        var isDemo = "{{ env('APP_VERSION') }}"
        if(isDemo == 0){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/user/product-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){
                console.log(err);

            }
        })
    }
</script>
@endsection
