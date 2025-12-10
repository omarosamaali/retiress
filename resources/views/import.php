<?php
// إعدادات الاتصال
$host = '127.0.0.1';
$dbname = 'u756060582_retirees';
$username = 'u756060582_retirees';
$password = 'o1m2r3e4l5Q!Q';

// الاتصال بالداتابيز
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // فتح ملف CSV
    $csvFile = 'data.csv';
    $file = fopen($csvFile, 'r');
    
    // تخطي الصف الأول (Headers)
    fgetcsv($file);
    
    // تحضير SQL لإدخال المستخدمين فقط
    $sql = "INSERT INTO users (email, password, name, created_at, updated_at) 
            VALUES (?, ?, ?, NOW(), NOW())";
    $stmt = $pdo->prepare($sql);
    
    $count = 0;
    
    // قراءة كل صف وإدخاله
    while (($row = fgetcsv($file)) !== FALSE) {
        try {
            // التحقق من وجود البريد الإلكتروني
            $email = trim($row[3]);
            
            // إذا كان البريد الإلكتروني فارغاً، استخدم رقم الهاتف + @gmail.com
            if (empty($email)) {
                $phone = trim($row[7]);
                $email = $phone . '@gmail.com';
                echo "ℹ️ تم إنشاء بريد إلكتروني: $email للمستخدم $row[1]<br>";
            }
            
            // تشفير رقم الهاتف (العمود 7) ككلمة مرور
            $hashedPassword = password_hash($row[7], PASSWORD_DEFAULT);
            
            $stmt->execute([
                $email,           // email (البريد الإلكتروني أو رقم الهاتف + @gmail.com)
                $hashedPassword,  // password (رقم الهاتف مشفر)
                $row[1]          // name (اسم العميل)
            ]);
            
            $count++;
            echo "✅ تم إضافة المستخدم رقم: $count - $row[1] ($email)<br>";
            
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "⚠️ المستخدم موجود مسبقًا: " . (empty(trim($row[3])) ? trim($row[7]) . '@gmail.com' : trim($row[3])) . "<br>";
            } else {
                echo "❌ خطأ في الصف رقم $count: " . $e->getMessage() . "<br>";
            }
        }
    }
    
    fclose($file);
    
    echo "<br><h3>✅ تم الانتهاء!</h3>";
    echo "<p>👥 تم إضافة <strong>$count</strong> مستخدم بنجاح.</p>";
    
} catch (PDOException $e) {
    die("❌ خطأ في الاتصال: " . $e->getMessage());
}
?>