function calcul_chart_dashboard() {
    $.ajax({
        url: "../../models/calculChartDashboard.php",
        method: "POST",
        success: function (data) {
            try {
                data = $.parseJSON(data);
                
                $('#nbr_francaise').text(data.res1);
                $('#nbr_europeenne').text(data.res2);
                
                const frenchCtx = document.getElementById('francaiseChart').getContext('2d');
                new Chart(frenchCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Mission Française', ''],
                        datasets: [{
                            data: [data.total1, 100 - data.total1],
                            backgroundColor: ['#470EE9', '#EFEFFF'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: false,
                        cutout: '85%',
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: false },
                            title: {
                                display: true,
                                position: 'center',
                                color: '#470EE9',
                                font: { size: 20, weight: 'bold' }
                            }
                        }
                    },
                    plugins: [{
                        id: 'centerText',
                        beforeDraw: function (chart) {
                            const width = chart.width,
                                  height = chart.height,
                                  ctx = chart.ctx;
                            ctx.restore();
                            const fontSize = (height / 114).toFixed(2);
                            ctx.font = fontSize + "em sans-serif";
                            ctx.fontWeight = 'bold';
                            ctx.textBaseline = "middle";
                            const text = data.total1 + '%',
                                  textX = Math.round((width - ctx.measureText(text).width) / 2),
                                  textY = height / 2;
                            ctx.fillStyle = '#470EE9';
                            ctx.fillText(text, textX, textY);
                            ctx.save();
                        }
                    }]
                });
                
                const europeCtx = document.getElementById('europeenneChart').getContext('2d');
                new Chart(europeCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Mission Européenne', ''],
                        datasets: [{
                            data: [data.total2, 100 - data.total2],
                            backgroundColor: ['#470EE9', '#EFEFFF'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: false,
                        cutout: '85%',
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: false },
                            title: {
                                display: true,
                                position: 'center',
                                color: '#470EE9',
                                font: { size: 20, weight: 'bold' }
                            }
                        }
                    },
                    plugins: [{
                        id: 'centerText',
                        beforeDraw: function (chart) {
                            const width = chart.width,
                                  height = chart.height,
                                  ctx = chart.ctx;
                            ctx.restore();
                            const fontSize = (height / 114).toFixed(2);
                            ctx.font = fontSize + "em sans-serif";
                            ctx.fontWeight = 'bold';
                            ctx.textBaseline = "middle";
                            const text = data.total2 + '%',
                                  textX = Math.round((width - ctx.measureText(text).width) / 2),
                                  textY = height / 2;
                            ctx.fillStyle = '#470EE9';
                            ctx.fillText(text, textX, textY);
                            ctx.save();
                        }
                    }]
                });
            } catch (err) {
                console.error("Erreur JSON:", err);
            }
        },
        error: function (xhr, status, error) {
            console.error("Erreur AJAX:", status, error);
        }
    });
}

document.addEventListener('DOMContentLoaded', calcul_chart_dashboard);
