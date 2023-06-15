<div class="dashboard-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <a class="navbar-brand" href="../index-2.html"><img src="{{ getlogo('logo') != null ? getlogo('logo') : url('admin/assets/images/logo.png')}}" alt="" width="155px" height="34px"></a>
      <div class="ml-auto" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto navbar-right-top flex-row ">
          <li class="nav-item d-none d-lg-block">
            <div id="custom-search" class="top-search-bar">
              <input class="form-control" type="text" placeholder="Search..">
            </div>
          </li>
          <li class="nav-item dropdown notification order-4 ">
            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span
                class="indicator"></span></a>
            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
              <li>
                <div class="notification-title"> Notification</div>
                <div class="notification-list">
                  <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">
                      <div class="notification-info">
                        <div class="notification-list-user-img"><img src="{{ url('admin/assets/images/avatar-2.jpg') }}" alt=""
                            class="avatar-xs rounded-circle"></div>
                        <div class="notification-list-user-block"><span class="notification-list-user-name">Jeremy
                            Rakestraw</span>accepted your invitation to join the team.
                          <div class="notification-date">2 min ago</div>
                        </div>
                      </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                      <div class="notification-info">
                        <div class="notification-list-user-img"><img src="{{ url('admin/assets/images/avatar-3.jpg') }}" alt=""
                            class="avatar-xs rounded-circle"></div>
                        <div class="notification-list-user-block"><span class="notification-list-user-name">John
                            Deo</span>is now following you
                          <div class="notification-date">2 days ago</div>
                        </div>
                      </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                      <div class="notification-info">
                        <div class="notification-list-user-img"><img src="{{ url('admin/assets/images/avatar-4.jpg') }}" alt=""
                            class="avatar-xs rounded-circle"></div>
                        <div class="notification-list-user-block"><span class="notification-list-user-name">Monaan
                            Pechi</span> is watching your main repository
                          <div class="notification-date">2 min ago</div>
                        </div>
                      </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                      <div class="notification-info">
                        <div class="notification-list-user-img"><img src="{{ url('admin/assets/images/avatar-5.jpg') }}" alt=""
                            class="avatar-xs rounded-circle"></div>
                        <div class="notification-list-user-block"><span class="notification-list-user-name">Jessica
                            Caruso</span>accepted your invitation to join the team.
                          <div class="notification-date">2 min ago</div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </li>
              <li>
                <div class="list-footer"> <a href="#">View all notifications</a></div>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown connection d-none d-md-block">
            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
            <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
              <li class="connection-list">
                <div class="row">
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 ">
                    <a href="#" class="connection-item"><img src="{{ url('admin/assets/images/github.png') }}" alt="">
                      <span>Github</span></a>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 ">
                    <a href="#" class="connection-item"><img src="{{ url('admin/assets/images/dribbble.png') }}" alt="">
                      <span>Dribbble</span></a>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 ">
                    <a href="#" class="connection-item"><img src="{{ url('admin/assets/images/dropbox.png') }}" alt="">
                      <span>Dropbox</span></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 ">
                    <a href="#" class="connection-item"><img src="{{ url('admin/assets/images/bitbucket.pn') }}g" alt="">
                      <span>Bitbucket</span></a>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 ">
                    <a href="#" class="connection-item"><img src="{{ url('admin/assets/images/mail_chimp.png') }}"
                        alt=""><span>Mail chimp</span></a>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 ">
                    <a href="#" class="connection-item"><img src="{{ url('admin/assets/images/slack.png') }}" alt="">
                      <span>Slack</span></a>
                  </div>
                </div>
              </li>
              <li class="connection-footer">
                <div><a href="#">More</a></div>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown nav-user order-lg-4 ">
            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false"><img src="{{ auth()->user()->image }}" alt=""
                class="avatar-xs rounded-circle"></a>
            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
              <div class="nav-user-info">
                <h5 class="mb-0 text-white nav-user-name">{{ auth()->user()->name }}</h5>
                <span class="status"></span><span>Available</span>
              </div>
              <a class="dropdown-item" href="{{ route('profile_edit') }}"><i class="fas fa-user mr-2"></i>Update Profile</a>
              <a class="dropdown-item" href="{{ route('change_password') }}"><i class="fas fa-key mr-2"></i>Change Password</a>
              <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-power-off mr-2"></i>Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
