<?php
	$list = json_decode($_GET['data']);

	$p = new PDFlib();
	$p->set_parameter('licensefile', '/usr/local/pdflib/licensekeys.txt');
	$p->begin_document('', '');
	$p->set_parameter('topdown', 'true');
	$p->set_parameter('usercoordinates', 'true');	
	
	$p->set_parameter('FontOutline', 'Regular=Times_New_Roman_Normal.ttf'); 

	/*
	for($i = 0; $i < count($list); $i++){
		$j = $i % 10;

		if ($j == 0 && $i > 0){
			$p->end_page_ext('');
		}

		if ($j == 0){
			$p->begin_page_ext(8.5 * 72, 11 * 72, '');
		}

		$y = floor($j / 2.0);
		$x = floor($j % 2);
		
		$tf = $p->create_textflow($list[$i], 'fontname=Regular fontsize=80 embedding encoding=winansi alignment=center');
		$p->fit_textflow($tf, 4.25 * 72 * $x, 2.2 * 72 * $y, 4.25 * 72 * $x + 4.25 * 72, 2.2 * 72 * $y + 2.2 * 72, 'verticalalign=center showborder');
	}*/

	for($i = 0; $i <= (count($list) - 1) / 10; $i++){
		
		$p->begin_page_ext(8.5 * 72, 11 * 72, '');

		for($j = $i * 10; $j < $i * 10 + 10; $j++){
			$y = floor($j % 10 / 2.0);
			$x = floor($j % 2);

			$tf = $p->create_textflow($list[$j], 'fontname=Regular fontsize=80 embedding encoding=winansi alignment=center');
                	$p->fit_textflow($tf, .75 * 72 + 3.5 * 72 * $x, .5 * 72 + 2 * 72 * $y, .75 * 72 + 3.5 * 72 * $x + 3.5 * 72, .5 * 72 + 2 * 72 * $y + 2 * 72, 'verticalalign=center showborder');
		}

		$p->end_page_ext('');
		$p->begin_page_ext(8.5 * 72, 11 * 72, '');

		for($j = $i * 10; $j < $i * 10 + 10; $j++){
			$y = floor($j % 10 / 2.0);
                        $x = floor(($j + 1) % 2);

			$explode = explode('x', $list[$j]);
			$product = $explode[0] * $explode[1];
	
			if ($product == 0){
				continue;
			}	
		
                        $tf = $p->create_textflow($product, 'fontname=Regular fontsize=80 embedding encoding=winansi alignment=center');
                        $p->fit_textflow($tf, .75 * 72 + 3.5 * 72 * $x, .5 * 72 + 2 * 72 * $y, .75 * 72 + 3.5 * 72 * $x + 3.5 * 72, .5 * 72 + 2 * 72 * $y + 2 * 72, 'verticalalign=center showborder');
		}

		$p->end_page_ext('');
	}
		
	$p->end_document('');

	header("Content-type:application/pdf");
	header("Content-Disposition:attachment;filename='multi-table.pdf'");
	
	echo $p->get_buffer();	
	$p->delete();	
?>
