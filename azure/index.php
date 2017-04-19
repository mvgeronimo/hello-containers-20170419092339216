<?php

require(__DIR__.'/vendor/autoload.php');

?>
<br /><br />
<center>
<h1>Login</h1>
   <form action="result.php" method="POST">
      <table>
            <tr>
                   <td><label for="username">Email: </label></td>
                   <td><input  id="email" type="text" name="email" /> </td>
           </tr>
            <tr>
                   <td><label for="password">Password: </label></td>
                   <td><input id="password" type="password" name="password" /></td>
           </tr>
            <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Log-In" /></td>
           </tr>
   </table>
</form>
</center>