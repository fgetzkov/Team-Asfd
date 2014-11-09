<?php
session_start();
header('Content-Type: application/json');
$command = htmlspecialchars(file_get_contents('php://input'));
$response = new StdClass();
$student = "dmanchev";

if(empty($command)) {
    $error = true;
} else {
    switch($command) {
        case "arp -a":
            $result = "
? (192.168.0.1) ivan-pc on en0 ifscope [ethernet]
? (192.168.0.100) gov-pc on en0 ifscope permanent [ethernet]
? (192.168.0.102) sec-pc on en0 ifscope [ethernet]
? (192.168.0.107) admin-pc on en0 ifscope [ethernet]
? (192.168.0.110) backup on en0 ifscope [ethernet]
? (192.168.0.115) sec2 on en0 ifscope [ethernet]
? (192.168.0.255) broadcast on en0 ifscope [ethernet]
            ";
            break;
        case "ssh 192.168.0.107":
            $result = "sshed";
            break;
        case "ssh 129.124.65.8 -u root -p f34gbw2fs":
            $result = "sshed2";
            break;
        case "cat ftp.txt":
            $result = "
ftp server: cleverguard.com
user: susi@cleverguard.com
pass: KN7]JL1uCHsT
            ";
            break;
        case "cat /usr/var/www/public_html/config.php":
            $result = <<<'EOT'
<?php
$host = "localhost";
$user = "susi";
$password = "c32f24fv";
$db = "susidb";
?>
EOT;
            break;
        case "mysql -u susi -p c32f24fv":
            $result = "mysqled";
            break;
        case "USE susidb;":
            $result = "Database changed";
            break;
        case "show tables;":
            $result = "
+-----------------------+
| Tables_in_susidb      |
+-----------------------+
| students              |
| exams                 |
| admins                |
| options               |
| subjects              |
| logs                  |
| roles                 |
+-----------------------+
7 rows in set (0.00 sec)
            ";
            break;
        case "UPDATE exams SET passed = 1 WHERE student = $student;":
            $result = "Query OK, 7 rows affected (0.01 sec)";
            break;
        default:
            $error = true;
    }
}

if(isset($error)) {
    $response = [
        'error' => "Unknown command"
    ];
} else {
    $response = [
        'response' => $result,
    ];
}

echo json_encode($response);