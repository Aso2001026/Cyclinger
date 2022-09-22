<div class = "menuToggle">
    <input type = "checkbox" />
       <span></span>
       <span></span>
       <span></span>
     <ul class = "menu">
        <?php if(!empty($_SESSION['user']))  :?>
     	    <a href = "../PassCheck/PassCheck.php"><li>Setting</li></a>
            <a href = "../Calender/Calender.php"><li>Calendar</li></a>
            <a href = "../Logout/Logout.php"><li>Logout</li></a>
        <?php else:?>
            <a href = "../login/Login.php"><li>Login</li></a>
        <?php endif;?>
         <a href = ""><li class = "title">cyclringer</li></a>
      </ul>
</div>