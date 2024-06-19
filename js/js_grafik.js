document.addEventListener("DOMContentLoaded", function() {
    if (typeof dataPH !== 'undefined' && typeof dataSuhu !== 'undefined' && typeof dataDis_O2 !== 'undefined' && typeof dataKekeruhan !== 'undefined') {
        // Tampilkan grafik pH
        var ctxPH = document.getElementById('chartPH').getContext('2d');
        var chartPH = new Chart(ctxPH, {
            type: 'line',
            data: {
                labels: Object.keys(dataPH),
                datasets: [{
                    label: 'pH',
                    data: Object.values(dataPH),
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
                },
                plugins: {
                    legend: {
                        labels: {
                            fontSize: 30 // Ukuran label 3 kali lebih besar dari ukuran default
                        }
                    }
                }
            }
        });

        // Tampilkan grafik Suhu
        var ctxSuhu = document.getElementById('chartSuhu').getContext('2d');
        var chartSuhu = new Chart(ctxSuhu, {
            type: 'line',
            data: {
                labels: Object.keys(dataSuhu),
                datasets: [{
                    label: 'Suhu',
                    data: Object.values(dataSuhu),
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            fontSize: 30 // Ukuran label 3 kali lebih besar dari ukuran default
                        }
                    }
                }
            }
        });

        // Tampilkan grafik Dissolved Oxygen
        var ctxDisO2 = document.getElementById('chartDis_O2').getContext('2d');
        var chartDisO2 = new Chart(ctxDisO2, {
            type: 'line',
            data: {
                labels: Object.keys(dataDis_O2),
                datasets: [{
                    label: 'Dissolved Oxygen',
                    data: Object.values(dataDis_O2),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            fontSize: 30 // Ukuran label 3 kali lebih besar dari ukuran default
                        }
                    }
                }
            }
        });

        // Tampilkan grafik Kekeruhan
        var ctxKekeruhan = document.getElementById('chartKekeruhan').getContext('2d');
        var chartKekeruhan = new Chart(ctxKekeruhan, {
            type: 'line',
            data: {
                labels: Object.keys(dataKekeruhan),
                datasets: [{
                    label: 'Kekeruhan',
                    data: Object.values(dataKekeruhan),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            fontSize: 30 // Ukuran label 3 kali lebih besar dari ukuran default
                        }
                    }
                }
            }
        });
    }
});