<nav class="navbar navbar-expand-lg navbar-light bg-light" style="width: 100%">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">GreenIoT</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="controlPanel.php">Control Panel</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="readings.php">Readings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
    </ul>

    <div class="welcome">
      <?php echo $_SESSION['user_info']['name']  ?>, you are logged in. &nbsp; &nbsp;              
    </div>  

    <form class="form-inline my-2 my-lg-0">
      <a href="index.php?ac=logout" class="btn btn-outline-success my-2 my-sm-0">Logout</a>
    </form>
  </div>
</nav>