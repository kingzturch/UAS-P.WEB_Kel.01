// Fungsi untuk mengunduh grafik sebagai PDF
function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const charts = document.querySelectorAll("canvas");

    const pdf = new jsPDF();
    let yOffset = 10;

    charts.forEach((chart, index) => {
        const imgData = chart.toDataURL("image/jpeg", 1.0);
        pdf.addImage(imgData, 'JPEG', 10, yOffset, 190, 80);
        yOffset += 90;

        if (index < charts.length - 1) {
            pdf.addPage();
            yOffset = 10;
        }
    });

    pdf.save("grafik_pemantauan.pdf");
}

// Fungsi untuk mengunduh grafik sebagai JPEG
function downloadJPEG() {
    const charts = document.querySelectorAll("canvas");

    charts.forEach((chart, index) => {
        const imgData = chart.toDataURL("image/jpeg", 1.0);
        const link = document.createElement('a');
        link.href = imgData;
        link.download = `grafik_${chart.id}.jpeg`;
        link.click();
    });
}
