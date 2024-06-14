<!DOCTYPE html>
<html>
<head>
	<title>Invoice - {{$data->no_bukti}}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            width: 1020px;
        }
        .table-bordered {
            width: 1020px; 
        }
        .table-bordered, .table-bordered th, .table-bordered td, {
            border: 1px solid black; 
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td colspan="9"><h4>PT. MASUYA GRAHA TRIKENCANA</h4></td>
        <td style="text-align: right;">{{$data->tanggal}}</td>
    </tr>
    <tr>
        <td colspan="9">JL. MAHENDRADATTA NO.15 E-F, PADANGSAMBIAN, KEC. DENPASAR BARAT</td>
        <td style="text-align: right;">{{$data->no_bukti}}</td> 
    </tr>    
    <tr>
        <td colspan="9">KOTA DENPASAR, BALI 80119</td>
        <td style="text-align: right;">{{$data->jatuh_tempo}}</td>
    </tr><br>
    <tr>
        <td colspan="9">
            <h4>{{$data->customer->nama_cust}}</h4>
        </td>
        <td style="text-align: center;">{{$data->author}}</td>
        
    </tr>
    <tr>
        <td colspan="9">{{$data->customer->alm_1}}, {{$data->customer->alm_2}}, {{$data->customer->alm_3}}</td>
        <td style="font-weight: bold; text-align: center;">*INVOICE*</td>
    </tr>
    <tr class="table-tr">
    <td class="table-td" colspan="9">
    <table class="table table-bordered">
      <tr>
        <th style="text-align: center;">Kode Barang</th>
        <th style="text-align: center;">Quantity</th>
        <th style="text-align: center;">Nama Barang</th>
        <th style="text-align: center;">Satuan</th>
        <th style="text-align: center;">Harga Per Unit</th>
      </tr>
      @foreach($dataDetail as $detail)
      <tr>
        <td style="width: 180px;">{{$detail->kode_brg}}</td>
        <td style="width: 180px; text-align: center;">{{$detail->qty_order}}</td>
        <td style="width: 320px;">{{$detail->nama_brg}}</td>
        <td style="text-align: center;">{{$detail->satuan->satuan}}</td>
        <td style="width: 180px; text-align: center;">Rp. {{number_format(floatval($detail->hrg_per_unit), 2, ',', '.')}}</td>
      </tr>
      @endforeach
      <tr>
        <td colspan="1" rowspan="1">Ordered by:</td>
        <td rowspan="1">Received by:</td>
        <td colspan="1" rowspan="6" style="vertical-align: top; text-align: left;">Penerima:</td>
        <td rowspan="1" style="text-align: center;">SUBTOTAL</td>
        <td rowspan="1" style="text-align: center;">Rp. {{number_format(floatval($data->sub_total), 2, ',', '.')}}</td>
      </tr>
      <tr>
        <td colspan="1" rowspan="5" style="vertical-align: top; text-align: left;">Disetujui:</td>
        <td rowspan="5" style="vertical-align: top; text-align: left;">Pengirim:</td>
        <td rowspan="1" style="text-align: center;">PPN</td>
        <td rowspan="1" style="text-align: center;">{{$data->persen_ppn}}%</td>
      </tr>
      <tr>
        <td rowspan="4" style="text-align: center;">TOTAL</td>
        <td rowspan="4" style="text-align: center;">Rp. {{number_format(floatval($data->total), 2, ',', '.')}}</td>
      </tr>
    </table>
    </td>
    </tr>
    <tr>
      <td colspan="4">Status Pembayaran: 
        @if($data->lunas == 'Belum Lunas')
            {{$data->lunas}}
        @else
            Lunas tanggal {{$data->tgl_lunas}}
        @endif
      </td>
    </tr>
    <tr>
      <td colspan="4">Status Pengiriman: 
        @if($data->status == 'Belum Terkirim')
            {{$data->status}}
        @else
            Terkirim tanggal {{$data->tgl_terkirim}}
        @endif
      </td>
    </tr>
</table>
</body>
</html>