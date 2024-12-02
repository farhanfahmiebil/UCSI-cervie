<div class="row pt-3">
  <div class="col-12">
    <!-- card -->
    <div class="card">

      <!-- card body -->
      <div class="card-body">

        <!-- title -->
        <div class="d-flex align-items-center justify-content-between">
          <h4 class="card-title mb-2">Grant</h4>
        </div>
        <!-- end title -->

        <!-- tab list -->
        <ul class="nav nav-tabs tab-no-active-fill pt-5" role="tablist">
          <li class="nav-item">
            <a class="nav-link active ps-2 pe-2" id="on-going-tab" data-bs-toggle="tab" href="#on-going" role="tab" aria-controls="on-going" aria-selected="true">On-Going</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ps-2 pe-2" id="grant-type-tab" data-bs-toggle="tab" href="#grant-type" role="tab" aria-controls="grant-type" aria-selected="false">Grant Type by Year</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ps-2 pe-2" id="grant-type-quantum-tab" data-bs-toggle="tab" href="#grant-type-quantum" role="tab" aria-controls="grant-type-quantum" aria-selected="false">Grant Type by Year (Quantum)</a>
          </li>
        </ul>
        <!-- end tab list -->

        <!-- tab content -->
        <div class="tab-content tab-no-active-fill-tab-content">

          <!-- on going -->
          <div class="tab-pane fade show active" id="on-going" role="tabpanel" aria-labelledby="on-going-tab">
            <div class="container mt-5">
              <table class="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Grant Title</th>
                    <th>Progress</th>
                    <th>Progress</th>
                    <th>Start Date</th>
                    <!-- <th>End Date</th> -->
                  </tr>
                </thead>
                <tbody>
                  @foreach($data['report']['by']['grant']['progress'] as $key=>$value)

                    <tr>
                      <td>{{ ($key+1) }}</td>
                      <td>{{ $value->title }}</td>
                      <td class="col-md-8">
                        <div class="progress" style="height: 30px;">
                          <div class="progress-bar progress-bar-striped progress-bar-animated
                                @if($value->percentage_left <= 25) bg-danger
                                @elseif($value->percentage_left <= 50) bg-warning
                                @elseif($value->percentage_left <= 75) bg-primary
                                @else bg-success
                                @endif"
                               role="progressbar"
                               style="width: {{ number_format($value->percentage_left, 2) }}%;"
                               aria-valuenow="{{ number_format($value->percentage_left, 2) }}"
                               aria-valuemin="0"
                               aria-valuemax="100"
                               data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="Progress: {{ number_format($value->percentage_left, 2) }}%<br>Start Date: {{ \Carbon\Carbon::parse($value->date_start)->format('Y-m-d') }}"
                               data-bs-html="true">
                          </div>
                        </div>
                      </td>
                      <td>{{ number_format($value->percentage_left, 2) }}%</td>
                      <!-- Optionally display start date -->
                      <td>{{ \Carbon\Carbon::parse($value->date_start)->format('d M Y') }}</td>
                    </tr>

                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
          <!-- end on going -->

        </div>
        <!-- end tab content -->

        <!-- tab content -->
        <div class="tab-content tab-no-active-fill-tab-content">

          <!-- on going -->
          <div class="tab-pane fade" id="grant-type" role="tabpanel" aria-labelledby="grant-type-tab">
            <div class="container">
              <div id="graphGrantTypeByYear" class="border"></div>

            </div>
          </div>
          <!-- end on going -->

        </div>
        <!-- end tab content -->

        <!-- tab content -->
        <div class="tab-content tab-no-active-fill-tab-content">

          <!-- on going -->
          <div class="tab-pane fade" id="grant-type-quantum" role="tabpanel" aria-labelledby="grant-type-quantum-tab">
            <div class="container">
              <div id="graphGrantTypeByYearQuantum" class="border"></div>

            </div>
          </div>
          <!-- end on going -->

        </div>
        <!-- end tab content -->

      </div>
      <!-- card body -->

    </div>
    <!-- end card -->

  </div>

</div>
<!-- end publication -->
@include(Config::get('routing.application.modules.dashboard.researcher.layout').'.plugin.apex.index')

<script>


/**************************************************************************************
 On-going tooltip
**************************************************************************************/

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});


/**************************************************************************************
 Graph Grant Type By Year
**************************************************************************************/

// Extract the data passed from Laravel to JavaScript
const data = @json($data['cervie']['researcher']['grant']['graph']['type']['by']['year']); // This will convert your PHP array into a JavaScript array

