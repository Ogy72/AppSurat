<html>
	
		<div class="col-5 bg-chart">
			<h5 class="pt-2">Data surat masuk dan keluar</h5>
			<h6> Periode <?php echo date('d-m-Y',strtotime($_POST["tanggal1"]))?> - <?php echo date('d-m-Y',strtotime($_POST["tanggal2"]))?> :</h6>
			<div id="canvas-holder">
				<canvas id="chart-area"></canvas>
			</div>
		</div>
		<div class="col-7 pt-4 bg-chart">

			<div class="row pt-5">
				<div class="col-5 pt5">
					<table class="table table-bordered table-sm text-center">
						<thead class="thead-light">
							<tr>
								<th style="color:rgb(255, 99, 132)">Surat Masuk</th>
								<th style="color:rgb(54, 162, 235)">Surat Keluar</th>
							</tr>
						</thead>
						<tbody class="bg-primary text-white">
							<tr>
								<td><?php echo $suratMasuk ?></td>
								<td><?php echo $suratKeluar ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-7"></div>
			</div>

			<div class="row ">
				<div class="col-12">
					<h5 class="pt-2">Rincian Surat keluar :</h5>
					<table class="table table-bordered table-sm pt-4">
						<thead class="thead-light text-center">
							<tr>
								<th>Quotation</th>
								<th>Invoice</th>
								<th>Berita Acara</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody class="bg-primary text-white text-center">
							<td><?php echo $aSuk ?></td>
							<td><?php echo $cSuk ?></td>
							<td><?php echo $eSuk ?></td>
							<td><?php echo $sumSurat ?></td>
						</tbody>
					</table>
				</div>
			</div>

			<div class="row pt-5">
				<div class="col-12 text-right pt-4">
					<a href="view/PrintLaporan.php?tgl1=<?php echo $_POST["tanggal1"] ?>&tgl2=<?php echo $_POST["tanggal2"]?>" target="_Blank" class="btn btn-success btn-sm text-light">Cetak Laporan</a>
				</div>
			</div>

		</div>
		
    <script src="chart-js/Chart.js"></script>
    <script src="chart-js/Chart.bundle.js"></script>
    <script src="chart-js/utils.js"></script>

    <script>
        //Grafik Surat Masuk & Keluar
		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
                        <?php
                            echo $suratMasuk;
                        ?>, //Data Surat Masuk
                        <?php
                            echo $suratKeluar;
                        ?> //Data Surat Keluar
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
        };	
        
        	
    </script>
    
    
</html>