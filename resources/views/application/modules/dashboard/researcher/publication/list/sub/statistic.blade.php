<!-- publication -->
<div class="row">
  <div class="col-sm-12 grid-margin d-flex stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between py-4">
          <h4 class="card-title mb-2">Statistic</h4>
        </div>
        <div>
          <ul class="nav nav-tabs tab-no-active-fill" role="tablist">
            <li class="nav-item">
              <a class="nav-link active ps-2 pe-2" id="publication-type-tab" data-bs-toggle="tab" href="#publication-type" role="tab" aria-controls="publication-type" aria-selected="true">Publication Type</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ps-2 pe-2" id="publication-indexing-body-tab" data-bs-toggle="tab" href="#publication-indexing-body" role="tab" aria-controls="publication-indexing-body" aria-selected="false">Publication By Indexing Body</a>
            </li>
          </ul>
          <div class="tab-content tab-no-active-fill-tab-content">
            <div class="tab-pane fade show active" id="publication-type" role="tabpanel" aria-labelledby="publication-type-tab">
              <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand"><div class=""></div></div>
                <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
              </div>

                <div id="graphPublicationByPublicationType" class="border"></div>

                <!-- <div id="revenuechart-legend" class="revenuechart-legend">
                  <ul class="2-legend">
                    <li><span class="legend-box" style="background:#0ddbb9;"></span><span class="legend-label" style="">Margin</span></li>
                    <li><span class="legend-box" style="background:#464dee;"></span><span class="legend-label" style="">Product</span></li>
                    <li><span class="legend-box" style="background:#ee5b5b;"></span><span class="legend-label" style="">Cost</span></li>
                  </ul>
                </div> -->
            </div>
            <div class="tab-pane fade" id="publication-indexing-body" role="tabpanel" aria-labelledby="publication-indexing-body-tab">

                <div id="graphPublicationByIndexingBody" class="border"></div>

                <!-- <p class="mb-4">+5.2% vs last 7 days</p> -->
                <!-- <div id="serveLoading-legend" class="revenuechart-legend">
                  <ul class="3-legend">
                    <li><span class="legend-box" style="background:#0ddbb9;"></span><span class="legend-label" style="">Margin</span></li>
                    <li><span class="legend-box" style="background:#464dee;"></span><span class="legend-label" style="">Product</span></li>
                    <li><span class="legend-box" style="background:#ee5b5b;"></span><span class="legend-label" style="">Cost</span></li>
                  </ul>
                </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end publication -->
@include(Config::get('routing.application.modules.dashboard.researcher.layout').'.plugin.apex.index')
<script type="text/javascript">
// const graph_by_type = @json($data['graph']['type']);
//
// var options = {
//      chart: {
//          type: 'bar',
//          height: 350
//      },
//      plotOptions: {
//          bar: {
//              horizontal: false,
//              columnWidth: '45%',
//              endingShape: 'rounded'
//          }
//      },
//      dataLabels: {
//          enabled: true
//      },
//      colors: ['#008FFB', '#00E396'], // Colors for each series
//      series: [
//          {
//              name: 'Series A',
//              data: [30, 40, 45, 50]
//          },
//          {
//              name: 'Series B',
//              data: [20, 30, 25, 40]
//          }
//      ],
//      xaxis: {
//          categories: ['2024', '2023', '2022', '2021']
//      },
//      yaxis: {
//          title: {
//              text: 'Values'
//          }
//      },
//      title: {
//          text: 'Clustered Bar Chart Example',
//          align: 'center'
//      },
//      legend: {
//          position: 'top',
//          horizontalAlign: 'left',
//          floating: false,
//          offsetY: 0,
//          offsetX: 0
//      },
//      tooltip: {
//          shared: true,
//          intersect: false
//      }
//  };
//

