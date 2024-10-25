<!-- publication -->
<div class="row">
  <div class="col-sm-12 grid-margin d-flex stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <h4 class="card-title mb-2">Graph</h4>
        </div>
        <div>
          <ul class="nav nav-tabs tab-no-active-fill" role="tablist">
            <li class="nav-item">
              <a class="nav-link active ps-2 pe-2" id="on-going-tab" data-bs-toggle="tab" href="#on-going" role="tab" aria-controls="on-going" aria-selected="true">On-Going</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ps-2 pe-2" id="server-loading-tab" data-bs-toggle="tab" href="#server-loading" role="tab" aria-controls="server-loading" aria-selected="false">This Year</a>
            </li>
          </ul>
          <div class="tab-content tab-no-active-fill-tab-content">
            <div class="tab-pane fade show active" id="on-going" role="tabpanel" aria-labelledby="on-going-tab">
              <div class="container mt-5">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Grant Title</th>
                      <th>Progress</th>
                      <th>Progress</th>
                      <!-- <th>Start Date</th>
                      <th>End Date</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data['main']['cervie']['researcher']['ongoing'] as $grant)
                    <tr>
                        <td>{{ $grant['grant_title'] }}</td>
                        <td class="col-md-8">
                            <div class="progress" style="height: 30px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                     role="progressbar"
                                     style="width: {{ $grant['progress'] }}%;"
                                     aria-valuenow="{{ $grant['progress'] }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100"
                                     data-bs-toggle="tooltip"
                                     data-bs-placement="top"
                                     title="Progress: {{ $grant['progress'] }}%<br>Start Date: {{ \Carbon\Carbon::parse($grant['date_start'])->format('Y-m-d') }}"
                                     data-bs-html="true">
                                </div>
                            </div>
                        </td>
                        <td>{{ $grant['progress'] }}%</td>
                        <!-- Optionally display start date -->
                        <td>{{ \Carbon\Carbon::parse($grant['date_start'])->format('d M Y') }}</td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="server-loading" role="tabpanel" aria-labelledby="server-loading-tab">
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
