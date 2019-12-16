<?php 
set_time_limit(0); 

include "../config.php";

$to = "backup@tgp.vn";

$date = date("d-m-y_h-i-a"); 
$dbserver = $host; 
$dbname = $csdl; 
$file = $dbname.".sql.gz"; 
$gzip = TRUE; 
$silent = FALSE; 

function gwrite($contents) { 
   if ($GLOBALS['gzip']) { 
      gzwrite($GLOBALS['fp'], $contents); 
   } else { 
      fwrite($GLOBALS['fp'], $contents); 
   } 
} 

mysql_connect ($dbserver, $dbuser, $dbpass); 
mysql_select_db($dbname); 

@unlink( $file );

if ($gzip) { 
   $fp = gzopen($file, "w"); 
} else { 
   $fp = fopen($file, "w"); 
} 

$message ="<font face='Courier New' size=2><B>The Gioi Phang - MySQL Backup ... </b><br>";
$message.="Database : <br>"
		. "<br>";

echo $message;

$tables = mysql_query ("SHOW TABLES"); 
while ($i = mysql_fetch_array($tables)) { 
   $i = $i['Tables_in_'.$dbname]; 

   if (!$silent) { 
      $nd = "+ Table : ".$i." ...<br>";
	  echo $nd;
	  $message .= $nd;
   } 

   // Create DB code 
   $create = mysql_fetch_array(mysql_query ("SHOW CREATE TABLE ".$i)); 

   gwrite($create['Create Table'].";\n\n"); 

   // DB Table content itself 
   $sql = mysql_query ("SELECT * FROM ".$i); 
   if (mysql_num_rows($sql)) { 
      while ($row = mysql_fetch_row($sql)) { 
         foreach ($row as $j => $k) { 
            $row[$j] = "'".mysql_escape_string($k)."'"; 
         } 

         gwrite("INSERT INTO $i VALUES(".implode(",", $row).");\n"); 
      } 
   } 
} 

$gzip ? gzclose($fp) : fclose ($fp); 

echo "<br>";

// Optional Options You May Optionally Configure 

$use_gzip = "yes";            // Set to No if you don't want the files sent in .gz format 

// MAIL CONFIG
// Configure the path that this script resides on your server. 

$savepath = ""; // Full path to this directory. Do not use trailing slash! 

$send_email = "yes";                        /* Do you want this database backup sent to your email? Yes/No? If Yes, Fill out the next 2 lines */ 
$from  = "MySQL Backup <support@vinahoster.com>";    // Who to send the emails to, enter ur correct id. 

$senddate = date("d/m/y h:ia"); 

$subject = "Database : $dbname .::. $senddate"; // Subject in the email to be sent. 
$message .= "<br><b>Your MySQL database has been backed up and is attached to this email</b>"; // Brief Message. 

// FTP CONFIG
$use_ftp = "no";                             // Do you want this database backup uploaded to an ftp server? Fill out the next 4 lines 
$ftp_server = "";               // FTP hostname 
$ftp_user_name = ""; // FTP username 
$ftp_user_pass = "";   // FTP password 
$ftp_path = "/"; // This is the path to upload on your ftp server! 

// Do not Modify below this line! It will void your warranty :-D! 

if($use_gzip=="yes"){ 
 $filename2 = $file; 
} else { 
 $filename2 = "$savepath/$dbname-$date.sql"; 
} 

if($send_email == "yes" ){ 
 $fileatt_type = filetype($filename2); 
 $fileatt_name = $dbname."-".$date.".sql.gz"; 
  
 $headers = "From: $from"; 
  
 // Read the file to be attached ('rb' = read binary) 
 $file = fopen($filename2,'rb'); 
 $data = fread($file,filesize($filename2)); 
 fclose($file); 

 // Generate a boundary string 
 $semi_rand = md5(time()); 
 $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

 // Add the headers for a file attachment 
 $headers .= "\nMIME-Version: 1.0\n" ."Content-Type: multipart/mixed;\n" ." boundary=\"{$mime_boundary}\""; 

 // Base64 encode the file data 
 $data = chunk_split(base64_encode($data)); 

 // Add a multipart boundary above the plain message 
 $message = "This is a multi-part message in MIME format.\n\n"
			."--{$mime_boundary}\n"
			."Content-Type:text/html; charset=\"utf-8\"\n"
			."Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
			// Add file attachment to the message 
 $message .= "--{$mime_boundary}\n"
			."Content-Type: {$fileatt_type};\n"
			." name=\"{$fileatt_name}\"\n"
			."Content-Disposition: attachment;\n"
			." filename=\"{$fileatt_name}\"\n"
			."Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"
			."--{$mime_boundary}--\n";

 // Send the message 
 $ok = @mail($to, $subject, $message, $headers); 
}
?> 