// Initialize arrays for storing the chart data
let categories = [];
let seriesData = [];

// Get unique years and grant types
let years = [...new Set(data.map(item => item.year_start))];
let grantTypes = [...new Set(data.map(item => item.grant_type_name))];

// Prepare data for each grant type
grantTypes.forEach(grantType => {
  seriesData.push({
      name: grantType,
      data: years.map(year => {
          // Find the data for each year and grant type
          const item = data.find(d => d.year_start === year && d.grant_type_name === grantType);
          return item ? item.total : 0; // Return the total or 0 if no data for that year/grant type
      })
  });
});

// Prepare categories for x-axis (year_start)
categories = years;

// ApexCharts options
var options = {
  chart: {
      type: 'bar',
      height: 350,
      background: '#f4f4f4', // Optional: Light background for better visibility
  },
  plotOptions: {
      bar: {
          horizontal: false,
          columnWidth: '55%',
          endingShape: 'rounded'
      }
  },
  dataLabels: {
      enabled: true,  // Show the numbers on top of the bars
      style: {
          fontSize: '12px',
          colors: ['#fff'],  // White text on dark bars
      },
      formatter: function (val) {
          return val; // Directly show the value
      },
  },
  xaxis: {
      categories: categories, // Year categories on the X-axis
  },
  yaxis: {
      title: {
          text: 'Total Grants'
      },
      labels: {
          formatter: function (val) {
              return val.toFixed(0); // Round y-axis numbers to whole numbers
          }
      }
  },
  series: seriesData, // The data series for each grant type
  title: {
      text: 'Grants by Year and Type',
      align: 'center'
  },
  tooltip: {
      enabled: true,  // Enable tooltip
      y: {
          formatter: function (val) {
              return val + ' Grants'; // Tooltip text
          }
      }
  }
};


 // Create a new chart instance with the options defined above
 var chart = new ApexCharts(document.querySelector("#graphGrantTypeByYear"), options);

 // Render the chart
 chart.render();

 /**************************************************************************************
  Graph Grant Type By Year (Quantum)
 **************************************************************************************/

 // Get data passed from Laravel to JavaScript
 const dataQuantum = @json($data['cervie']['researcher']['grant']['graph']['type']['by']['quantum']);

 // Prepare unique years and grant types
 const yearsQuantum = [...new Set(dataQuantum.map(item => item.year_start))];
 const grantTypesQuantum = [...new Set(dataQuantum.map(item => item.grant_type_name))];

 // Create an object to aggregate the total quantum by year and grant type
 const aggregatedData = {};

 // Loop through the data and aggregate by year_start and grant_type_name
 dataQuantum.forEach(item => {
     const key = `${item.year_start}-${item.grant_type_name}`;
     if (!aggregatedData[key]) {
         aggregatedData[key] = 0;
     }
     aggregatedData[key] += parseFloat(item.total);
 });

 // Initialize series data for the chart
 const seriesDataQuantum = grantTypesQuantum.map(grantType => {
     return {
         name: grantType,
         data: yearsQuantum.map(year => {
             // Create the key for each year and grant type
             const key = `${year}-${grantType}`;
             // If data exists for this year and grant type, use it, otherwise set to 0
             return aggregatedData[key] || 0;
         })
     };
 });

 // ApexCharts configuration
 const quantum = {
     chart: {
         type: 'bar',
         height: 350,
         background: '#f4f4f4',
     },
     plotOptions: {
         bar: {
             horizontal: false,
             columnWidth: '55%',
             endingShape: 'rounded'
         }
     },
     dataLabels: {
         enabled: true,
         style: {
             fontSize: '12px',
             colors: ['#fff'],
         },
         formatter: function (val) {
             return val.toFixed(2); // Show 2 decimal places
         }
     },
     xaxis: {
         categories: yearsQuantum, // Year categories on X-axis
     },
     yaxis: {
         title: {
             text: 'Total Quantum Grants'
         },
         labels: {
             formatter: function (val) {
                 return val.toFixed(2); // Format Y-axis labels
             }
         }
     },
     series: seriesDataQuantum, // The data series for each grant type
     title: {
         text: 'Grants by Year and Type (Quantum)',
         align: 'center'
     },
     tooltip: {
         enabled: true,
         y: {
             formatter: function (val) {
                 return `${val.toFixed(2)} Quantum Grants`; // Tooltip format
             }
         }
     }
 };

// Create and render the chart in the designated container
const quantumChart = new ApexCharts(document.querySelector("#graphGrantTypeByYearQuantum"), quantum);
quantumChart.render();

</script>
