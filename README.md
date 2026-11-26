# Musana Manufacturing Company - Website and Worker Management (pure PHP + MySQL)

BIT 2103 Internet Technologies & Advanced Website Development - practical project.

## 1. Run locally (WampServer)
1. Copy this folder to `C:\wamp64\www\musana1`.
2. Start WampServer (icon green). Open `http://localhost/phpmyadmin`.
3. Create a database named `musana_db` (collation `utf8mb4_unicode_ci`), choose **Import** and import `database/musana.sql`.
4. If your MySQL user/password are not `root` / empty, edit `includes/config.php`.
5. Open `http://localhost/musana1/setup.php` ONCE to create the first **developer** account (choose your own username, not "admin"). Then **delete `setup.php`**.
6. Website: `http://localhost/musana1/` - Staff login: `http://localhost/musana1/admin/login.php` (not linked anywhere on the public site).

## 2. Edit the real client details
Open `includes/config.php` and replace: `SITE_EMAIL`, `SITE_PHONE`, `SITE_ADDRESS`, `SITE_HOURS` and **`WHATSAPP_NUMBER`** (international format, digits only, e.g. `256772123456`).
Replace the "REPLACE" text in `about.php` and the starter products/article (table `products`, `posts` in phpMyAdmin) with the client's real content, photos and product details. Exam rule: all content must be real and the client's written consent attached.

## 3. Deploy to cPanel
1. cPanel > MySQL Databases: create database + user, give the user ALL privileges.
2. phpMyAdmin (cPanel): import `database/musana.sql`.
3. File Manager: upload the folder contents to `public_html` (or zip, upload and extract).
4. Edit `includes/config.php` with the cPanel database name, user and password; set `SITE_URL` to `https://yourdomain`, `CLEAN_URLS` to `true`, keep `APP_DEBUG` `false`.
5. Install SSL (cPanel > SSL/TLS Status > AutoSSL). The `.htaccess` then forces HTTPS.
6. Open `https://yourdomain/setup.php`, create the developer account, then delete `setup.php`.
7. Create the manager accounts: sign in > **Staff Accounts**.
8. Create a temporary examiner account (role manager or developer) and delete it after marking.
9. Submit `https://yourdomain/sitemap.xml` in Google Search Console.

## 4. Who can open the management area?
| Page | Visitor | Manager | Developer |
|---|---|---|---|
| Public site | yes | yes | yes |
| /admin/login.php | form only | yes | yes |
| Dashboard, Workers, Messages, My Password | redirected to login | yes | yes |
| Staff Accounts (create/disable/reset managers) | redirected to login | 403 denied | yes |

Every management page starts with `require_role([...])` (see `includes/auth.php`). Accounts are re-checked in the database on each request, so disabling an account locks it out immediately.

## 5. Exam requirement map
- Task 3: multi-page responsive site (`index/about/products/news/article/contact.php`), branding in `assets/`, custom module = **Worker Management** (`admin/workers.php`) with full CRUD, PDO prepared statements and JOINs (workers-departments, activity-users, departments-workers counts), business feature = contact enquiries + WhatsApp click-to-chat.
- Task 4: HTTPS redirect, hashed passwords (`password_hash`), login-attempt limits (5 per username / 15 per IP per 15 min), CSRF tokens, session hardening + idle timeout, no default admin username, role-based access, security headers + CSP, private folders blocked, output escaping, audit log.
- Task 5: unique titles/meta descriptions, canonical URLs, friendly URLs, `sitemap.xml`, `robots.txt`, JSON-LD, 500+ word keyword article (`posts` table), gzip + browser caching in `.htaccess`. Still to do by you: Search Console verification, speed test before/after, compress real photos, GitHub repo with 8+ commits and a merged pull request.
- Tasks 1 and 2 (documents, domain, hosting, email, backups) are your own paperwork/evidence - not code.

## 6. WhatsApp
The Contact page has (a) a "Start WhatsApp chat" button, (b) a "Send via WhatsApp" button that opens WhatsApp with the visitor's name, subject and message pre-filled, and (c) a floating WhatsApp button on every page. These use WhatsApp's official click-to-chat link (`wa.me`), which needs no API key. Automatic server-to-server messaging would need the WhatsApp Business Cloud API (a Meta account and token) - not required here.

## 7. Privacy
Worker records are personal data. Only enter what Musana has authorised, keep HTTPS on, use strong manager passwords, and take regular backups (cPanel > Backup).

## 8. Plywood redesign (blue / yellow / white / black)
- **Pages:** `gallery.php` is new (144 images, category filter, hover captions, lightbox). Data lives in `includes/gallery_data.php`.
- **Images:** the pictures in `assets/img/gallery/` are original illustrations. To use real photos, save a photo as `assets/img/photos/<same-name>.jpg` (e.g. `press-1.jpg`) and it replaces the illustration automatically.
- **Map:** Contact page uses your Kakungube Google Maps embed (the CSP in `includes/functions.php` allows `frame-src https://www.google.com`).
- **Products:** if you already imported the database, run `database/update_plywood_products.sql` in phpMyAdmin to replace the starter "Product Range A/B/C" rows.
- **Dashboard:** staff area is still `/admin/` (not linked anywhere, noindex, blocked in robots.txt). Only the developer and ONE manager account can exist/be active; visitors are redirected to login.
