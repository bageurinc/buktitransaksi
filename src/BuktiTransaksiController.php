<?php
namespace Bageur\BuktiTransaksi;

use App\Http\Controllers\Controller;
use App\transaksi;
use Illuminate\Http\Request;
use Bageur\BuktiTransaksi\model\bukti_transaksi;
use Validator;
use Illuminate\Support\Str;

class BuktiTransaksiController extends Controller
{

    public function index(Request $request)
    {
    $transaksi = transaksi::findOrFail($request->transaksi_id);

    return view('bageur::uploadbukti', compact('transaksi'));
    }

    public function store(Request $request)
    {
        $rules    = [
            'file'      => 'required',
            'nama'      => 'required',
            'bank'      => 'required',
            'no_rek'    => 'required',
            'atas_nama' => 'required',
        ];

        $messages = [
        ];

        $attributes = [
        ];
        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);

        }else{
            $uuid = Str::uuid();
            $file = $request->file('file');
            $transaksi = transaksi::find($request->transaksi_id);

            $bgr_upload               = new \Bageur\Auth\Model\upload;
            $bgr_upload->uuid         = $uuid;
            $bgr_upload->group        = $bgr_upload->uuid;
            $upload                   = \Bageur::blob($file, 'bukti');
            $bgr_upload->folder       = $upload['path'];
            $bgr_upload->file         = $upload['up'];
            $bgr_upload->type         = $file->getMimeType();
            $bgr_upload->save();

            $transaksi->bukti_pembayaran  = $bgr_upload->file;
            $transaksi->save();

            $bgr_bukti                = new bukti_transaksi;
            $bgr_bukti->bgr_upload_id = $bgr_upload->id;
            $detail['transaksi_id']   = $transaksi->id;
            $detail['kode']           = $transaksi->kode;
            $detail['nama']           = $request->nama;
            $detail['bank']           = $request->bank;
            $detail['no_rek']         = $request->no_rek;
            $detail['atas_nama']      = $request->atas_nama;

            $bgr_bukti->detail        = json_encode($detail);
            if (isset($transaksi->keterangan)) {
                $bgr_bukti->type = 'training';
            }else{
                $bgr_bukti->type = 'shop';
            }
            $bgr_bukti->save();

            return view('bageur::berhasil');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return bukti_transaksi::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //   $delete = bukti_transaksi::findOrFail($id);
        //   $delete->delete();
        //   return response(['status' => true ,'text'    => 'has deleted'], 200);
    }

    public function berhasil()
    {
    return view('bageur::berhasil');
    }
}
