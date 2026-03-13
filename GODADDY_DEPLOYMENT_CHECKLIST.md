# GoDaddy Deployment Checklist

Use this checklist after uploading files to the live domain so the homepage and redirect issues are actually fixed on the server.

## 1. Confirm the document root

- Open GoDaddy File Manager.
- Find the live document root for eclipsewatertechnologies.com.
- On most shared hosting setups this is `public_html` or a domain-specific folder under it.

## 2. Upload the required files to the live root

Make sure these files are in the exact live document root:

- `index.php`
- `.htaccess`
- `robots.txt`
- `sitemap.xml`
- all linked PHP landing pages

## 3. Remove the stale homepage file

- If `index.html` exists in the live root, rename it to `index-old.html` or remove it.
- This is required because Apache is still serving the stale HTML homepage at `/`.

## 4. Verify the root homepage

After upload, check:

- `https://eclipsewatertechnologies.com/`
- `https://eclipsewatertechnologies.com/index.php`
- `https://eclipsewatertechnologies.com/index.html`

Expected result:

- `/` loads the PHP homepage
- `/index.php` redirects to `/`
- `/index.html` redirects to `/`

## 5. Verify legacy redirects

Check these URLs after upload:

- `https://eclipsewatertechnologies.com/services.html`
- `https://eclipsewatertechnologies.com/industries.html`
- `https://eclipsewatertechnologies.com/specs.html`
- `https://eclipsewatertechnologies.com/contact.html`
- `https://eclipsewatertechnologies.com/case-studies.html`

Expected result:

- each old `.html` URL returns a `301` redirect to the matching `.php` page

## 6. Verify crawl files

Check these directly in the browser:

- `https://eclipsewatertechnologies.com/robots.txt`
- `https://eclipsewatertechnologies.com/sitemap.xml`

Expected result:

- both load publicly without errors

## 7. Clear caches if needed

- Clear any GoDaddy caching layer if enabled.
- Hard refresh the browser.
- Re-test in an incognito window.

## 8. Re-run the live SEO check

After steps 1 through 7 are complete, re-test:

- homepage canonical
- homepage internal links
- legacy redirects
- sitemap visibility
- robots visibility

At that point the live technical SEO audit can be rerun meaningfully.