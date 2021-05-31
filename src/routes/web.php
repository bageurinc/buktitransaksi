<?php
Route::name('bageur.')->group(function () {
	Route::group(['prefix' => 'bageur/v1','middleware' => 'api'], function () {
		Route::apiResource('bukti-transaksi', 'Bageur\BuktiTransaksi\BuktiTransaksiController');
		Route::get('bukti-transaksi-berhasil', 'Bageur\BuktiTransaksi\BuktiTransaksiController@berhasil');
	});
});
