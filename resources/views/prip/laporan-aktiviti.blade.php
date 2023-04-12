<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Laporan Aktiviti</title>

		<style>
            .page-main {
                page-break-after: avoid;
                margin-left: 20px;
                margin-right: 20px;
            }

			      table, th, td {
                padding-top: 15px;
                padding-bottom: 15px;
            }

            th, td{
                text-align:left;
                padding-left: 10px;
            }

            th {
                vertical-align: top;
            }

            .content{
                text-align: center;
            }
            .content .header{
                font-size: 15px;
                text-align: center;
            }


		</style>
	</head>
	<body>

        
            <div class="page-main">
               
                <h2 style="text-align: center; margin-bottom: -10px;">Laporan Aktiviti PRIP</h2>
                <div class="content">
                    <h3>
                        <span class="header">{{$prip->polikk}}<br>
                        Tel: {{$prip->telefon}} | Email: <span class="text-primary"><u>{{$prip->email}}</u></span>
                    </h3>
                </div>

                <table style="width:90%; margin-top:50px;">
                  <tr>
                    <th style="width: 25%; " >Nama Aktiviti:</th>
                    <td>
                      {{$aktiviti->nama}}
                    </td>
                  </tr>
                  <tr>
                    <th>Butiran Aktiviti:</th>
                    <td>
                      {{$aktiviti->butiran}}
                    </td>
                  </tr>
                  <tr>
                    <th>Tarikh Mula:</th>
                    <td>
                      {{date('d/m/Y', strtotime($aktiviti->tarikh_mula))}}
                    </td>
                  </tr>
                  <tr>
                    <th>Tarikh Akhir:</th>
                    <td>
                      {{date('d/m/Y', strtotime($aktiviti->tarikh_akhir))}}
                    </td>
                  </tr>
                  @if (Session::get('role')==='1')
                    @php
                        $now = strtotime($aktiviti->tarikh_akhir); // or your date as well
                        $your_date = strtotime($aktiviti->tarikh_mula);
                        $datediff = $now - $your_date;

                        $hari = round($datediff / (60 * 60 * 24)) + 1;
                    @endphp
                    
                    <tr>
                      <th>Jumlah Hari:</th>
                      <td>
                        {{$hari}} hari
                      </td>
                    </tr>
                  @endif
                  <tr>
                    <th>Bilangan Peserta:</th>
                    <td>
                      {{$aktiviti->bil_peserta}} orang
                    </td>
                  </tr>
                  <tr>
                    <th>Tempat:</th>
                    <td>
                      {{$aktiviti->tempat}}
                    </td>
                  </tr>
                  <tr>
                    <th>Institusi Terlibat:</th>
                    <td>{{$aktiviti->institusi}}</td>
                  </tr>
                  <tr>
                    <th>Evidens:</th>
                    <td>
                        <img style="display:block" width="100%" height="auto" src="{{public_path().'/storage/gambar/aktiviti/'.$aktiviti->gambar}}" alt="" >
                    </td>
                  </tr>
                </table>
                


            </div>

	</body>
</html>