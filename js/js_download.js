// Function to download table as Excel
function downloadExcel() {
    var table = document.getElementById('data-table');
    var cloneTable = table.cloneNode(true);
    var lastColumnIndex = cloneTable.rows[0].cells.length - 1;

    // Remove the last column (Aksi) from the cloned table
    for (var i = 0; i < cloneTable.rows.length; i++) {
        cloneTable.rows[i].deleteCell(lastColumnIndex);
    }

    var wb = XLSX.utils.table_to_book(cloneTable, { sheet: "Sheet JS" });
    XLSX.writeFile(wb, 'water_quality_monitoring.xlsx');
}

// Function to download table as PDF
async function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const table = document.getElementById('data-table');
    const rows = table.rows;
    let col = [];
    let row = [];

    for (let i = 0; i < rows[0].cells.length - 1; i++) { // Exclude last column
        col.push(rows[0].cells[i].innerText);
    }

    for (let i = 1; i < rows.length; i++) {
        let tempRow = [];
        for (let j = 0; j < rows[i].cells.length - 1; j++) { // Exclude last column
            tempRow.push(rows[i].cells[j].innerText);
        }
        row.push(tempRow);
    }

    doc.autoTable({
        head: [col],
        body: row,
    });

    doc.save('water_quality_monitoring.pdf');
}

// Function to download table as JPEG
function downloadJPEG() {
    const table = document.getElementById('data-table');
    const cloneTable = table.cloneNode(true);
    const lastColumnIndex = cloneTable.rows[0].cells.length - 1;

    // Remove the last column (Aksi) from the cloned table
    for (let i = 0; i < cloneTable.rows.length; i++) {
        cloneTable.rows[i].deleteCell(lastColumnIndex);
    }

    html2canvas(cloneTable).then(canvas => {
        let link = document.createElement('a');
        link.href = canvas.toDataURL("image/jpeg");
        link.download = 'water_quality_monitoring.jpg';
        link.click();
    });
}

var animateButton = function(e) {

    e.preventDefault;
    e.target.classList.remove('animate');

    e.target.classList.add('animate');
    setTimeout(function() {
        e.target.classList.remove('animate');
    }, 700);
};

var bubblyButtons = document.getElementsByClassName("bubble-button");

for (var i = 0; i < bubblyButtons.length; i++) {
    bubblyButtons[i].addEventListener('click', animateButton, false);
}