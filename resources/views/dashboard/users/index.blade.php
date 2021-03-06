@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Users

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dahboard</a></li>
                <li><a href="{{ route('users.index') }}"> Users</a></li>

            </ol>
        </section>

        <!-- Main content -->

        <!-- /.content -->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 20px"> <small>{{ $users->total() }}</small></h3>
                    <!-- search data -->
         <form action="{{ route('users.index')}}" method="get">
             <div class="row">
                 <div class="col-md-4">
                     <input type="text" name="search" class="form-control" placeholder="search user" value="{{ request()->search }}">
                 </div>
                 <div class="col-md-4">
                     <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-search"></i> Search</button>
                     @if (auth()->user()->hasPermission('create_users'))
                     <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus"> </i> ADD</a>
                        @else
                        <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"> </i> ADD</a>
                     @endif

                 </div>
             </div>
         </form>

                </div><!-- end of box header -->
                <div class="box-body">
                    <!-- check user counts-->
                    @if($users->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $index=>$user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name}}</td>

                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <img src="{{ $user->image_path}}" style="width: 50px" class="img-thumbnail">
                                    </td>

                       <td>
                           @if (auth()->user()->hasPermission('update_users'))
                           <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
                           @else
                           <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-trash"></i>Edit</a>
                           @endif


                           @if (auth()->user()->hasPermission('delete_users'))
                           <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline-block">
                            {{ csrf_field()}}
                            {{ method_field('delete')}}
                            <button class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                        </form>
                           @else
                           <button class="btn btn-danger btn-sm disabled">Delete</button>
                           @endif
                       </td>


                                </tr>
                                @endforeach
                            </tbody><!-- end tbody -->

                        </table><!-- end of table -->
                        <!--pagination link -->
                        <!--appends prevent guery search deleted from url -->
                       @else
                       <p> No Users Data Found<p>

                   @endif
                   {{ $users->appends(request()->query())->links() }}

                </div><!-- end of box body -->
            </div><!-- end of box  -->

        </section>
    </div>


@endsection
