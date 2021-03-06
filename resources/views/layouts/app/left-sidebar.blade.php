<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('public/adminBSB') }}/images/user.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>Log Out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ set_active('home') }}">
                <a href="{{ route('home') }}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            @hasrole('pegawai')
                <li class="{{ set_active('download.sk.index') }}">
                    <a href="{{ route('download.sk.index') }}">
                        <i class="material-icons">archive</i>
                        <span>Download SK</span>
                    </a>
                </li>
            @endhasrole
            
            @hasrole(['data-informasi'])
                <li class="{{ set_active(['nosk.index','uploadsk.index']) }}">
                    <a href="javascript:void(0)" class="menu-toggle">
                        <i class="material-icons">unarchive</i>
                        <span>Upload Data SK</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ set_active('uploadsk.index') }}">
                            <a href="{{ route('uploadsk.index') }}">
                                <span>Upload SK</span>
                            </a>
                        </li>
                        <li class="{{ set_active('nosk.index') }}">
                            <a href="{{ route('nosk.index') }}">
                                <span>Nomor SK</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ set_active('download.sk.index') }}">
                    <a href="{{ route('download.sk.index') }}">
                        <i class="material-icons">archive</i>
                        <span>Download Data SK</span>
                    </a>
                </li>
            @endhasrole

            @hasrole('administrator')
                <li class="{{ set_active(['master-data.index']) }}">
                    <a href="javascript:void(0)" class="menu-toggle">
                        <i class="material-icons">dvr</i>
                        <span>Master Data</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('master-data.index', ['params' => 'pegawai']) }}">
                                <span>Data Pegawai</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('master-data.index', ['params' => 'unit-kerja']) }}">
                                <span>Data Unit Kerja</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('master-data.index', ['params' => 'jenis-jabatan']) }}">
                                <span>Data Jenis Jabatan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('master-data.index', ['params' => 'jabatan']) }}">
                                <span>Data Jabatan</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ set_active('rekon.index') }}">
                    <a href="{{ route('rekon.index') }}">
                        <i class="material-icons">laptop</i>
                        <span>Rekon Data</span>
                    </a>
                </li>
                <li class="{{ set_active('user.index') }}">
                    <a href="{{ route('user.index') }}">
                        <i class="material-icons">person</i>
                        <span>User Manajemen</span>
                    </a>
                </li>
            @endhasrole
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2019 - {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>.
        </div>
        <div class="version">
            <b>Version: </b> <sup>beta</sup>
        </div>
    </div>
    <!-- #Footer -->
</aside>
