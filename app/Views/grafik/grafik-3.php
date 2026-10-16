<div class="col-12">
    <div class="p-3 bg-white rounded-3 shadow-sm border">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0 text-warning">
                <i class="fa-solid fa-chart-column me-2"></i> Grafik Pelanggaran (Kelas: <?= esc($kelas) ?> <?= esc($jurusan) ?> / Bulan: <?= esc($bulan) ?> / Tahun: <?= esc($tahun) ?>)
            </h6>
            <span class="badge bg-warning-subtle text-warning border rounded-pill">Total: <?= count($grafik_kelas_bulan) ?> Kategori</span>
        </div>
        <div style="position: relative; height: 350px;">
            <canvas id="canvasChart3"></canvas>
        </div>
    </div>
</div>

<script>
(function() {
    var labels = [];
    var dataValues = [];

    <?php foreach ($grafik_kelas_bulan as $row): ?>
        labels.push(<?= json_encode($row['nama_pelanggaran']) ?>);
        dataValues.push(<?= (int)$row['JumlahPelanggaran'] ?>);
    <?php endforeach; ?>

    var ctx = document.getElementById('canvasChart3').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Pelanggaran',
                data: dataValues,
                backgroundColor: 'rgba(245, 158, 11, 0.85)',
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
                    cornerRadius: 8
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
                        font: { size: 11 }
                    }
                }
            }
        }
    });
})();
</script>