// var options = {
//   series: [
//     {
//       name: 'Total',
//       data: graph_by_type.value // Ongoing status for each category
//     },
//     // {
//     //   name: 'Completed',
//     //   data: [53, 32, 33, 52, 13, 44, 32, 25, 15, 35, 22, 30, 20, 25, 27, 20, 18] // Completed status for each category
//     // }
//   ],
//   chart: {
//     type: 'bar',
//     height: 600, // Increase height for more categories
//     width: '100%', // Set width to 100% to make it responsive
//     // stacked: true // Enable stacking
//   },
//   title: {
//             text: 'Publications by Type', // Set your chart title here
//             align: 'center', // Title alignment (optional: 'left', 'center', 'right')
//             style: {
//                 fontSize: '16px', // Customize font size
//                 fontWeight: 'bold', // Customize font weight
//                 color: '#333', // Customize font color
//                 fontFamily: 'Roboto, sans-serif' // Set your desired font family
//
//             }
//         },
//   plotOptions: {
//     bar: {
//       horizontal: true, // Horizontal bars
//       dataLabels: {
//         position: 'top',
//       },
//     }
//   },
//   dataLabels: {
//     enabled: true,
//     offsetX: -6,
//     style: {
//       fontSize: '12px',
//       colors: ['#fff']
//     }
//   },
//   stroke: {
//     show: true,
//     width: 1,
//     colors: ['#fff']
//   },
//   tooltip: {
//     shared: true,
//     intersect: false
//   },
//   xaxis: {
//     categories: graph_by_type.label, // List of categories
//   },
//   colors: [
//     '#1f77b4', '#89c2ff'
//   ], // Blue for Ongoing, Light Blue for Completed
//   fill: {
//     opacity: 1
//   },
//   legend: {
//     show: true,
//     position: 'top',
//     horizontalAlign: 'left',
//   },
// };
//
// var chart = new ApexCharts(document.querySelector("#graphPublicationByPublicationType"), options);
//
// chart.render();

// Prepare data for Publication Type Chart
var publicationTypeData = @json($data['graph']['type']);
var publicationYears = Object.keys(publicationTypeData);
var publicationSeries = [];

// Create series data for each publication type
publicationYears.forEach(function(year) {
    // Ensure we're working with individual types for the series
    for (var i = 0; i < publicationTypeData[year].label.length; i++) {
        // Check if the series for this type already exists
        let typeName = publicationTypeData[year].label[i];
        let typeValue = publicationTypeData[year].value[i] || 0; // Default to 0 if no value

        // Find if the series already exists
        let existingSeries = publicationSeries.find(series => series.name === typeName);

        if (existingSeries) {
            // If it exists, push the value for the current year
            existingSeries.data.push(typeValue);
        } else {
            // If it doesn't exist, create a new series entry
            publicationSeries.push({
                name: typeName,
                data: [typeValue] // Initialize data with the current year's value
            });
        }
    }
});

var publicationOptions = {
    chart: {
        type: 'bar', // Set chart type to bar
        height: 350
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '40%', // Adjust width for spacing
            endingShape: 'rounded'
        }
    },
    dataLabels: {
        enabled: true
    },
    series: publicationSeries, // Use the constructed series
    xaxis: {
        categories: publicationYears, // Use years as categories on x-axis
        title: {
            text: 'Year'
        }
    },
    yaxis: {
        title: {
            text: 'Values'
        }
    },
    grid: {
        borderColor: '#e0e0e0', // Color of the grid lines
        strokeDashArray: 4, // Dashed lines for the grid
        yaxis: {
            lines: {
                show: true // Show grid lines for y-axis
            }
        }
    },
    title: {
        text: 'Publications by Type (Bar Chart)',
        align: 'center'
    },
    legend: {
        position: 'top',
        horizontalAlign: 'left'
    },
    tooltip: {
        shared: true,
        intersect: false
    }
};


  // Initialize Publication Type Chart
  var publicationChart = new ApexCharts(document.querySelector("#graphPublicationByPublicationType"), publicationOptions);
  publicationChart.render();

const graph_by_indexing_body = @json($data['graph']['indexing']['body']);

console.log(graph_by_indexing_body);

var options = {
  series: [
    {
      name: 'Ongoing',
      data: graph_by_indexing_body.value // Ongoing status for each category
    },
  ],
  chart: {
    type: 'bar',
    height: 600, // Increase height for more categories
    width: '100%', // Set width to 100% to make it responsive
    stacked: true // Enable stacking
  },
  plotOptions: {
    bar: {
      horizontal: true, // Horizontal bars
      dataLabels: {
        position: 'top',
      },
    }
  },
  dataLabels: {
    enabled: true,
    offsetX: -6,
    style: {
      fontSize: '12px',
      colors: ['#fff'] // Color for data labels
    }
  },
  stroke: {
    show: true,
    width: 1,
    colors: ['#fff'] // Stroke color
  },
  tooltip: {
    shared: true,
    intersect: false
  },
  xaxis: {
    categories: graph_by_indexing_body.label,
    labels: {
        style: {
            fontSize: '14px', // Change font size
            fontFamily: 'Roboto, sans-serif', // Set your desired font family
            color: '#333333' // Change font color
        }
    } // List of categories
  },
  colors: [
    '#ff0000', // Red for Ongoing
    '#ffcccc'  // Light Red for Completed
  ],
  fill: {
    opacity: 1
  },
  legend: {
    show: true,
    position: 'top',
    horizontalAlign: 'left',
  },
};

var chart = new ApexCharts(document.querySelector("#graphPublicationByIndexingBody"), options);

chart.render();

</script>
