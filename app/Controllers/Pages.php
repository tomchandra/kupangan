<?php

namespace App\Controllers;

use App\Models\FoodModel;
use \Mpdf\Mpdf;

class Pages extends BaseController
{
	protected $session;
	protected $request;
	protected $foodModel;
	public $output = [
		'sukses'    => false,
		'pesan'     => '',
		'data'      => []
	];

	public function __construct()
	{
		$this->foodModel = new FoodModel();
		$this->session = \Config\Services::session();
		$this->session->start();
		$this->request = \Config\Services::request();
	}

	public function index()
	{
		$data = [
			'title' => 'KUDAPAN - Home'
		];
		return view('pages/home', $data);
	}

	public function input()
	{
		$food = $this->foodModel->getProduct();
		$data = [
			'title' => 'KUDAPAN - Kalkulator Bahan Pangan',
			'food'	=> $food
		];
		return view('pages/input_data', $data);
	}

	public function help()
	{
		$data = [
			'title' => 'KUDAPAN - Help'
		];
		return view('pages/help', $data);
	}

	public function login()
	{
		$data = [
			'title' => 'KUDAPAN - Login'
		];
		return view('pages/login', $data);
	}

	public function cari($food_id = '')
	{
		if ($this->request->isAJAX()) {
			$cari = $this->foodModel->getProductDetail($food_id);
			if ($cari) {
				$this->output['sukses'] = true;
				$this->output['pesan']  = 'Ok';
				$this->output['data'] 	= $cari;
			}

			echo json_encode($this->output);
		}
	}

	public function get_var()
	{
		if ($this->request->isAJAX()) {
			$array_items = ['query', 'total'];
			$this->session->remove($array_items);

			$data = [
				'query' => service('request')->getPost('query'),
				'total' => service('request')->getPost('total')
			];
			$this->session->set($data);
			echo json_encode($this->session->get("query"));
		}
	}

	public function print()
	{

		$mpdf = new Mpdf(['debug' => FALSE, 'mode' => 'utf-8', 'format' => 'A4-P']);

		$data = $this->session->get("query");
		$total = $this->session->get("total");
		$tr_content = $tr_gizi = "";

		foreach ($data as $key => $value) {
			$tr_content .= '<tr>
								<td class="align-middle text-left">' . $data[$key]['foodName'] . '</td>
								<td class="align-middle">' . $data[$key]['weight'] . '</td>
							</tr>';
		}

		foreach ($total as $key => $value) {
			$isi = explode("|", $value);
			$tr_gizi .= '<tr>
								<td>' . $isi[1] . '</td>
								<td class="text-right">' . number_format((float)$isi[0], 1, '.', '') . ' ' . $isi[2] . '</td>
							</tr>';
		}

		$header = '
		<table width="100%">
			<tr>
				<td align="center"><img src="public/images/logo-otsuka.png"></td>
			</tr>
			<tr>
				<td align="center" style="font-size:0.8em;font-weight:bold;">OTSUKA INDONESIA</td>
			</tr>
			<tr>
				<td align="center" style="font-size:1.8em;font-weight:bold;">KALKULATOR ENTERAL</td>
			</tr>
			<tr>
				<td align="center" style="font-size:0.8em;font-weight:bold;">Ahli Gizi Indonesia</td>
			</tr>
		</table>
		<hr/>';

		$content = '
		<br/>
		<table width="100%" class="table table-borderless table-sm">
			<tr>
				<td width="60%" valign="top">
					<table class="table table-bordered text-center border-dark">
					<tr>
						<th class="align-middle text-left" style="background-color:#b8daff">Nama Bahan Makanan</th>
						<th class="align-middle" style="background-color:#b8daff">Berat (g)</th>
					</tr>
					' . $tr_content . '
					</table>				
				</td>
				<td width="40%">
					<table class="table table-bordered border-dark">
					<tr>
						<th class="align-middle text-left" style="background-color:#b8daff" colspan="2">Informasi Nilai Gizi</th>
					</tr>
					' . $tr_gizi . '
					</table>				
				</td>
			</tr>
		</table>';

		$mpdf->AddPage(
			'P', // L - landscape, P - portrait 
			'',
			'',
			'',
			'',
			2, // margin_left
			2, // margin right
			10, // margin top
			5, // margin bottom
			2, // margin header
			1 // margin footer
		);

		$stylesheet = file_get_contents("public/themes/css/bootstrap.min.css");
		$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
		$mpdf->WriteHTML($header);
		$mpdf->WriteHTML($content);
		$mpdf->Output('KUPANGAN-Kalkulator-Gizi.pdf', 'I');
		exit;
	}
}
