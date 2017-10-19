var dataCom = [
  {
    x: ['Never','Rarely','Sometimes', 'Usually', 'Always'],
    y: [0.2, 0.6, 13.1, 76, 10.2],
    type: 'bar',
    marker:{
        color: '#0ba39c'
    }
  }
];

Plotly.newPlot('satisfaction', dataCom);