<!-- publication -->
<div class="row">

  <!-- stretch card -->
  <div class="col-sm-12 grid-margin d-flex stretch-card">

    <!-- card -->
    <div class="card">

      <!-- card body -->
      <div class="card-body">

        <!-- title -->
        <div class="d-flex align-items-center justify-content-between">
          <h4 class="card-title mb-2">Insight</h4>
        </div>
        <!-- end title -->

        <!-- tab list -->
        <ul class="nav nav-tabs tab-no-active-fill pt-5" role="tablist">
          <li class="nav-item">
            <a class="nav-link active ps-2 pe-2" id="on-going-tab" data-bs-toggle="tab" href="#on-going" role="tab" aria-controls="on-going" aria-selected="true">On-Going</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link ps-2 pe-2" id="server-loading-tab" data-bs-toggle="tab" href="#server-loading" role="tab" aria-controls="server-loading" aria-selected="false">This Year</a>
          </li> -->
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

          <!-- <div class="tab-pane fade" id="server-loading" role="tabpanel" aria-labelledby="server-loading-tab">
            <div class="d-flex justify-content-between">
              <p class="mb-4">+5.2% vs last 7 days</p>
              <div id="serveLoading-legend" class="revenuechart-legend">
                <ul class="3-legend">
                  <li><span class="legend-box" style="background:#0ddbb9;"></span><span class="legend-label">Margin</span></li>
                  <li><span class="legend-box" style="background:#464dee;"></span><span class="legend-label">Product</span></li>
                  <li><span class="legend-box" style="background:#ee5b5b;"></span><span class="legend-label">Cost</span></li>
                </ul>
              </div>
            </div>
            <canvas id="serveLoading" height="0" class="chartjs-render-monitor" style="display: block; width: 0px; height: 0px;" width="0"></canvas>
          </div> -->
        </div>
        <!-- end tab content -->

      </div>
      <!-- card body -->

    </div>
    <!-- end card -->

  </div>
  <!-- end stretch card -->

</div>
<!-- end publication -->

<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Animate progress bars after they are rendered
    document.querySelectorAll('.progress-bar').forEach(function(bar) {
        const progress = bar.getAttribute('aria-valuenow');
        bar.style.setProperty('--progress-value', progress + '%'); // Set dynamic width using CSS variable
        bar.style.width = '0'; // Start from 0%
        setTimeout(() => {
            bar.style.width = progress + '%'; // Animate to the actual progress
        }, 10); // Small delay to allow for animation
    });
</script>
