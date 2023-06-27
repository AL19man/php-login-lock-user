# php login lock user


some tests to prevent bruteforce with random user lock . 
this code not prevent from SQL injection   
need to be used couple functions  
mysqli_real_escape_string($db, $password);
