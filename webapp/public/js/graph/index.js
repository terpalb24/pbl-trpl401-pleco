const ctx = document.getElementById('myChart');
let chart;

const dailyChartInfo = { next: '',  prev: '' };
const monthlyChartInfo = { next: new Date().getFullYear() + 1,  prev: new Date().getFullYear() - 1 };
const yearlyChartInfo = { next: new Date().getFullYear() + 5,  prev: new Date().getFullYear() - 5 };

(async() => {
    chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: '# sampah',
                data: [],
                borderRadius: 10,
                backgroundColor: '#1B66DB',
                hoverBackgroundColor: '#2F2ACF'
            }]
        },
        options: {
            scales: {
                x: {
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    document.getElementById('loading-text').remove();
    await fetchDailyData(new Date().getDate());
})();



async function fetchDailyData(endDate) {
    try {
        const req = await fetch('/stats?period=daily&start=' + endDate);
        if (req.status !== 200) return;

        const res = await req.json();

        const labels = res['labels'];
        const allTrash = res['data'];

        const values = [];
        for (let date of labels) {
            const trashFound = allTrash.find(x => x['collected_at'] === date);

            if (!trashFound) {
                values.push(0);
                continue;
            }

            values.push(trashFound['total']);
        }

        dailyChartInfo.prev = res['info']['date_for_prev'];
        dailyChartInfo.next = res['info']['date_for_next'];
        updateChart(labels, values);
    } catch (err) {
        //
    }
}

async function fetchMonthlyData(year) {
    try {
        const req = await fetch('/stats?period=monthly&start=' + year);
        if (req.status !== 200) return;

        const res = await req.json();

        let labels = res['labels'];
        const allTrash = res['data'];

        const values = [];
        for (let date of labels) {
            const trashFound = allTrash.find(x => x['month'] === date);

            if (!trashFound) {
                values.push(0);
                continue;
            }

            values.push(trashFound['total']);
        }

        labels = labels.map(x => x + ' ' + year);

        monthlyChartInfo.prev = res['info']['year_for_prev'];
        monthlyChartInfo.next = res['info']['year_for_next'];
        updateChart(labels, values);
    } catch (err) {
        //
    }
}

async function fetchYearlyData(year) {
    try {
        const req = await fetch('/stats?period=yearly&start=' + year);
        if (req.status !== 200) return;

        const res = await req.json();

        let labels = res['labels'];
        const allTrash = res['data'];

        const values = [];
        for (let date of labels) {
            const trashFound = allTrash.find(x => x['year'] === date);

            if (!trashFound) {
                values.push(0);
                continue;
            }

            values.push(trashFound['total']);
        }

        yearlyChartInfo.prev = res['info']['year_for_prev'];
        yearlyChartInfo.next = res['info']['year_for_next'];
        updateChart(labels, values);
    } catch (err) {
        //
    }
}



document.getElementById('period').onchange = async(e) => {
    const period = e.target.value;
    if (period === 'h') await fetchDailyData(new Date().getDate());
    if (period === 'b') await fetchMonthlyData(new Date().getFullYear());
    if (period === 't') await fetchYearlyData(new Date().getFullYear());
}

document.getElementById('prev-period').onclick = async() => {
    const period = document.getElementById('period').value;
    if (period === 'h') await fetchDailyData(dailyChartInfo.prev);
    if (period === 'b') await fetchMonthlyData(monthlyChartInfo.prev);
    if (period === 't') await fetchYearlyData(yearlyChartInfo.prev);
}

document.getElementById('next-period').onclick = async() => {
    const period = document.getElementById('period').value;
    if (period === 'h') await fetchDailyData(dailyChartInfo.next);
    if (period === 'b') await fetchMonthlyData(monthlyChartInfo.next);
    if (period === 't') await fetchYearlyData(yearlyChartInfo.next);
}



function updateChart(labels, data) {
    chart.data.labels = labels;
    chart.data.datasets[0].data = data;
    chart.update();
}
