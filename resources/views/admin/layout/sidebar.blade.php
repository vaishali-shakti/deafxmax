<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="d-xl-none d-lg-none text-white" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav flex-column">
            <li class="nav-item">
              <a class="nav-link {{ routeActive('dashboard') }} " href="{{ route('dashboard') }}"  aria-expanded="false">
                <i class="fa fa-fw fa-user-circle"></i>Dashboard
              </a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link {{ routeActive('consultant.index') }}{{ routeActive('consultant.create') }}{{ routeActive('consultant.edit') }}" href="{{ route('consultant.index') }}"  aria-expanded="false">
                <i class="fas fa-users"></i>Consultant
              </a>
            </li> --}}
            @if(auth()->user()->role_id == 1)
            <li class="nav-item">
              <a class="nav-link {{ routeActive('setting.index') }}{{ routeActive('setting.create') }}{{ routeActive('setting.edit') }}" href="{{ route('setting.index') }}"  aria-expanded="false">
                <i class="fa fa-cog"></i>Setting
              </a>
            </li>
            @endif
            {{-- @if(auth()->user()->role_id == 2) --}}
            <li class="nav-item">
              <a class="nav-link {{ routeActive('members.index') }}{{ routeActive('members.create') }}{{ routeActive('members.edit') }}{{ routeActive('members.destroy') }}" href="{{ route('members.index') }}" aria-expanded="false">
                <i class="fa fa-users"></i>Members
              </a>
            </li>
            {{-- @endif --}}
          </ul>
        </div>
      </nav>
    </div>
  </div>
