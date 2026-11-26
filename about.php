<?php
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';

$page_title = 'About Us';
$meta_desc  = 'About ' . SITE_NAME . ': a plywood factory at Kakungube, Uganda with 16 years in existence. Our products, production process and daily activities.';
$nav = 'about';
$canonical = site_origin() . '/' . (CLEAN_URLS ? 'about' : 'about.php');

/** [image, title, text] */
$sections = [
    'Our factory and people' => [
        ['photo-032', 'The factory at Kakungube', 'Our plywood factory stands at Kakungube in Uganda. It has log storage, a veneer line, a press shop, finishing machines, a store and a loading yard, all in one compound.'],
        ['photo-049', 'The people behind the boards', 'A trained workforce runs every stage. Hard hats, hi-vis vests and boots are worn on the factory floor, and supervisors check safety and quality at each station.'],
        ['photo-desk', 'Orders, stock and records', 'The office handles customer orders, stock records and worker information, so every order can be traced from production to delivery.'],
    ],
    'Our products' => [
        ['photo-062', 'Commercial plywood', 'An all-round board with five glued layers, used for partitions, cabinets, ceilings and furniture carcasses.'],
        ['photo-068', 'Marine and moisture-resistant plywood', 'Bonded with water-resistant glue for boats, bathrooms, kitchens and other damp places.'],
        ['photo-043', 'Shuttering plywood', 'A tough board that holds wet concrete in shape on building sites and can be re-used several times.'],
        ['photo-055', 'Flexible and decorative plywood', 'Thin sheets that bend around curves and give attractive faces for wall linings, counters and display units.'],
    ],
    'How we make plywood' => [
        ['photo-051', 'Logs and raw material', 'Plywood begins with logs. We sort them by size and quality so only sound, straight logs go to the lathe.'],
        ['photo-053', 'Peeling', 'Each log is spun against a knife and peeled into a thin continuous veneer ribbon, which is then clipped into sheets.'],
        ['photo-033', 'Drying', 'Veneer is dried in a heated dryer, fed by our steam boiler, until its moisture is right for gluing.'],
        ['photo-036', 'Gluing and hot pressing', 'Glued veneers are laid with alternating grain and pressed under heat and pressure into one solid panel.'],
        ['photo-041', 'Trimming and sanding', 'Panels are cut square to size and sanded smooth to an even thickness.'],
    ],
    'Quality, storage and delivery' => [
        ['photo-047', 'Quality control', 'We check face quality, thickness, size, moisture and glue bond, and we keep samples and records for each batch.'],
        ['photo-081', 'Storage', 'Finished boards are stored flat and dry on racks, sorted by thickness and grade.'],
        ['photo-069', 'Handling', 'Forklifts move heavy stacks safely between the finishing area, the store and the loading bay.'],
        ['photo-074', 'Delivery', 'Packs are strapped, labelled and loaded for delivery to builders, hardware shops and furniture makers.'],
    ],
];

include __DIR__ . '/includes/header.php';
?>
<section class="page-banner banner-about">
  <div class="container"><h1>About Us</h1><p>Who we are and how we make plywood.</p></div>
</section>

<section class="section">
  <div class="container">
    <div class="split">
      <figure class="split-media"><?= photo_img('photo-031', 'Production hall with stacks of veneer at the Musana plywood factory', '', 1600, 700) ?><figcaption>Our factory compound at Kakungube, Uganda.</figcaption></figure>
      <div class="split-text">
        <span class="eyebrow">Our story</span>
        <h2>16 years of making plywood</h2>
        <p><?= e(SITE_NAME) ?> has been in existence for 16 years. We make plywood boards in our own factory at Kakungube, from the arrival of logs to the loading of finished sheets.</p>
        <p><strong>Our mission:</strong> to manufacture dependable, good-value plywood and be a trusted partner to our customers, our staff and our community.</p>
        <p><strong>Our values:</strong> quality in every sheet, integrity in every dealing and teamwork across every department.</p>
      </div>
    </div>
  </div>
</section>

<?php $alt = false; foreach ($sections as $heading => $figs): $alt = !$alt; ?>
<section class="section<?= $alt ? ' section-alt' : '' ?>">
  <div class="container">
    <div class="section-head"><h2><?= e($heading) ?></h2></div>
    <div class="fig-grid<?= count($figs) === 4 ? ' cols-4' : '' ?>">
      <?php foreach ($figs as [$img, $title, $text]): ?>
        <figure class="fig"><?= photo_img($img, $title) ?><figcaption><h3><?= e($title) ?></h3><p><?= e($text) ?></p></figcaption></figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endforeach; ?>

<section class="section">
  <div class="container prose">
    <h2>What we do every day</h2>
    <ul class="ticks">
      <li>Receive, sort and store logs.</li>
      <li>Peel, clip, dry and grade veneer.</li>
      <li>Mix glue, lay up layers and press boards.</li>
      <li>Trim, sand, inspect and grade finished sheets.</li>
      <li>Pack, label, store and deliver orders.</li>
      <li>Keep accurate worker, stock and order records.</li>
    </ul>
  </div>
</section>

<section class="cta">
  <div class="container">
    <h2>Visit us or get in touch</h2>
    <a class="btn btn-gold" href="<?= e(page_url('contact')) ?>">Contact us</a>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
