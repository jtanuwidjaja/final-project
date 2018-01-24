
<script type="text/javascript">

</script> 
<!-- Static navbar -->
    <nav class="navbar navbar-inverse ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="calendar.php"><img src="images/MRBSicon.png" width="100px" height="25px" alt="">
          </a>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="navibar" class="nav navbar-nav">
            <li><a href="calendar.php">Home</a></li>
            <?php 
            if(($_SESSION["role"] == "1" || ($_SESSION["role"] == "0"))){
                echo '<li><a href="booking.php">Booking</a></li>';
                echo '<li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catalogue<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                ';
            }
            if ($_SESSION["role"] == "0") {
                echo '          <li><a href="branch.php">Branch</a></li>
                                <li><a href="building.php">Building</a></li>
                                <li><a href="faculty.php">Faculty</a></li>
                                <li><a href="room_list.php">Room List</a></li>
                                <li role="separator" class="divider"></li>
                ';
            }
            
            if (($_SESSION["role"] == "0") || ($_SESSION["role"] == "1")){
                echo '          <li><a href="tutor.php">Tutor</a></li>
                            </ul>
                     </li>
                ';
            }
            
            if ($_SESSION["role"] == "0") {
                echo '<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="user.php">User List</a></li>
                        </ul>
                      </li>
                ';
            }
            ?>          
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#" class="dropdown-item">Report1</a></li>
                <li><a href="#" class="dropdown-item">Report2</a></li>
                <li><a href="#" class="dropdown-item">Report3</a></li>
              </ul>
            </li>


                         
            <li><a href="contact.php">Contact us</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION["name"])) { echo '
            <li><a href="userinfo.php?ID='.$_SESSION["login"].'">'.$_SESSION["name"].'</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>'; }
            else {
                echo '
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>'; }?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


    <script type="text/javascript">
     $('document').ready(function() {
        $('.navbar-collapse li a').each(function() {
            if ('http://localhost/developer/'+$(this).attr('href') == window.location.href)
            {
                $(this).parent().addClass('active');
            }
        });
         $('.navbar-collapse li a').each(function() {
            if ('http://localhost/developer/'+$(this).attr('href') == window.location.href)
            {
                $(this).parent().parent().parent().addClass('active');
            }
        });
    }); 
      $('ul.nav li.dropdown').hover(function(){
        $('.dropdown-menu', this).fadeIn('fast');
      }, function(){
        $('.dropdown-menu', this).fadeOut('fast');
      });
      
     </script>
