@extends('layouts.app')

@section('head-links')
    <link href="{{ asset('storage/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
@endsection

@section('body-content')
    <div class="container">
        <div class="pagetitle">
            <h1>List of Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active">Users List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        {{-- alert --}}
        @include('components.alert')

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title">Users</h5>
                            <p>This are the list of Users in the System.</p>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>
                                            Name of the User
                                        </th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Created at</th>
                                        <th>Updated At</th>
                                        {{-- <th data-type="date" data-format="YYYY/DD/MM">Updated At</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- list of users --}}
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <a href="{{ route('user.edit', $user->id) }}" class=" btn btn-sm btn-outline-dark w-100">
                                                    {{ $user->name }}
                                                </a>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->type }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{ $user->updated_at }}</td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">
                                            <h1 class="text-muted text-center">No Users</h1>
                                        </td>
                                    </tr>
                                    @endforelse
                                    {{-- @for ($i = 0; $i < 50; $i++)
                                        <tr>
                                            <td>9958</td>
                                            <td>Unity Pugh</td>
                                            <td>Curicó</td>
                                            <td>Col 3rd</td>
                                            <td>B</td>
                                            <td>2005/02/11</td>
                                        </tr>
                                        <tr>
                                            <td>65434</td>
                                            <td>Unity Pugh</td>
                                            <td>Curicó</td>
                                            <td>Col 3rd</td>
                                            <td>B</td>
                                            <td>2005/02/11</td>
                                        </tr>
                                    @endfor --}}
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@section('body-links')
    <script src="{{ asset('storage/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
@endsection
