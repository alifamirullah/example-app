@extends( (auth()->user()->type == 'admin') ? 'admin.adminDashboard' : 'auth.dashboard')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">       
            <form class="mt-5 sm:flex sm:items-center" action="{{ route('products.index') }}" name="search" method="POST">
                @csrf
                @method('get')
                <input id="search" name="search" class="inline w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-3 leading-5 placeholder-gray-500 focus:border-indigo-500 focus:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" placeholder="Name" type="search" autofocus="" value="{{ old('search') }}">
                <button type="submit" class="inline w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Search</button>
            </form>
        </div>
        <div class="col-6">
            @if(auth()->user()->type == 'seller')
            <div class="pull-right">
                <a class="inline w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
            @endif
        </div>
    </div>
</div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <!-- ✅ Grid Section - Starts Here 👇 -->
    <section id="Projects"
        class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">
        @foreach ($products as $product)
        <!--   ✅ Product card 1 - Starts Here 👇 -->
        <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
            <a href="{{ route('products.show',$product->id) }}">
                <img src="@if($product->file != NULL){{ Storage::url($product->file) }} @endif"
                        alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
                <div class="px-4 py-3 w-72">
                    <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                    <p class="text-lg font-bold text-black truncate block capitalize">{{ $product->name }}</p>
                    <div class="flex items-center">
                        <p class="text-lg font-semibold text-black cursor-auto my-3">RM {{ $product->price }}</p>
                        <!-- <del>
                            <p class="text-sm text-gray-600 cursor-auto ml-2">$199</p>
                        </del> -->
                        <div class="ml-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg></div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </section>

   

    
      
@endsection
