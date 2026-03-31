<!-- SDI/Resin Tank Sizing Calculator Form Only (no duplicate header/hero) -->
        <div class="container calc-form">
            <form id="tankCalc" autocomplete="off">
                <div class="calc-section">
                    <h2>Step 1: Your Water Usage</h2>
                    <label for="flowRange">What is your typical flow rate?</label>
                    <span class="info">If unsure, estimate the average flow in gallons per minute (gpm) your process or equipment uses.</span>
                    <select id="flowRange" required>
                        <option value="3">1–5 gpm (small lab, glasswasher, etc.)</option>
                        <option value="8">5–10 gpm (medium process, small production)</option>
                        <option value="15">10–20 gpm (large process, multiple outlets)</option>
                        <option value="30">20–40 gpm (industrial, large system)</option>
                        <option value="60">40–80 gpm (very large system)</option>
                        <option value="100">80–120 gpm (multiple large systems)</option>
                    </select>
                    <label for="hours">How many hours per day do you use water?</label>
                    <span class="info">Estimate the number of hours your system runs each day.</span>
                    <input type="number" id="hours" value="8" min="0" step="0.1" required>
                </div>
                <div class="calc-section">
                    <h2>Step 2: Water Quality (Optional)</h2>
                    <label for="conductivity">Feedwater Conductivity (μS/cm)</label>
                    <span class="info">If you have a water quality report, enter the conductivity. Otherwise, leave the default.</span>
                    <input type="number" id="conductivity" value="75" min="0" step="0.1">
                    <div style="margin:1.2rem 0 0.5rem 0;">
                        <div class="info" style="margin-bottom:0.5em;">
                            <strong>Advanced Options:</strong> For most users, the default water quality values are accurate. If you have a water analysis or lab report, you can enter your own TDS, CO₂, or grains loading values for a more precise calculation.
                        </div>
                        <button type="button" id="toggleAdvanced" style="margin-bottom:0.5em; background:#0099A8; color:#fff; border:none; border-radius:4px; padding:0.5em 1.2em; font-weight:600; font-size:1em; cursor:pointer; box-shadow:0 2px 6px rgba(0,0,0,0.07); transition:background 0.2s;">Show Advanced Options</button>
                    </div>
                    <div id="advancedOptions" style="display:none;background:#fafdff;border:1px solid #d9eff2;border-radius:8px;padding:1rem;margin-bottom:1rem;">
                        <label for="tds">Feedwater TDS (mg/L)</label>
                        <span class="info">TDS (Total Dissolved Solids) is usually about 0.67 × conductivity. You can override this if you have a lab value.</span>
                        <input type="number" id="tds" value="50" min="0" step="0.1">
                        <label for="co2">Feedwater CO₂ (mg/L)</label>
                        <span class="info">CO₂ is typically 1–5 mg/L in municipal water. If unsure, leave as default.</span>
                        <input type="number" id="co2" value="2" min="0" step="0.1">
                        <label for="grainsLoading">Grains Loading (grains/USG)</label>
                        <span class="info">Calculated as (TDS + CO₂) / 17.1. Lower grains loading means higher purity water and less capacity per tank.</span>
                        <input type="number" id="grainsLoading" value="3.0" min="0.1" step="0.01">
                        <div style="font-size:0.97em;color:#0099A8;margin-top:0.7em;">Lower conductivity (higher purity) water will reduce grains loading and tank capacity. Adjust grains loading if your water is purer than typical feedwater.</div>
                    </div>
                    <div id="assumptionsBox" style="background:#fafdff;border:1px solid #d9eff2;border-radius:8px;padding:1rem;margin-bottom:1rem;">
                        <strong>Assumptions (edit in Advanced Options):</strong>
                        <ul style="margin:0 0 0 1.2em;">
                            <li>TDS: <span id="assumeTDS">50</span> mg/L</li>
                            <li>CO₂: <span id="assumeCO2">2</span> mg/L</li>
                            <li>Grains Loading: <span id="assumeGrains">3.0</span> grains/USG</li>
                            <li>Standard resin capacity per tank model (12,000 grains/ft³)</li>
                        </ul>
                    </div>
                </div>
                <div class="calc-section">
                    <h2>Step 3: See Your Results</h2>
                    <button type="submit" class="btn">Calculate My Tank Size</button>
                </div>
            </form>
            <div class="calc-results" id="results" style="display:none;"></div>
            <button id="downloadPDF" style="display:none;margin-top:1.2em;background:#0099A8;color:#fff;border:none;border-radius:4px;padding:0.5em 1.2em;font-weight:600;font-size:1em;cursor:pointer;box-shadow:0 2px 6px rgba(0,0,0,0.07);transition:background 0.2s;" disabled>Download PDF Report</button>
            <div id="pdfWaitMsg" style="display:none;color:#b00;font-size:1em;margin-top:0.5em;">PDF library is still loading. Please wait...</div>
        </div>
    <script src="load-jspdf.js"></script>
        <script>
        // Wait for jsPDF to load, then enable the button
        function enablePDFButtonWhenReady() {
            var check = setInterval(function() {
                if (window.jspdf && window.jspdf.jsPDF) {
                    document.getElementById('downloadPDF').disabled = false;
                    document.getElementById('pdfWaitMsg').style.display = 'none';
                    clearInterval(check);
                } else {
                    document.getElementById('pdfWaitMsg').style.display = 'block';
                }
            }, 200);
        }
        enablePDFButtonWhenReady();
        </script>
    <script>
                // Auto-calculate TDS from conductivity unless user overrides in advanced
                function updateTDSfromConductivity() {
                    const cond = parseFloat(document.getElementById('conductivity').value);
                    const tdsField = document.getElementById('tds');
                    if (tdsField && document.getElementById('advancedOptions').style.display === 'none') {
                        tdsField.value = (cond * 0.67).toFixed(1);
                        updateAssumptions();
                    }
                }
                document.getElementById('conductivity').addEventListener('input', updateTDSfromConductivity);

        // Advanced Options toggle
        document.getElementById('toggleAdvanced').onclick = function() {
            const adv = document.getElementById('advancedOptions');
            adv.style.display = adv.style.display === 'none' ? 'block' : 'none';
            this.textContent = adv.style.display === 'block' ? 'Hide Advanced Options' : 'Show Advanced Options';
        };

        // Update assumptions box live
        function updateAssumptions() {
                document.getElementById('conductivity').value && (document.getElementById('assumeTDS').textContent = (parseFloat(document.getElementById('conductivity').value) * 0.67).toFixed(1));
            document.getElementById('assumeTDS').textContent = document.getElementById('tds').value;
            document.getElementById('assumeCO2').textContent = document.getElementById('co2').value;
            document.getElementById('assumeGrains').textContent = document.getElementById('grainsLoading').value;
        }
        ['tds','co2','grainsLoading'].forEach(id => {
            document.addEventListener('input', function(e) {
                if (e.target && e.target.id === id) updateAssumptions();
            });
        });

        // Show grains loading formula and calculation
        function grainsLoadingFormula(tds, co2) {
            return `Grains Loading = (TDS + CO₂) / 17.1 = (${tds} + ${co2}) / 17.1`;
        }

        document.getElementById('tankCalc').onsubmit = function(e) {
            e.preventDefault();
            // Get values
            let tds = parseFloat(document.getElementById('tds').value);
            let co2 = parseFloat(document.getElementById('co2').value);
            let grainsLoading = parseFloat(document.getElementById('grainsLoading') ? document.getElementById('grainsLoading').value : 3.0);
            // If advanced is hidden, recalc grains loading from TDS/CO2
            if (document.getElementById('advancedOptions').style.display === 'none') {
                grainsLoading = ((tds + co2) / 17.1).toFixed(2);
            }
            // Tank models and capacities
            const tanks = [
                {label: '8x44 (1.0 ft³)', resin: 1.0, capacity: 12500, flow: 3},
                {label: '14x47 (3.5 ft³)', resin: 3.5, capacity: 35000, flow: 8},
                {label: '21x62 (7.0 ft³)', resin: 7.0, capacity: 70000, flow: 15},
                {label: 'Jumbo (42 ft³)', resin: 42, capacity: 420000, flow: 60}
            ];
            const flowRange = parseFloat(document.getElementById('flowRange').value);
            const hours = parseFloat(document.getElementById('hours').value);
            // Find recommended tank
            let recommended = tanks[0];
            for (let i = 0; i < tanks.length; i++) {
                if (flowRange <= tanks[i].flow) {
                    recommended = tanks[i];
                    break;
                }
            }
            // Always use the formula for tank capacity
            let tankCapacity = ((12000 * recommended.resin) / grainsLoading).toFixed(1);
            const gallonsPerDay = (flowRange * 60 * hours).toFixed(0);
            const daysToExchange = (tankCapacity / gallonsPerDay).toFixed(1);
            document.getElementById('results').style.display = 'block';
            document.getElementById('results').innerHTML = `
                <strong>Recommended Tank:</strong> ${recommended.label}<br>
                <strong>Tank Capacity:</strong> ${parseInt(tankCapacity).toLocaleString()} USG<br>
                <strong>Estimated Days to Exchange:</strong> ${daysToExchange} days<br>
                <hr style="margin:1em 0;">
                <strong>Grains Loading Calculation:</strong><br>
                <span style="font-size:0.98em;">${grainsLoadingFormula(tds, co2)} = <strong>${grainsLoading}</strong> grains/USG</span><br>
                <span style="font-size:0.98em;color:#0099A8;">TDS (mg/L) ≈ Conductivity (μS/cm) × 0.67</span><br>
                <span style="font-size:0.98em;color:#0099A8;">Assumptions: TDS ${tds} mg/L, CO₂ ${co2} mg/L, Grains Loading ${grainsLoading} grains/USG</span>
            `;
            // Show PDF button
            const pdfBtn = document.getElementById('downloadPDF');
            pdfBtn.style.display = 'inline-block';
            pdfBtn.onclick = function() {
                if (!window.jspdf && window.jspdf === undefined && !window.jsPDFLoaded) {
                    alert('PDF library not loaded yet. Please wait a moment and try again.');
                    return;
                }
                const { jsPDF } = window.jspdf || window.jspdf || {};
                const doc = new jsPDF();
                let y = 15;
                // Logo removed for compatibility
                // Draw dark blue header background
                doc.setFillColor(0,51,102);
                doc.rect(0, y-7, 210, 13, 'F');
                // White header text
                doc.setFontSize(16);
                doc.setTextColor(255,255,255);
                doc.text('Eclipse Water Technologies SDI Tank Sizing Report', 105, y, {align:'center'});
                y += 10;
                // Set light gray for all main text
                doc.setTextColor(80,80,80);
                doc.setFontSize(12);
                doc.text('Date: ' + new Date().toLocaleString(), 14, y);
                y += 10;
                doc.setFontSize(13);
                doc.text('Inputs:', 14, y);
                y += 8;
                doc.setFontSize(11);
                // Use monospace for all input lines
                doc.setFont('courier', 'normal');
                doc.text(`Feedwater Conductivity: ${document.getElementById('conductivity').value} microseimen per cm`, 14, y);
                y += 7;
                doc.text(`Feedwater TDS: ${tds} mg/L`, 14, y);
                y += 7;
                doc.text(`Feedwater CO2: ${co2} mg/L`, 14, y);
                y += 7;
                doc.text(`Grains Loading: ${grainsLoading} grains/USG`, 14, y);
                y += 7;
                doc.text(`Flow Rate: ${flowRange} USGPM`, 14, y);
                y += 7;
                doc.text(`Hours per Day: ${hours}`, 14, y);
                y += 10;
                doc.setFont('helvetica', 'normal');
                doc.setFontSize(13);
                doc.text('Calculation Steps:', 14, y);
                y += 8;
                doc.setFontSize(11);
                doc.setFont('courier', 'normal');
                doc.text('1. Grains Loading Formula:', 14, y);
                y += 7;
                doc.text('   Grains Loading = (TDS + CO2) / 17.1', 18, y);
                y += 7;
                doc.text(`   = (${tds} + ${co2}) / 17.1 = ${grainsLoading} grains/USG`, 18, y);
                y += 10;
                doc.text('2. Tank Capacity Formula:', 14, y);
                y += 7;
                doc.text('   Tank Capacity = (Resin Volume x 12,000) / Grains Loading', 18, y);
                y += 7;
                doc.text(`   = (${recommended.resin} x 12,000) / ${grainsLoading} = ${parseInt(tankCapacity).toLocaleString()} USG`, 18, y);
                y += 10;
                doc.text('3. Days to Exchange:', 14, y);
                y += 7;
                doc.text('   Gallons per Day = Flow Rate x 60 x Hours', 18, y);
                y += 7;
                doc.text(`   = ${flowRange} x 60 x ${hours} = ${gallonsPerDay} USG/day`, 18, y);
                y += 7;
                doc.text('   Days to Exchange = Tank Capacity / Gallons per Day', 18, y);
                y += 7;
                doc.text(`   = ${parseInt(tankCapacity).toLocaleString()} / ${gallonsPerDay} = ${daysToExchange} days`, 18, y);
                y += 10;
                doc.setFont('helvetica', 'normal');
                doc.setFontSize(13);
                doc.text('Results:', 14, y);
                y += 8;
                doc.setFontSize(11);
                doc.text(`Recommended Tank: ${recommended.label}`, 14, y);
                y += 7;
                doc.text(`Tank Capacity: ${parseInt(tankCapacity).toLocaleString()} USG`, 14, y);
                y += 7;
                doc.text(`Estimated Days to Exchange: ${daysToExchange} days`, 14, y);
                y += 10;
                doc.setFont('helvetica', 'normal');
                doc.setFontSize(13);
                doc.text('Assumptions:', 14, y);
                y += 8;
                doc.setFontSize(11);
                doc.text('• TDS (mg/L) = Conductivity (microseimen per cm) x 0.67', 14, y);
                doc.text('• Standard resin capacity per tank model (12,000 grains/ft³)', 14, y+7);
                y += 18;
                doc.setFontSize(12);
                doc.setTextColor(0, 51, 102);
                doc.text('Eclipse Water Technologies', 14, y);
                y += 7;
                doc.setFontSize(11);
                doc.setTextColor(80, 80, 80); // Light gray for contact info
                doc.text('Website: eclipsewatertechnologies.com', 14, y);
                y += 6;
                doc.text('Phone: 647 355 0944', 14, y);
                y += 6;
                doc.text('Email: rlee@eclipsewatertechnologies.com', 14, y);
                y += 8;
                doc.setFontSize(11);
                doc.setTextColor(0, 51, 102);
                doc.text('To order a tank or discuss your application, contact us or visit our website.', 14, y);
                doc.setTextColor(0, 0, 0);
                doc.save('Resin_Tank_Sizing_Report.pdf');
            };
        };
    </script>
    <?php include 'Cancellation Page/layout_end.php'; ?>
</body>
</html>
