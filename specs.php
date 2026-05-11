<?php
$pageTitle = 'Technical Specifications | Eclipse Water Technologies';
$pageDescription = 'Comprehensive technical specifications for Eclipse Water Technologies DI and filtration systems, including tank models, construction, and operating parameters.';
include 'header.php';
?>
<style>
    .accordion {
      border-radius: 18px;
      box-shadow: 0 4px 24px rgba(0,32,64,0.10);
      border: 1.5px solid #b3d1e6;
      background: linear-gradient(120deg, #fafdff 60%, #e6f4ff 100%);
      margin-bottom: 2.2rem;
      overflow: hidden;
      transition: box-shadow 0.2s, border 0.2s;
    }
    .accordion.open {
      box-shadow: 0 6px 32px rgba(0,32,64,0.16);
      border-color: #0099A8;
    }
    .accordion-header {
      cursor: pointer;
      padding: 1.3rem 2rem 1.3rem 2.2rem;
      font-family: 'Montserrat', sans-serif;
      font-size: 1.22rem;
      color: #003366;
      background: linear-gradient(90deg, #e6f4ff 80%, #d0eaff 100%);
      border-bottom: 1px solid #d0eaff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-weight: 700;
      letter-spacing: 0.01em;
      transition: background 0.2s, color 0.2s;
    }
    .accordion-header:hover {
      background: linear-gradient(90deg, #d0eaff 80%, #b3e6ff 100%);
      color: #0099A8;
    }
    .accordion-content {
      display: none;
      padding: 2.2rem 2.2rem 2rem 2.2rem;
      background: #fafdff;
      animation: fadeIn 0.3s;
    }
    .accordion.open .accordion-content {
      display: block;
    }
    .accordion-arrow {
      font-size: 1.4em;
      color: #0099A8;
      transition: transform 0.2s, color 0.2s;
    }
    .accordion.open .accordion-arrow {
      transform: rotate(90deg);
      color: #003366;
    }
    .specs-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      margin-bottom: 1.2rem;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 1px 6px rgba(0,32,64,0.06);
    }
    .specs-table th, .specs-table td {
      padding: 0.85em 1em;
      text-align: left;
      font-size: 1.04em;
    }
    .specs-table th {
      background: #e6f4ff;
      color: #003366;
      font-weight: 700;
      border-bottom: 2px solid #b3d1e6;
    }
    .specs-table tr:nth-child(even) td {
      background: #f3faff;
    }
    .specs-table tr:nth-child(odd) td {
      background: #fff;
    }
    .specs-table td {
      color: #2a3a4a;
      border-bottom: 1px solid #e6f4ff;
    }
    .specs-table tr:last-child td {
      border-bottom: none;
    }
    .note {
      font-size: 0.98em;
      color: #0099A8;
      background: #e6f4ff;
      border-left: 4px solid #0099A8;
      padding: 0.7em 1.2em;
      border-radius: 6px;
      margin-top: 0.7em;
      margin-bottom: 0.2em;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    @media (max-width: 700px) {
      .accordion-header, .accordion-content {
        padding-left: 1.1rem;
        padding-right: 1.1rem;
      }
    }
  </style>
  <main>
    <section class="container" style="margin-top:2rem;">
      <h1 style="font-family:'Montserrat',sans-serif;color:#003366;font-size:2rem;margin-bottom:1.5rem;">Technical Specifications</h1>
      <a href="resin-tank-calculator.php" class="btn" style="margin-bottom:2rem;display:inline-block;">Resin Tank Sizing Calculator</a>
      <div class="accordion" id="accordion-tank-models">
        <div class="accordion-header">Tank Models & Capacities <span class="accordion-arrow">▶</span></div>
        <div class="accordion-content">
          <div class="table-wrap">
          <table class="specs-table">
            <thead>
              <tr>
                <th>Model</th>
                <th>Size (ft³)</th>
                <th>Flow GPM</th>
                <th>Capacities Gal</th>
                <th>Construction</th>
                <th>Internals</th>
                <th>Fittings</th>
                <th>Media Options</th>
              </tr>
            </thead>
            <tbody>
                <td>8x44</td>
                <td>1.0</td>
                <td>1 to 5 </td>
                <td>12500</td>
                <td>FRP (Fiberglass) w/ Polyethylene Liner</td>
                <td>PVC</td>
                <td>Park Quick Connect</td>
                <td>Mixed Bed Resin; Softening; Activated Carbon</td>
              </tr>
              <tr>
                <td>14x47</td>
                <td>3.5</td>
                <td>3 to 13</td>
                <td>35000</td>
                <td>FRP (Fiberglass) w/ Polyethylene Liner</td>
                <td>PVC</td>
                <td>Park Quick Connect</td>
                <td>Mixed Bed Resin; Softening; Activated Carbon</td>
              </tr>
              <tr>
                <td>Jumbo</td>
                <td>42</td>
                <td>30 to 100</td>
                <td>420000</td>
                <td>FRP (Fiberglass) w/ Polyethylene Liner</td>
                <td>PVC, CPVC, or Stainless Steel</td>
                <td>Camlock</td>
                <td>Mixed Bed Resin; Softening; Activated Carbon</td>
              </tr>
            </tbody>
          </table>
          </div><!-- /.table-wrap -->
          <p class="note">Capacities are nominal and may vary based on feed water quality and application. Contact Eclipse Water Technologies for detailed sizing and selection support.</p>
        </div>
      </div>
      <div class="accordion" id="accordion-operating-params">
        <div class="accordion-header">Recommended Operating Parameters <span class="accordion-arrow">▶</span></div>
        <div class="accordion-content">
          <div class="table-wrap">
          <table class="specs-table">
            <thead>
              <tr>
                <th>Parameter</th>
                <th>Recommended Maximum</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Operating Sec</td>
                <td>100 psi (6.9 bar) / 38°C (100°F)</td>
              </tr>
              <tr>
                <td>Feed Water Turbidity</td>
                <td>5 NTU (max)</td>
              </tr>
              <tr>
                <td>Feed Water Colour</td>
                <td>5 units (max)</td>
              </tr>
              <tr>
                <td>Feed Water Organics</td>
                <td>3 ppm (max)</td>
              </tr>
              <tr>
                <td>Feed Water Manganese &amp; Iron</td>
                <td>0.3 ppm (max, combined)</td>
              </tr>
              <tr>
                <td>Feed Water Total Chlorine</td>
                <td>0 ppm (max)</td>
              </tr>
            </tbody>
          </table>
          </div><!-- /.table-wrap -->
          <p class="note">For optimal performance and safety, do not exceed these values. Consult Eclipse Water Technologies for applications with special requirements.</p>
        </div>
      </div>
    </section>
  </main>
  <script>
    document.querySelectorAll('.accordion-header').forEach(header => {
      header.addEventListener('click', function() {
        const accordion = this.parentElement;
        const isOpen = accordion.classList.contains('open');
        document.querySelectorAll('.accordion').forEach(acc => acc.classList.remove('open'));
        if (!isOpen) accordion.classList.add('open');
      });
    });
  </script>
<?php include 'footer.php'; ?>
