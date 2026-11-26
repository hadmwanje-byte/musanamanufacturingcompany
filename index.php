<?php
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';

$featured = q('SELECT id, name, category, description FROM products WHERE is_featured = 1 ORDER BY id LIMIT 3')->fetchAll();
$latest   = q('SELECT slug, title, excerpt, published_at FROM posts ORDER BY published_at DESC LIMIT 2')->fetchAll();

$page_title = SITE_NAME;
$meta_desc  = SITE_NAME . ' - plywood manufacturer in Kakungube, Uganda with 16 years of experience. See how our plywood is made, browse our products and contact us.';
$nav = 'home';

$slides = [
    ['photo-031',  'Plywood made in Uganda, for 16 years', 'From log to finished board, every sheet is made, checked and packed in our own factory at Kakungube.', 'Read our story', 'about'],
    ['photo-053',  'It starts with a log', 'Selected logs are peeled on the lathe into long, thin ribbons of veneer: the layers that become plywood.', 'See the process', 'about'],
    ['photo-037',    'Layers glued, heated and pressed', 'Veneers are laid with alternating grain and pressed under heat, so the layers become one strong, flat board.', 'Browse products', 'products'],
    ['photo-020', 'Sanded, packed and delivered', 'Boards are trimmed, sanded smooth, stacked on pallets and loaded for builders, joiners and furniture makers.', 'View the gallery', 'gallery'],
    ['photo-022',  'Checked sheet by sheet', 'Inspectors check face, thickness, size, moisture and glue bond before a board is graded and dispatched.', 'Talk to our team', 'contact'],
];

$steps = [
    ['photo-051',     'Log selection and storage', 'Everything starts in the yard.', 'Logs arrive from plantations and are sorted by length and diameter. Straight, sound logs give the widest, cleanest veneer, so poor logs are set aside early.', ['Logs sorted by size and quality', 'Stored so they stay fresh and free from cracks', 'Cut to the length of the sheet being made']],
    ['photo-053',    'Peeling the log into veneer', 'The lathe turns a log into a ribbon.', 'The log spins against a long knife and unrolls into a continuous thin ribbon of wood, like paper from a roll. The ribbon is clipped into sheets and defects are cut out.', ['Rotary peeling wastes very little wood', 'Face veneers are kept apart from core veneers', 'Sheets are stacked by thickness and grade']],
    ['photo-032', 'Drying the veneer', 'Dry wood glues well and stays flat.', 'Wet veneer passes through a heated dryer. Steam from our boiler brings the moisture down to the level needed for a strong glue bond and a board that will not warp.', ['Controlled, even heat', 'Moisture level checked after drying', 'Wood waste can be burnt to make the steam']],
    ['photo-034', 'Gluing and lay-up', 'Cross-grain layers give plywood its strength.', 'Rollers spread a thin, even coat of glue on the core veneers. Layers are then laid one on top of the other with the grain turned 90 degrees each time, with good face veneers on the outside.', ['Measured glue mix for every batch', 'Odd number of layers for a balanced board', 'Grain direction alternates layer to layer']],
    ['photo-036',      'Hot pressing', 'Heat and pressure make one solid board.', 'The stacked layers go into the hot press. Heat cures the glue while pressure squeezes the layers tight, so the board comes out as a single, flat, solid panel.', ['Time, heat and pressure set for each thickness', 'Several boards can be pressed at once', 'Boards cool and flatten before trimming']],
    ['photo-041',       'Trimming and sanding', 'Square edges, smooth faces.', 'Pressed boards are trimmed square to their final size and passed through wide-belt sanders that smooth both faces and bring every sheet to the right thickness.', ['Standard sizes or cut-to-size on request', 'Small defects patched', 'Even thickness from sheet to sheet']],
    ['photo-021',         'Inspection, grading and packing', 'Nothing leaves without a check.', 'Each sheet is inspected for knots, splits, size and moisture, then graded. Good boards are stacked on pallets, strapped, labelled and loaded for delivery.', ['Grade, size and thickness on every label', 'Glue-bond samples tested', 'Records kept so batches can be traced']],
];

