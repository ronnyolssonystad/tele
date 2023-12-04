<!DOCTYPE html>


<style>
<?php
    include 'formstyle.css';
?>
</style>    



<html lang="en">
<head>
    
<title>Kontakt</title>
</head>
<body>
    <div>
  <form action='php/newpers.php' method="POST">
    <fieldset>
    <h1>Detaljer</h1>
    <p>
        Förnamn: <input type = "text" name = "fname" />
    </p>
    <p>
        Efternamn: <input type = "text" name = "lname" />
    </p>
    <p>
        Adress: <input type = "text" name = "adress" />
    </p>
    <p>
        Nummer: <input type = "text" name = "nr" />
    </p>
    <p>
        Våning: <input type = "text" name = "etage" />
    </p> 
    <p>
        Telefonnummer: <input type = "text" name = "tel1" />
    </p>
    <p>
        Telefonnummer 2: <input type = "text" name = "tel2" />
    </p> 
    <p>
        email: <input type = "email" name = "email" />
    </p>    
 <p>
      <input type = "submit" name = "submit" value = "Spara" />
    </p>
</fieldset>
</form>
</div>
</body>
</html>