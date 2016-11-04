  <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{!!URL::to('/')!!}"><img src="{!!URL::to('/images/logo.svg')!!}"></a>
    </div>
       
    <ul class="nav navbar-top-links navbar-right">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
          algo@algo.com <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
          <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a>
          </li>
          <li class="divider"></li>
          <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
          </li>
        </ul>
      </li>
    </ul>

    <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
          <li>
            <a href="#"><i class="fa fa-user fa-fw"></i> Usuarios<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a href="#"><i class='fa fa-plus fa-fw'></i> Agregar Usuario</a>
              </li>
              <li>
                <a href="#"><i class='fa fa-th-list fa-fw'></i> Lista de Usuarios</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="{!!URL::to('/')!!}"><i class='fa fa-search fa-fw'></i> Customer Search</a>
          </li>
          <li>
            <a href="{!!URL::to('/possible-match/')!!}"><i class='fa fa-clone fa-fw'></i> Possible Match</a>
          </li>
          <li>
            <a href="#"><i class="fa fa-plus fa-fw"></i> New Customer Managment<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a href="#"><i class='fa fa-circle fa-fw'></i> New Customer</a>
              </li>
              <li>
                <a href="#"><i class='fa fa-circle fa-fw'></i> New Branch</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>