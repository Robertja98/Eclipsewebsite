<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
<header class="site-header">
  <div class="nav-wrap">
    <a class="brand" href="index.php">
      <img src="Eclipselogo2026.png" alt="Eclipse Water Technologies Logo" class="logo" />
    </a>
    <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
    <nav id="main-nav">
      <ul class="nav">
        <li><a href="about.php"<?php if ($currentPage === 'about.php') echo ' class="active"'; ?>>About</a></li>
        <li><a href="services.php"<?php if ($currentPage === 'services.php') echo ' class="active"'; ?>>Services</a></li>
        <li><a href="industries.php"<?php if ($currentPage === 'industries.php') echo ' class="active"'; ?>>Industries</a></li>
        <li><a href="specs.php"<?php if ($currentPage === 'specs.php') echo ' class="active"'; ?>>Technical Specs</a></li>
        <li><a href="sdi-tank-sizing.php"<?php if ($currentPage === 'sdi-tank-sizing.php') echo ' class="active"'; ?>>Tank Sizing</a></li>
        <li><a href="case-studies.php"<?php if ($currentPage === 'case-studies.php') echo ' class="active"'; ?>>Case Studies</a></li>
        <li><a href="resources.php"<?php if ($currentPage === 'resources.php') echo ' class="active"'; ?>>Resources</a></li>
        <li><a href="contact.php" class="btn btn-small<?php if ($currentPage === 'contact.php') echo ' active'; ?>">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>
<script>
  (function() {
    var toggle = document.querySelector('.nav-toggle');
    if (toggle) {
      toggle.addEventListener('click', function() {
        var nav = document.getElementById('main-nav');
        var expanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', String(!expanded));
        nav.classList.toggle('open');
        this.classList.toggle('open');
      });
    }
  })();
</script>
