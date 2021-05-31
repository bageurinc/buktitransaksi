<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Bukti</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="col-md-4 offset-md-4 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Upload Bukti Pembayaran</h4>
                </div>
                <form action="bukti-transaksi" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
						<b>File Gambar</b><br/>
                        <input type="hidden" name="transaksi_id" value="{{$transaksi->id}}">
						<input type="file" name="file">
                        <small>*wajib diisi</small>
					</div>
                    <div class="form-group">
						<b>Kode Transaksi</b><br/>
						<input type="input" name="kode_transaksi required" value="{{$transaksi->kode}}" disabled>
					</div>
                    <div class="form-group">
						<b>Nama</b><br/>
						<input type="input" name="nama" required>
					</div>
                    <div class="form-group">
						<b>Nama Bank</b><br/>
						<input type="input" name="bank" required>
					</div>
                    <div class="form-group">
						<b>Nomor Rekening</b><br/>
						<input type="input" name="no_rek" required>
					</div>
                    <div class="form-group">
						<b>Atas Nama</b><br/>
						<input type="input" name="atas_nama" required>
					</div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Upload</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
