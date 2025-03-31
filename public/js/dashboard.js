const salesCtx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Sales',
            data: [1200, 1900, 1500, 2500, 1800, 3000, 2800],
            backgroundColor: 'rgba(255, 190, 51, 0.2)',
            borderColor: '#ffbe33',
            borderWidth: 2,
            tension: 0.3,
            pointBackgroundColor: '#ffbe33',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)'
                },
                ticks: {
                    color: '#fff'
                }
            },
            x: {
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)'
                },
                ticks: {
                    color: '#fff'
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
const dataDiv = document.getElementById("category-chart-data");
if (dataDiv) {
    const labels = JSON.parse(dataDiv.dataset.labels);
    const values = JSON.parse(dataDiv.dataset.values);

    const ctx = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: [
                    '#dc3545', '#ffc107', '#28a745', '#17a2b8', '#6c757d'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#fff',
                        padding: 15,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }
            },
            cutout: '70%'
        }
    });
}

// const categoryCtx = document.getElementById('categoryChart').getContext('2d');
// const categoryChart = new Chart(categoryCtx, {
//     type: 'doughnut',
//     data: {
//         labels: ['Burger', 'Pizza', 'Pasta', 'Fries', 'Drinks'],
//         datasets: [{
//             data: [35, 25, 20, 15, 5],
//             backgroundColor: [
//                 '#dc3545',
//                 '#ffc107',
//                 '#28a745',
//                 '#17a2b8',
//                 '#6c757d'
//             ],
//             borderWidth: 0
//         }]
//     },
//     options: {
//         responsive: true,
//         maintainAspectRatio: false,
//         plugins: {
//             legend: {
//                 position: 'bottom',
//                 labels: {
//                     color: '#fff',
//                     padding: 15,
//                     usePointStyle: true,
//                     pointStyle: 'circle'
//                 }
//             }
//         },
//         cutout: '70%'
//     }
// });