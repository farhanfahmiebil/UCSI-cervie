<!-- tab pane -->
<div class="tab-pane fade {{ ((request()->tab_category == 'general_information')?'show active':'') }}" id="general_information" role="tabpanel">

  <!-- form -->
  <form action="{{ route($hyperlink['page']['update'],['organization_id'=>request()->organization_id,'id'=>request()->id,'tab'=>'tab','tab_category'=>'general_information']) }}" method="POST">
    {{csrf_field()}}

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">
        <h3>General Information</h3>
      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row gx-3">

          <!-- col -->
          <div class="col-sm-12 col-12">

            <!-- row -->
            <div class="row gx-3">

              <!-- col -->
              <div class="col-12">

                <div class="row justify-content-center mt-5">
								<div class="col-xxl-3 col-sm-6 col-12 order-xxl-1 order-xl-2 order-lg-2 order-md-2 order-sm-2">
									<div class="card">
										<div class="card-header">
											<div class="card-title">About</div>
										</div>
										<div class="card-body">
											<h6 class="mb-3">
												<i class="bi bi-house font-2x me-2"></i> Lives in
												<span>San Fransisco</span>
											</h6>
											<h6 class="mb-3">
												<i class="bi bi-building font-2x me-2"></i> Works @
												<span>Bootstrap Gallery</span>
											</h6>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<div class="card-title">Skills</div>
										</div>
										<div class="card-body">
											<div class="d-inline-flex gap-3 flex-wrap">
												<span class="badge red">HTML</span>
												<span class="badge red">Javascript</span>
												<span class="badge red">React</span>
												<span class="badge red">Scss</span>
												<span class="badge red">Angular</span>
												<span class="badge red">CSS</span>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<div class="card-title">Earnings</div>
										</div>
										<div class="card-body" style="position: relative;">
											<div id="income" class="auto-align-graph" style="min-height: 291px;"><div id="apexchartsk3ufwmza" class="apexcharts-canvas apexchartsk3ufwmza apexcharts-theme-light" style="width: 344px; height: 276px;"><svg id="SvgjsSvg1116" width="344" height="276" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1118" class="apexcharts-inner apexcharts-graphical" transform="translate(39, 30)"><defs id="SvgjsDefs1117"><linearGradient id="SvgjsLinearGradient1123" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1124" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop1125" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop1126" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient><clipPath id="gridRectMaskk3ufwmza"><rect id="SvgjsRect1128" width="299" height="195.77888297526042" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskk3ufwmza"></clipPath><clipPath id="nonForecastMaskk3ufwmza"></clipPath><clipPath id="gridRectMarkerMaskk3ufwmza"><rect id="SvgjsRect1129" width="299" height="199.77888297526042" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><rect id="SvgjsRect1127" width="29.5" height="195.77888297526042" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1123)" class="apexcharts-xcrosshairs" y2="195.77888297526042" filter="none" fill-opacity="0.9"></rect><g id="SvgjsG1170" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1171" class="apexcharts-xaxis-texts-g" transform="translate(0, -10)"><text id="SvgjsText1173" font-family="Lato" x="24.583333333333332" y="218.77888297526042" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Lato;" transform="rotate(-45 25.583332061767578 213.2788848876953)"><tspan id="SvgjsTspan1174">Jan</tspan><title>Jan</title></text><text id="SvgjsText1176" font-family="Lato" x="73.75" y="218.77888297526042" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Lato;" transform="rotate(-45 74.75 213.2788848876953)"><tspan id="SvgjsTspan1177">Feb</tspan><title>Feb</title></text><text id="SvgjsText1179" font-family="Lato" x="122.91666666666667" y="218.77888297526042" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Lato;" transform="rotate(-45 123.91667175292969 213.2788848876953)"><tspan id="SvgjsTspan1180">Mar</tspan><title>Mar</title></text><text id="SvgjsText1182" font-family="Lato" x="172.08333333333331" y="218.77888297526042" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Lato;" transform="rotate(-45 173.0833282470703 213.2788848876953)"><tspan id="SvgjsTspan1183">Apr</tspan><title>Apr</title></text><text id="SvgjsText1185" font-family="Lato" x="221.24999999999997" y="218.77888297526042" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Lato;" transform="rotate(-45 222.25 213.2788848876953)"><tspan id="SvgjsTspan1186">May</tspan><title>May</title></text><text id="SvgjsText1188" font-family="Lato" x="270.4166666666667" y="218.77888297526042" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Lato;" transform="rotate(-45 271.4166564941406 213.2788848876953)"><tspan id="SvgjsTspan1189">June</tspan><title>June</title></text></g></g><g id="SvgjsG1202" class="apexcharts-grid"><g id="SvgjsG1203" class="apexcharts-gridlines-horizontal"></g><g id="SvgjsG1204" class="apexcharts-gridlines-vertical"><line id="SvgjsLine1205" x1="0" y1="0" x2="0" y2="195.77888297526042" stroke="#b7c6d8" stroke-dasharray="5" class="apexcharts-gridline"></line><line id="SvgjsLine1207" x1="49.166666666666664" y1="0" x2="49.166666666666664" y2="195.77888297526042" stroke="#b7c6d8" stroke-dasharray="5" class="apexcharts-gridline"></line><line id="SvgjsLine1209" x1="98.33333333333333" y1="0" x2="98.33333333333333" y2="195.77888297526042" stroke="#b7c6d8" stroke-dasharray="5" class="apexcharts-gridline"></line><line id="SvgjsLine1211" x1="147.5" y1="0" x2="147.5" y2="195.77888297526042" stroke="#b7c6d8" stroke-dasharray="5" class="apexcharts-gridline"></line><line id="SvgjsLine1213" x1="196.66666666666666" y1="0" x2="196.66666666666666" y2="195.77888297526042" stroke="#b7c6d8" stroke-dasharray="5" class="apexcharts-gridline"></line><line id="SvgjsLine1215" x1="245.83333333333331" y1="0" x2="245.83333333333331" y2="195.77888297526042" stroke="#b7c6d8" stroke-dasharray="5" class="apexcharts-gridline"></line><line id="SvgjsLine1217" x1="295" y1="0" x2="295" y2="195.77888297526042" stroke="#b7c6d8" stroke-dasharray="5" class="apexcharts-gridline"></line></g><line id="SvgjsLine1206" x1="0" y1="196.77888297526042" x2="0" y2="202.77888297526042" stroke="#ffffff" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1208" x1="49.166666666666664" y1="196.77888297526042" x2="49.166666666666664" y2="202.77888297526042" stroke="#ffffff" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1210" x1="98.33333333333333" y1="196.77888297526042" x2="98.33333333333333" y2="202.77888297526042" stroke="#ffffff" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1212" x1="147.5" y1="196.77888297526042" x2="147.5" y2="202.77888297526042" stroke="#ffffff" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1214" x1="196.66666666666666" y1="196.77888297526042" x2="196.66666666666666" y2="202.77888297526042" stroke="#ffffff" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1216" x1="245.83333333333331" y1="196.77888297526042" x2="245.83333333333331" y2="202.77888297526042" stroke="#ffffff" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1218" x1="295" y1="196.77888297526042" x2="295" y2="202.77888297526042" stroke="#ffffff" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1220" x1="0" y1="195.77888297526042" x2="295" y2="195.77888297526042" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1219" x1="0" y1="1" x2="0" y2="195.77888297526042" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1130" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1131" class="apexcharts-series" rel="1" seriesName="Income" data:realIndex="0"><path id="SvgjsPath1135" d="M 9.833333333333332 195.77888297526042L 9.833333333333332 154.8341622314453Q 9.833333333333332 146.8341622314453 17.833333333333332 146.8341622314453L 31.33333333333333 146.8341622314453Q 39.33333333333333 146.8341622314453 39.33333333333333 154.8341622314453L 39.33333333333333 154.8341622314453L 39.33333333333333 195.77888297526042L 39.33333333333333 195.77888297526042z" fill="rgba(226,33,50,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskk3ufwmza)" pathTo="M 9.833333333333332 195.77888297526042L 9.833333333333332 154.8341622314453Q 9.833333333333332 146.8341622314453 17.833333333333332 146.8341622314453L 31.33333333333333 146.8341622314453Q 39.33333333333333 146.8341622314453 39.33333333333333 154.8341622314453L 39.33333333333333 154.8341622314453L 39.33333333333333 195.77888297526042L 39.33333333333333 195.77888297526042z" pathFrom="M 9.833333333333332 195.77888297526042L 9.833333333333332 195.77888297526042L 39.33333333333333 195.77888297526042L 39.33333333333333 195.77888297526042L 39.33333333333333 195.77888297526042L 39.33333333333333 195.77888297526042L 39.33333333333333 195.77888297526042L 9.833333333333332 195.77888297526042" cy="146.8341622314453" cx="59" j="0" val="20" barHeight="48.944720743815104" barWidth="29.5"></path><path id="SvgjsPath1141" d="M 59 195.77888297526042L 59 130.36180185953776Q 59 122.36180185953776 67 122.36180185953776L 80.5 122.36180185953776Q 88.5 122.36180185953776 88.5 130.36180185953776L 88.5 130.36180185953776L 88.5 195.77888297526042L 88.5 195.77888297526042z" fill="rgba(226,33,50,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskk3ufwmza)" pathTo="M 59 195.77888297526042L 59 130.36180185953776Q 59 122.36180185953776 67 122.36180185953776L 80.5 122.36180185953776Q 88.5 122.36180185953776 88.5 130.36180185953776L 88.5 130.36180185953776L 88.5 195.77888297526042L 88.5 195.77888297526042z" pathFrom="M 59 195.77888297526042L 59 195.77888297526042L 88.5 195.77888297526042L 88.5 195.77888297526042L 88.5 195.77888297526042L 88.5 195.77888297526042L 88.5 195.77888297526042L 59 195.77888297526042" cy="122.36180185953775" cx="108.16666666666666" j="1" val="30" barHeight="73.41708111572267" barWidth="29.5"></path><path id="SvgjsPath1147" d="M 108.16666666666666 195.77888297526042L 108.16666666666666 105.88944148763021Q 108.16666666666666 97.88944148763021 116.16666666666666 97.88944148763021L 129.66666666666666 97.88944148763021Q 137.66666666666666 97.88944148763021 137.66666666666666 105.88944148763021L 137.66666666666666 105.88944148763021L 137.66666666666666 195.77888297526042L 137.66666666666666 195.77888297526042z" fill="rgba(226,33,50,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskk3ufwmza)" pathTo="M 108.16666666666666 195.77888297526042L 108.16666666666666 105.88944148763021Q 108.16666666666666 97.88944148763021 116.16666666666666 97.88944148763021L 129.66666666666666 97.88944148763021Q 137.66666666666666 97.88944148763021 137.66666666666666 105.88944148763021L 137.66666666666666 105.88944148763021L 137.66666666666666 195.77888297526042L 137.66666666666666 195.77888297526042z" pathFrom="M 108.16666666666666 195.77888297526042L 108.16666666666666 195.77888297526042L 137.66666666666666 195.77888297526042L 137.66666666666666 195.77888297526042L 137.66666666666666 195.77888297526042L 137.66666666666666 195.77888297526042L 137.66666666666666 195.77888297526042L 108.16666666666666 195.77888297526042" cy="97.88944148763021" cx="157.33333333333331" j="2" val="40" barHeight="97.88944148763021" barWidth="29.5"></path><path id="SvgjsPath1153" d="M 157.33333333333331 195.77888297526042L 157.33333333333331 81.41708111572265Q 157.33333333333331 73.41708111572265 165.33333333333331 73.41708111572265L 178.83333333333331 73.41708111572265Q 186.83333333333331 73.41708111572265 186.83333333333331 81.41708111572265L 186.83333333333331 81.41708111572265L 186.83333333333331 195.77888297526042L 186.83333333333331 195.77888297526042z" fill="rgba(226,33,50,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskk3ufwmza)" pathTo="M 157.33333333333331 195.77888297526042L 157.33333333333331 81.41708111572265Q 157.33333333333331 73.41708111572265 165.33333333333331 73.41708111572265L 178.83333333333331 73.41708111572265Q 186.83333333333331 73.41708111572265 186.83333333333331 81.41708111572265L 186.83333333333331 81.41708111572265L 186.83333333333331 195.77888297526042L 186.83333333333331 195.77888297526042z" pathFrom="M 157.33333333333331 195.77888297526042L 157.33333333333331 195.77888297526042L 186.83333333333331 195.77888297526042L 186.83333333333331 195.77888297526042L 186.83333333333331 195.77888297526042L 186.83333333333331 195.77888297526042L 186.83333333333331 195.77888297526042L 157.33333333333331 195.77888297526042" cy="73.41708111572265" cx="206.49999999999997" j="3" val="50" barHeight="122.36180185953776" barWidth="29.5"></path><path id="SvgjsPath1159" d="M 206.49999999999997 195.77888297526042L 206.49999999999997 56.94472074381508Q 206.49999999999997 48.94472074381508 214.49999999999997 48.94472074381508L 227.99999999999997 48.94472074381508Q 235.99999999999997 48.94472074381508 235.99999999999997 56.94472074381508L 235.99999999999997 56.94472074381508L 235.99999999999997 195.77888297526042L 235.99999999999997 195.77888297526042z" fill="rgba(226,33,50,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskk3ufwmza)" pathTo="M 206.49999999999997 195.77888297526042L 206.49999999999997 56.94472074381508Q 206.49999999999997 48.94472074381508 214.49999999999997 48.94472074381508L 227.99999999999997 48.94472074381508Q 235.99999999999997 48.94472074381508 235.99999999999997 56.94472074381508L 235.99999999999997 56.94472074381508L 235.99999999999997 195.77888297526042L 235.99999999999997 195.77888297526042z" pathFrom="M 206.49999999999997 195.77888297526042L 206.49999999999997 195.77888297526042L 235.99999999999997 195.77888297526042L 235.99999999999997 195.77888297526042L 235.99999999999997 195.77888297526042L 235.99999999999997 195.77888297526042L 235.99999999999997 195.77888297526042L 206.49999999999997 195.77888297526042" cy="48.94472074381508" cx="255.66666666666663" j="4" val="60" barHeight="146.83416223144533" barWidth="29.5"></path><path id="SvgjsPath1165" d="M 255.66666666666663 195.77888297526042L 255.66666666666663 32.47236037190754Q 255.66666666666663 24.47236037190754 263.66666666666663 24.47236037190754L 277.16666666666663 24.47236037190754Q 285.16666666666663 24.47236037190754 285.16666666666663 32.47236037190754L 285.16666666666663 32.47236037190754L 285.16666666666663 195.77888297526042L 285.16666666666663 195.77888297526042z" fill="rgba(226,33,50,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskk3ufwmza)" pathTo="M 255.66666666666663 195.77888297526042L 255.66666666666663 32.47236037190754Q 255.66666666666663 24.47236037190754 263.66666666666663 24.47236037190754L 277.16666666666663 24.47236037190754Q 285.16666666666663 24.47236037190754 285.16666666666663 32.47236037190754L 285.16666666666663 32.47236037190754L 285.16666666666663 195.77888297526042L 285.16666666666663 195.77888297526042z" pathFrom="M 255.66666666666663 195.77888297526042L 255.66666666666663 195.77888297526042L 285.16666666666663 195.77888297526042L 285.16666666666663 195.77888297526042L 285.16666666666663 195.77888297526042L 285.16666666666663 195.77888297526042L 285.16666666666663 195.77888297526042L 255.66666666666663 195.77888297526042" cy="24.47236037190754" cx="304.8333333333333" j="5" val="70" barHeight="171.30652260335287" barWidth="29.5"></path><g id="SvgjsG1133" class="apexcharts-bar-goals-markers" style="pointer-events: none"><g id="SvgjsG1134" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1140" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1146" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1152" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1158" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1164" className="apexcharts-bar-goals-groups"></g></g></g><g id="SvgjsG1132" class="apexcharts-datalabels" data:realIndex="0"><g id="SvgjsG1137" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText1139" font-family="Lato" x="24.583333333333336" y="161.8341622314453" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-datalabel" style="font-family: Lato;" cx="24.583333333333336" cy="161.8341622314453">20</text></g><g id="SvgjsG1143" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText1145" font-family="Lato" x="73.75" y="137.36180185953776" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-datalabel" style="font-family: Lato;" cx="73.75" cy="137.36180185953776">30</text></g><g id="SvgjsG1149" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText1151" font-family="Lato" x="122.91666666666666" y="112.88944148763021" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-datalabel" style="font-family: Lato;" cx="122.91666666666666" cy="112.88944148763021">40</text></g><g id="SvgjsG1155" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText1157" font-family="Lato" x="172.08333333333331" y="88.41708111572265" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-datalabel" style="font-family: Lato;" cx="172.08333333333331" cy="88.41708111572265">50</text></g><g id="SvgjsG1161" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText1163" font-family="Lato" x="221.24999999999997" y="63.94472074381508" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-datalabel" style="font-family: Lato;" cx="221.24999999999997" cy="63.94472074381508">60</text></g><g id="SvgjsG1167" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText1169" font-family="Lato" x="270.41666666666663" y="39.47236037190754" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-datalabel" style="font-family: Lato;" cx="270.41666666666663" cy="39.47236037190754">70</text></g></g></g><line id="SvgjsLine1221" x1="0" y1="0" x2="295" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1222" x1="0" y1="0" x2="295" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1223" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1224" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1225" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1190" class="apexcharts-yaxis" rel="0" transform="translate(9, 0)"><g id="SvgjsG1191" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1192" font-family="Lato" x="20" y="31.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Lato;"><tspan id="SvgjsTspan1193">80</tspan><title>80</title></text><text id="SvgjsText1194" font-family="Lato" x="20" y="80.34472074381512" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Lato;"><tspan id="SvgjsTspan1195">60</tspan><title>60</title></text><text id="SvgjsText1196" font-family="Lato" x="20" y="129.28944148763023" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Lato;"><tspan id="SvgjsTspan1197">40</tspan><title>40</title></text><text id="SvgjsText1198" font-family="Lato" x="20" y="178.23416223144534" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Lato;"><tspan id="SvgjsTspan1199">20</tspan><title>20</title></text><text id="SvgjsText1200" font-family="Lato" x="20" y="227.17888297526045" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#000000" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Lato;"><tspan id="SvgjsTspan1201">0</tspan><title>0</title></text></g></g><g id="SvgjsG1119" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 138px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Lato; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(226, 33, 50);"></span><div class="apexcharts-tooltip-text" style="font-family: Lato; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light"><div class="apexcharts-xaxistooltip-text" style="font-family: Lato; font-size: 12px;"></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
											<div class="text-center">
												<h2>
													$75K
													<i class="bi bi-arrow-up-right-circle-fill text-red ms-2"></i>
												</h2>
												<p class="text-truncate">18% higher than last month.</p>
											</div>
										<div class="resize-triggers"><div class="expand-trigger"><div style="width: 385px; height: 408px;"></div></div><div class="contract-trigger"></div></div></div>
									</div>
									<div class="card">
										<div class="card-header">
											<div class="card-title">Activity</div>
										</div>
										<div class="card-body">
											<div class="scroll370 os-host os-theme-dark os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px; width: 343px; height: 369px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px; height: 100%; width: 100%;">
												<div class="my-2">
													<div class="activity-block d-flex position-relative">
														<img src="assets/images/user3.png" class="img-5x me-3 rounded-circle activity-user" alt="Admin Dashboard">
														<div class="mb-5">
															<h5>Araceli Barrera</h5>
															<p class="m-0">3 day ago</p>
															<p>Paid invoice ref. #26788</p>
															<span class="badge shade-red">Sent</span>
														</div>
													</div>
													<div class="activity-block d-flex position-relative">
														<img src="assets/images/user4.png" class="img-5x me-3 rounded-circle activity-user" alt="Admin Dashboard">
														<div class="mb-5">
															<h5>Corine Sparks</h5>
															<p class="m-0">3 hours ago</p>
															<p>Sent invoice ref. #23457</p>
															<span class="badge shade-red">Sent</span>
														</div>
													</div>
													<div class="activity-block d-flex position-relative">
														<img src="assets/images/user2.png" class="img-5x me-3 rounded-circle activity-user" alt="Admin Dashboard">
														<div class="mb-5">
															<h5>Misty Arellano</h5>
															<p class="m-0">One week ago</p>
															<p>Paid invoice ref. #34546</p>
															<span class="badge shade-red">Invoice</span>
														</div>
													</div>
													<div class="activity-block d-flex position-relative">
														<img src="assets/images/user3.png" class="img-5x me-3 rounded-circle activity-user" alt="Admin Dashboard">
														<div class="mb-5">
															<h5>Remssy Wilson</h5>
															<p class="m-0">7 hours ago</p>
															<p>Paid invoice ref. #23459</p>
															<span class="badge shade-red">Payments</span>
														</div>
													</div>
													<div class="activity-block d-flex position-relative">
														<img src="assets/images/user5.png" class="img-5x me-3 rounded-circle activity-user" alt="Admin Dashboard">
														<div class="mb-5">
															<h5>Elliott Hermans</h5>
															<p class="m-0">1 day ago</p>
															<p>Paid invoice ref. #23473</p>
															<span class="badge shade-red">Paid</span>
														</div>
													</div>
												</div>
											</div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track os-scrollbar-track-off"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track os-scrollbar-track-off"><div class="os-scrollbar-handle" style="height: 45.8488%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
										</div>
									</div>
								</div>
								<div class="col-xxl-6 col-sm-12 col-12 order-xxl-2 order-xl-1 order-lg-1 order-md-1 order-sm-1">
									<div class="card">
										<div class="card-img">
											<img src="assets/images/food/img8.jpg" class="card-img-top img-fluid" alt="Bootstrap Admin Panel">
										</div>
										<div class="card-body">
											<h5 class="card-title mb-2">Bootstrap Gallery</h5>
											<p class="mb-3">
												Best Bootstrap Admin Dashboards available at best price.
												Bootstrap Gallery specialized in designing and
												developing Admin Dashboards, Admin Panels, CRM
												Dashboards, and Bootstrap themes.
											</p>
											<div class="d-flex align-items-center">
												<img src="assets/images/user.png" class="rounded-circle me-3 img-4x" alt="Admin Themes">
												<h6 class="m-0">Misty Arellanoi</h6>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-body">
											<div class="d-flex">
												<img src="assets/images/user2.png" class="rounded-circle me-3 img-4x" alt="Admin Panel">
												<div class="flex-grow-1">
													<p class="float-end text-red">7 hrs ago</p>
													<h6 class="fw-bold">Elliott Hermans</h6>
													<p class="text-muted">Today 2:45pm</p>
													<p>
														A dashboard, in website administration, is typically
														the index page of the control panel for a website's
														content management system. Bootstrap Gallery Admin
														Dashboards are fully responsive built on Bootstrap 5
														framework.
													</p>
													<div class="row gx-3">
														<div class="col-12">
															<p class="fw-bold">Media Files (3)</p>
														</div>
														<div class="col-4">
															<img src="assets/images/food/img1.jpg" alt="Bootstrap Gallery" class="img-fluid rounded">
														</div>
														<div class="col-4">
															<img src="assets/images/food/img5.jpg" alt="Bootstrap Gallery" class="img-fluid rounded">
														</div>
														<div class="col-4">
															<img src="assets/images/food/img2.jpg" alt="Bootstrap Gallery" class="img-fluid rounded">
														</div>
													</div>
													<button class="btn btn-primary mt-2">
														<i class="bi bi-heart-fill"></i> Like
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-body">
											<div class="d-flex">
												<img src="assets/images/user5.png" class="rounded-circle me-3 img-4x" alt="Admin Themes">
												<div class="flex-grow-1">
													<p class="float-end text-red">5 mins ago</p>
													<h6 class="fw-bold">
														Willa Henrys started following Oriel Row
													</h6>
													<p class="text-muted">Today 7:50pm</p>
													<div class="mb-2">
														<textarea name="" rows="2" class="form-control"></textarea>
													</div>
													<button class="btn btn-primary">Message</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xxl-3 col-sm-6 col-12 order-xxl-3 order-xl-3 order-lg-3 order-md-3 order-sm-3">
									<div class="stats-tile d-flex align-items-center tile-red">
										<div class="sale-icon icon-box xl rounded-5 me-3">
											<i class="bi bi-trophy font-2x text-red"></i>
										</div>
										<div class="sale-details text-white">
											<h5>New level</h5>
											<h3 class="m-0">18</h3>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<div class="card-title">Gallery</div>
										</div>
										<div class="card-body">
											<div class="row g-2 row-cols-3">
												<div class="col">
													<img src="assets/images/user2.png" class="img-fluid rounded-2" alt="Bootstrap Gallery">
												</div>
												<div class="col">
													<img src="assets/images/user3.png" class="img-fluid rounded-2" alt="Bootstrap Gallery">
												</div>
												<div class="col">
													<img src="assets/images/user4.png" class="img-fluid rounded-2" alt="Bootstrap Gallery">
												</div>
												<div class="col">
													<img src="assets/images/user5.png" class="img-fluid rounded-2" alt="Bootstrap Gallery">
												</div>
												<div class="col">
													<img src="assets/images/user.png" class="img-fluid rounded-2" alt="Bootstrap Gallery">
												</div>
												<div class="col">
													<img src="assets/images/user2.png" class="img-fluid rounded-2" alt="Bootstrap Gallery">
												</div>
												<div class="col">
													<img src="assets/images/user1.png" class="img-fluid rounded-2" alt="Bootstrap Gallery">
												</div>
												<div class="col">
													<img src="assets/images/user3.png" class="img-fluid rounded-2" alt="Bootstrap Gallery">
												</div>
												<div class="col">
													<img src="assets/images/user1.png" class="img-fluid rounded-2" alt="Bootstrap Gallery">
												</div>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<div class="card-title">Projects</div>
										</div>
										<div class="card-body">
											<ul class="m-0">
												<li class="activity-list d-flex">
													<div class="activity-time pt-2 pe-3 me-3">
														<p class="date m-0">10:30 am</p>
														<span class="badge shade-red">75%</span>
													</div>
													<div class="d-flex flex-column py-2">
														<h5>Bootstrap Gallery</h5>
														<p class="m-0">by Elnathan Lois</p>
													</div>
												</li>
												<li class="activity-list d-flex">
													<div class="activity-time pt-2 pe-3 me-3">
														<p class="date m-0">11:30 am</p>
														<span class="badge shade-red">50%</span>
													</div>
													<div class="d-flex flex-column py-2">
														<h5>Mobile App</h5>
														<p class="m-0">by Patrobus Nicole</p>
													</div>
												</li>
												<li class="activity-list d-flex">
													<div class="activity-time pt-2 pe-3 me-3">
														<p class="date m-0">12:50 pm</p>
														<span class="badge shade-red">90%</span>
													</div>
													<div class="d-flex flex-column py-2">
														<h5>UI Kit</h5>
														<p class="m-0">by Abilene Omega</p>
													</div>
												</li>
												<li class="activity-list d-flex">
													<div class="activity-time pt-2 pe-3 me-3">
														<p class="date m-0">02:30 pm</p>
														<span class="badge shade-red">50%</span>
													</div>
													<div class="d-flex flex-column py-2">
														<h5>Invoice Design</h5>
														<p class="m-0">by Shelomi Sarah</p>
													</div>
												</li>
											</ul>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<div class="card-title">Links</div>
										</div>
										<div class="card-body">
											<ul class="list-group">
												<li class="list-group-item">
													<a href="" class="text-red">
														<i class="bi bi-lightning-charge"></i> Bootstrap 5
														Admin Dashboard
													</a>
												</li>
												<li class="list-group-item">
													<a href="" class="text-red">
														<i class="bi bi-lightning-charge"></i> Best
														Bootstrap Themes
													</a>
												</li>
												<li class="list-group-item">
													<a href="" class="text-red">
														<i class="bi bi-lightning-charge"></i> Quality
														Bootstrap Themes
													</a>
												</li>
												<li class="list-group-item">
													<a href="" class="text-red">
														<i class="bi bi-lightning-charge"></i> Best
														Bootstrap 5 Admin Templates
													</a>
												</li>
												<li class="list-group-item">
													<a href="" class="text-red">
														<i class="bi bi-lightning-charge"></i> Premium
														Bootstrap 5 Admin Dashboards
													</a>
												</li>
												<li class="list-group-item">
													<a href="" class="text-red">
														<i class="bi bi-lightning-charge"></i> Quality
														Bootstrap Admin Dashboards
													</a>
												</li>
												<li class="list-group-item">
													<a href="" class="text-red">
														<i class="bi bi-lightning-charge"></i> Free
														Bootstrap Admin Dashboards
													</a>
												</li>
												<li class="list-group-item">
													<a href="" class="text-red">
														<i class="bi bi-lightning-charge"></i> Best
														Bootstrap Dashboards
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>


              </div>
              <!-- end col -->

            </div>
            <!-- end row -->

          </div>
          <!-- end col -->

        </div>
        <!-- end row -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

    <!-- control -->
    <div class="d-flex gap-2 justify-content-end">
      <input type="hidden" name="tab_category" value="personal">
      <a href="{{ route($hyperlink['page']['list']['home'],['organization_id'=>request()->organization_id]) }}" class="btn btn-dark">Back to List</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
    <!-- end control -->

  </form>
  <!-- end form -->

</div>
<!-- end tab pane -->


<script type="text/javascript">

/**************************************************************************************
  Document On Load
**************************************************************************************/
$(document).ready(function($){


});

</script>
