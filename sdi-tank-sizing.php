<?php
$pageTitle = 'SDI Tank Sizing Calculator | Eclipse Water Technologies';
$pageDescription = 'Use this tool to determine the right SDI tank size for your application. Enter your water usage and quality details to get a step-by-step sizing recommendation.';
include 'header.php';
?>
    <section class="hero hero-sub">
        <div class="section-inner">
            <h1>SDI Tank Sizing Calculator</h1>
            <p style="font-size:1.18em;max-width:700px;margin:0.7em auto 0;">Use this tool to determine the right SDI tank size for your application. Enter your water usage and quality details to get a professional, step-by-step engineering report.</p>
        </div>
    </section>
    <div class="container calc-form">
        <?php include 'resin-tank-calculator.php'; ?>
    </div>

<?php include 'footer.php'; ?>
