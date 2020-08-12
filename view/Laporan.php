<html>
    <!-- link css -->
    <link rel="stylesheet" href="../css/bootstrap.css">    
    
    <link rel="stylesheet" href="../chart-js/Chart.css">   
<body>
    


    <div class="container">
        <div class="row mt-5">
            <div class="col-1"> <!-- margin left--></div>
            <div class="col-2 " style="border-bottom: solid 3px">
                <img src="../img/logo.png" width="120px" height="97px">
            </div>
            <div class="col-6  text-center" style="border-bottom: solid 3px">
                <h2 class="text-danger p-0 m-0">PT. Alfitra Raya Vespindo</h2>
                <h6 class="p-0 m-0">JL. Mawar No. S-15 RT.05 Samarinda, Kal-Tim 75123</h6>
                <h6 class="p-0 m-0">Telp: 0541-749637/0811 554 296/0822 5432 9300</h6>
                <a href="info.alfitravespindo@gmail.com">info.alfitravespindo@gmail.com</a>
            </div>
            <div class="col-2 " style="border-bottom: solid 3px">
            </div>
            <div class="col-1"> <!-- margin right--></div>
        </div>

        <div class="row pt-4">
            <div class="col-1"> <!-- margin left--></div>
            <div class="col-10 text-center ">
                <h4 class="text-dark">LAPORAN SURAT</h4>
                <h5 class="p-0 m-0">Periode</h5>
                <h5 class="p-0 m-0">Tanggal 1 - Tanggal 2</h5>
            </div>
            <div class="col-1"> <!-- margin right--></div>
        </div>

        <div class="row pt-5">
            <div class="col-1"> <!-- margin left--></div>
            <div class="col-10 ">
                <h5>Berikut ini adalah data surat masuk dan keluar :</h5>
            </div>
            <div class="col-1"> <!-- margin right--></div>
        </div>
        <div class="row">
            <div class="col-1"> <!-- margin left--></div>
            <div class='col-5 '>
                <div id='canvas-holder'>
                    <canvas id='chart-area'></canvas>
                </div>
            </div>
            <div class='col-3  pt-4'>
                <table class="table table-bordered table-sm text-center">
                    <thead>
                        <tr>
                            <th style="color:rgb(54, 162, 235)">Surat Masuk</th>
                            <th style="color:rgb(255, 99, 132)">Surat Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>5</td>
                            <td>7</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-3"> <!-- margin right--></div>
        </div>

        <div class="row pt-4">
            <div class="col-1"> <!-- margin left--></div>
            <div class="col-10 ">
                <h5>Dengan Rincian Surat Keluar Sebagai Berikut :</h5>
            </div>
            <div class="col-1"> <!-- margin right--></div>
        </div>
        <div class="row">
            <div class="col-1"> <!-- margin left--></div>
            <div class="col-10 text-center  pt-2">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Quotation</th>
                            <th>Invoice</th>
                            <th>Berita Acara</th>
                            <th>total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>15</td>
                            <td>10</td>
                            <td>10</td>
                            <td>35</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-1"> <!-- margin right--></div>
        </div>

            <div class="row pt-5">
                <div class="col-1"> <!-- margin left--></div>
                <div class="col-7 ">
                </div>
                <div class="col-3 text-center">
                    Tertanda Admin,
                </div>
                <div class="col-1"> <!-- margin right--></div>
            </div>
            <div class="row pt-5">
                <div class="col-1"> <!-- margin left--></div>
                <div class="col-7 ">
                </div>
                <div class="col-3 h-50">
                    
                </div>
                <div class="col-1"> <!-- margin right--></div>
            </div>
            <div class="row">
                <div class="col-1"> <!-- margin left--></div>
                <div class="col-7 ">
                </div>
                <div class="col-3 text-center">
                    Admin,
                </div>
                <div class="col-1"> <!-- margin right--></div>
            </div>
        
    </div>

    <script src='../chart-js/Chart.js'></script>
    <script src='../chart-js/Chart.bundle.js'></script>
    <script src='../chart-js/utils.js'></script>

    <script>
        //Grafik Surat Masuk & Keluar
		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
                        5, //Data Surat Masuk
                        7//Data Surat Keluar
					],
					backgroundColor: [
						window.chartColors.red,
						window.chartColors.blue,
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Surat Masuk',
					'Surat Keluar',
				]
			},
			options: {
				responsive: true
			}
        };

		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
            window.myPie = new Chart(ctx, config);
            
            var ctx = document.getElementById('chart-area2').getContext('2d');
			window.myPie = new Chart(ctx, config2);
        };	
        
        	
    </script>
</body>
</html>