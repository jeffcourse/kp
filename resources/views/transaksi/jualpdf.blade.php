<!DOCTYPE html>
<html>
<head>
	<title>Invoice - {{$data->no_bukti}}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            width: 100%;
        }
        .table-bordered {
            width: 100%; 
        }
        .table-bordered, .table-bordered th, .table-bordered td {
            border: 2px solid black; 
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td colspan="8"><h4>PT. MASUYA GRAHA TRIKENCANA</h4></td>
        <td style="text-align: right;">{{$data->tanggal}}</td>
    </tr>
    <tr>
        <td colspan="8">JL. MAHENDRADATTA NO.15 E-F, PADANGSAMBIAN, KEC. DENPASAR BARAT</td>
        <td style="text-align: right;">{{$data->no_bukti}}</td> 
    </tr>    
    <tr>
        <td colspan="8">KOTA DENPASAR, BALI 80119</td>
        <td style="text-align: right;">{{$data->jatuh_tempo}}</td>
    </tr><br>
    <tr>
        <td colspan="8">
            <h4>{{$data->customer->nama_cust}}</h4>
        </td>
        <td style="text-align: center;">{{$data->author}}</td>
        
    </tr>
    <tr>
        <td colspan="8">{{$data->customer->alm_1}}, {{$data->customer->alm_2}}, {{$data->customer->alm_3}}</td>
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
        <td style="width: 180px;">{{$detail->qty_order}}</td>
        <td style="width: 270px;">{{$detail->nama_brg}}</td>
        <td>{{$detail->satuan->satuan}}</td>
        <td style="width: 180px;">Rp. {{number_format($detail->hrg_per_unit, 0, ',', '.')}}</td>
      </tr>
      @endforeach
      <tr>
        <td colspan="1">Ordered by:</td>
        <td>Received by:</td>
        <td colspan="1" rowspan="3">Penerima:</td>
        <td>SUBTOTAL</td>
        <td>Rp. {{number_format($data->sub_total, 0, ',', '.')}}</td>
      </tr>
      <tr>
        <td colspan="1" rowspan="2">Disetujui:</td>
        <td rowspan="2">Pengirim:</td>
        <td>PPN</td>
        <td>{{$data->persen_ppn}}%</td>
      </tr>
      <tr>
        <td>TOTAL</td>
        <td>Rp. {{number_format($data->total, 0, ',', '.')}}</td>
      </tr>
    </table>
    </td>
    </tr>
</table>
</body>
</html>