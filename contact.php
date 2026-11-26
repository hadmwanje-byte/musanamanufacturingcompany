<?php
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';
start_secure_session();

$errors = [];
$sent   = false;
$old    = ['name' => '', 'email' => '', 'phone' => '', 'subject' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    foreach ($old as $k => $_) {
        $old[$k] = trim((string) ($_POST[$k] ?? ''));
    }

    // Honeypot: real visitors never fill this hidden field
    if (trim((string) ($_POST['website'] ?? '')) !== '') {
        redirect(page_url('contact'));
    }

    if (str_len($old['name']) < 2 || str_len($old['name']) > 120) { $errors[] = 'Please enter your name.'; }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL) || str_len($old['email']) > 190) { $errors[] = 'Please enter a valid email address.'; }
    if ($old['phone'] !== '' && !preg_match('/^[0-9+\-\s()]{5,40}$/', $old['phone'])) { $errors[] = 'Phone number may only contain digits, spaces, + - ( ).'; }
    if (str_len($old['subject']) < 3 || str_len($old['subject']) > 150) { $errors[] = 'Please enter a subject (3 to 150 characters).'; }
    if (str_len($old['message']) < 10 || str_len($old['message']) > 3000) { $errors[] = 'Your message must be between 10 and 3000 characters.'; }

    if (!$errors) {
        $recent = (int) q('SELECT COUNT(*) FROM messages WHERE ip_address = :ip AND created_at >= :c', [
            'ip' => client_ip(), 'c' => date('Y-m-d H:i:s', time() - 3600),
        ])->fetchColumn();
        if ($recent >= 5) {
            $errors[] = 'You have sent several messages recently. Please wait a while or contact us on WhatsApp.';
        }
    }

    if (!$errors) {
        q('INSERT INTO messages (name, email, phone, subject, message, ip_address, is_read, created_at) VALUES (:n, :e, :p, :s, :m, :ip, 0, :t)', [
            'n' => $old['name'], 'e' => $old['email'], 'p' => $old['phone'], 's' => $old['subject'],
            'm' => $old['message'], 'ip' => client_ip(), 't' => date('Y-m-d H:i:s'),
        ]);
        $_SESSION['contact_sent'] = true;
        redirect(page_url('contact') . '?sent=1');
    }
}

if (isset($_GET['sent']) && !empty($_SESSION['contact_sent'])) {
    $sent = true;
    unset($_SESSION['contact_sent']);
}

$page_title = 'Contact Us';
$meta_desc  = 'Contact ' . SITE_NAME . ' by phone, email, contact form or WhatsApp. Find our address and opening hours.';
$nav = 'contact';
$canonical = site_origin() . '/' . (CLEAN_URLS ? 'contact' : 'contact.php');
include __DIR__ . '/includes/header.php';
?>
<section class="page-banner banner-contact">
  <div class="container"><h1>Contact Us</h1><p>We would love to hear from you.</p></div>
</section>

<section class="section">
  <div class="container grid grid-2">
    <div>
      <h2>Send us a message</h2>

      <?php if ($sent): ?>
        <div class="alert alert-ok" role="status">Thank you. Your message has been received and our team will reply soon.</div>
      <?php endif; ?>
      <?php if ($errors): ?>
        <div class="alert alert-error" role="alert"><?= implode('<br>', array_map('e', $errors)) ?></div>
      <?php endif; ?>

      <form id="contact-form" method="post" action="<?= e(page_url('contact')) ?>" novalidate>
        <?= csrf_field() ?>
        <div class="hp" aria-hidden="true"><label for="website">Leave this empty</label><input type="text" id="website" name="website" tabindex="-1" autocomplete="off"></div>
        <div class="form-grid">
          <div><label for="name">Your name *</label><input id="name" name="name" required maxlength="120" value="<?= e($old['name']) ?>" autocomplete="name"></div>
          <div><label for="email">Email *</label><input id="email" type="email" name="email" required maxlength="190" value="<?= e($old['email']) ?>" autocomplete="email"></div>
          <div><label for="phone">Phone</label><input id="phone" name="phone" maxlength="40" value="<?= e($old['phone']) ?>" autocomplete="tel"></div>
          <div><label for="subject">Subject *</label><input id="subject" name="subject" required maxlength="150" value="<?= e($old['subject']) ?>"></div>
          <div class="full"><label for="message">Message *</label><textarea id="message" name="message" required maxlength="3000"><?= e($old['message']) ?></textarea></div>
        </div>
        <div class="btn-row mt">
          <button class="btn" type="submit">Send message</button>
          <button class="btn btn-wa" type="button" id="wa-send" data-number="<?= e(preg_replace('/\D/', '', WHATSAPP_NUMBER)) ?>">Send via WhatsApp</button>
        </div>
        <p class="help">"Send message" saves your enquiry with our team. "Send via WhatsApp" opens WhatsApp with your message ready to send.</p>
      </form>
    </div>

    <div>
      <h2>Reach us directly</h2>
      <ul class="contact-list">
        <li><strong>Address:</strong> <?= e(SITE_ADDRESS) ?></li>
        <li><strong>Phone:</strong> <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', SITE_PHONE)) ?>"><?= e(SITE_PHONE) ?></a></li>
        <li><strong>Email:</strong> <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
        <li><strong>Hours:</strong> <?= e(SITE_HOURS) ?></li>
      </ul>
      <div class="card mt-lg">
        <h3>Chat with us on WhatsApp</h3>
        <p>Get quick answers about products, prices and orders.</p>
        <a class="btn btn-wa" href="<?= e(whatsapp_link('Hello ' . SITE_NAME . ', I would like to make an enquiry.')) ?>" target="_blank" rel="noopener noreferrer">Start WhatsApp chat</a>
      </div>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head"><span class="eyebrow">Find us</span><h2>Our location</h2><p>Visit the factory at Kakungube. Open the map to get directions.</p></div>
    <div class="map-wrap">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15958.781059906536!2d31.833334!3d0.4499999499999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177d260b4c8f3a77%3A0x97456695740d16b7!2sKakungube!5e0!3m2!1sen!2sug!4v1795176678042!5m2!1sen!2sug" title="Map showing the Musana factory location at Kakungube, Uganda" width="600" height="450" allowfullscreen loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
    </div>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
