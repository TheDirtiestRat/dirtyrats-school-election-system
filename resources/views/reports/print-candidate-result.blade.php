<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@include('components.app-name')</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    {{-- html head links --}}
    @yield('head-links')

    @vite(['resources/js/app.js', 'resources/css/app.css'])


    <link href="{{ asset('storage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
</head>

<body>
    <main>
        <div class="vh-100 p-4">
            {{-- content body --}}
            <div class="text-center mt-3">
                <h1>@include('components.app-name')</h1>
                <h3>Results</h3>
            </div>

            <div class="p-3 rounded shadow">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr class="text-center">
                            <th colspan="4" class="text-start">Voters : <strong>{{ $registered_voters }}</strong>
                            </th>
                            <th>Voted : <strong>{{ $voted_voters }}</strong></th>
                            <th>Remaining : <strong>{{ $remaining }}</strong></th>
                        </tr>
                        <tr class="text-center">
                            <th scope="col">Photo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th>Agreed</th>
                            <th scope="col">Voted</th>
                            <th scope="col">%</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @for ($i = 0; $i < $positions->count(); $i++)
                            {{-- list of positions --}}
                            <tr>
                                <td colspan="6">
                                    <h1>{{ $positions[$i]->name }}</h1>
                                </td>
                            </tr>
                            {{-- list of candidatates --}}
                            @forelse ($candidates as $candidate)
                                @if ($candidate->position == $positions[$i]->name)
                                    <tr>
                                        <td><img src="{{ asset('storage/candidate img/' . $candidate->photo) }}"
                                                alt="" class=" rounded-4 " width="100px">
                                        </td>
                                        <td class="fw-bold">
                                            <h4>{{ $candidate->name }}</h4>
                                        </td>
                                        <td class="text-center">{{ $candidate->position }}</td>
                                        @php
                                            $vote = [];

                                            foreach ($votes as $key => $value) {
                                                if ($value->candidate == $candidate->id) {
                                                    $vote = $value;
                                                }
                                            }
                                            // yes or no of each candidates
                                            $yes = [];
                                            $no = [];
                                            foreach ($agree_votes as $key => $value) {
                                                if ($value->candidate == $candidate->id) {
                                                    $yes = $value;
                                                }
                                            }
                                            foreach ($disagree_votes as $key => $value) {
                                                if ($value->candidate == $candidate->id) {
                                                    $no = $value;
                                                }
                                            }
                                        @endphp
                                        <td class="text-center">
                                            Yes -
                                            @if ($yes == null)
                                                0
                                            @else
                                                {{ $yes->total }}
                                            @endif
                                            No - @if ($no == null)
                                                0
                                            @else
                                                {{ $no->total }}
                                            @endif
                                        </td>
                                        <td class="fw-bold text-center">
                                            @if ($vote == null)
                                                0
                                            @else
                                                {{ $vote->total }}
                                            @endif
                                            {{-- {{ $candidate->total }} --}}
                                        </td>
                                        <td>
                                            <h1 class="text-center">
                                                @if ($vote == null)
                                                    %0
                                                @else
                                                    {{ round(($vote->total / $registered_voters) * 100, 2) }}%
                                                @endif
                                            </h1>
                                            {{-- <h1 class="text-center">
                                                {{ round(($candidate->total / $registered_voters) * 100, 2) }}%</h1> --}}
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="5">No top yet</td>
                                </tr>
                            @endforelse
                        @endfor



                        {{-- @forelse ($top_candidates as $candidate)
                            <tr>
                                <td><img src="{{ asset('storage/candidate img/' . $candidate->photo) }}" alt=""
                                        class=" rounded-4 " width="100px">
                                    </th>
                                <td class="fw-bold">
                                    <h4>{{ $candidate->name }}</h4>
                                </td>
                                <td class="text-center">{{ $candidate->position }}</td>
                                <td class="fw-bold text-center">{{ $candidate->total }}</td>
                                <td>
                                    <h1 class="text-center">
                                        {{ round(($candidate->total / $registered_voters) * 100, 2) }}%</h1>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th scope="row"></th>
                                <td>No top yet</td>
                                <td></td>
                                <td class="fw-bold"></td>
                                <td></td>
                            </tr>
                        @endforelse --}}
                    </tbody>
                </table>
            </div>

            <div class="m-2">
                Develop by <a href="https://www.tiktok.com/@thedirtiestrat">Mr. Dirtiest Rat (Dunhill Mar Louise
                    Leal)</a>
            </div>
        </div>
    </main>

    <script src="{{ asset('storage/assets/vendor/tinymce/tinymce.min.js') }}"></script>
</body>

</html>
