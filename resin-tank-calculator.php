<!-- SDI/Resin Tank Sizing Calculator Form Only (no duplicate header/hero) -->
        <div class="container calc-form">
            <form id="tankCalc" autocomplete="off">
                <div class="calc-section">
                    <h2>Step 1: Your Water Usage</h2>
                    <span class="info">Reference the chart below to estimate your typical flow rate and see the USG capacity for each tank model.</span>
                    <table style="width:100%;margin-bottom:1em;border-collapse:collapse;text-align:center;">
                        <thead>
                            <tr style="background:#eaf7f0;">
                                <th>Application</th>
                                <th>Flow Range (GPM)</th>
                                <th>Recommended Tank Model</th>
                                <th>USG Capacity*</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Small lab, glasswasher</td>
                                <td>1–5</td>
                                <td>8x44 (1.0 ft³)</td>
                                <td>1,200–1,500</td>
                            </tr>
                            <tr>
                                <td>Medium process, small production</td>
                                <td>5–10</td>
                                <td>14x47 (3.5 ft³)</td>
                                <td>3,500–4,500</td>
                            </tr>
                            <tr>
                                <td>Large process, multiple outlets</td>
                                <td>10–20</td>
                                <td>21x62 (7.0 ft³)</td>
                                <td>7,000–9,000</td>
                            </tr>
                            <tr>
                                <td>Industrial, large system</td>
                                <td>20–40</td>
                                <td>Jumbo (42 ft³)</td>
                                <td>42,000–50,000</td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:600px;margin-bottom:1em;border-collapse:separate;border-spacing:0 0.5em;">
                        <tr>
                            <td style="width:45%;vertical-align:top;font-weight:600;">Select Tank Model:</td>
                            <td style="width:55%;vertical-align:top;">
                                <select id="tankModel" required style="width:100%;">
                                    <option value="1.0">8x44 (1.0 ft³)</option>
                                    <option value="3.5">14x47 (3.5 ft³)</option>
                                    <option value="7.0">21x62 (7.0 ft³)</option>
                                    <option value="42">Jumbo (42 ft³)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top;font-weight:600;">Enter your typical flow rate (GPM):</td>
                            <td style="vertical-align:top;">
                                <input type="number" id="flowRate" value="5" min="0.1" step="0.1" required style="width:100%;max-width:120px;">
                                <div style="font-size:0.97em;color:#888;">Enter the average flow in gallons per minute (gpm) your process or equipment uses.</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top;font-weight:600;">How many hours per day do you use water?</td>
                            <td style="vertical-align:top;">
                                <input type="number" id="hours" value="8" min="0" step="0.1" required style="width:100%;max-width:120px;">
                                <div style="font-size:0.97em;color:#888;">Estimate the number of hours your system runs each day.</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top;font-weight:600;">Number of Tanks (in series)</td>
                            <td style="vertical-align:top;">
                                <input type="number" id="numTanks" value="1" min="1" max="10" step="1" required style="width:100%;max-width:120px;">
                                <div style="font-size:0.97em;color:#888;">How many tanks will be used in series (one after another)?</div>
                            </td>
                        </tr>
                    </table>
                    <div style="font-size:0.95em;color:#888;margin-top:0.5em;">*USG capacity is an estimate and will be refined by your water quality in later steps.</div>
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
                        <table style="width:100%;max-width:600px;margin-bottom:0.5em;border-collapse:separate;border-spacing:0 0.5em;">
                            <tr>
                                <td style="width:38%;vertical-align:top;font-weight:600;">Feedwater TDS (mg/L)</td>
                                <td style="width:62%;vertical-align:top;">
                                    <input type="number" id="tds" value="50" min="0" step="0.1" style="width:100%;max-width:120px;">
                                    <div style="font-size:0.97em;color:#888;">TDS (Total Dissolved Solids) is usually about 0.67 × conductivity. You can override this if you have a lab value.</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;font-weight:600;">Feedwater CO₂ (mg/L)</td>
                                <td style="vertical-align:top;">
                                    <input type="number" id="co2" value="2" min="0" step="0.1" style="width:100%;max-width:120px;">
                                    <div style="font-size:0.97em;color:#888;">CO₂ is typically 1–5 mg/L in municipal water. If unsure, leave as default.</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;font-weight:600;">Grains Loading (grains/USG)</td>
                                <td style="vertical-align:top;">
                                    <input type="number" id="grainsLoading" value="3.0" min="0.1" step="0.01" style="width:100%;max-width:120px;">
                                    <div style="font-size:0.97em;color:#888;">Calculated as (TDS + CO₂) / 17.1. Lower grains loading means higher purity water and less capacity per tank.</div>
                                </td>
                            </tr>
                        </table>
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
    <!-- PDF logic removed, replaced with TXT download logic -->
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
            let numTanks = parseInt(document.getElementById('numTanks').value) || 1;
            let tankModel = parseFloat(document.getElementById('tankModel').value);
            let tankLabel = document.getElementById('tankModel').options[document.getElementById('tankModel').selectedIndex].text;
            let flowRate = parseFloat(document.getElementById('flowRate').value);
            let hours = parseFloat(document.getElementById('hours').value);
            // If advanced is hidden, recalc grains loading from TDS/CO2
            if (document.getElementById('advancedOptions').style.display === 'none') {
                grainsLoading = ((tds + co2) / 17.1).toFixed(2);
            }
            // In series: only one tank's capacity is used for service interval
            let singleTankCapacity = ((12000 * tankModel) / grainsLoading).toFixed(1);
            let totalCapacity = (singleTankCapacity * numTanks).toFixed(1);
            const gallonsPerDay = (flowRate * 60 * hours).toFixed(0);
            // Days to Exchange = Gallons Capacity / Gallons Per Day
            const daysToExchange = (singleTankCapacity / gallonsPerDay).toFixed(1);
            document.getElementById('results').style.display = 'block';
            document.getElementById('results').innerHTML = `
                <strong>Selected Tank Model:</strong> ${tankLabel}<br>
                <strong>Number of Tanks (in series):</strong> ${numTanks}<br>
                <strong>Single Tank Capacity:</strong> ${parseInt(singleTankCapacity).toLocaleString()} USG<br>
                <strong>Total System Capacity:</strong> ${parseInt(totalCapacity).toLocaleString()} USG<br>
                <strong>Flow Rate Used for Calculation:</strong> ${flowRate} GPM<br>
                <strong>Estimated Days to Exchange (per tank):</strong> ${daysToExchange} days<br>
                <span style="font-size:0.97em;color:#0099A8;">Days to Exchange = Gallons Capacity / Gallons Per Day</span><br>
                <hr style="margin:1em 0;">
                <strong>Grains Loading Calculation:</strong><br>
                <span style="font-size:0.98em;">${grainsLoadingFormula(tds, co2)} = <strong>${grainsLoading}</strong> grains/USG</span><br>
                <span style="font-size:0.98em;color:#0099A8;">TDS (mg/L) ≈ Conductivity (μS/cm) × 0.67</span><br>
                <span style="font-size:0.98em;color:#0099A8;">Assumptions: TDS ${tds} mg/L, CO₂ ${co2} mg/L, Grains Loading ${grainsLoading} grains/USG</span>
            `;
            // Show TXT button
            const txtBtn = document.getElementById('downloadTXT');
            txtBtn.style.display = 'inline-block';
            txtBtn.onclick = function() {
                // Build plain text report
                let txt = '';
                txt += 'Eclipse Water Technologies SDI Tank Sizing Report\n';
                txt += 'Date: ' + new Date().toLocaleString() + '\n\n';
                txt += 'Inputs:\n';
                txt += `Feedwater Conductivity: ${document.getElementById('conductivity').value} μS/cm\n`;
                txt += `Feedwater TDS: ${tds} mg/L\n`;
                txt += `Feedwater CO2: ${co2} mg/L\n`;
                txt += `Grains Loading: ${grainsLoading} grains/USG\n`;
                txt += `Tank Model: ${tankLabel}\n`;
                txt += `Flow Rate: ${flowRate} USGPM\n`;
                txt += `Hours per Day: ${hours}\n`;
                txt += `Number of Tanks (in series): ${numTanks}\n\n`;
                txt += 'Calculation Steps:\n';
                txt += '1. Grains Loading Formula:\n';
                txt += `   Grains Loading = (TDS + CO2) / 17.1 = (${tds} + ${co2}) / 17.1 = ${grainsLoading} grains/USG\n`;
                txt += '2. Single Tank Capacity Formula:\n';
                txt += `   Single Tank Capacity = (Resin Volume x 12,000) / Grains Loading = (${tankModel} x 12,000) / ${grainsLoading} = ${parseInt(singleTankCapacity).toLocaleString()} USG\n`;
                txt += '3. Days to Exchange (per tank):\n';
                txt += `   Gallons per Day = Flow Rate x 60 x Hours = ${flowRate} x 60 x ${hours} = ${gallonsPerDay} USG/day\n`;
                txt += `   Days to Exchange = Gallons Capacity / Gallons per Day = ${parseInt(singleTankCapacity).toLocaleString()} / ${gallonsPerDay} = ${daysToExchange} days\n\n`;
                txt += 'Results:\n';
                txt += `Selected Tank Model: ${tankLabel}\n`;
                txt += `Number of Tanks (in series): ${numTanks}\n`;
                txt += `Single Tank Capacity: ${parseInt(singleTankCapacity).toLocaleString()} USG\n`;
                txt += `Total System Capacity: ${parseInt(totalCapacity).toLocaleString()} USG\n`;
                txt += `Flow Rate Used for Calculation: ${flowRate} GPM\n`;
                txt += `Estimated Days to Exchange (per tank): ${daysToExchange} days\n\n`;
                txt += 'Assumptions:\n';
                txt += '• TDS (mg/L) = Conductivity (μS/cm) x 0.67\n';
                txt += '• Standard resin capacity per tank model (12,000 grains/ft³)\n\n';
                txt += 'Eclipse Water Technologies\n';
                txt += 'Website: eclipsewatertechnologies.com\n';
                txt += 'Phone: 647 355 0944\n';
                txt += 'Email: rlee@eclipsewatertechnologies.com\n';
                txt += 'To order a tank or discuss your application, contact us or visit our website.\n';
                // Download as TXT
                var blob = new Blob([txt], { type: 'text/plain' });
                var a = document.createElement('a');
                a.href = URL.createObjectURL(blob);
                a.download = 'Resin_Tank_Sizing_Report.txt';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            };
        };
    </script>
    <?php include 'Cancellation Page/layout_end.php'; ?>
</body>
</html>
