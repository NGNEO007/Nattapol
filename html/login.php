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
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ตรวจสอบข้อมูลในฐานข้อมูล
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $row['password'])) {
            echo "เข้าสู่ระบบสำเร็จ";
            // สามารถเพิ่มระบบการตั้ง session หรือ redirect ได้ที่นี่
        } else {
            echo "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        echo "อีเมลนี้ไม่พบในระบบ";
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
}
?>
