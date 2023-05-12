<div class="navbar-bg"></div>

<nav class="navbar navbar-expand-lg main-navbar bg-primary">
  <div class="form-inline mr-auto">
    <ul class="navbar-nav mr-3 text-white">
      <li>
        <!-- <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"> <i data-feather="align-justify"></i></a> -->
        <h4><?= env('APP_NAME') ?><?= (isset($barTitle)) ? $barTitle :  ''  ?></h4>
      </li>
      <!-- <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a>
            </li> -->
      <li>
        <!-- <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form> -->
      </li>
    </ul>
  </div>
  <ul class="navbar-nav navbar-right">

    <?php if (auth()) : ?>

      <li class="dropdown">

        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
          <i class="fa fa-power-off" aria-hidden="true"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right pullDown">
          <div class="dropdown-title"><?= auth()->name ?></div>

          <a href="<?= base_url('logout') ?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
            Logout
          </a>
        </div>
      </li>

    <?php endif; ?>

  </ul>
</nav>