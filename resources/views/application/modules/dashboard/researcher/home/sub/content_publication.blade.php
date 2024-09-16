<!-- publication -->
<div class="row">
  <div class="col-sm-12 grid-margin d-flex stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <h4 class="card-title mb-2">Publication</h4>
          <div class="dropdown">
            <a href="#" class="text-success btn btn-link  px-1"><i class="mdi mdi-refresh"></i></a>
            <a href="#" class="text-success btn btn-link px-1 dropdown-toggle dropdown-arrow-none" data-bs-toggle="dropdown" id="settingsDropdownsales">
              <i class="mdi mdi-dots-horizontal"></i></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="settingsDropdownsales">
                <a class="dropdown-item">
                  <i class="mdi mdi-grease-pencil text-primary"></i>
                  Edit
                </a>
              </div>
          </div>
        </div>
        <div>
          <ul class="nav nav-tabs tab-no-active-fill" role="tablist">
            <li class="nav-item">
              <a class="nav-link active ps-2 pe-2" id="revenue-for-last-month-tab" data-bs-toggle="tab" href="#revenue-for-last-month" role="tab" aria-controls="revenue-for-last-month" aria-selected="true">Last Year</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ps-2 pe-2" id="server-loading-tab" data-bs-toggle="tab" href="#server-loading" role="tab" aria-controls="server-loading" aria-selected="false">This Year</a>
            </li>
          </ul>
          <div class="tab-content tab-no-active-fill-tab-content">
            <div class="tab-pane fade show active" id="revenue-for-last-month" role="tabpanel" aria-labelledby="revenue-for-last-month-tab"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <div class="d-lg-flex justify-content-between">
                <p class="mb-4">+5.2% vs last 7 days</p>
                <div id="revenuechart-legend" class="revenuechart-legend"><ul class="2-legend"><li><span class="legend-box" style="background:#0ddbb9;"></span><span class="legend-label" style="">Margin</span></li><li><span class="legend-box" style="background:#464dee;"></span><span class="legend-label" style="">Product</span></li><li><span class="legend-box" style="background:#ee5b5b;"></span><span class="legend-label" style="">Cost</span></li></ul></div>
              </div>
              <canvas id="revenue-for-last-month-chart" width="1179" height="589" style="display: block; width: 1179px; height: 589px;" class="chartjs-render-monitor"></canvas>
            </div>
            <div class="tab-pane fade" id="server-loading" role="tabpanel" aria-labelledby="server-loading-tab">
              <div class="d-flex justify-content-between">
                <p class="mb-4">+5.2% vs last 7 days</p>
                <div id="serveLoading-legend" class="revenuechart-legend"><ul class="3-legend"><li><span class="legend-box" style="background:#0ddbb9;"></span><span class="legend-label" style="">Margin</span></li><li><span class="legend-box" style="background:#464dee;"></span><span class="legend-label" style="">Product</span></li><li><span class="legend-box" style="background:#ee5b5b;"></span><span class="legend-label" style="">Cost</span></li></ul></div>
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
