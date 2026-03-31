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
            <button id="downloadTXT" style="display:none;margin-top:1.2em;background:#0099A8;color:#fff;border:none;border-radius:4px;padding:0.5em 1.2em;font-weight:600;font-size:1em;cursor:pointer;box-shadow:0 2px 6px rgba(0,0,0,0.07);transition:background 0.2s;">Download TXT Report</button>
        </div>
    <script src="load-jspdf.js"></script>
        <script>
        // Download TXT logic
        function buildTxtReport(data) {
            return (
    `Eclipse Water Technologies SDI Tank Sizing Report\n\n` +
    `Date: ${data.date}\n\n` +
    `Inputs:\n` +
    `Feedwater Conductivity: ${data.conductivity} microseimen per cm\n` +
    `Feedwater TDS: ${data.tds} mg/L\n` +
    `Feedwater CO2: ${data.co2} mg/L\n` +
    `Grains Loading: ${data.grainsLoading} grains/USG\n` +
    `Flow Rate: ${data.flowRange} USGPM\n` +
    `Hours per Day: ${data.hours}\n\n` +
    `Calculation Steps:\n` +
    `1. Grains Loading Formula:\n` +
    `   Grains Loading = (TDS + CO2) / 17.1\n` +
    `   = (${data.tds} + ${data.co2}) / 17.1 = ${data.grainsLoading} grains/USG\n\n` +
    `2. Tank Capacity Formula:\n` +
    `   Tank Capacity = (Resin Volume x 12,000) / Grains Loading\n` +
    `   = (${data.resin} x 12,000) / ${data.grainsLoading} = ${data.tankCapacity} USG\n\n` +
    `3. Days to Exchange:\n` +
    `   Gallons per Day = Flow Rate x 60 x Hours\n` +
    `   = ${data.flowRange} x 60 x ${data.hours} = ${data.gallonsPerDay} USG/day\n` +
    `   Days to Exchange = Tank Capacity / Gallons per Day\n` +
    `   = ${data.tankCapacity} / ${data.gallonsPerDay} = ${data.daysToExchange} days\n\n` +
    `Results:\n` +
    `Recommended Tank: ${data.tankLabel}\n` +
    `Tank Capacity: ${data.tankCapacity} USG\n` +
    `Estimated Days to Exchange: ${data.daysToExchange} days\n\n` +
    `Assumptions:\n` +
    `• TDS (mg/L) = Conductivity (microseimen per cm) x 0.67\n` +
    `• Standard resin capacity per tank model (12,000 grains/ft³)\n\n` +
    `Eclipse Water Technologies\n` +
    `Website: eclipsewatertechnologies.com\n` +
    `Phone: 647 355 0944\n` +
    `Email: rlee@eclipsewatertechnologies.com\n` +
    `To order a tank or discuss your application, contact us or visit our website.\n`
            );
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
            // Show TXT button
            var txtBtn = document.getElementById('downloadTXT');
            if (txtBtn) {
                txtBtn.style.display = 'inline-block';
                txtBtn.onclick = function() {
                    const txt = buildTxtReport({
                        date: new Date().toLocaleString(),
                        conductivity: document.getElementById('conductivity').value,
                        tds,
                        co2,
                        grainsLoading,
                        flowRange,
                        hours,
                        resin: recommended.resin,
                        tankCapacity: parseInt(tankCapacity).toLocaleString(),
                        gallonsPerDay,
                        daysToExchange,
                        tankLabel: recommended.label
                    });
                    const blob = new Blob([txt], {type: 'text/plain'});
                    const a = document.createElement('a');
                    a.href = URL.createObjectURL(blob);
                    a.download = 'SDI_Tank_Sizing_Report.txt';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                };
            }
        };
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
            // Show TXT button
            var txtBtn = document.getElementById('downloadTXT');
            if (txtBtn) {
                txtBtn.style.display = 'inline-block';
                txtBtn.onclick = function() {
                    const txt = buildTxtReport({
                        date: new Date().toLocaleString(),
                        conductivity: document.getElementById('conductivity').value,
                        tds,
                        co2,
                        grainsLoading,
                        flowRange,
                        hours,
                        resin: recommended.resin,
                        tankCapacity: parseInt(tankCapacity).toLocaleString(),
                        gallonsPerDay,
                        daysToExchange,
                        tankLabel: recommended.label
                    });
                    const blob = new Blob([txt], {type: 'text/plain'});
                    const a = document.createElement('a');
                    a.href = URL.createObjectURL(blob);
                    a.download = 'SDI_Tank_Sizing_Report.txt';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                };
            }
        };
        </script>
        <?php include 'Cancellation Page/layout_end.php'; ?>
    </body>
    </html>
