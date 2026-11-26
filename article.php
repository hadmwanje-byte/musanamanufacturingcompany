<?php
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';

$slug = (string) ($_GET['slug'] ?? '');
$post = preg_match('/^[a-z0-9\-]{1,160}$/', $slug)
    ? q('SELECT slug, title, excerpt, body, published_at FROM posts WHERE slug = :s', ['s' => $slug])->fetch()
    : false;

if (!$post) {
    http_response_code(404);
    $page_title = 'Article not found';
    $meta_desc  = 'The article you are looking for could not be found.';
    $robots = 'noindex, follow';
    $nav = 'news';
    include __DIR__ . '/includes/header.php';
    echo '<section class="section"><div class="container prose"><h1>Article not found</h1><p>Sorry, we could not find that article.</p><p><a class="btn" href="' . e(page_url('news')) . '">Back to news</a></p></div></section>';
    include __DIR__ . '/includes/footer.php';
    exit;
}

$page_title = $post['title'];
$meta_desc  = $post['excerpt'];
$og_type    = 'article';
$nav        = 'news';
$canonical  = site_origin() . '/' . (CLEAN_URLS ? 'news/' . rawurlencode($post['slug']) : 'article.php?slug=' . rawurlencode($post['slug']));
include __DIR__ . '/includes/header.php';
?>
<section class="page-banner">
  <div class="container"><h1><?= e($post['title']) ?></h1><p>Published <?= e(format_date($post['published_at'], 'j F Y')) ?></p></div>
</section>
<article class="section">
  <div class="container prose article-body">
    <?php
    foreach (preg_split('/\R{2,}/', trim($post['body'])) as $block) {
        $block = trim($block);
        if ($block === '') {
            continue;
        }
        if (str_starts_with($block, '## ')) {
            echo '<h2>' . e(substr($block, 3)) . '</h2>';
        } else {
            echo '<p>' . e($block) . '</p>';
        }
    }
    ?>
    <p><a class="btn" href="<?= e(page_url('news')) ?>">&larr; Back to news</a></p>
  </div>
</article>
<?php include __DIR__ . '/includes/footer.php'; ?>
