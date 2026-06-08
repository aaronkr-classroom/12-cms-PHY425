<?php
// 슬라이드 53
declare(strict_types = 1); // 엄격한 타입 사용
require 'includes/database-connection.php'; // PDO 객체
require 'includes/functions.php';

// ----------
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // 아이디 유효성 확인
if (!$id) {
  include 'page-not-found.php';
}
// ----------

$sql = "SELECT a.title, a.summary, a.content, a.created, a.category_id, a.member_id,
               c.name AS category,
               CONCAT(m.forename, ' ', m.surname) AS author,
               i.file    AS image_file,
               i.alt     AS image_alt
          FROM article   AS a
          JOIN category  AS c ON a.category_id  = c.id
          JOIN member    AS m ON a.member_id    = m.id
         LEFT JOIN image AS i ON a.image_id     = i.id
        WHERE a.category_id = :id AND a.published = 1
        ORDER BY a.id DESC;"; // 최근 기사 가져오는 SQL
$articles = pdo($pdo, $sql, [$id])->fetchAll(); // 기사 6개 불러오기

$sql = "SELECT id, name FROM category WHERE navigation = 1;";
$navigation = pdo($pdo, $sql)->fetchAll();

$section    = $category['id'];
$title      = $category['name']; // HTML <title> tag
$description= $category['description']; // 메타 description
?>
<?php include 'includes/header.php'; ?>
  <main class="article container" id="content">
    <section class="image">
      <img src="uploads/<?= // @TODO ?>" 
           alt="<?= // @TODO ?>">
    </section>
    <section class="text">
      <h1><?= // @TODO ?></h1>
      <div class="date"><?= // @TODO ?></div>
      <div class="content"><?= // @TODO ?></div>
      <p class="credit">
        Posted in <a href="category.php?id=<?= $article['category_id'] ?>"><?= // @TODO ?></a> by <a href="member.php?id=<?= $article['member_id'] ?>">
          <?= // @TODO ?></a>
      </p>
    </section>
  </main>
<?php include 'includes/footer.php'; ?>