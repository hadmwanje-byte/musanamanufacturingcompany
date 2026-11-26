<?php
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';

$categories = q('SELECT DISTINCT category FROM products ORDER BY category')->fetchAll(PDO::FETCH_COLUMN);
$cat = trim((string) ($_GET['category'] ?? ''));
if ($cat !== '' && !in_array($cat, $categories, true)) {
    $cat = '';
}
$products = $cat === ''
    ? q('SELECT id, name, category, description FROM products ORDER BY category, name')->fetchAll()
    : q('SELECT id, name, category, description FROM products WHERE category = :c ORDER BY name', ['c' => $cat])->fetchAll();

$page_title = 'Products';
$meta_desc  = 'Browse the products made by ' . SITE_NAME . ' and ask us about bulk or custom orders.';
$nav = 'products';
$canonical = site_origin() . '/' . (CLEAN_URLS ? 'products' : 'products.php');
include __DIR__ . '/includes/header.php';
?>
<section class="page-banner banner-products">
  <div class="container"><h1>Our Products</h1><p>Plywood made in our factory, checked before it leaves.</p></div>
</section>

<section class="section">
  <div class="container">
    <div class="filters" role="navigation" aria-label="Product categories">
      <a href="<?= e(page_url('products')) ?>"<?= $cat === '' ? ' class="active"' : '' ?>>All</a>
      <?php foreach ($categories as $c): ?>
        <a href="<?= e(page_url('products') . '?category=' . rawurlencode($c)) ?>"<?= $cat === $c ? ' class="active"' : '' ?>><?= e($c) ?></a>
      <?php endforeach; ?>
    </div>
    <div class="grid grid-3">
      <?php foreach ($products as $p): ?>
        <article class="card">
          <?= photo_img(product_photo($p), $p['name'] . ' plywood sheet', 'th-img') ?>
          <span class="tag"><?= e($p['category']) ?></span>
          <h2 class="card-title"><?= e($p['name']) ?></h2>
          <p><?= e($p['description']) ?></p>
          <a class="btn btn-sm btn-wa" href="<?= e(whatsapp_link('Hello, I would like to ask about: ' . $p['name'])) ?>" target="_blank" rel="noopener noreferrer">Ask on WhatsApp</a>
        </article>
      <?php endforeach; ?>
      <?php if (!$products): ?><p>No products found.</p><?php endif; ?>
    </div>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
