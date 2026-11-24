<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$dbname = 'my_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['text']);
        $plainPassword = $_POST['password'];

        $sql = "INSERT INTO users (text, password) VALUES (:text, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':text' => $email,
            ':password' => $plainPassword
        ]);

        echo '<img src="phote/ns.png" alt="تم الحفظ" style=  "width: 100%; height: 99%; object-fit: cover;">';
    }
} catch (PDOException $e) {
    echo "حدث خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage();
}
?>