@extends('layouts.printables')

@section('title')
    Remaining Voters
@endsection

@section('content')
    <h1 class="text-center">Remaining Voters</h1>
    <h2 class="text-center">@include('components.app-name')</h2>

    <div class="shadow rounded-3 p-2">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th colspan="9">
                        <h4>TOTAL: {{ $total_remaining }}</h4>
                    </th>
                </tr>
                <tr>
                    <th>No.</th>
                    <th>Usn</th>
                    <th>Voter Id</th>
                    <th>Full Name</th>
                    <th>School Level</th>
                    <th>Year</th>
                    <th>Strand or Course</th>
                    <th>Section</th>
                    {{-- <th>Registered at</th> --}}
                </tr>
            </thead>

            <tbody>
                @php
                    $index = 1;
                @endphp
                {{-- registered voters list --}}
                @forelse ($voters as $voter)
                    <tr>
                        <td>{{ $index }}</td>
                        <td>{{ $voter->usn_or_lrn }}</td>
                        <td>
                            {{ $voter->voter_id }}
                        </td>
                        <td>{{ $voter->first_name }} {{ $voter->mid_name }} {{ $voter->last_name }}</td>
                        <td>{{ $voter->school_level }}</td>
                        <td>{{ $voter->year }}</td>
                        <td>{{ $voter->strand_or_course }}</td>
                        <td>{{ $voter->section }}</td>
                        {{-- <td>{{ $voter->created_at }}</td> --}}
                    </tr>
                    @php
                        $index++;
                    @endphp
                @empty
                    <tr>
                        <td colspan="9" class="text-center">
                            No registerd voters yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
