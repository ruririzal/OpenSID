<script type="text/javascript">
	var baseURL = "<?= base_url(); ?>";
	$(function()
	{
		var keyword = <?= $keyword?> ;
		$( "#cari" ).autocomplete(
		{
			source: keyword,
			maxShowItems: 10,
		});
	});

	$(document).ready(function()
	{
		$('#modalEkspor').on('show.bs.modal', function(e)
		{
			var link = $(e.relatedTarget);
			var title = link.data('title');
			var modal = $(this)
			modal.find('.modal-title').text(title)
			$(this).find('.fetched-data').load(link.attr('href'));
		});
	});
</script>


<div class="box box-info">
  <div class="box-header with-border">
		<a href="<?= site_url("{$this->controller}/dialog_cetak/$kat")?>" class="btn btn-social btn-flat bg-purple btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Cetak Dokumen" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Laporan">
			<i class="fa fa-print"></i>Cetak
  	</a>
		<a href="<?= site_url("{$this->controller}/dialog_excel/$kat")?>" class="btn btn-social btn-flat bg-navy btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Unduh Dokumen" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Laporan">
			<i class="fa fa-download"></i>Unduh
  	</a>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-sm-12">
				<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
					<form id="mainform" name="mainform" action="" method="post">
						<input name="kategori" type="hidden" value="<?= $kat?>">
						<div class="row">
							<div class="col-sm-6">
								<select class="form-control input-sm " name="filter" onchange="formAction('mainform','<?= site_url($this->controller.'/filter')?>')">
									<option value="">Semua</option>
									<option value="1" <?php selected($filter, 1); ?>>Aktif</option>
									<option value="2" <?php selected($filter, 2); ?>>Tidak Aktif</option>
								</select>
							</div>
							<div class="col-sm-6">
								<div class="box-tools">
									<div class="input-group input-group-sm pull-right">
										<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?=html_escape($cari)?>" onkeypress="if (event.keyCode == 13){$('#'+'mainform').attr('action', '<?= site_url("{$this->controller}/search")?>');$('#'+'mainform').submit();}">
										<div class="input-group-btn">
											<button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("{$this->controller}/search")?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="table-responsive">
									<table class="table table-bordered table-striped dataTable table-hover">
										<thead class="bg-gray disabled color-palette">
											<tr>
												<th>No</th>
												<?php if ($o==2): ?>
                          <th><a href="<?= site_url("{$this->controller}/index/$kat/$p/1")?>">Nama <i class='fa fa-sort-asc fa-sm'></i></a></th>
                        <?php elseif ($o==1): ?>
                          <th><a href="<?= site_url("{$this->controller}/index/$kat/$p/2")?>">Nama <i class='fa fa-sort-desc fa-sm'></i></a></th>
                        <?php else: ?>
                          <th><a href="<?= site_url("{$this->controller}/index/$kat/$p/1")?>">Nama <i class='fa fa-sort fa-sm'></i></a></th>
                        <?php endif; ?>
												<?php if ($kat == 1): ?>
													<th>Kategori Info Publik</th>
													<th>Tahun</th>
												<?php elseif ($kat == 2): ?>
													<th nowrap>Nomor Dan Tanggal Keputusan</th>
													<th nowrap>Uraian Singkat</th>
												<?php elseif ($kat == 3): ?>
													<th nowrap>Nomor Dan Tanggal Ditetapkan</th>
													<th nowrap>Uraian Singkat</th>
												<?php endif; ?>
                        <?php if ($o==4): ?>
                          <th nowrap><a href="<?= site_url("{$this->controller}/index/$kat/$p/3")?>">Aktif <i class='fa fa-sort-asc fa-sm'></i></a></th>
                        <?php elseif ($o==3): ?>
                          <th nowrap><a href="<?= site_url("{$this->controller}/index/$kat/$p/4")?>">Aktif <i class='fa fa-sort-desc fa-sm'></i></a></th>
                        <?php else: ?>
                          <th nowrap><a href="<?= site_url("{$this->controller}/index/$kat/$p/3")?>">Aktif <i class='fa fa-sort fa-sm'></i></a></th>
                        <?php endif; ?>
												<?php if ($o==6): ?>
                          <th nowrap><a href="<?= site_url("{$this->controller}/index/$kat/$p/5")?>">Dimuat Pada <i class='fa fa-sort-asc fa-sm'></i></a></th>
                        <?php elseif ($o==5): ?>
                          <th nowrap><a href="<?= site_url("{$this->controller}/index/$kat/$p/6")?>">Dimuat Pada <i class='fa fa-sort-desc fa-sm'></i></a></th>
                        <?php else: ?>
                          <th nowrap><a href="<?= site_url("{$this->controller}/index/$kat/$p/5")?>">Dimuat Pada <i class='fa fa-sort fa-sm'></i></a></th>
                        <?php endif; ?>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($main as $data): ?>
												<tr>
													<td><?=$data['no']?></td>
													<td width="30%"><?= $data['nama']?></td>
													<?php if ($kat == 1): ?>
														<td><?= $data['kategori_info_publik']?></td>
														<td><?= $data['tahun']?></td>
													<?php elseif ($kat == 2): ?>
														<td><?= $data['attr']['no_kep_kades']." / ".$data['attr']['tgl_kep_kades']?></td>
														<td><?= $data['attr']['uraian']?></td>
													<?php elseif ($kat == 3): ?>
														<td><?= $data['attr']['no_ditetapkan']." / ".$data['attr']['tgl_ditetapkan']?></td>
														<td width="30%"><?= $data['attr']['uraian']?></td>
													<?php endif; ?>
													<td><?= $data['aktif']?></td>
													<td nowrap><?= tgl_indo2($data['tgl_upload'])?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</form>
          <div class="row">
            <div class="col-sm-6">
              <div class="dataTables_length">
                <form id="paging" action="<?= site_url($this->controller.'/index/'.$kat)?>" method="post" class="form-horizontal">
                  <label>
                    Tampilkan
                    <select name="per_page" class="form-control input-sm" onchange="$('#paging').submit()">
                      <option value="20" <?php selected($per_page, 20); ?> >20</option>
                      <option value="50" <?php selected($per_page, 50); ?> >50</option>
                      <option value="100" <?php selected($per_page, 100); ?> >100</option>
                    </select>
                    Dari
                    <strong><?= $paging->num_rows?></strong>
                    Total Data
                  </label>
                </form>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="dataTables_paginate paging_simple_numbers">
                <ul class="pagination">
                  <?php if ($paging->start_link): ?>
                    <li><a href="<?= site_url("{$this->controller}/index/$kat/$paging->start_link/$o")?>" aria-label="First"><span aria-hidden="true">Awal</span></a></li>
                  <?php endif; ?>
                  <?php if ($paging->prev): ?>
                    <li><a href="<?= site_url("{$this->controller}/index/$kat/$paging->prev/$o")?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                  <?php endif; ?>
                  <?php for ($i=$paging->start_link;$i<=$paging->end_link;$i++): ?>
                    <li <?=jecho($p, $i, "class='active'")?>><a href="<?= site_url("{$this->controller}/index/$kat/$i/$o")?>"><?= $i?></a></li>
                  <?php endfor; ?>
                  <?php if ($paging->next): ?>
                    <li><a href="<?= site_url("{$this->controller}/index/$kat/$paging->next/$o")?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                  <?php endif; ?>
                  <?php if ($paging->end_link): ?>
                    <li><a href="<?= site_url("{$this->controller}/index/$kat/$paging->end_link/$o")?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a></li>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
          </div>
				</div>
			</div>
		</div>
	</div>
</div>