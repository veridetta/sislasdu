<style>
  *{
      margin-left: auto;
      margin-right: auto;
      font-family: sans-serif;
  }

  table{
      border-collapse: collapse;
  }

  table tr td{
      padding:3px 10px;
  }
</style>
<html>
<head>
    <title>Cetak Surat</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body style="padding-top:0px !important;margin-top:0px !important">
  <table style="padding-top:0px !important">
    <tr>
    <td style="width: 30%;"><img src="{{asset('images/logo/logo.png')}}" alt="" width="150" height="120" /></td>
    <td style="width: 70%;">
    <h3 style="text-align: center;line-height:0 !important;"><strong>PEMERINTAH KABUPATEN CIREBON</strong></h3>
    <h3 style="text-align: center;line-height:0 !important;"><strong>KECAMATAN JAMBLANG </strong></h3>
    <h1 style="text-align: center;line-height:0.5;"><strong>DESA BAKUNG LOR</strong></h1>
    <p style="text-align: center; line-height:0.5"><strong>Kantor : Jl. Suryajayanegara No. 197 Bakunglor, Jamblang-Cirebon 45157</strong></p>
    <p style="text-align: center;line-height:0 !important;"><strong>Email : </strong><a href="mailto:pemdesbakunglor22@gmail.com"><strong>pemdesbakunglor22@gmail.com</strong></a></p>
    </td>
    </tr>
    </table>
    <hr>
    <table style="width:98%; margin-top:20px;">
        <tr>
          <td style="text-align: center;line-height:0 !important;"><h1><strong><u>SURAT KETERANGAN DOMISILI</u></strong></h1></td>
        </tr>
        <tr>
          <td style="text-align: center;">Nomor :&nbsp;&nbsp;&nbsp;&nbsp; {{$surat->kode}}</td>
        </tr>
      
    </table>
    <table>
      <tr>
        <td style="width: 90%;">Yang bertanda tangan dibawah ini, Kuwu Desa Bakunglor, Kecamatan Jamblang, Kabupaten Cirebon, menerangkan bahwa  :</td>
      </tr>
    </table>
    <table>
    <tr>
      <td style="width: 20%;">Nama</td>
      <td style="width: 5%;">:</td>
      <td style="width: 70%;">{{$surat->nama}}</td>
    </tr>
    <tr>
      <td style="width: 20%;">Tempat / Tanggal Lahir</td>
      <td style="width: 5%;">:</td>
      <td style="width: 70%;">{{$surat->tempat_lahir.'/'.$surat->tanggal_lahir}}</td>
    </tr>
    <tr>
    <td style="width: 20%;">Jenis Kelamin</td>
      <td style="width: 5%;">:</td>
      <td style="width: 70%;">{{$surat->jk}}</td>
    </tr>
    <tr>
    <td style="width: 20%;">No KTP</td>
      <td style="width: 5%;">:</td>
      <td style="width: 70%;">{{$surat->nik}}</td>
    </tr>
    <tr>
    <td style="width: 20%;">Status Perkawinan</td>
      <td style="width: 5%;">:</td>
      <td style="width: 70%;">{{$surat->st_nikah}}</td>
    </tr>
    <tr>
    <td style="width: 20%;">Agama</td>
      <td style="width: 5%;">:</td>
      <td style="width: 70%;">{{$surat->agama}}</td>
    </tr>
    <tr>
    <td style="width: 20%;">Warga Negara</td>
      <td style="width: 5%;">:</td>
      <td style="width: 70%;">{{$surat->st_warga}}</td>
    </tr>
    <tr>
    <td style="width: 20%;">Pekerjaan</td>
      <td style="width: 5%;">:</td>
      <td style="width: 70%;">{{$surat->pekerjaan}}</td>
    </tr>
    <tr>
    <td style="width: 20%;">Alamat</td>
      <td style="width: 5%;">:</td>
      <td style="width: 70%;">{{$surat->alamat}}</td>
    </tr>

    
    </table>
    <table style="width:95% !important">
      
        <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Adalah benar berdomisili di {{$surat->alamat}}.</td></tr>
      
      <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Demikian Surat Keterangan ini kami buat dengan sebenar &ndash; benarnya agar kepada yang terkait menjadi maklum dan dapat dipergunakan sebagaimana mestinya.</td></tr>
      <tr ><td></td></tr>
      <tr><td></td></tr>
      <tr style="text-align: right;"><td>Bakunglor,&nbsp; &nbsp;{{$tanggal}}</td></tr>
      <tr style="text-align: right;"><td>Kuwu Bakunglor</td></tr>
      <tr style="text-align: right;""><td><img src="{{asset('images/logo/logo.png')}}" alt="" width="100" height="80" /></td></tr>
      <tr style="text-align: right;"><td>&nbsp;H. WATMA</td></tr>
      
    </table>
</body>