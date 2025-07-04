@extends('admin.adminDashboard')

@section('content')
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->type }}</td>
            <td>
                <form action="{{ route('admin.destroy',$user->id) }}" method="POST">
   

                    <a class="btn btn-primary" href="{{ route('admin.edit',$user->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>

               

                </form>
            </td>
            
        </tr>
        @endforeach
    </table>
     {!! $users->links() !!}

</body>
</html>
@endsection