include __DIR__ . '/includes/header.php';
?>
<section class="slider" data-slider aria-roledescription="carousel" aria-label="Plywood factory highlights" tabindex="0">
  <div class="slides">
    <?php foreach ($slides as $i => [$img, $title, $text, $btn, $page]): ?>
      <div class="slide" role="group" aria-roledescription="slide" aria-label="Slide <?= $i + 1 ?> of <?= count($slides) ?>">
        <?= photo_img($img, $title . ' - ' . $text, '', 1600, 700, $i > 0) ?>
        <div class="container"><div class="slide-body">
          <span class="eyebrow"><?= e(SITE_NAME) ?></span>
          <?= $i === 0 ? '<h1>' . e($title) . '</h1>' : '<h2>' . e($title) . '</h2>' ?>
          <p><?= e($text) ?></p>
          <div class="btn-row">
            <a class="btn btn-gold" href="<?= e(page_url($page)) ?>"><?= e($btn) ?></a>
            <a class="btn btn-outline" href="<?= e(whatsapp_link('Hello ' . SITE_NAME . ', I would like to make an enquiry.')) ?>" target="_blank" rel="noopener noreferrer">Chat on WhatsApp</a>
          </div>
        </div></div>
      </div>
    <?php endforeach; ?>
  </div>
  <button class="slider-btn slider-prev" type="button" aria-label="Previous slide">&#8249;</button>
  <button class="slider-btn slider-next" type="button" aria-label="Next slide">&#8250;</button>
  <div class="slider-dots"></div>
  <div class="slide-count" aria-hidden="true"></div>
</section>

<section class="stats-strip" aria-label="Company facts">
  <div class="container grid">
    <div><strong>16</strong><span>years in existence</span></div>
    <div><strong>7</strong><span>stages from log to dispatch</span></div>
    <div><strong>Kakungube</strong><span>our factory home, Uganda</span></div>
    <div><strong>Every batch</strong><span>inspected and recorded</span></div>
  </div>
</section>

