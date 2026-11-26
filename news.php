<?php
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';

$posts = q('SELECT slug, title, excerpt, published_at FROM posts ORDER BY published_at DESC')->fetchAll();

$page_title = 'News';
$meta_desc  = 'News and articles from ' . SITE_NAME . ' about manufacturing, quality and our work in Uganda.';
$nav = 'news';
$canonical = site_origin() . '/' . (CLEAN_URLS ? 'news' : 'news.php');
include __DIR__ . '/includes/header.php';
?>
<section class="page-banner banner-news">
  <div class="container"><h1>News and Articles</h1><p>Updates from the factory floor.</p></div>
</section>
<section class="section">
  <div class="container">
    <div class="grid grid-2">
      <?php foreach ($posts as $post): ?>
        <article class="card card-img">
          <?= photo_img(['photo-021', 'photo-019', 'photo-032', 'photo-036', 'photo-069', 'photo-049'][crc32($post['slug']) % 6], $post['title'], '') ?>
          <div class="card-body">
          <p class="meta"><?= e(format_date($post['published_at'])) ?></p>
          <h2 class="card-title"><a href="<?= e(article_url($post['slug'])) ?>"><?= e($post['title']) ?></a></h2>
          <p><?= e($post['excerpt']) ?></p>
          <a href="<?= e(article_url($post['slug'])) ?>">Read the full article</a>
          </div>
        </article>
      <?php endforeach; ?>
      <?php if (!$posts): ?><p>No articles have been published yet.</p><?php endif; ?>
    </div>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
