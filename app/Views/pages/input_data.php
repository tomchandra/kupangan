<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Modal -->
<div class="modal fade" id="print-preview" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Print Preview</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row mt-5 align-items-center">
		<div class="col-lg-3 col-md-12 col-sm-12">
			<div class="form-group">
				<label for="food-list" style="font-size:12px">Nama Bahan Pangan</label>
				<select id='food-list' class='selectize' style="min-width: 300px;width:100%;">
					<option value="">Pilih Nama Bahan Pangan</option>
					<?php foreach ($food as $f) : ?>
						<option value="<?= $f['foodId']; ?>"><?= $f['foodName']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-lg-1 col-md-12 col-sm-12 text-left">
			<div class="form-group">
				<label for="food-weight" style="font-size:12px">Berat</label>
				<input type="number" name="" id="food-weight" class="form-control" onkeyup="add_item(this,event);">
			</div>
		</div>
		<div class="col-lg-1 col-md-12 col-sm-12 text-left">
			<div class="form-group">
				<label for="add-food" style="font-size:12px; color:#fff;">Tambah</label>
				<button type="button" class=" btn btn-primary w-100" id='add-food'>Tambah</button>
			</div>
		</div>
		<div class="col-lg-6 col-md-12 col-sm-12 text-left">
		</div>
		<div class="col-lg-1 col-md-12 col-sm-12 text-right">
			<div class="form-group">
				<label for="add-food" style="font-size:12px; color:#fff;">Print</label>
				<button type="button" class="btn btn-danger w-100" id='print-food'>Cetak</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 mt-2">
			<div class="table-responsive">
				<table id="data-food" class='table table-sm table-bordered text-center border-dark' style="font-size: 14px;" width="100%">
					<thead>
						<tr class="table-primary">
							<th rowspan="4" class="align-middle text-left">Nama Bahan Makanan</th>
							<th rowspan="4" class="align-middle">BERAT <br />(g)</th>
							<th rowspan="4" class="align-middle">SUMBER</th>
						</tr>
						<tr>
							<th colspan="22" class="table-warning">KOMPOSISI ZAT GIZI MAKANAN</th>
							<th rowspan="4" class="table-primary align-middle">Aksi</th>
						</tr>
						<tr class="table-primary">
							<th>AIR</th>
							<th>ENERGI</th>
							<th>PROTEIN</th>
							<th>LEMAK</th>
							<th>KH</th>
							<th>SERAT</th>
							<th>ABU</th>
							<th>Ca</th>
							<th>P</th>
							<th>Fe</th>
							<th>Na</th>
							<th>K</th>
							<th>Cu</th>
							<th>Zn</th>
							<th>RETINOL</th>
							<th>&beta;-KAR</th>
							<th>KAR-TOTAL</th>
							<th>THIAMIN</th>
							<th>RIBOFLAVIN</th>
							<th>NIASIN</th>
							<th>VIT-C</th>
							<th rowspan="2" class="align-middle">BDD (%)</th>
						</tr>
						<tr class="table-primary">
							<th>(g)</th>
							<th>(Kal)</th>
							<th>(g)</th>
							<th>(g)</th>
							<th>(g)</th>
							<th>(g)</th>
							<th>(g)</th>
							<th>(mg)</th>
							<th>(mg)</th>
							<th>(mg)</th>
							<th>(mg)</th>
							<th>(mg)</th>
							<th>(mg)</th>
							<th>(mg)</th>
							<th>(&mu;g)</th>
							<th>(&mu;g)</th>
							<th>(&mu;g)</th>
							<th>(mg)</th>
							<th>(mg)</th>
							<th>(mg)</th>
							<th>(mg)</th>
						</tr>
					</thead>
					<tfoot>
						<tr class="table-warning font-weight-bold" id="total-all" style="display:none;">
							<td colspan="3" class="none">TOTAL</td>
							<td id="total-air"></td>
							<td id="total-energi"></td>
							<td id="total-protein"></td>
							<td id="total-lemak"></td>
							<td id="total-kh"></td>
							<td id="total-serat"></td>
							<td id="total-abu"></td>
							<td id="total-kalsium"></td>
							<td id="total-fosfor"></td>
							<td id="total-besi"></td>
							<td id="total-natrium"></td>
							<td id="total-kalium"></td>
							<td id="total-tembaga"></td>
							<td id="total-seng"></td>
							<td id="total-retinol"></td>
							<td id="total-bkar"></td>
							<td id="total-kartotal"></td>
							<td id="total-thiamin"></td>
							<td id="total-riborflavin"></td>
							<td id="total-niasin"></td>
							<td id="total-vitc"></td>
							<td colspan="2" class="none"></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('extra-js'); ?>