<section class="factory-bg">
  <?= photo_img('photo-031', 'Production hall with stacks of veneer', 'bg', 1200, 750) ?>
  <div class="container factory-grid">
    <div>
      <span class="eyebrow">Factory background</span>
      <h2>A plywood factory with 16 years of experience</h2>
      <div class="years-badge"><b>16</b><span>years<br>in existence</span></div>
      <p>The company has been in existence for 16 years. In that time <?= e(SITE_NAME) ?> has become a working factory that receives logs, turns them into veneer, presses them into boards and delivers them to builders, joiners and furniture makers.</p>
      <p>Our factory at Kakungube combines trained people, steady machines and careful checking, so a customer who buys a sheet today can expect the same quality next year.</p>
      <div class="btn-row"><a class="btn btn-gold" href="<?= e(page_url('about')) ?>">More about us</a><a class="btn btn-outline" href="<?= e(page_url('contact')) ?>">Visit the factory</a></div>
    </div>
    <div class="factory-photos">
      <figure><?= photo_img('photo-032', 'Veneer drying line in the factory hall', '', 1200, 750) ?><figcaption><strong>The production hall.</strong> Drying line, presses and sanders under one roof at Kakungube.</figcaption></figure>
      <figure><?= photo_img('photo-049', 'Supervisors and workers reviewing records among stacks of plywood', '', 1200, 800) ?><figcaption><strong>The team.</strong> Supervisors and workers review production records among stacked boards.</figcaption></figure>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">How plywood is made</span>
      <h2>Our factory process, step by step</h2>
      <p>Seven stages turn a raw log into a graded, packed sheet of plywood.</p>
    </div>
    <?php foreach ($steps as $i => [$img, $title, $lead, $text, $points]): ?>
      <div class="split<?= $i % 2 ? ' reverse' : '' ?>">
        <figure class="split-media">
          <?= photo_img($img, $title . ': ' . $lead) ?>
          <figcaption>Stage <?= $i + 1 ?>: <?= e($title) ?></figcaption>
        </figure>
        <div class="split-text">
          <span class="step-no"><?= $i + 1 ?></span>
          <h2><?= e($title) ?></h2>
          <p><strong><?= e($lead) ?></strong> <?= e($text) ?></p>
          <ul class="ticks"><?php foreach ($points as $pt): ?><li><?= e($pt) ?></li><?php endforeach; ?></ul>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head"><span class="eyebrow">Products</span><h2>What we make</h2><p>Boards in a range of types and thicknesses. Ask us for sizes and prices.</p></div>
    <div class="grid grid-3">
      <?php foreach ($featured as $p): ?>
        <article class="card card-img">
          <?= photo_img(product_photo($p), $p['name'] . ' plywood sheet') ?>
          <div class="card-body">
            <span class="tag"><?= e($p['category']) ?></span>
            <h3><?= e($p['name']) ?></h3>
            <p><?= e(mb_strimwidth($p['description'], 0, 140, '...')) ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="fig-grid cols-4 mt-lg">
      <figure class="fig"><?= photo_img('photo-062', 'Commercial plywood 12 mm') ?><figcaption><h3>Commercial plywood</h3><p>Interior partitions, cabinets and furniture.</p></figcaption></figure>
      <figure class="fig"><?= photo_img('photo-068', 'Marine plywood 18 mm') ?><figcaption><h3>Marine plywood</h3><p>Water-resistant glue for damp, wet uses.</p></figcaption></figure>
      <figure class="fig"><?= photo_img('photo-043', 'Shuttering plywood 18 mm') ?><figcaption><h3>Shuttering plywood</h3><p>Strong, re-usable concrete formwork.</p></figcaption></figure>
      <figure class="fig"><?= photo_img('photo-055', 'Flexible plywood 4 mm') ?><figcaption><h3>Flexible plywood</h3><p>Thin and bendable for curved work.</p></figcaption></figure>
    </div>
    <p class="text-center mt-lg"><a class="btn" href="<?= e(page_url('products')) ?>">View all products</a></p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head"><span class="eyebrow">Why us</span><h2>Why customers choose us</h2><p>Simple promises we keep on every order.</p></div>
    <div class="grid grid-3">
      <article class="card card-img"><?= photo_img('photo-047', 'Worker measuring a plywood sheet with a tape') ?><div class="card-body"><h3>Consistent quality</h3><p>Materials, production and finished boards are inspected at every stage so each order matches the last.</p></div></article>
      <article class="card card-img"><?= photo_img('photo-069', 'Truck loaded with plywood for delivery') ?><div class="card-body"><h3>Reliable supply</h3><p>Planned production and organised stores mean we deliver the quantities you order, when you need them.</p></div></article>
      <article class="card card-img"><?= photo_img('photo-035', 'Production crew handling large veneer sheets') ?><div class="card-body"><h3>Skilled team</h3><p>Sixteen years of experience sit in a trained workforce that takes pride in every sheet.</p></div></article>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head"><span class="eyebrow">Gallery preview</span><h2>Inside the factory</h2><p>A few pictures from our gallery.</p></div>
    <div class="fig-grid">
      <figure class="fig"><?= photo_img('photo-006', 'Worker watching a log being peeled into veneer') ?><figcaption><h3>Peeling</h3><p>The log is peeled into a thin continuous veneer ribbon.</p></figcaption></figure>
      <figure class="fig"><?= photo_img('photo-016', 'Operator at the hydraulic press') ?><figcaption><h3>Pressing</h3><p>Stacked layers are pressed under heat and pressure.</p></figcaption></figure>
      <figure class="fig"><?= photo_img('photo-020', 'Operator feeding a sheet into the sanding machine') ?><figcaption><h3>Sanding</h3><p>Belts smooth both faces to an even thickness.</p></figcaption></figure>
      <figure class="fig"><?= photo_img('photo-055', 'Tall stack of veneer sheets') ?><figcaption><h3>Veneer stacks</h3><p>Dried veneer is sorted and stacked by grade.</p></figcaption></figure>
      <figure class="fig"><?= photo_img('photo-052', 'Worker watching logs on the conveyor') ?><figcaption><h3>Log handling</h3><p>Logs move on conveyors into the production hall.</p></figcaption></figure>
      <figure class="fig"><?= photo_img('photo-074', 'Palletised and strapped plywood') ?><figcaption><h3>Packing</h3><p>Pallets are strapped tight for safe transport.</p></figcaption></figure>
    </div>
    <p class="text-center mt-lg"><a class="btn btn-gold" href="<?= e(page_url('gallery')) ?>">Open the full gallery</a></p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head"><h2>Latest news</h2></div>
    <div class="grid grid-2">
      <?php foreach ($latest as $post): ?>
        <article class="card">
          <p class="meta"><?= e(format_date($post['published_at'])) ?></p>
          <h3><a href="<?= e(article_url($post['slug'])) ?>"><?= e($post['title']) ?></a></h3>
          <p><?= e($post['excerpt']) ?></p>
          <a href="<?= e(article_url($post['slug'])) ?>">Read more</a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="cta">
  <div class="container">
    <h2>Ready to place an order or ask a question?</h2>
    <p>Talk to our team by phone, email or WhatsApp.</p>
    <a class="btn btn-gold" href="<?= e(page_url('contact')) ?>">Contact us</a>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
