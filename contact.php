<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact | Eclipse Water Technologies</title>
  <meta name="description" content="Get in touch with Eclipse Water Technologies. Reach out to Robert Lee, CET, PMP for expert water treatment solutions." />
  <link rel="stylesheet" href="styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <?php include 'navbar.php'; ?>

  <section class="container contact-info">
    <h2>Contact Robert Lee, CET, PMP</h2>
    <p><strong>Phone:</strong> <a href="tel:+16473550944">647-355-0944</a></p>
    <p><strong>Email:</strong> <a href="mailto:rlee@eclipsewatertechnologies.com">rlee@eclipsewatertechnologies.com</a></p>
    <p><strong>Location:</strong> Toronto, Ontario, Canada</p>
    <p><strong>Title:</strong> Certified Engineering Technologist & Project Management Professional</p>
  </section>

  <section class="container contact-grid">
    <div>
      <h2>Send Us a Message</h2>
      <form class="form" action="submit-contact.php" method="POST">
        <input type="text" name="name" placeholder="Your Name" required />
        <input type="email" name="email" placeholder="Your Email" required />
        <input type="text" name="company" placeholder="Company (optional)" />
        <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
        <button class="btn" type="submit">Submit</button>
      </form>
    </div>
    <div class="highlight">
      <h3>Why Eclipse?</h3>
      <ul class="checklist">
        <li>Canadian-based, no U.S. tariffs</li>
        <li>Stable pricing and dependable supply</li>
        <li>Expert service and support</li>
      </ul>
    </div>
  </section>

  <footer class="site-footer">
    <div class="container footer-grid">
      <div><strong>Eclipse Water Technologies</strong></div>
      <div style="display: flex; gap: 1.2rem; align-items: center;">
        <a href="contact.php" class="btn btn-small">Talk to us</a>
        <a href="https://www.linkedin.com/company/eclipse-water-technologies" target="_blank" aria-label="LinkedIn" style="margin-left:0.5rem;"><img src="linkedin-icon.svg" alt="LinkedIn" style="height:24px;width:24px;vertical-align:middle;"></a>
        <a href="https://www.instagram.com/eclipsewatertech" target="_blank" aria-label="Instagram"><img src="instagram-icon.svg" alt="Instagram" style="height:24px;width:24px;vertical-align:middle;"></a>
        <a href="https://www.facebook.com/eclipsewatertech" target="_blank" aria-label="Facebook"><img src="facebook-icon.svg" alt="Facebook" style="height:24px;width:24px;vertical-align:middle;"></a>
      </div>
      <div><p>&copy; 2026 Eclipse Water Technologies</p></div>
    </div>
  </footer>
</body>
</html>