<script>
	$(document).ready(function() {
		// addNumeration("table-numero")
		var data_source;
		var data_print = [];

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf_token_name"]').attr('content')
			}
		});
		$('.selectize').selectize({
			onChange: function(value) {
				$.ajax({
					url: `<?= base_url("pages/cari/") ?>/${value}`,
					type: 'GET',
					dataType: 'JSON',
					success: function(x) {
						if (x.sukses == true) {
							data_source = x.data;
							$('#food-weight').val('');
							$('#food-weight').focus();
						}
					}
				});

			}
		});

		$('#add-food').click(function() {

			if ($('#food-list').val().trim() == '' || $('#food-weight').val().trim() == '') {
				Swal.fire({
					type: 'error',
					title: 'Perhatian',
					html: 'Nama bahan pangan dan berat harus diisi!!',
					timer: 2000
				});
				return;
			} else {
				var data = calculate($('#food-weight').val(), data_source);
				//<a href="#" class="btn btn-outline-success btn-sm edit-row" data-foodid='${data.foodid}' data-weight='${data.weight}'>Edit</a> 
				var action = `<a href="#" class="btn btn-outline-danger btn-sm delete-row" data-food="${$('#food-list').text()}">Hapus</a>`;
				var id = $('#food-list').val();
				let html = `<tr id='data-${id}' class="table-light">
                        <td class="align-middle text-left">${data.foodname}</td>
                        <td class="align-middle">${data.weight}</td>
                        <td class="align-middle">${data_source[0].sourceName}</td>
                        <td class="align-middle">${data.air}</td>
                        <td class="align-middle">${data.energi}</td>
                        <td class="align-middle">${data.protein}</td>
                        <td class="align-middle">${data.lemak}</td>
                        <td class="align-middle">${data.kh}</td>
                        <td class="align-middle">${data.serat}</td>
                        <td class="align-middle">${data.abu}</td>
                        <td class="align-middle">${data.kalsium}</td>
                        <td class="align-middle">${data.fosfor}</td>
                        <td class="align-middle">${data.besi}</td>
                        <td class="align-middle">${data.natrium}</td>
                        <td class="align-middle">${data.kalium}</td>
                        <td class="align-middle">${data.tembaga}</td>
                        <td class="align-middle">${data.seng}</td>
                        <td class="align-middle">${data.retinol}</td>
                        <td class="align-middle">${data.bkar}</td>
                        <td class="align-middle">${data.karTotal}</td>
                        <td class="align-middle">${data.thiamin}</td>
                        <td class="align-middle">${data.riborflavin}</td>
                        <td class="align-middle">${data.niasin}</td>
                        <td class="align-middle">${data.vitc}</td>
                        <td class="align-middle">${data.bdd}</td>
						<td class="align-middle">${action}</td>
                    </tr>`;

				if ($('#data-' + id).length > 0) {
					Swal.fire({
						title: 'Perhatian!',
						text: `Item ${$('#food-list').text()} sudah ada di list, Apakah anda mau merubahnya ?`,
						type: 'warning',
						showCancelButton: true,
						confirmButtonText: 'Ya',
						cancelButtonText: 'Batal'
					}).then((result) => {
						if (result.value) {
							$('#data-' + id).remove();
							$('table#data-food').append(html);
							getTotal();

							Swal.fire({
								type: 'success',
								title: 'Berhasil!',
								showConfirmButton: false,
								timer: 1000
							});
						}
					});
				} else {
					$('table#data-food').append(html);
					$('#food-weight').val('');
					$('#food-list').selectize()[0].selectize.setValue('');
					getTotal();
				}
			}
		});

		$('#print-food').click(function() {
			if ($('tr[id^="data-"]').length < 1) {
				Swal.fire({
					type: 'error',
					title: 'Perhatian',
					html: 'Belum ada data yang diinput!!',
					timer: 2000
				});
			} else {
				$.ajax({
					url: '<?= base_url("pages/get_var"); ?>',
					type: 'POST',
					dataType: 'JSON',
					data: {
						query: getNumericData(),
						total: sum(getNumericData())
					},
					success: function(result) {
						//console.log(result);
						var render_pdf = `<object data='<?= base_url("pages/print"); ?>' type='application/pdf' width="100%" height="700"><iframe src='<?= base_url("pages/print"); ?>' width='100%'></iframe></object>`;

						$('#print-preview').modal('show');
						$('.modal-body').html(render_pdf);
					}
				});
			}
		});

		$('body').on('change', '.getindex', function() {
			var index = $(this).closest('tr').index() + 1;
			var td = $('table#data-food tbody tr:nth-child(' + index + ') td:nth-child(4)').text();
			//console.log(index);
			//console.log(td);
		});


		$('body').on('click', '.delete-row', function() {
			var index = $(this).closest('tr').index() + 1;
			//console.log(index);
			var foodName = $(this).data('food');

			Swal.fire({
				title: 'Perhatian!',
				text: `Anda yakin menghapus ${foodName} dari list ?`,
				type: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.value) {
					$('table#data-food tbody tr:nth-child(' + index + ')').remove();
					getTotal();
					Swal.fire({
						type: 'success',
						title: 'Berhasil!',
						showConfirmButton: false,
						timer: 1000
					});
				}
			});
		});

		$('body').on('click', '.edit-row', function() {
			var index = $(this).closest('tr').index() + 1;

			var $select = $("#food-list").selectize();
			var selectize = $select[0].selectize;
			selectize.setValue($(this).data("foodid"));
			$('#food-weight').val($(this).data("weight"));
			//console.log(index);
		});

		function calculate(berat, data) {
			var result_calculate = new Object();

			result_calculate.foodid = data[0].foodId;
			result_calculate.foodname = data[0].foodName;
			result_calculate.weight = parseFloat(berat);
			result_calculate.air = multFloats(berat, data[0].air);
			result_calculate.energi = multFloats(berat, data[0].energi);
			result_calculate.protein = multFloats(berat, data[0].protein);
			result_calculate.lemak = multFloats(berat, data[0].lemak);
			result_calculate.kh = multFloats(berat, data[0].kh);
			result_calculate.serat = multFloats(berat, data[0].serat);
			result_calculate.abu = multFloats(berat, data[0].abu);
			result_calculate.kalsium = multFloats(berat, data[0].kalsium);
			result_calculate.fosfor = multFloats(berat, data[0].fosfor);
			result_calculate.besi = multFloats(berat, data[0].besi);
			result_calculate.natrium = multFloats(berat, data[0].natrium);
			result_calculate.kalium = multFloats(berat, data[0].kalium);
			result_calculate.tembaga = multFloats(berat, data[0].tembaga);
			result_calculate.seng = multFloats(berat, data[0].seng);
			result_calculate.retinol = multFloats(berat, data[0].retinol);
			result_calculate.bkar = multFloats(berat, data[0].bkar);
			result_calculate.karTotal = multFloats(berat, data[0].karTotal);
			result_calculate.thiamin = multFloats(berat, data[0].thiamin);
			result_calculate.riborflavin = multFloats(berat, data[0].riborflavin);
			result_calculate.niasin = multFloats(berat, data[0].niasin);
			result_calculate.vitc = multFloats(berat, data[0].vitc);
			result_calculate.bdd = data[0].bdd;

			return result_calculate;

		}

		function multFloats(a, b) {
			var num = parseFloat(a) * parseFloat(b) / 100;
			var res = isNaN(num) ? parseFloat(0.0) : roundNumber(num, 1);
			return res;
		}

		function roundNumber(num, scale = 1) {
			if (!("" + num).includes("e")) {
				return +(Math.round(num + "e+" + scale) + "e-" + scale);
			} else {
				var arr = ("" + num).split("e");
				var sig = ""
				if (+arr[1] + scale > 0) {
					sig = "+";
				}
				return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
			}
		}

		function sum(data) {
			var total_gizi = new Object();
			total_gizi.air = 0;
			total_gizi.energi = 0;
			total_gizi.protein = 0;
			total_gizi.lemak = 0;
			total_gizi.kh = 0;
			total_gizi.serat = 0;
			total_gizi.abu = 0;
			total_gizi.kalsium = 0;
			total_gizi.fosfor = 0;
			total_gizi.besi = 0;
			total_gizi.natrium = 0;
			total_gizi.kalium = 0;
			total_gizi.tembaga = 0;
			total_gizi.seng = 0;
			total_gizi.retinol = 0;
			total_gizi.bkar = 0;
			total_gizi.kartotal = 0;
			total_gizi.thiamin = 0;
			total_gizi.riborflavin = 0;
			total_gizi.niasin = 0;
			total_gizi.vitc = 0;

			data.forEach(item => {
				total_gizi.air += parseFloat(item.air);
				total_gizi.energi += parseFloat(item.energi);
				total_gizi.protein += parseFloat(item.protein);
				total_gizi.lemak += parseFloat(item.lemak);
				total_gizi.kh += parseFloat(item.kh);
				total_gizi.serat += parseFloat(item.serat);
				total_gizi.abu += parseFloat(item.abu);
				total_gizi.kalsium += parseFloat(item.kalsium);
				total_gizi.fosfor += parseFloat(item.fosfor);
				total_gizi.besi += parseFloat(item.besi);
				total_gizi.natrium += parseFloat(item.natrium);
				total_gizi.kalium += parseFloat(item.kalium);
				total_gizi.tembaga += parseFloat(item.tembaga);
				total_gizi.seng += parseFloat(item.seng);
				total_gizi.retinol += parseFloat(item.retinol);
				total_gizi.bkar += parseFloat(item.bkar);
				total_gizi.kartotal += parseFloat(item.karTotal);
				total_gizi.thiamin += parseFloat(item.thiamin);
				total_gizi.riborflavin += parseFloat(item.riborflavin);
				total_gizi.niasin += parseFloat(item.niasin);
				total_gizi.vitc += parseFloat(item.vitc);
			});

			total_gizi.air += "|Air|g";
			total_gizi.energi += "|Energi|Kal";
			total_gizi.protein += "|Protein|g";
			total_gizi.lemak += "|Lemak|g";
			total_gizi.kh += "|KH|g";
			total_gizi.serat += "|Serat|g";
			total_gizi.abu += "|Abu|g";
			total_gizi.kalsium += "|Ca|mg";
			total_gizi.fosfor += "|P|mg";
			total_gizi.besi += "|Fe|mg";
			total_gizi.natrium += "|Na|mg";
			total_gizi.kalium += "|K|mg";
			total_gizi.tembaga += "|Cu|mg";
			total_gizi.seng += "|Zn|mg";
			total_gizi.retinol += "|Retinol|&mu;g";
			total_gizi.bkar += "|&beta;-Caroten|&mu;g";
			total_gizi.kartotal += "|Karoten Total|&mu;g";
			total_gizi.thiamin += "|Thiamin|mg";
			total_gizi.riborflavin += "|Riborflavin|mg";
			total_gizi.niasin += "|Niasin|mg";
			total_gizi.vitc += "|Vit C|mg";

			return total_gizi;
		}

		function addNumeration(cl) {
			var table = document.querySelector('table.' + cl + ' tbody')
			var trs = table.querySelectorAll('tr')
			var counter = 1

			Array.prototype.forEach.call(trs, function(x, i) {
				var firstChild = x.children[0]
				if (firstChild.tagName === 'TD') {
					var cell = document.createElement('td')
					cell.textContent = counter++
					x.insertBefore(cell, firstChild)
				} else {
					firstChild.setAttribute('colspan', 2)
				}
			})
		}

		function getNumericData() {
			var i, items, item, dataItem, data = [];
			var cols = ["foodName", "weight", "source", "air", "energi", "protein", "lemak", "kh", "serat", "abu", "kalsium",
				"fosfor", "besi", "natrium", "kalium", "tembaga", "seng", "retinol", "bkar", "karTotal", "thiamin", "riborflavin", "niasin", "vitc", "bdd"
			];

			$("#data-food tbody tr").each(function() {
				items = $(this).children('td');

				if (items.length === 0) { // return if this tr only contains th
					return;
				}

				dataItem = {};
				for (i = 0; i < cols.length; i += 1) {
					item = items.eq(i);
					if (item) {
						if (cols[i] == 'foodName' || cols[i] == 'source') {
							dataItem[cols[i]] = item.html();
						} else {
							dataItem[cols[i]] = roundNumber(parseFloat(item.html()), 1);
						}
					}
				}
				data.push(dataItem);
			});

			return data;
		}

		function getTotal() {
			var total = sum(getNumericData());;

			for (var k in total) {
				var ttl = total[k].split("|");
				//console.log(ttl[0]);
				$("#data-food tfoot tr td:not(.none)").each(function() {
					var id = $(this).attr("id");
					if ('total-' + k == id) {
						$('#' + id).html(roundNumber(ttl[0]));
					}
				});
			}

			$('#total-all').show();
		}
	});

	function add_item(d, e) {
		if (e.keyCode === 13) {
			e.preventDefault();
			$('#add-food').trigger('click');

		}
	}
</script>
<?= $this->endSection(); ?>