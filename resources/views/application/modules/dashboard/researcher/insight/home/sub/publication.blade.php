<div class="row">
  <div class="col-12">
    <div class="card">

      <div class="card-body">

        <div class="row">
          <div class="col-md-12">
            <div class="card-title">Publication</div>
          </div>

          <div class="col-md-6 ">
            <div class="mb-3">
              Publication By Type
            </div>

            <div id="graphPublicationByPublicationType" class="border"></div>
          </div>

          <div class="col-md-6 ">
            <div class="mb-3">
              Publication By Indexing Body
            </div>

            <div id="graphPublicationByIndexingBody" class="border"></div>
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
      name: 'Ongoing',
      data: [44, 55, 41, 64, 22, 43, 21, 34, 23, 43, 32, 40, 24, 33, 39, 25, 27] // Ongoing status for each category
    },
    {
      name: 'Completed',
      data: [53, 32, 33, 52, 13, 44, 32, 25, 15, 35, 22, 30, 20, 25, 27, 20, 18] // Completed status for each category
    }
  ],
  chart: {
    type: 'bar',
    height: 600, // Increase height for more categories
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
      "Articles",
      "Journals",
      "Books",
      "Book Chapter",
      "Conference Paper",
      "Proceeding Paper",
      "Thesis",
      "Dissertations",
      "Research Reports",
      "Market Research Report",
      "Newspapers",
      "Review",
      "Statistics",
      "Legislation",
      "Encyclopedias",
      "Video",
      "Image",
      "Sound Research"
    ], // List of categories
  },
  colors: [
    '#1f77b4', '#89c2ff'
  ], // Blue for Ongoing, Light Blue for Completed
  fill: {
    opacity: 1
  },
  legend: {
    show: true,
    position: 'top',
    horizontalAlign: 'left',
  },
};

var chart = new ApexCharts(document.querySelector("#graphPublicationByPublicationType"), options);

chart.render();

var options = {
  series: [
    {
      name: 'Ongoing',
      data: [44, 55, 41, 64, 22, 43, 21, 34, 23, 43, 32, 40, 24, 33, 39, 25, 27] // Ongoing status for each category
    },
    {
      name: 'Completed',
      data: [53, 32, 33, 52, 13, 44, 32, 25, 15, 35, 22, 30, 20, 25, 27, 20, 18] // Completed status for each category
    }
  ],
  chart: {
    type: 'bar',
    height: 600, // Increase height for more categories
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
    categories: [
      'SCI',
      'Other',
      'ERA',
      'MyCite',
      'Google Scholar',
      'Scopus'
    ], // List of categories
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






  $(document).ready(function(){


  });

</script>
