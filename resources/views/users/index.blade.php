@extends('layouts.admin')
@section('main-content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="page-header">All Admin Panel Users</h1>
            </div>
            <div class="col-lg-12">
                <!-- </div> -->

                <!-- <div class="row"> -->
                <div class="card shadow mb-4">
                    <div class="card-body">

                        <!-- search bar and add new product -->
                        <div class="row text-center">


                            <div class=" col  mb-2">
                                <a href="{{ route('users.create') }}" class="btn btn-success float-right mb-2">Create New
                                    User</a>
                            </div>

                        </div>
                        <!-- search bar and add new product -->
                        @if ($users->count())
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th width="280px">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($users as $key => $user)

                                            <tr>

                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    {{ $user->getRoleNames()[0] }}
                                                </td>

                                                <td>
                                                    <a class="btn btn-info"
                                                        href="{{ route('users.show', $user->id) }}">Show</a>
                                                    <a class="btn btn-primary"
                                                        href="{{ route('users.edit', $user->id) }}">Edit</a>


                                                    <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit"
                                                    href="{{ route('users.destroy', $user->id) }}"
                                                    >Delete </button>
                                                    </form>


                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        @else
                            <hr class="sidebar-divider my-0">
                            <h4 class="text-center mt-3">No users to show.</h4>
                        @endif
                    </div>

                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
            <!-- </div> -->
        </div>

    @endsection
