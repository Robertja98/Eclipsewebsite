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
                    <h2>Step 1b: Resin Type</h2>
                    <label for="resinType"><strong>Resin Type:</strong></label>
                    <select id="resinType" style="width:100%;max-width:360px;margin-bottom:0.5em;">
                        <option value="12">Mixed Bed (12 kgrn/ft³)</option>
                        <option value="36">Cation (36 kgrn/ft³)</option>
                        <option value="23.5">Anion (23.5 kgrn/ft³)</option>
                        <option value="custom">Custom (enter below)</option>
                    </select>
                    <input type="number" id="customGrains" value="12" min="1" max="50" step="0.1" style="width:100%;max-width:180px;display:none;margin-top:0.5em;" placeholder="Custom kgrn/ft³">
                    <div style="font-size:0.97em;color:#888;">Capacity values are in kilograins per cubic foot (kgrn/ft³).</div>
                </div>
                <div class="calc-section">
                    <h2>Step 2: Water Quality</h2>
                    <label for="conductivity">Feedwater Conductivity (micromhos/cm or μS/cm)</label>
                    <span class="info">This method estimates loading using: grains/gal = conductivity ÷ 34.</span>
                    <input type="number" id="conductivity" value="250" min="0" step="0.1">
                    <div id="assumptionsBox" style="background:#fafdff;border:1px solid #d9eff2;border-radius:8px;padding:1rem;margin:1rem 0;">
                        <strong>Assumptions:</strong>
                        <ul style="margin:0 0 0 1.2em;">
                            <li>pH range: 6–8</li>
                            <li>Use 90% of resin capacity</li>
                            <li>Loading: <span id="assumeGrains">7.35</span> grains/gal (conductivity ÷ 34)</li>
                            <li>Resin capacity: <span id="assumeResin">12</span> kgrn/ft³</li>
                        </ul>
                    </div>
                </div>
                <div class="calc-section">
                    <h2>Step 3: See Your Results</h2>
                    <button type="submit" class="btn">Calculate My Tank Size</button>
                </div>
            </form>
            <div class="calc-results" id="results" style="display:none;"></div>
            <div class="calc-disclaimer" style="margin-top:1rem;font-size:0.95em;color:#666;">
                This calculator provides an estimate only. For an accurate assessment, a detailed water analysis and application review are required.
            </div>
            <button id="downloadTXT" style="display:none;margin-top:1.2em;background:#0099A8;color:#fff;border:none;border-radius:4px;padding:0.5em 1.2em;font-weight:600;font-size:1em;cursor:pointer;box-shadow:0 2px 6px rgba(0,0,0,0.07);transition:background 0.2s;">Download TXT Report</button>
        </div>
    <!-- PDF logic removed, replaced with TXT download logic -->
    <script>
        // Update assumptions box live
        function updateAssumptions() {
            const conductivity = parseFloat(document.getElementById('conductivity').value) || 0;
            const grainsLoading = conductivity > 0 ? (conductivity / 34).toFixed(2) : '0.00';
            document.getElementById('assumeGrains').textContent = grainsLoading;
            // Update resin capacity
            let resinType = document.getElementById('resinType').value;
            let resinKgrn = 12;
            if (resinType === 'custom') {
                resinKgrn = parseFloat(document.getElementById('customGrains').value) || 12;
            } else {
                resinKgrn = parseFloat(resinType);
            }
            document.getElementById('assumeResin').textContent = resinKgrn;
        }
        ['conductivity','resinType','customGrains'].forEach(id => {
            document.addEventListener('input', function(e) {
                if (e.target && e.target.id === id) updateAssumptions();
            });
            document.addEventListener('change', function(e) {
                if (e.target && e.target.id === id) updateAssumptions();
            });
        });
        updateAssumptions();

        // Show/hide custom grains input
        document.getElementById('resinType').addEventListener('change', function() {
            if (this.value === 'custom') {
                document.getElementById('customGrains').style.display = 'inline-block';
            } else {
                document.getElementById('customGrains').style.display = 'none';
            }
            updateAssumptions();
        });

        // Show grains loading formula and calculation
        function grainsLoadingFormula(conductivity) {
            return `Grains Loading = Conductivity / 34 = ${conductivity} / 34`;
        }

        document.getElementById('tankCalc').onsubmit = function(e) {
            e.preventDefault();
            // Get values
            let conductivity = parseFloat(document.getElementById('conductivity').value);
            let numTanks = parseInt(document.getElementById('numTanks').value) || 1;
            let tankModel = parseFloat(document.getElementById('tankModel').value);
            let tankLabel = document.getElementById('tankModel').options[document.getElementById('tankModel').selectedIndex].text;
            let flowRate = parseFloat(document.getElementById('flowRate').value);
            let hours = parseFloat(document.getElementById('hours').value);
            // Resin capacity in kgrn/ft³
            let resinKgrn = 12;
            const resinType = document.getElementById('resinType').value;
            if (resinType === 'custom') {
                resinKgrn = parseFloat(document.getElementById('customGrains').value) || 12;
            } else {
                resinKgrn = parseFloat(resinType);
            }
            const grainsLoading = conductivity > 0 ? (conductivity / 34).toFixed(2) : 0;
            const usableCapacityFactor = 0.9;
            const gallonsPerFt3 = conductivity > 0
                ? ((resinKgrn * usableCapacityFactor * 34 * 1000) / conductivity)
                : 0;
            let singleTankCapacity = (gallonsPerFt3 * tankModel).toFixed(1);
            let totalCapacity = (singleTankCapacity * numTanks).toFixed(1);
            const gallonsPerDay = (flowRate * 60 * hours).toFixed(0);
            // Days to Exchange = Gallons Capacity / Gallons Per Day
            const daysToExchange = gallonsPerDay > 0 ? (totalCapacity / gallonsPerDay).toFixed(1) : 0;
            document.getElementById('results').style.display = 'block';
            document.getElementById('results').innerHTML = `
                <strong>Selected Tank Model:</strong> ${tankLabel}<br>
                <strong>Number of Tanks (in series):</strong> ${numTanks}<br>
                <strong>Single Tank Capacity:</strong> ${parseInt(singleTankCapacity).toLocaleString()} USG<br>
                <strong>Total System Capacity:</strong> ${parseInt(totalCapacity).toLocaleString()} USG<br>
                <strong>Flow Rate Used for Calculation:</strong> ${flowRate} GPM<br>
                <strong>Estimated Days to Exchange:</strong> ${daysToExchange} days<br>
                <span style="font-size:0.97em;color:#0099A8;">Days to Exchange = Gallons Capacity / Gallons Per Day</span><br>
                <hr style="margin:1em 0;">
                <strong>Grains Loading Calculation:</strong><br>
                <span style="font-size:0.98em;">${grainsLoadingFormula(conductivity)} = <strong>${grainsLoading}</strong> grains/gal</span><br>
                <span style="font-size:0.98em;color:#0099A8;">Assumptions: pH 6–8, 90% capacity used</span><br>
                <span style="font-size:0.95em;color:#666;">Estimate only. Accurate assessment requires detailed water analysis and application review.</span>
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
                txt += `Feedwater Conductivity: ${document.getElementById('conductivity').value} micromhos/cm\n`;
                txt += `Grains Loading: ${grainsLoading} grains/gal\n`;
                txt += `Tank Model: ${tankLabel}\n`;
                txt += `Flow Rate: ${flowRate} USGPM\n`;
                txt += `Hours per Day: ${hours}\n`;
                txt += `Number of Tanks (in series): ${numTanks}\n\n`;
                txt += 'Calculation Steps:\n';
                txt += '1. Grains Loading Formula:\n';
                txt += `   Grains Loading = Conductivity / 34 = ${conductivity} / 34 = ${grainsLoading} grains/gal\n`;
                txt += '2. Single Tank Capacity Formula:\n';
                txt += `   Gallons per ft³ = (Resin Capacity x 0.90 x 34 x 1000) / Conductivity\n`;
                txt += `   Gallons per ft³ = (${resinKgrn} x 0.90 x 34 x 1000) / ${conductivity} = ${parseInt(gallonsPerFt3).toLocaleString()} USG/ft³\n`;
                txt += `   Single Tank Capacity = Gallons per ft³ x Resin Volume = ${parseInt(gallonsPerFt3).toLocaleString()} x ${tankModel} = ${parseInt(singleTankCapacity).toLocaleString()} USG\n`;
                txt += '3. Days to Exchange (per tank):\n';
                txt += `   Gallons per Day = Flow Rate x 60 x Hours = ${flowRate} x 60 x ${hours} = ${gallonsPerDay} USG/day\n`;
                txt += `   Days to Exchange = Gallons Capacity / Gallons per Day = ${parseInt(totalCapacity).toLocaleString()} / ${gallonsPerDay} = ${daysToExchange} days\n\n`;
                txt += 'Results:\n';
                txt += `Selected Tank Model: ${tankLabel}\n`;
                txt += `Number of Tanks (in series): ${numTanks}\n`;
                txt += `Single Tank Capacity: ${parseInt(singleTankCapacity).toLocaleString()} USG\n`;
                txt += `Total System Capacity: ${parseInt(totalCapacity).toLocaleString()} USG\n`;
                txt += `Flow Rate Used for Calculation: ${flowRate} GPM\n`;
                txt += `Estimated Days to Exchange: ${daysToExchange} days\n\n`;
                txt += 'Assumptions:\n';
                txt += '• pH range: 6–8\n';
                txt += '• Use 90% of resin capacity\n';
                txt += '• Grains/gal = conductivity ÷ 34\n';
                txt += `• Resin capacity: ${resinKgrn} kgrn/ft³\n`;
                txt += '• Estimate only; accurate assessment requires detailed water analysis and application review\n';
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
