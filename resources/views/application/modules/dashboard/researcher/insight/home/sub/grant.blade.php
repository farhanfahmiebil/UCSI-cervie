<div class="row pt-3">
  <div class="col-12">
    <div class="card">

      <div class="card-body">

        <div class="row">
          <div class="col-md-12">
            <div class="card-title">Grant</div>
          </div>

          <div class="col-md-12">
            <div class="mb-3">
              Grant By Category
            </div>

            <div id="graphGrantByCategory" class="border"></div>
          </div>

        </div>

      </div>
    </div>
  </div>

</div>
@include(Config::get('routing.application.modules.dashboard.researcher.layout').'.plugin.apex.index')
<script type="text/javascript">

var options = {
  series: [
    {
      name: 'National',
      data: [20, 15, 30, 25, 20, 18, 22, 35, 44, 13, 52, 33] // Completed status by month for National
    },
    {
      name: 'International',
      data: [18, 20, 15, 32, 44, 13, 25, 30, 22, 35, 53, 27] // Completed status by month for International
    }
  ],
  chart: {
    type: 'bar',
    height: 600, // Increase height for more categories
    stacked: true // Enable stacking
  },
  plotOptions: {
    bar: {
      horizontal: false, // Vertical bars
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
      colors: ['#fff']
    }
  },
  stroke: {
    show: true,
    width: 1,
    colors: ['#fff']
  },
  tooltip: {
    shared: true,
    intersect: false
  },
  xaxis: {
    categories: [
      "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ], // List of months
  },
  colors: [
    '#ff0000', // Red for National
    '#ffcccc'  // Light Red for International
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

var chart = new ApexCharts(document.querySelector("#graphGrantByCategory"), options);


chart.render();







  $(document).ready(function(){


  });

</script>
