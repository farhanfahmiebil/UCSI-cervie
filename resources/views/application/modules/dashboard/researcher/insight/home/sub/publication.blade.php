<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between py-4">
          <h4 class="card-title mb-2">Publication</h4>
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

                <div id="graphPublicationByPublicationType" class="border"></div>

            </div>
            <div class="tab-pane fade" id="publication-indexing-body" role="tabpanel" aria-labelledby="publication-indexing-body-tab">

                <div id="graphPublicationByIndexingBody" class="border"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@include(Config::get('routing.application.modules.dashboard.researcher.layout').'.plugin.apex.index')
<script type="text/javascript">
var publicationOptions = {
      chart: {
        type: 'bar',
        height: 550,
        stacked: false, // Disable stacking to create clustered bars
        zoom: {
            enabled: true, // Enable zooming
            type: 'x',    // Type of zoom, 'x' for horizontal zoom
            resetIcon: {
                offsetX: -10,
                offsetY: 0,
                shape: 'circle',
                size: 20,
                color: '#5478B8',
                strokeWidth: 2
            }
        },
    },
    plotOptions: {
        bar: {
            horizontal: false, // Set to `true` for horizontal bars
            columnWidth: '100%', // Bar width
            barGroupPadding: 0.15, // Padding between groups of bars
            endingShape: 'rounded' // Rounded ends for bars
        }
    },
    series: @json($data['graph']['publication']['type']['label']).map(function(label, index) {
        var dataForLabel = @json($data['graph']['publication']['type']['year']).map(function(year) {
            return @json($data['graph']['publication']['type']['data'])[year][label] || 0;
        });

        // Define a color for each label (publication type)
        var colors = [
            '#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#8E44AD', '#F39C12', '#2C3E50',
            '#1ABC9C', '#D35400', '#9B59B6', '#3498DB', '#E74C3C', '#BDC3C7', '#16A085',
            '#F1C40F', '#7F8C8D', '#9B59B6', '#E67E22' // Example color codes for 18 publication types
        ];

        return {
            name: label,
            data: dataForLabel,
            color: colors[index] // Assign each series a unique color
        };
    }),
    xaxis: {
        categories: @json($data['graph']['publication']['type']['year']),  // Use years as x-axis categories
        labels: {
            padding: 10 // Add padding between the categories (years)
        }
    },
    yaxis: {
        title: {
            text: 'Publication Type'
        }
    },
    title: {
        text: 'Publication Types by Year',
        align: 'center'
    },
    fill: {
        opacity: 0.9
    },
    legend: {
        position: 'right', // Legend on the right
        horizontalAlign: 'center',
        floating: false,
        itemMargin: {
            vertical: 5
        }
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return val;
            }
        }
    },
    grid: {
        borderColor: '#e0e0e0',  // Light gray color for the gridline
        strokeDashArray: 0, // Solid gridline (use 5 for dashed lines)
        yaxis: {
            lines: {
                show: true // Show gridlines behind bars
            }
        },
        xaxis: {
            lines: {
                show: true // Show gridlines behind bars (vertical gridlines)
            }
        }
    },
    stroke: {
        width: 0, // Width of the border/stroke for the bars
        colors: ['#000000'], // Color of the stroke (line) around the bars
        dashArray: 0 // Solid stroke (use 5 for dashed stroke)
    },
    responsive: [{
    breakpoint: 1200,
    options: {
        chart: {
            height: 400
        },
        legend: {
            position: 'bottom'
        }
    }
}]
};
// Initialize Publication Type Chart
var publicationChart = new ApexCharts(document.querySelector("#graphPublicationByPublicationType"), publicationOptions);
publicationChart.render();

// Make sure that the indexing body data is passed correctly from PHP to JavaScript
var indexingData = @json($data['graph']['indexing']['body']);

// Check if indexing data exists and is in the correct format
if (indexingData && indexingData.year && indexingData.label && indexingData.data) {

    // var years_indexing = indexingData.year; // Array of years
    // var labels = indexingData.label; // Array of indexing body types
    // var dataByYear = indexingData.data; // Data grouped by year and indexing body type
    //
    // // Initialize the series array for ApexCharts (for the indexing body data)
    // var series = labels.map(function(label) {
    //     // For each label (indexing body type), build the data array for each year
    //     var dataForLabel = years_indexing.map(function(year) {
    //         // Safely access the data and provide a default value of 0 if not found
    //         return dataByYear[year] && dataByYear[year][label] !== undefined
    //             ? dataByYear[year][label]
    //             : 0; // Force a 0 value if the data is undefined or null
    //     });
    //
    //     return {
    //         name: label, // Indexing body type as the series name
    //         data: dataForLabel
    //     };
    // });

  // Extract years, labels, and data
  var years_indexing = indexingData.year;  // Array of years
  var labels = indexingData.label;  // Array of indexing body types
  var dataByYear = indexingData.data;  // Data grouped by year and indexing body type

  // Create series for each label (indexing body type)
  var series = labels.map(function(label) {
      // For each label (indexing body type), build the data array for each year
      var dataForLabel = years_indexing.map(function(year) {
          return dataByYear[year] && dataByYear[year][label] !== undefined
              ? dataByYear[year][label]
              : 0;  // Force a 0 value if the data is undefined or null
      });

      return {
          name: label,  // Indexing body type as the series name
          data: dataForLabel
      };
  });

  // Chart configuration
  var indexingOptions = {
      chart: {
          type: 'bar',
          height: 350,
          stacked: false,
      },
      series: series,
      xaxis: {
          categories: years_indexing,  // Years will be displayed on the X-axis
      },
      yaxis: {
          title: {
              text: 'Indexing Body Count'
          }
      },
      title: {
          text: 'Indexing Body by Year and Type',
          align: 'center'
      },
      fill: {
          opacity: 0.9
      },
      legend: {
          position: 'right',  // Position the legend on the right
          showForZeroSeries: true,  // Show legend even if the data is zero
          onItemClick: {
              toggleDataSeries: true
          },
          onItemHover: {
              highlightDataSeries: true
          },
          itemMargin: {
              horizontal: 5,
              vertical: 10
          }
      },
      plotOptions: {
          bar: {
              columnWidth: '50%',  // Adjust width of bars
          }
      },
      grid: {
          borderColor: '#e7e7e7',
          padding: {
              bottom: 10
          }
      }
  };

    // Initialize the chart
    var publicationIndexingBody = new ApexCharts(document.querySelector("#graphPublicationByIndexingBody"), indexingOptions);
    publicationIndexingBody.render();

} else {
    console.error('Indexing body data is missing or incorrectly formatted');
}

</script>
