<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "manga_store";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // ตรวจสอบว่ารหัสผ่านและยืนยันรหัสผ่านตรงกัน
    if ($password !== $confirmPassword) {
        echo "รหัสผ่านไม่ตรงกัน";
        exit;
    }

    // เข้ารหัสรหัสผ่าน
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // ตรวจสอบอีเมลซ้ำในฐานข้อมูล
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "อีเมลนี้ถูกใช้แล้ว";
        exit;
    }

    // เพิ่มข้อมูลผู้ใช้ลงฐานข้อมูล
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "สมัครสมาชิกสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
}
?>
