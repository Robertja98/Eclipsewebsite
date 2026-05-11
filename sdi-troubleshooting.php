<?php
$pageTitle = 'SDI Troubleshooting — Low Resistivity, Channeling, Silica Breakthrough | Eclipse Water Technologies';
$pageDescription = 'Diagnosing common SDI system problems: low resistivity after a fresh tank swap, premature exhaustion, silica breakthrough, channeling, and resin degradation. Practical fixes for Canadian facilities.';
$pageExtraHead = <<<'EXTRAHEAD'
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <meta name="keywords" content="SDI troubleshooting, low resistivity DI water, silica breakthrough DI tank, DI resin channeling, deionized water quality problem, service deionization problem Canada" />
  <meta name="author" content="Eclipse Water Technologies" />
  <link rel="canonical" href="https://eclipsewatertechnologies.com/sdi-troubleshooting.php" />
  <meta property="og:title" content="SDI Troubleshooting — Low Resistivity, Channeling, Silica Breakthrough | Eclipse Water Technologies" />
  <meta property="og:description" content="Common SDI system problems explained — with practical diagnostics and fixes for Canadian industrial and laboratory water users." />
  <meta property="og:image" content="https://eclipsewatertechnologies.com/Eclipselogo2026.png" />
  <meta property="og:url" content="https://eclipsewatertechnologies.com/sdi-troubleshooting.php" />
  <meta property="og:type" content="article" />
  <meta property="og:locale" content="en_CA" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="SDI Troubleshooting — Low Resistivity, Channeling, Silica Breakthrough" />
  <meta name="twitter:description" content="Diagnosing and fixing common DI water quality problems in SDI systems — for Canadian industrial and lab facilities." />
  <meta name="twitter:image" content="https://eclipsewatertechnologies.com/Eclipselogo2026.png" />
  <meta name="twitter:site" content="@EclipseWaterTech" />
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "Why is my DI water resistivity low right after a fresh tank swap?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Low resistivity immediately after a fresh tank is almost always a piping or connection issue — not a bad tank. Check for leaks or bypasses in fittings that allow untreated water to mix with DI output. Also flush the tank connections thoroughly after every swap, as stagnant water in supply lines can temporarily suppress readings. If the problem persists after flushing, contact your service provider to verify the tank was properly regenerated."
        }
      },
      {
        "@type": "Question",
        "name": "What causes premature resin exhaustion in an SDI tank?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Premature exhaustion is usually caused by higher-than-expected feed water TDS, a flow rate exceeding the tank's rated capacity, or a tank that is undersized for the application. Chlorine or chloramines in feed water also degrade resin over time, reducing its capacity with each regeneration cycle. Adding a carbon prefilter and reviewing feed water quality are the first diagnostic steps."
        }
      },
      {
        "@type": "Question",
        "name": "What is silica breakthrough in a DI system and why does it happen?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Silica breakthrough occurs when silica (SiO2) passes through the anion resin without being captured. Silica is weakly ionized and requires a strong-base anion resin to remove it effectively. If your resin is aged, degraded by chlorine exposure, or regenerated at too low a temperature, its silica capacity drops. Silica breakthrough shows up as a drop in purity even when other ion measurements look acceptable. It's especially problematic for semiconductor and pharmaceutical applications."
        }
      },
      {
        "@type": "Question",
        "name": "What is channeling in an SDI resin tank?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Channeling occurs when water finds a preferential flow path through the resin bed rather than distributing evenly. This means a portion of the resin never contacts the water, reducing effective capacity and causing premature quality degradation. Channeling is often caused by resin settling, fines migration, or improper backwashing during regeneration. Symptoms include resistivity that drops faster than expected relative to the volume of water treated."
        }
      },
      {
        "@type": "Question",
        "name": "Why does my DI water quality fluctuate throughout the day?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Daily fluctuations in DI water quality are usually caused by changes in feed water temperature or TDS, variation in flow rate, or stagnant water in downstream piping that has absorbed ions from materials. Higher water temperature reduces ion exchange efficiency slightly. If quality is worse in the morning after overnight stagnation, flush the line before use. If the variation correlates with high-flow periods, the tank may be undersized for peak demand."
        }
      }
    ]
  }
  </script>
