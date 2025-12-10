<?php
// إعدادات الاتصال
$host = '127.0.0.1';
$dbname = 'u756060582_retirees';
$username = 'u756060582_retirees'; // غير ده
$password = 'o1m2r3e4l5Q!Q'; // غير ده

// الاتصال بالداتابيز
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // فتح ملف CSV
    $csvFile = 'your_file.csv'; // حط اسم الملف هنا
    $file = fopen($csvFile, 'r');

    // تخطي الصف الأول (Headers)
    fgetcsv($file);

    // تحضير الـ SQL Statement
    $sql = "INSERT INTO member_applications (
        membership_number, full_name, national_id, email, emirate, 
        retirement_date, mobile_phone, created_at, expiration_date, 
        early_reason, educational_qualification, date_of_birth, gender, 
        previous_experience, contract_type, professional_experiences, status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '[]', 1)";

    $stmt = $pdo->prepare($sql);

    $count = 0;
    // قراءة كل صف وإدخاله
    while (($row = fgetcsv($file)) !== FALSE) {
        try {
            $stmt->execute($row);
            $count++;
            echo "تم إدخال الصف رقم: $count<br>";
        } catch (Exception $e) {
            echo "خطأ في الصف رقم $count: " . $e->getMessage() . "<br>";
        }
    }

    fclose($file);
    echo "<br>✅ تم الانتهاء! تم إدخال $count صف بنجاح.";
} catch (PDOException $e) {
    die("خطأ في الاتصال: " . $e->getMessage());
}
