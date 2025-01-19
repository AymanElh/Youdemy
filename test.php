<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart.js Example</title>
</head>

<body>
    <div class="bg-white shadow-lg p-4 rounded-md">
        <h3 class="text-lg font-semibold">Enrollments by Category</h3>
        <canvas id="enrollmentPieChart" width="400" height="400"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Debugging: Ensure the canvas element is accessible
        const canvas = document.getElementById('enrollmentPieChart');
        console.log(canvas); // Should output <canvas> element

        const ctx = canvas.getContext('2d');
        console.log(ctx); // Should output CanvasRenderingContext2D

        const enrollmentPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Web Development', 'Data Science', 'Design'],
                datasets: [{
                    label: 'Enrollments by Category',
                    data: [45, 30, 25],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)', // Web Development
                        'rgba(54, 162, 235, 0.6)', // Data Science
                        'rgba(255, 206, 86, 0.6)' // Design
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed + '%';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>