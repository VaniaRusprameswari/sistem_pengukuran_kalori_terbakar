<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengukuran Kalori Terbakar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            padding: 30px;
        }

        .input-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .results-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: #667eea;
            outline: none;
        }

        .btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease;
            width: 100%;
            margin-bottom: 10px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-simulate {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
        }

        .btn-simulate:hover {
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
        }

        .result-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            text-align: center;
        }

        .result-value {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .result-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        .chart-container {
            background: white;
            margin: 20px 0;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .sensor-data {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .sensor-reading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .error-analysis {
            background: linear-gradient(135deg, #ffeaa7, #fdcb6e);
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
        }

        .method-info {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .info-text {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        #heartRateChart {
            width: 100%;
            height: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔥 Sistem Pengukuran Kalori Terbakar</h1>
            <p>Menggunakan Metode Simpson & Analisis Galat</p>
        </div>

        <div class="main-content">
            <div class="input-section">
                <div class="method-info" id="methodInfo">
                    <h3>📊 Metode Simpson</h3>
                    <p id="methodDescription">Pilih metode Simpson yang akan digunakan untuk menghitung integral dari fungsi kalori yang terbakar berdasarkan detak jantung sepanjang waktu berolahraga.</p>
                    <div class="info-text" id="methodFormula">
                        <strong>Rumus:</strong> Pilih metode terlebih dahulu
                    </div>
                </div>

                <form id="calorieForm">
                    <div class="form-group">
                        <label for="method">Metode Perhitungan:</label>
                        <select id="method" name="method" required onchange="updateMethodInfo()">
                            <option value="">-- Pilih Metode --</option>
                            <option value="simpson13">Simpson 1/3</option>
                            <option value="simpson38">Simpson 3/8</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="weight">Berat Badan (kg):</label>
                        <input type="number" id="weight" name="weight" value="70" min="30" max="200" required>
                    </div>

                    <div class="form-group">
                        <label for="age">Usia (tahun):</label>
                        <input type="number" id="age" name="age" value="25" min="10" max="100" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Jenis Kelamin:</label>
                        <select id="gender" name="gender" required>
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="duration">Durasi Olahraga (menit):</label>
                        <input type="number" id="duration" name="duration" value="30" min="5" max="300" required>
                    </div>

                    <div class="form-group">
                        <label for="intervals">Jumlah Interval Pengukuran:</label>
                        <input type="number" id="intervals" name="intervals" value="12" min="3" max="50" required>
                        <small style="color: #666;" id="intervalNote">*Pilih metode terlebih dahulu untuk melihat persyaratan interval</small>
                    </div>

                    <button type="button" class="btn btn-simulate" onclick="simulateSensorData()">
                        🔄 Simulasi Data Sensor
                    </button>

                    <button type="submit" class="btn">
                        ⚡ Hitung Kalori Terbakar
                    </button>
                </form>

                <div class="sensor-data" id="sensorData" style="display: none;">
                    <h3>📡 Data Sensor Detak Jantung</h3>
                    <div id="sensorReadings"></div>
                </div>
            </div>

            <div class="results-section">
                <div id="results" style="display: none;">
                    <div class="result-card pulse">
                        <div class="result-value" id="totalCalories">0</div>
                        <div class="result-label">Kalori Terbakar (kcal)</div>
                    </div>

                    <div class="result-card">
                        <div class="result-value" id="avgHeartRate">0</div>
                        <div class="result-label">Rata-rata Detak Jantung (dpm)</div>
                    </div>

                    <div class="error-analysis">
                        <h4>📈 Analisis Galat</h4>
                        <p><strong>Metode yang Digunakan:</strong> <span id="usedMethod">-</span></p>
                        <p><strong>Galat Truncation:</strong> <span id="truncationError">0</span></p>
                        <p><strong>Galat Relatif:</strong> <span id="relativeError">0</span>%</p>
                        <p><strong>Akurasi Metode:</strong> <span id="accuracy">99.9</span>%</p>
                    </div>
                </div>

                <div class="chart-container">
                    <h3>📈 Grafik Detak Jantung vs Waktu</h3>
                    <canvas id="heartRateChart"></canvas>
                </div>

                <div id="calculationDetails" style="display: none; margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                    <h4>🔢 Detail Perhitungan Metode Simpson</h4>
                    <div id="simpsonSteps"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simulasi data sensor detak jantung
        let sensorData = [];
        let chartCanvas, chartCtx;

        function updateMethodInfo() {
            const method = document.getElementById('method').value;
            const methodInfo = document.getElementById('methodInfo');
            const methodDescription = document.getElementById('methodDescription');
            const methodFormula = document.getElementById('methodFormula');
            const intervalNote = document.getElementById('intervalNote');
            const intervalsInput = document.getElementById('intervals');
            
            if (method === 'simpson13') {
                methodInfo.querySelector('h3').textContent = '📊 Metode Simpson 1/3';
                methodDescription.textContent = 'Metode Simpson 1/3 menggunakan parabola untuk memperkirakan integral. Cocok untuk fungsi yang halus dan memberikan akurasi tinggi.';
                methodFormula.innerHTML = '<strong>Rumus:</strong> ∫f(x)dx ≈ (h/3)[f(x₀) + 4f(x₁) + 2f(x₂) + 4f(x₃) + ... + f(xₙ)]';
                intervalNote.textContent = '*Harus bilangan genap untuk metode Simpson 1/3';
                intervalsInput.setAttribute('step', '2');
                intervalsInput.value = '12';
            } else if (method === 'simpson38') {
                methodInfo.querySelector('h3').textContent = '📊 Metode Simpson 3/8';
                methodDescription.textContent = 'Metode Simpson 3/8 menggunakan kubik untuk memperkirakan integral. Memberikan akurasi lebih tinggi untuk fungsi dengan kelengkungan yang kompleks.';
                methodFormula.innerHTML = '<strong>Rumus:</strong> ∫f(x)dx ≈ (3h/8)[f(x₀) + 3f(x₁) + 3f(x₂) + 2f(x₃) + 3f(x₄) + ... + f(xₙ)]';
                intervalNote.textContent = '*Harus kelipatan 3 untuk metode Simpson 3/8';
                intervalsInput.setAttribute('step', '3');
                intervalsInput.value = '12';
            } else {
                methodInfo.querySelector('h3').textContent = '📊 Metode Simpson';
                methodDescription.textContent = 'Pilih metode Simpson yang akan digunakan untuk menghitung integral dari fungsi kalori yang terbakar berdasarkan detak jantung sepanjang waktu berolahraga.';
                methodFormula.innerHTML = '<strong>Rumus:</strong> Pilih metode terlebih dahulu';
                intervalNote.textContent = '*Pilih metode terlebih dahulu untuk melihat persyaratan interval';
                intervalsInput.removeAttribute('step');
            }
        }

        function simulateSensorData() {
            const method = document.getElementById('method').value;
            const intervals = parseInt(document.getElementById('intervals').value);
            const duration = parseInt(document.getElementById('duration').value);
            
            if (!method) {
                alert('Pilih metode perhitungan terlebih dahulu!');
                return;
            }
            
            // Validasi interval sesuai metode
            if (method === 'simpson13' && intervals % 2 !== 0) {
                alert('Jumlah interval harus bilangan genap untuk metode Simpson 1/3!');
                return;
            }
            
            if (method === 'simpson38' && intervals % 3 !== 0) {
                alert('Jumlah interval harus kelipatan 3 untuk metode Simpson 3/8!');
                return;
            }

            sensorData = [];
            const timeStep = duration / intervals;
            
            // Simulasi detak jantung dengan variasi realistis
            const baseHeartRate = 120;
            
            for (let i = 0; i <= intervals; i++) {
                const time = i * timeStep;
                // Simulasi detak jantung dengan pola naik-turun dan noise
                const heartRate = baseHeartRate + 
                    20 * Math.sin(time * 0.3) + 
                    15 * Math.cos(time * 0.5) + 
                    (Math.random() - 0.5) * 10;
                
                sensorData.push({
                    time: time,
                    heartRate: Math.max(80, Math.min(180, Math.round(heartRate)))
                });
            }

            displaySensorData();
            drawChart();
        }

        function displaySensorData() {
            const sensorDataDiv = document.getElementById('sensorData');
            const sensorReadingsDiv = document.getElementById('sensorReadings');
            
            sensorReadingsDiv.innerHTML = '';
            
            sensorData.forEach((data, index) => {
                const reading = document.createElement('div');
                reading.className = 'sensor-reading';
                reading.innerHTML = `
                    <span>T${index}: ${data.time.toFixed(1)} mnt</span>
                    <span><strong>${data.heartRate} dpm</strong></span>
                `;
                sensorReadingsDiv.appendChild(reading);
            });
            
            sensorDataDiv.style.display = 'block';
        }

        function drawChart() {
            const canvas = document.getElementById('heartRateChart');
            const ctx = canvas.getContext('2d');
            
            canvas.width = canvas.offsetWidth;
            canvas.height = 300;
            
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            if (sensorData.length === 0) return;
            
            const padding = 40;
            const graphWidth = canvas.width - 2 * padding;
            const graphHeight = canvas.height - 2 * padding;
            
            const maxTime = Math.max(...sensorData.map(d => d.time));
            const minHR = Math.min(...sensorData.map(d => d.heartRate)) - 10;
            const maxHR = Math.max(...sensorData.map(d => d.heartRate)) + 10;
            
            // Draw axes
            ctx.strokeStyle = '#333';
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.moveTo(padding, padding);
            ctx.lineTo(padding, canvas.height - padding);
            ctx.lineTo(canvas.width - padding, canvas.height - padding);
            ctx.stroke();
            
            // Draw grid
            ctx.strokeStyle = '#eee';
            ctx.lineWidth = 1;
            for (let i = 1; i < 10; i++) {
                const y = padding + (graphHeight * i / 10);
                ctx.beginPath();
                ctx.moveTo(padding, y);
                ctx.lineTo(canvas.width - padding, y);
                ctx.stroke();
            }
            
            // Draw heart rate line
            ctx.strokeStyle = '#e74c3c';
            ctx.lineWidth = 3;
            ctx.beginPath();
            
            sensorData.forEach((data, index) => {
                const x = padding + (data.time / maxTime) * graphWidth;
                const y = canvas.height - padding - ((data.heartRate - minHR) / (maxHR - minHR)) * graphHeight;
                
                if (index === 0) {
                    ctx.moveTo(x, y);
                } else {
                    ctx.lineTo(x, y);
                }
            });
            
            ctx.stroke();
            
            // Draw points
            ctx.fillStyle = '#c0392b';
            sensorData.forEach(data => {
                const x = padding + (data.time / maxTime) * graphWidth;
                const y = canvas.height - padding - ((data.heartRate - minHR) / (maxHR - minHR)) * graphHeight;
                
                ctx.beginPath();
                ctx.arc(x, y, 4, 0, 2 * Math.PI);
                ctx.fill();
            });
            
            // Labels
            ctx.fillStyle = '#333';
            ctx.font = '12px Arial';
            ctx.fillText('Waktu (menit)', canvas.width / 2 - 40, canvas.height - 10);
            
            ctx.save();
            ctx.translate(15, canvas.height / 2);
            ctx.rotate(-Math.PI / 2);
            ctx.fillText('Detak Jantung (dpm)', -60, 0);
            ctx.restore();
        }

        // Implementasi Metode Simpson 1/3
        function simpson13Rule(data) {
            const n = data.length - 1;
            const h = (data[n].time - data[0].time) / n;
            
            if (n % 2 !== 0) {
                throw new Error('Jumlah interval harus genap untuk metode Simpson 1/3');
            }
            
            let sum = data[0].value + data[n].value;
            
            // Koefisien 4 untuk indeks ganjil
            for (let i = 1; i < n; i += 2) {
                sum += 4 * data[i].value;
            }
            
            // Koefisien 2 untuk indeks genap
            for (let i = 2; i < n; i += 2) {
                sum += 2 * data[i].value;
            }
            
            return (h / 3) * sum;
        }

        // Implementasi Metode Simpson 3/8
        function simpson38Rule(data) {
            const n = data.length - 1;
            const h = (data[n].time - data[0].time) / n;
            
            if (n % 3 !== 0) {
                throw new Error('Jumlah interval harus kelipatan 3 untuk metode Simpson 3/8');
            }
            
            let sum = data[0].value + data[n].value;
            
            // Koefisien 3 untuk indeks yang bukan kelipatan 3
            for (let i = 1; i < n; i++) {
                if (i % 3 === 0) {
                    sum += 2 * data[i].value;
                } else {
                    sum += 3 * data[i].value;
                }
            }
            
            return (3 * h / 8) * sum;
        }

        // Fungsi wrapper untuk memilih metode yang tepat
        function calculateIntegral(data, method) {
            if (method === 'simpson13') {
                return simpson13Rule(data);
            } else if (method === 'simpson38') {
                return simpson38Rule(data);
            } else {
                throw new Error('Metode tidak dikenal');
            }
        }

        // Menghitung kalori berdasarkan detak jantung
        function calculateCalorieRate(heartRate, weight, age, gender) {
            // Formula Karvonen untuk kalori per menit
            const genderFactor = gender === 'male' ? 1 : 0.9;
            const calorieRate = ((heartRate * 0.6309) + (weight * 0.1988) + (age * 0.2017) - 55.0969) / 4.184;
            return Math.max(0, calorieRate * genderFactor);
        }

        // Analisis galat berdasarkan metode
        function calculateTruncationError(data, method) {
            const h = (data[data.length - 1].time - data[0].time) / (data.length - 1);
            let maxDerivative = 0;
            let errorCoefficient = 0;
            
            if (method === 'simpson13') {
                // Estimasi turunan ke-4 untuk Simpson 1/3
                for (let i = 2; i < data.length - 2; i++) {
                    const d4 = data[i-2].value - 4*data[i-1].value + 6*data[i].value - 4*data[i+1].value + data[i+2].value;
                    maxDerivative = Math.max(maxDerivative, Math.abs(d4));
                }
                errorCoefficient = Math.pow(h, 5) / 90;
            } else if (method === 'simpson38') {
                // Estimasi turunan ke-4 untuk Simpson 3/8
                for (let i = 2; i < data.length - 2; i++) {
                    const d4 = data[i-2].value - 4*data[i-1].value + 6*data[i].value - 4*data[i+1].value + data[i+2].value;
                    maxDerivative = Math.max(maxDerivative, Math.abs(d4));
                }
                errorCoefficient = Math.pow(h, 5) / 80; // Simpson 3/8 memiliki koefisien error yang sedikit berbeda
            }
            
            return errorCoefficient * maxDerivative;
        }

        document.getElementById('calorieForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const method = document.getElementById('method').value;
            
            if (!method) {
                alert('Pilih metode perhitungan terlebih dahulu!');
                return;
            }
            
            if (sensorData.length === 0) {
                alert('Silakan simulasi data sensor terlebih dahulu!');
                return;
            }
            
            const weight = parseFloat(document.getElementById('weight').value);
            const age = parseInt(document.getElementById('age').value);
            const gender = document.getElementById('gender').value;
            
            // Konversi data detak jantung ke data kalori per menit
            const calorieData = sensorData.map(data => ({
                time: data.time,
                value: calculateCalorieRate(data.heartRate, weight, age, gender),
                heartRate: data.heartRate
            }));
            
            // Hitung total kalori menggunakan metode yang dipilih
            const totalCalories = calculateIntegral(calorieData, method);
            const avgHeartRate = sensorData.reduce((sum, data) => sum + data.heartRate, 0) / sensorData.length;
            
            // Analisis galat
            const truncationError = calculateTruncationError(calorieData, method);
            const relativeError = (truncationError / totalCalories) * 100;
            const accuracy = 100 - Math.abs(relativeError);
            
            // Tampilkan hasil
            document.getElementById('totalCalories').textContent = totalCalories.toFixed(1);
            document.getElementById('avgHeartRate').textContent = avgHeartRate.toFixed(0);
            document.getElementById('usedMethod').textContent = method === 'simpson13' ? 'Simpson 1/3' : 'Simpson 3/8';
            document.getElementById('truncationError').textContent = truncationError.toFixed(6);
            document.getElementById('relativeError').textContent = Math.abs(relativeError).toFixed(4);
            document.getElementById('accuracy').textContent = accuracy.toFixed(2);
            
            // Tampilkan detail perhitungan Simpson
            displaySimpsonCalculation(calorieData, method);
            
            document.getElementById('results').style.display = 'block';
            document.getElementById('calculationDetails').style.display = 'block';
        });

        function displaySimpsonCalculation(data, method) {
            const stepsDiv = document.getElementById('simpsonSteps');
            const n = data.length - 1;
            const h = (data[n].time - data[0].time) / n;
            
            let html = '';
            
            if (method === 'simpson13') {
                html = `
                    <p><strong>Metode Simpson 1/3:</strong></p>
                    <p>∫f(x)dx ≈ (h/3)[f(x₀) + 4f(x₁) + 2f(x₂) + 4f(x₃) + ... + f(xₙ)]</p>
                    <p><strong>h =</strong> ${h.toFixed(3)} menit</p>
                    <p><strong>n =</strong> ${n} interval</p>
                    <p><strong>Penjelasan:</strong> Metode ini menggunakan parabola (polinomial derajat 2) untuk memperkirakan luas di bawah kurva. Memberikan akurasi tinggi untuk fungsi yang halus.</p>
                    <br>
                    <p><strong>Pola Koefisien Simpson 1/3:</strong> 1, 4, 2, 4, 2, ..., 4, 1</p>
                    <p><strong>Koefisien dan Nilai Kalori per Menit:</strong></p>
                    <ul style="margin-left: 20px;">
                `;
                
                data.forEach((point, index) => {
                    let coefficient = 1;
                    if (index > 0 && index < n) {
                        coefficient = (index % 2 === 1) ? 4 : 2;
                    }
                    html += `<li>f(${point.time.toFixed(1)}) = ${point.value.toFixed(3)} kcal/mnt, koefisien = ${coefficient}</li>`;
                });
                
            } else if (method === 'simpson38') {
                html = `
                    <p><strong>Metode Simpson 3/8:</strong></p>
                    <p>∫f(x)dx ≈ (3h/8)[f(x₀) + 3f(x₁) + 3f(x₂) + 2f(x₃) + 3f(x₄) + ... + f(xₙ)]</p>
                    <p><strong>h =</strong> ${h.toFixed(3)} menit</p>
                    <p><strong>n =</strong> ${n} interval</p>
                    <p><strong>Penjelasan:</strong> Metode ini menggunakan kubik (polinomial derajat 3) untuk memperkirakan luas di bawah kurva. Memberikan akurasi lebih tinggi untuk fungsi dengan kelengkungan kompleks.</p>
                    <br>
                    <p><strong>Pola Koefisien Simpson 3/8:</strong> 1, 3, 3, 2, 3, 3, 2, ..., 3, 3, 1</p>
                    <p><strong>Koefisien dan Nilai Kalori per Menit:</strong></p>
                    <ul style="margin-left: 20px;">
                `;
                
                data.forEach((point, index) => {
                    let coefficient = 1;
                    if (index > 0 && index < n) {
                        if (index % 3 === 0) {
                            coefficient = 2;
                        } else {
                            coefficient = 3;
                        }
                    }
                    html += `<li>f(${point.time.toFixed(1)}) = ${point.value.toFixed(3)} kcal/mnt, koefisien = ${coefficient}</li>`;
                });
            }
            
            html += `</ul>
                <br>
                <p><strong>Keunggulan Metode ${method === 'simpson13' ? 'Simpson 1/3' : 'Simpson 3/8'}:</strong></p>
                <ul style="margin-left: 20px;">`;
            
            if (method === 'simpson13') {
                html += `
                    <li>Lebih sederhana dan mudah dipahami</li>
                    <li>Cocok untuk fungsi yang relatif halus</li>
                    <li>Membutuhkan interval genap</li>
                    <li>Galat truncation berorde O(h⁵)</li>
                `;
            } else {
                html += `
                    <li>Akurasi lebih tinggi untuk fungsi kompleks</li>
                    <li>Menggunakan polinomial kubik</li>
                    <li>Membutuhkan interval kelipatan 3</li>
                    <li>Galat truncation berorde O(h⁵) dengan konstanta lebih kecil</li>
                `;
            }
            
            html += '</ul>';
            stepsDiv.innerHTML = html;
        }

        // Inisialisasi chart saat halaman dimuat
        window.addEventListener('load', function() {
            updateMethodInfo(); // Set default method info
            // Tidak langsung simulasi, biarkan user memilih metode dulu
        });

        // Responsive chart
        window.addEventListener('resize', function() {
            if (sensorData.length > 0) {
                setTimeout(drawChart, 100);
            }
        });
    </script>
</body>
</html>