EXTRAHEAD;
include 'header.php';
?>
<section class="hero hero-sub">
    <div class="container">
      <h1>SDI Troubleshooting Guide</h1>
      <p>Common problems with service deionization systems — what causes them, how to diagnose them, and what to do about it.</p>
      <a href="contact.php" class="btn">Talk to a DI Specialist</a>
    </div>
  </section>

  <section class="container cards">

    <article class="card">
      <h3>Problem: Low resistivity immediately after a fresh tank swap</h3>
      <p><strong>What you see:</strong> You just installed a freshly regenerated tank but resistivity reads low from the start.</p>
      <p style="margin-top:0.6rem;"><strong>Most likely causes:</strong></p>
      <ul class="bullets">
        <li>Untreated water bypass — a leak or loose fitting is allowing feed water to mix with DI output</li>
        <li>Stagnant water in the supply or distribution piping — flush thoroughly after every tank swap</li>
        <li>The tank was not properly regenerated or was contaminated during transport or storage</li>
        <li>Your monitor needs recalibration — verify with a secondary reading or meter</li>
      </ul>
      <p style="margin-top:0.6rem;"><strong>What to do:</strong> Flush all connections, check all fittings for leaks, verify monitor calibration. If the problem persists through a full flush, contact your service provider.</p>
    </article>

    <article class="card">
      <h3>Problem: Tanks exhausting much faster than expected</h3>
      <p><strong>What you see:</strong> Tanks that used to last 3–4 weeks now exhaust in days.</p>
      <p style="margin-top:0.6rem;"><strong>Most likely causes:</strong></p>
      <ul class="bullets">
        <li>Feed water TDS has increased — seasonal variation, a new water source, or upstream changes in treatment</li>
        <li>Water usage has increased — more production, a new process line, or leaks causing continuous flow</li>
        <li>Chlorine or chloramine damage to resin — degraded resin holds less capacity with each regeneration cycle</li>
        <li>Resin fines migration — damaged resin beads that have broken down reduce effective bed volume</li>
        <li>Tank undersized for current demand — the original sizing may no longer match your operation</li>
      </ul>
      <p style="margin-top:0.6rem;"><strong>What to do:</strong> Test your feed water TDS and check upstream for changes. Audit your actual daily water usage. Add a carbon prefilter if chlorine is the issue. Consider upsizing your tank or adding a second tank in series.</p>
    </article>

    <article class="card">
      <h3>Problem: Silica breakthrough</h3>
      <p><strong>What you see:</strong> Overall resistivity looks acceptable but silica-sensitive processes are showing contamination or interference.</p>
      <p style="margin-top:0.6rem;"><strong>Why it happens:</strong></p>
      <ul class="bullets">
        <li>Silica is a weakly ionized species — it requires <em>strong-base anion resin</em> to capture effectively</li>
        <li>Chlorine exposure degrades strong-base sites on anion resin, reducing silica capacity over time</li>
        <li>Regeneration at insufficient temperature or with insufficient caustic can leave silica on resin</li>
        <li>An anion resin that's been used for many cycles may have lost silica capacity even if it still captures other ions</li>
      </ul>
      <p style="margin-top:0.6rem;"><strong>What to do:</strong> Confirm feed water silica levels with a lab test. Add a carbon prefilter to protect anion resin from chlorine. Discuss resin replacement or a mixed-bed upgrade with your service provider. For critical applications, add silica-specific monitoring.</p>
    </article>

    <article class="card">
      <h3>Problem: Channeling — resistivity drops faster than water volume suggests</h3>
      <p><strong>What you see:</strong> The tank loses quality much sooner than the expected capacity calculations would predict.</p>
      <p style="margin-top:0.6rem;"><strong>Why it happens:</strong></p>
      <ul class="bullets">
        <li>Resin settling or compaction creates preferential flow paths — water bypasses large portions of the bed</li>
        <li>Fines (broken resin beads) migrate and plug distributor screens, forcing uneven flow distribution</li>
        <li>Air pockets introduced during startup or tank swap prevent resin from settling evenly</li>
        <li>High flow rates beyond the tank's rated GPM cause channeling even in a healthy bed</li>
      </ul>
      <p style="margin-top:0.6rem;"><strong>What to do:</strong> Reduce flow rate during startup. Purge air slowly when connecting a new tank. Discuss tank inspection or resin replacement with your service provider if channeling persists.</p>
    </article>

    <article class="card">
      <h3>Problem: DI water quality fluctuates throughout the day</h3>
      <p><strong>What you see:</strong> Resistivity is fine in the morning, drops at peak hours, and sometimes recovers overnight.</p>
      <p style="margin-top:0.6rem;"><strong>Most likely causes:</strong></p>
      <ul class="bullets">
        <li>Flow rate spikes during peak production exceed the tank's rated capacity — slow breakthrough at high flow</li>
        <li>Feed water temperature increases during the day, reducing ion exchange efficiency slightly</li>
        <li>Morning stagnation — water sitting in distribution lines overnight absorbs trace ions from pipe materials</li>
        <li>Feed water TDS fluctuations from the municipal supply, especially in spring (snowmelt) or after storms</li>
      </ul>
      <p style="margin-top:0.6rem;"><strong>What to do:</strong> Flush lines at startup. Verify flow rates against tank ratings. Consider a second tank for peak-hour buffering, or upsize to a larger tank that can handle fluctuating demand.</p>
    </article>

    <article class="card">
      <h3>Problem: Resin oxidation or chlorine damage</h3>
      <p><strong>What you see:</strong> Gradual decline in tank capacity over many cycles — tanks that used to last weeks now last a fraction of that, and the decline is progressive.</p>
      <p style="margin-top:0.6rem;"><strong>Why it happens:</strong></p>
      <ul class="bullets">
        <li>Chlorine and chloramines (common in municipal water) attack and degrade ion exchange resin over time</li>
        <li>Strong oxidants crack resin beads, producing fines that reduce bed volume and clog distributors</li>
        <li>This damage is cumulative — the effect worsens with each cycle on unprotected resin</li>
      </ul>
      <p style="margin-top:0.6rem;"><strong>What to do:</strong> Install an activated carbon prefilter upstream of your DI tank. Carbon removes chlorine and chloramines before they reach the resin. This is one of the highest-ROI upgrades for a Canadian SDI system on municipal water. See our <a class="link" href="activated-carbon-filtration-service.php">activated carbon filtration service</a>.</p>
    </article>

  </section>

  <section class="container cards">
    <article class="card">
      <h3>Quick diagnostic checklist</h3>
      <ul class="bullets">
        <li>Test feed water TDS — compare to historical baseline</li>
        <li>Check outlet resistivity with a calibrated meter (not just the panel display)</li>
        <li>Confirm actual daily flow rate vs. tank rated capacity</li>
        <li>Check all connections and fittings for leaks or bypass</li>
        <li>Verify carbon pretreatment is in place and media is active</li>
        <li>Review how long this tank has been in service vs. typical life</li>
        <li>Check for any upstream changes — new water source, new equipment, new process lines</li>
      </ul>
    </article>

    <article class="card">
      <h3>Related pages</h3>
      <ul class="bullets">
        <li><a class="link" href="how-sdi-works.php">How service deionization works</a></li>
        <li><a class="link" href="sdi-tank-regeneration-frequency.php">How often should SDI tanks be regenerated?</a></li>
        <li><a class="link" href="sdi-vs-ro-canada.php">SDI vs RO comparison</a></li>
        <li><a class="link" href="activated-carbon-filtration-service.php">Activated Carbon Filtration Service</a></li>
        <li><a class="link" href="di-tank-exchange-service.php">DI Tank Exchange Service</a></li>
        <li><a class="link" href="sdi-tank-sizing.php">SDI Tank Sizing Calculator</a></li>
      </ul>
    </article>
  </section>

  <section class="strip cta-strip">
    <div class="container">
      <h2>Having a problem with your DI system?</h2>
      <p>Describe what you're seeing — low resistivity, fast exhaustion, quality fluctuations — and we'll help you diagnose it and recommend a fix.</p>
      <a href="contact.php" class="btn">Get Troubleshooting Help</a>
    </div>
  </section>

<?php include 'footer.php'; ?>
