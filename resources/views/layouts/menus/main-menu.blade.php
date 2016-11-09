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
          {!! Auth::user()->name !!} <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
          <li><a href="{!!URL::to('/users/'.Auth::user()->id)!!}"><i class="fa fa-user fa-fw"></i> {{ trans('strings.userprofile') }}</a>
          </li>
          <li class="divider"></li>
          <li><a href="{!!URL::to('/logout')!!}"><i class="fa fa-sign-out fa-fw"></i> {{ trans('strings.logout') }}</a>
          </li>
        </ul>
      </li>
    </ul>

    <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
          @if(session('lang') == "es")
              <li>
                <a href="{{ url('lang', ['en']) }}"><i class='fa fa-globe fa-fw'></i> {{ trans('strings.enlanguage') }}</a>
              </li>
          @else
              <li>
                <a href="{{ url('lang', ['es']) }}"><i class='fa fa-globe fa-fw'></i> {{ trans('strings.eslanguage') }}</a>
              </li>
          @endif
          @if(Auth::user()->p_superadmin == 1)
            <li>
              <a href="#"><i class="fa fa-user fa-fw"></i> {{ trans('strings.users') }}<span class="fa arrow"></span></a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="{!!URL::to('/users/create')!!}"><i class='fa fa-plus fa-fw'></i> {{ trans('strings.adduser') }}</a>
                </li>
                <li>
                  <a href="/users"><i class='fa fa-th-list fa-fw'></i> {{ trans('strings.listuser') }}</a>
                </li>
              </ul>
            </li>
          @endif
          <li>
            <a href="{!!URL::to('/customer-search')!!}"><i class='fa fa-search fa-fw'></i> {{ trans('strings.customersearch') }}</a>
          </li>
          @if(Auth::user()->p_admin == 1)
            <li>
              <a href="{!!URL::to('/possible-match/')!!}"><i class='fa fa-clone fa-fw'></i> {{ trans('strings.possiblematch') }}</a>
            </li>
          @endif
          <li>
            <a href="{!!URL::to('/master-record/create-customer')!!}"><i class='fa fa-plus fa-fw'></i> {{ trans('strings.newcustomer') }}</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>