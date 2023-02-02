<?php
$ftp_server = 'ftp-server';
$ftp_port = 21;
$ftp_user_name = 'ftp_user';
$ftp_user_pass = 'ftp_password';
$ftp_send_file = '/hoge/data.txt';
$ftp_remote_file = '/hoge/data.txt';

// เชื่อมต่อกับเซิร์ฟเวอร์ FTP
$conn_id = ftp_connect($ftp_server, $ftp_port);
if($conn_id == false){
    echo "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ FTP"."\n";
    exit();
}

// เข้าสู่ระบบด้วยชื่อผู้ใช้และรหัสผ่าน
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
if($login_result == false){
    echo "เข้าสู่ระบบเซิร์ฟเวอร์ FTP ล้มเหลว"."\n";
    // ปิดการเชื่อมต่อ
    ftp_close($conn_id);
    exit();
}

//ตั้งเป็นโหมดพาสซีฟ
ftp_pasv($conn_id, true);

// อัพโหลดไฟล์
if (ftp_put($conn_id, $ftp_remote_file, $ftp_send_file, FTP_BINARY)) {
    echo "UPLOAD สำเร็จ"."\n";
} else {
    echo "UPLOAD ล้มเหลว"."\n";
}

// ปิดการเชื่อมต่อ
ftp_close($conn_id);