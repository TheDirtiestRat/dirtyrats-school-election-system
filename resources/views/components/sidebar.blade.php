<aside id="sidebar" class="sidebar rounded-4 shadow mt-2">

    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- for admin only --}}
        @if (Auth::user()->type == 'ADMIN')
            <li class="nav-heading">Administrator</li>

            <li class="nav-item">
                <a class="nav-link " href="{{ url('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Candidates</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('candidates.create') }}">
                            <i class="bi bi-circle"></i><span>Add new Candidate</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('candidates.index') }}">
                            <i class="bi bi-circle"></i><span>Candidate List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('positions.index') }}">
                            <i class="bi bi-circle"></i><span>Positions</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Voters</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('registeredVoters') }}">
                            <i class="bi bi-circle"></i><span>Registered Voters</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ url('signedVoters') }}">
                            <i class="bi bi-circle"></i><span>Signed Voters</span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ url('votedVoters') }}">
                            <i class="bi bi-circle"></i><span>Voted Voters</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('remainingVoters') }}">
                            <i class="bi bi-circle"></i><span>Remaining Voters</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('importVoters') }}">
                            <i class="bi bi-download fs-5"></i><span>Import Voters</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        @endif

        @if (Auth::user()->type == 'VIEW' || Auth::user()->type == 'ADMIN')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('Live') }}" target="_blank">
                            <i class="bi bi-circle"></i><span>Live</span>
                        </a>
                    </li>
                    @if (Auth::user()->type == 'ADMIN')
                        <li>
                            <a href="{{ url('votersReports') }}">
                                <i class="bi bi-circle"></i><span>Voters</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('candidatesReports') }}">
                                <i class="bi bi-circle"></i><span>Candidates</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li><!-- End Tables Nav -->
        @endif


        @if (Auth::user()->type == 'SCANNER' || Auth::user()->type == 'ADMIN')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-qr-code-scan"></i><span>Scanner</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('scanner') }}">
                            <i class="bi bi-circle"></i><span>Scan Registered Voters</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('scannedList') }}">
                            <i class="bi bi-circle"></i><span>Scanned Voters</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Charts Nav -->
        @endif

        {{-- for voters, admin --}}
        @if (Auth::user()->type == 'VOTER')
            <li class="nav-heading">Voter Function</li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#voter-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i>
                    <span>Voter</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="voter-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('voteCandidates') }}">
                            <i class="bi bi-circle"></i><span>Vote</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('votedCandidates') }}">
                            <i class="bi bi-circle"></i><span>Voted Candidates</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('qrcodeID',  $voter_user->id) }}" target="_blank">
                            <i class="bi bi-circle"></i><span>Voter ID QR code</span>
                        </a>
                    </li> --}}
                </ul>
            </li><!-- End voter Page Nav -->
        @endif

        {{-- for admin only --}}
        @if (Auth::user()->type == 'ADMIN')
            <li class="nav-heading">Users Management</li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i>
                    <span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('user.create') }}">
                            <i class="bi bi-circle"></i><span>Add new Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.index') }}">
                            <i class="bi bi-circle"></i><span>Users list</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Users Page Nav -->

            <li class="nav-heading">Settings</li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#config-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear-wide-connected"></i>
                    <span>Configs</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="config-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('configuration') }}">
                            <i class="bi bi-circle"></i><span>Configuration</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Users Page Nav -->
        @endif

        <li class="nav-heading">Management</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('user.show', Auth::user()->id) }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
    </ul>

</aside><!-- End Sidebar-->
