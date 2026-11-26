<?php
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';

/** Gallery rows live in includes/gallery_data.php: [file, category, title, description]. */
$rows = require __DIR__ . '/includes/gallery_data.php';
$cats = [];
foreach ($rows as $r) {
    $cats[$r[1]] = ($cats[$r[1]] ?? 0) + 1;
}

$page_title = 'Gallery';
$meta_desc  = 'Photo gallery of plywood products, production stages, quality checks, applications and deliveries at ' . SITE_NAME . '.';
$nav = 'gallery';
$canonical = site_origin() . '/' . (CLEAN_URLS ? 'gallery' : 'gallery.php');
include __DIR__ . '/includes/header.php';

/* Repeating size pattern gives the mixed-size "Modula" grid. */
$pattern = ['w2 h2', '', '', 'h2', '', 'w2', '', '', '', 'w2', '', 'h2', '', '', '', '', 'w2', '', ''];
?>
<section class="page-banner banner-gallery">
  <div class="container"><h1>Gallery</h1><p><?= count($rows) ?> images of our plywood, process and factory. Hover to read, click to enlarge.</p></div>
</section>

<section class="section">
  <div class="container">
    <div class="mod-filters" role="group" aria-label="Filter gallery">
      <button type="button" data-filter="all" aria-pressed="true">All (<?= count($rows) ?>)</button>
      <?php foreach ($cats as $c => $n): ?>
        <button type="button" data-filter="<?= e($c) ?>" aria-pressed="false"><?= e($c) ?> (<?= $n ?>)</button>
      <?php endforeach; ?>
    </div>
    <p class="mod-count" id="mod-count" aria-live="polite">Showing <?= count($rows) ?> images</p>

    <div class="modula">
      <?php foreach ($rows as $i => [$file, $cat, $title, $desc]): $size = $pattern[$i % count($pattern)]; ?>
        <a class="mod-item w1 <?= e($size) ?>" href="<?= e(photo($file)) ?>" data-cat="<?= e($cat) ?>" data-title="<?= e($title) ?>" data-desc="<?= e($desc) ?>" aria-label="<?= e($title . ': ' . $desc) ?>">
          <img src="<?= e(photo($file)) ?>" width="800" height="600" alt="<?= e($title . ' - ' . $desc) ?>" loading="lazy" decoding="async">
          <span class="mod-over" aria-hidden="true">
            <span class="mod-zoom">+</span>
            <span class="mod-cat"><?= e($cat) ?></span>
            <span class="mod-title"><?= e($title) ?></span>
            <span class="mod-desc"><?= e($desc) ?></span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<div class="lb" id="lightbox" role="dialog" aria-modal="true" aria-label="Image viewer">
  <button class="lb-btn lb-close" type="button" aria-label="Close">&times;</button>
  <button class="lb-btn lb-prev" type="button" aria-label="Previous image">&#8249;</button>
  <button class="lb-btn lb-next" type="button" aria-label="Next image">&#8250;</button>
  <div class="lb-box">
    <img alt="">
    <div class="lb-cap"><strong></strong><span></span><small></small></div>
  </div>
</div>

<section class="cta">
  <div class="container">
    <h2>Like what you see?</h2>
    <p>Ask us about sizes, thicknesses and prices.</p>
    <a class="btn btn-gold" href="<?= e(page_url('contact')) ?>">Contact us</a>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
