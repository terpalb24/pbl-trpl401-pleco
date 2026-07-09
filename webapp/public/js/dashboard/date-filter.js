const trashElementIds = ['BOTTLE', 'PLASTIC_BAG', 'MILK_CARTON'];

document.getElementById('trash-date-filter').onchange = async(e) => {
    const selectedDate = e.target.value;
    if (!selectedDate) {
        resetTrashData();
        return;
    }

    await requestOneDayData(selectedDate);
}

function resetTrashData() {
    const allIds = trashElementIds.map(x => x);
    allIds.push('all-trash');

    for (const trashId of allIds) {
        const element = document.getElementById(trashId);
        element.innerHTML = element.dataset.default;
    }
}

async function requestOneDayData(date) {
    const req = await fetch(`/stats?period=one_day&start=${date}`);
    if (!req.ok) return;

    const data = await req.json();

    setTrashData(data);
}

function setTrashData(data) {
    let total = 0;

    for (const trashId of trashElementIds) {
        const trashTotal = data.find(x => x['trash_id'] === trashId)?.total ?? 0;
        document.getElementById(trashId).innerHTML = trashTotal;
        total += trashTotal;
    }

    document.getElementById('all-trash').innerHTML = total.toString();
}
