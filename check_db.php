<?php
require_once __DIR__ . '/config/database.php';

try {
    $pdo->beginTransaction();

    $email = 'test' . time() . '@test.com';
    $password = '12345';
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (email, password_hash, role) VALUES (?, ?, 'member')");
    $stmt->execute([$email, $hash]);
    $userId = $pdo->lastInsertId();

    $catStmt = $pdo->prepare("SELECT id FROM member_categories ORDER BY id ASC LIMIT 1");
    $catStmt->execute();
    $cat = $catStmt->fetch();
    $categoryId = $cat ? $cat['id'] : null;

    if (!$categoryId) {
        $insCatStmt = $pdo->prepare("INSERT INTO member_categories (name, slug) VALUES (?, ?)");
        $insCatStmt->execute(['General', 'general']);
        $categoryId = $pdo->lastInsertId();
    }

    $name = 'Test';
    $slug = 'test-' . time();
    $department = 'CSE';
    $batch = '2k19';
    $phone = '123';
    $image_path = null;

    $stmt = $pdo->prepare("
        INSERT INTO members (user_id, category_id, name, slug, department, batch, phone, image_path, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'active')
    ");
    $stmt->execute([$userId, $categoryId, $name, $slug, $department, $batch, $phone, $image_path]);

    $pdo->rollBack();
    echo "SUCCESS";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . " at line " . $e->getLine();
}
