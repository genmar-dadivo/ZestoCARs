<?php
	$file = [
		['id' => 1,'size' => '30.8MB', 'name' => 'JAN2020 MNC', 'date' => '2021-02-27', 'identificator' => 'JAN2020MNC'],
		['id' => 2,'size' => '29.5MB', 'name' => 'FEB2020 MNC', 'date' => '2021-02-27', 'identificator' => 'FEB2020MNC'],
		['id' => 3,'size' => '22.0MB', 'name' => 'MAR2020 MNC', 'date' => '2021-02-27', 'identificator' => 'MAR2020MNC'],
		['id' => 4,'size' => '11.6MB', 'name' => 'APR2020 MNC', 'date' => '2021-02-27', 'identificator' => 'APR2020MNC'],
		['id' => 5,'size' => '30.1MB', 'name' => 'MAY2020 MNC', 'date' => '2021-02-27', 'identificator' => 'MAY2020MNC'],
		['id' => 6,'size' => '31.2MB', 'name' => 'JUN2020 MNC', 'date' => '2021-02-27', 'identificator' => 'JUN2020MNC'],
		['id' => 7,'size' => '35.2MB', 'name' => 'JUL2020 MNC', 'date' => '2021-02-27', 'identificator' => 'JUL2020MNC'],
		['id' => 8,'size' => '33.0MB', 'name' => 'AUG2020 MNC', 'date' => '2021-02-27', 'identificator' => 'AUG2020MNC'],
		['id' => 9,'size' => '39.0MB', 'name' => 'SEPT2020 MNC', 'date' => '2021-02-27', 'identificator' => 'SEPT2020MNC'],
		['id' => 10,'size' => '43.4MB', 'name' => 'OCT2020 MNC', 'date' => '2021-02-27', 'identificator' => 'OCT2020MNC'],
		['id' => 11,'size' => '36.2MB', 'name' => 'NOV2020 MNC', 'date' => '2021-02-27', 'identificator' => 'NOV2020MNC'],
		['id' => 12,'size' => '40.0MB', 'name' => 'DEC2020 MNC', 'date' => '2021-02-27', 'identificator' => 'DEC2020MNC'],
		['id' => 13,'size' => '42.0MB', 'name' => 'JAN2021 MNC', 'date' => '2021-03-9', 'identificator' => 'JAN2021MNC'],
		['id' => 14,'size' => '37.5MB', 'name' => 'FEB2021 MNC', 'date' => '2021-03-9', 'identificator' => 'FEB2021MNC'],
	];
	function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);
		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;
		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) { $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : ''); }
			else { unset($string[$k]); }
		}
		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="mb-2 mt-5 float-start">
			<input type="text" placeholder="Search" class="search border-0 form-control" autocomplete="off">
		</div>
	</div>
</div>
<div class="card mb-4 shadow-sm">
	<nav class="navbar navbar-light bg-light"></nav>
	<div class="card-body">
		<div class="container-fluid">
			<div class="row ag-header fs-6 fw-bolder border-bottom border-1">
				<div class="col-sm-8"> Name </div>
				<div class="col-sm-2"> Size </div>
				<div class="col-sm-2"> Date </div>
			</div>
			<div class="ag-content">
				<?php foreach ($file as $file_link) { ?>
				<div class="mt-3 <?php echo $file_link['identificator']; ?>">
					<div class="row ag-content pointer custom-hover" style="font-size: 12px;">
						<div class="col-sm-8">
							<figure>
								<blockquote>
									<a class="custom-a" href="../fm/<?php echo $file_link['name']; ?>" download> <?php echo $file_link['name']; ?> </a>
								</blockquote>
								<figcaption class="blockquote-footer">
									Macola Noah & CSI Sales
								</figcaption>
							</figure>
						</div>
						<div class="col-sm-2"> <?php echo $file_link['size']; ?> </div>
						<div class="col-sm-2"> <?php echo time_elapsed_string($file_link['date']); ?> </div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<script>
$(".search").keyup(function() {
	var value = $('.search').val().toLowerCase();
	if (value != '') { $('.search').addClass('text-lowercase'); }
	else { $('.search').removeClass('text-lowercase'); }
	$(".ag-content").filter(function() { $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1) });
});
</script>