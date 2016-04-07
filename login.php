<?php
//session_destroy();

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

readfile("./template/head.html");

echo '
        <form action="../action.php" method="POST" class="navbar-form navbar-right" role="form">
        <input type="hidden" name="signin" value="signin">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="username" type="text" class="form-control" name="username" value="" placeholder="username">                                        
            </div>

            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="password" type="password" class="form-control" name="password" value="" placeholder="Kennwort">                                        
            </div>

            <button type="submit" class="btn btn-primary">Anmelden</button>
       </form>
    ';

readfile("./template/footer.html");

?>