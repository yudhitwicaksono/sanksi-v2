<div class="col-12">
    <div class="p-3 bg-white rounded-3 shadow-sm border">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0 text-primary">
                <i class="fa-solid fa-chart-column me-2"></i> Grafik Pelanggaran (Bulan: <?= esc($bulan) ?> / Tahun: <?= esc($tahun) ?>)
            </h6>
            <span class="badge bg-primary-subtle text-primary border rounded-pill">Total: <?= count($grafik_bulan_tahun) ?> Kategori</span>
        </div>
        <div style="position: relative; height: 350px;">
            <canvas id="canvasChart1"></canvas>
        </div>
    </div>
</div>

<script>
(function() {
    var labels = [];
    var dataValues = [];

    <?php foreach ($grafik_bulan_tahun as $row): ?>
        labels.push(<?= json_encode($row['nama_pelanggaran']) ?>);
        dataValues.push(<?= (int)$row['JumlahPelanggaran'] ?>);
    <?php endforeach; ?>

    var ctx = document.getElementById('canvasChart1').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Pelanggaran',
                data: dataValues,
                backgroundColor: [
                    'rgba(99, 102, 241, 0.85)',
                    'rgba(14, 165, 233, 0.85)',
                    'rgba(245, 158, 11, 0.85)',
                    'rgba(239, 68, 68, 0.85)',
                    'rgba(16, 185, 129, 0.85)',
                    'rgba(168, 85, 247, 0.85)',
                    'rgba(236, 72, 153, 0.85)'
                ],
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    padding: 12,
                    cornerRadius: 8,
                    bodyFont: { family: 'Plus Jakarta Sans' }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 },
                    grid: { color: '#f1f5f9' }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 20,
                        font: { size: 11, family: 'Plus Jakarta Sans' }
                    }
                }
            }
        }
    });
})();
</script>
