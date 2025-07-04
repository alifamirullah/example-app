@extends( (auth()->user()->type == 'admin') ? 'admin.adminDashboard' : 'auth.dashboard')
 
@section('content')
    <div class="row">
        <div class="col-lg-8 margin-tb">
            <div class="pull-left">
            </div>

            <form action="{{ route('products.index') }}" name="search" method="POST">
                @csrf
                @method('get')
                <div class="form-group m-form__group row">
                    <div class="col-xl-8 col-lg-8">
                        <div class="input-group">
                        <input type="text" class="form-control m-input" placeholder="search" name="search" value="{{ old('search') }}" autocomplete="nofill">
                        <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="col-lg-4 margin-tb">
            @if(auth()->user()->type == 'seller')
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
            @endif
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th>Price</th>
            <th>Publish</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->detail }}</td>
            <td>RM {{ $product->price }}</td>
            <td>{{ $product->publish }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                    <p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-info" role="button">Add to cart</a></p>

                    @if(auth()->user()->type == 'seller')
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>

               

                    @endif
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  

    
      
@endsection
