document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("applyCustomerFilter").addEventListener("click", fetchAndRenderTopCustomers);
    const dateFromInput = document.getElementById("dateFrom");
    const dateToInput = document.getElementById("dateTo");
    const applyBtn = document.getElementById("applyDateRange");
    const periodButtons = document.querySelectorAll(".btn-group button");

    let currentPeriod = "weekly";

    const today = new Date();
    const formatDate = (date) => date.toISOString().split("T")[0];

    const oneWeekAgo = new Date(today);
    oneWeekAgo.setDate(today.getDate() - 6);
    dateFromInput.value = formatDate(oneWeekAgo);
    dateToInput.value = formatDate(today);


    applyBtn.addEventListener("click", () => {
        const from = dateFromInput.value;
        const to = dateToInput.value;
        if (!from || !to) return alert("Please select both dates");
        loadSalesChart(from, to, currentPeriod);
    });

    periodButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            periodButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
            currentPeriod = btn.textContent.toLowerCase();

            const today = new Date();
            let from;

            if (currentPeriod === "weekly") {
                from = new Date();
                from.setDate(today.getDate() - 6);
            } else if (currentPeriod === "monthly") {
                from = new Date(today.getFullYear(), today.getMonth(), 1);
            } else if (currentPeriod === "yearly") {
                from = new Date(today.getFullYear(), 0, 1);
            }

            const fromStr = formatDate(from);
            const toStr = formatDate(today);

            dateFromInput.value = fromStr;
            dateToInput.value = toStr;

            loadSalesChart(fromStr, toStr, currentPeriod);
        });
    });


    loadSalesChart(formatDate(oneWeekAgo), formatDate(today), currentPeriod);

    fetchAndRenderTopCustomers();
});
function fetchAndRenderTopCustomers() {
    const fromInput = document.getElementById("customerDateFrom");
    const toInput = document.getElementById("customerDateTo");
    const limitSelect = document.getElementById("customerCount");
    const applyBtn = document.getElementById("applyCustomerFilter");
    const tableBody = document.querySelector("#topCustomersTable tbody");

    const from = fromInput.value;
    const to = toInput.value;
    const limit = limitSelect.value;

    const formData = new FormData();
    formData.append("action", "getTopCustomerByPurchase");
    formData.append("from", from);
    formData.append("to", to);
    formData.append("limit", limit);

    fetch("/duanweb2/app/api/order.api.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if (res.success && Array.isArray(res.data)) {
            tableBody.innerHTML = "";
            res.data.forEach((customer, index) => {
                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">${customer.customer_name}</h6>
                                    <small class="text-muted">${customer.user_id}</small>
                                </div>
                            </div>
                        </td>
                        <td>${customer.email ?? 'N/A'}</td>
                        <td>${customer.total_orders}</td>
                        <td>${Number(customer.total_spent).toLocaleString('vi-VN') + ' VND'}</td>
                        <td>${customer.last_order_date ?? 'N/A'}</td>
                        <td>
                            <a href="/duanweb2/admin/customer-order-detail/page?userId=${customer.user_id}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye me-1"></i>Chi tiết
                            </a>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        } else {
            tableBody.innerHTML = `<tr><td colspan="7" class="text-center text-muted">No data found</td></tr>`;
        }
    })
    .catch(err => {
        console.error(err);
        tableBody.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Error loading data</td></tr>`;
    });
}
function formatDateTime(date, endOfDay = false) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = endOfDay ? '23' : '00';
    const minutes = endOfDay ? '59' : '00';
    const seconds = endOfDay ? '59' : '00';
    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}


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

async function loadSalesChart(fromRaw, toRaw, period) {
    const from = formatDateTime(new Date(fromRaw), false);
    const to = formatDateTime(new Date(toRaw), true);
    try {
        const response = await fetch(`/duanweb2/app/api/order.api.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=getSalesByDay&from=${from}&to=${to}&period=${period}`
        });

        const result = await response.json();

        if (result.success) {
            renderSalesChart(result.data, from, to);
        } else {
            console.error("Failed to fetch sales data:", result.message);
        }
    } catch (error) {
        console.error("Error fetching sales data:", error);
    }
}

function renderSalesChart(data, from, to) {
    const fromDate = new Date(from);
    const toDate = new Date(to);
    const dayDiff = (toDate - fromDate) / (1000 * 3600 * 24);

    const labels = data.map(d => {
        const date = new Date(d.date);
        if (dayDiff <= 7) {
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            return `${days[date.getDay()]} `;
        }
        return d.date;
    });

    const totals = data.map(d => d.total);

    salesChart.data.labels = labels;
    salesChart.data.datasets[0].data = totals;
    salesChart.update();
}


let dataDiv = document.getElementById("category-chart-data");
if (dataDiv) {
    console.log(dataDiv.dataset.values)
    const labels = JSON.parse(dataDiv.dataset.labels);
    const values = JSON.parse(dataDiv.dataset.values) || [];

    const intValues = JSON.parse(values);
    const labelsArray = JSON.parse(labels);

    const ctx = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labelsArray,
            datasets: [{
                data: intValues,
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

/* <td>${Number(customer.total_spent).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}</td> */