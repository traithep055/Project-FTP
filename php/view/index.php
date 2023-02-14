<?php
if (isset($_POST['submit'])) {
  // FTP connection settings
  $ftp_server = "localhost";
  $ftp_username = "username";
  $ftp_password = "mypass";

  // connect to FTP server
  $conn_id = ftp_connect($ftp_server) or die("Could not connect to FTP server");

  // login to FTP server
  if (@ftp_login($conn_id, $ftp_username, $ftp_password)) {
    // change to the appropriate directory
    ftp_chdir($conn_id, "/home/ftpuser");   //C:/uploadFTP

    // get the uploaded file
    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // upload the file
    if (ftp_put($conn_id, $file, $file_tmp, FTP_BINARY)) {
      echo "File uploaded successfully";
    } else {
      echo "Error uploading file";
    }
  } else {
    echo "Could not login to FTP server";
  }

  // close the FTP connection
  ftp_close($conn_id);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload a file to FTP server</title>
</head>
<body>
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
  </form>
</body>
</html>