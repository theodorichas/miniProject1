<!-- INI YANG TANGGAL 13 JUNI 2024 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenue Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('revenue-chart-canvas').getContext('2d');
        var revenueChart = new Chart(ctx, {
            type: 'bar', // You can change this to 'line', 'pie', etc.
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Revenue',
                    data: [12, 19, 3, 5, 2, 3, 7],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <form name="excelForm" enctype="multipart/form-data">
        <div class="form-group">
            <div class="mb-3">
                <label for="template_name" class="form-label">Select which template you want to choose</label>
                <select name="template_name" id="template_name" class="form-select">
                    <option value="">Select Template</option>
                    <?php foreach ($templates as $template) : ?>
                        <option value="<?= $template['template_id'] ?>"><?= $template['template_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="template_preview" class="form-label">Template Preview</label>
                <div id="template_preview" class="border p-2" style="min-height: 200px;"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="formAttach" id="formAttachlbl" class="form-label">Select which file you want to send</label>
                <input class="form-control" type="file" id="formAttachEmail" name="formAttachEmail">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="btnSendFileToEmail" class="btn btn-primary">Send to email</button>
        </div>
    </form>
</body>

</html>