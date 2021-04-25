

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <div class="container">
  <a class="navbar-brand" id="site-navbar" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
  <button class="navbar-toggler" id="navbar-btn-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT .'/pages/about'; ?>">About</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
     
      <!-- <?php if(isset($_SESSION['user_id'])){ ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT . '/users/logout'; ?>">Logout<span class="sr-only">(current)</span></a>
        </li>
      <?php }else{ ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT . '/users/register'; ?>">Register<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT .'/users/login'; ?>">Login</a>
          </li>
        <?php } ?>
      -->
    </ul>


  </div>
  </div>
</nav>