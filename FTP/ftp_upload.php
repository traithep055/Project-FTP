<?php
$ftp_server = 'ftp-server';
$ftp_port = 21;
$ftp_user_name = 'ftp_user';
$ftp_user_pass = 'ftp_password';
$ftp_send_file = '/hoge/data.txt';
$ftp_remote_file = '/hoge/data.txt';

// FTPサーバへ接続する
$conn_id = ftp_connect($ftp_server, $ftp_port);
if($conn_id == false){
    echo "FTPサーバへの接続失敗"."\n";
    exit();
}

// ユーザー名とパスワードでログインする
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
if($login_result == false){
    echo "FTPサーバへのログイン失敗"."\n";
    // 接続を閉じる
    ftp_close($conn_id);
    exit();
}

//パッシブモードに設定
ftp_pasv($conn_id, true);

// ファイルをアップロードする
if (ftp_put($conn_id, $ftp_remote_file, $ftp_send_file, FTP_BINARY)) {
    echo "UPLOAD 成功"."\n";
} else {
    echo "UPLOAD 失敗"."\n";
}

// 接続を閉じる
ftp_close($conn_id);