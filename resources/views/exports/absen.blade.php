<style>
 td {
    background-color: #000000;
    color: #ffffff;
 }
</style>
<table cellspacing="0" border="0">
	<colgroup width="183"></colgroup>
	<colgroup width="69"></colgroup>
	<colgroup width="78"></colgroup>
	<tr>
		<td height="27" align="left" valign=bottom><b><font color="#000000">Daily {{ getDay($month) }} {{ $year }}  </font></b></td>
        @foreach($check_ins as $row)
        <?php
        $date = $row['date'];
        $d    = new DateTime($date);
        
        ?>
        
         <!-- {{ $d->format('l') }} -->
         <?php if($d->format('l') == 'Sunday'): ?>
		<td style="border:1px solid #ffffff;background:#ff0000;color: #ffffff;text-transform:uppercase;text-align:center" align="left" colspan='2' valign=bottom>{{ \Carbon\Carbon::parse($row['date'])->format('d') }}</td>
        <?php else :?>
        <td style="border:1px solid #ffffff;background:#4288CE;color: #ffffff;text-transform:uppercase;text-align:center" align="left" colspan='2' valign=bottom><b><font color="#000000">{{ \Carbon\Carbon::parse($row['date'])->format('d') }} </font></b></td>
        <?php endif;?>
        @endforeach
        <td style="border:1px solid #ffffff;background:#4288CE;text-transform:uppercase;text-align:center" align="left" valign=bottom><b><font color="#000000"> </font></b></td>
        <td style="font-weight:bold;border:1px solid #ffffff;background:#7cb1e7;color: #ffffff;text-transform:uppercase;text-align:center" align="center" colspan='4' valign=bottom><font color="#000000"><br>KETERANGAN</font></td>
	</tr>
	<tr>
		<td style='font-weight:bold;border:1px solid #ffffff;background:#4288CE;color: #ffffff;text-transform:uppercase;text-align:center' height="27" align="left" valign=bottom>Nama</td>
        @foreach($check_ins as $row)
		<td style="font-weight:bold;border:1px solid #ffffff;background:#4288CE;color: #ffffff;text-transform:uppercase;text-align:center" align="left" valign=bottom>MASUK </td>
		<td style="font-weight:bold;border:1px solid #ffffff;background:#4288CE;color: #ffffff;text-transform:uppercase;text-align:center" align="left" valign=bottom>PULANG  </td>
        @endforeach
        <td style="font-weight:bold;border:1px solid #ffffff;background:#4288CE;color: #ffffff;text-transform:uppercase;text-align:center" align="left" valign=bottom>Durasi Terlambat</td>
        <td style="font-weight:bold;border:1px solid #ffffff;background:#7cb1e7;color: #ffffff;text-transform:uppercase;text-align:center" align="left" valign=bottom>Total Menit Terlambat</td>
        <td style="font-weight:bold;border:1px solid #ffffff;background:#7cb1e7;color: #ffffff;text-transform:uppercase;text-align:center" align="left" valign=bottom>Tidak Ceklok Datang</td>
        <td style="font-weight:bold;border:1px solid #ffffff;background:#7cb1e7;color: #ffffff;text-transform:uppercase;text-align:center" align="left" valign=bottom>Tidak Ceklok Pulang</td>
        <td style="font-weight:bold;border:1px solid #ffffff;background:#7cb1e7;color: #ffffff;text-transform:uppercase;text-align:center" align="left" valign=bottom>Tanpa Keterangan</td>
	</tr>
    @foreach($user as $row)
    
	<tr>
		<td align="left" valign=bottom><font color="#000000">{{ $row['name'] }} </font></td>
        @foreach($check_ins as $raw)
        <?php $absen = DB::table('check_ins')
                 ->leftjoin('check_outs',DB::raw('date(check_ins.time_in)'),'=',DB::raw('date(check_outs.time_out)'))
                 ->select('check_ins.time_in as time_in','check_outs.time_out as time_out','check_ins.id_status')
                 ->where('check_ins.id_user', '=', ''. $row['id'] .'' )
                 ->where('check_ins.time_in', 'LIKE',  '%' . $raw['date'] . '%')
                 ->groupBy(DB::raw('date(check_ins.time_in)'))->get();
        ?>
    
        <?php if($absen):?>
		@foreach($absen as $data)
        <?php if($data->id_status == 1):?>
		<td style="color:#ff0000;font-weight:bold;text-align:center" align="left" valign=bottom>{{ getHours($data->time_in)}} </td>
        <?php else :?>
        <td style="font-weight:bold;text-align:center" align="left" valign=bottom><b><font color="#000000">{{ getHours($data->time_in)}} </font></b></td>
        <?php endif;?>
		<td style="font-weight:bold;text-align:center" align="left" valign=bottom><b><font color="#000000">{{ getHours($data->time_out) }}  </font></b></td>
        @endforeach
        <?php else :?>
            <td align="left" valign=bottom><b><font color="#000000"> </font></b></td>
            <td align="left" valign=bottom><b><font color="#000000"> </font></b></td>
        <?php endif;?>
        @endforeach
        <?php $getMinutes = DB::table('check_ins')
                 ->select(DB::raw('SUM(MINUTE(time_in)) AS telat'))
                 ->where('id_user', '=', ''. $row['id'] .'' )
                 ->where('id_status','=', '1')
                 ->where(DB::raw('MONTH(time_in)'),'=',$month)
                 ->where(DB::raw('YEAR(time_in)'),'=',$year)->get();
        ?>
        <?php if($getMinutes): ?>
        @foreach($getMinutes as $total)
            <td align="left" valign=bottom><b><font color="#000000">{{ toHours($total->telat) }}  </font></b></td>
        @endforeach
        <?php else :?>
        <td align="left" valign=bottom><b><font color="#000000">  </font></b></td>
        <?php endif;?>
        <?php $getMinutes = DB::table('check_ins')
                 ->select(DB::raw('SUM(MINUTE(time_in)) AS telat'))
                 ->where('id_user', '=', ''. $row['id'] .'' )
                 ->where('id_status','=', '1')
                 ->where(DB::raw('MONTH(time_in)'),'=',$month)
                 ->where(DB::raw('YEAR(time_in)'),'=',$year)->get();
        ?>
        <?php if($getMinutes): ?>
        @foreach($getMinutes as $total)
            <td align="left" valign=bottom><b><font color="#000000">{{ toHours($total->telat) }}  </font></b></td>
        @endforeach
        <?php else :?>
        <td align="left" valign=bottom><b><font color="#000000">  </font></b></td>
        <?php endif;?>
        <?php $getNolog = DB::table('check_ins')
                 ->select(DB::raw('COUNT(time_in) as nolog'))
                 ->where('id_user', '=', ''. $row['id'] .'' )
                 ->where(DB::raw('HOUR(time_in)'),'=', '0')
                 ->where(DB::raw('MONTH(time_in)'),'=',$month)
                 ->where(DB::raw('YEAR(time_in)'),'=',$year)->get();
        ?>
        <?php if($getNolog): ?>
        @foreach($getNolog as $total)
            <td align="left" valign=bottom><b><font color="#000000">{{ $total->nolog }}  </font></b></td>
        @endforeach
        <?php else :?>
        <td align="left" valign=bottom><b><font color="#000000">  </font></b></td>
        <?php endif;?>
        <?php $getNolog = DB::table('check_outs')
                 ->select(DB::raw('COUNT(time_out) as nolog'))
                 ->where('id_user', '=', ''. $row['id'] .'' )
                 ->where(DB::raw('HOUR(time_out)'),'=', '0')
                 ->where(DB::raw('MONTH(time_out)'),'=',$month)
                 ->where(DB::raw('YEAR(time_out)'),'=',$year)->get();
        ?>
        <?php if($getNolog): ?>
        @foreach($getNolog as $total)
            <td align="left" valign=bottom><b><font color="#000000">{{ $total->nolog }}  </font></b></td>
        @endforeach
        <?php else :?>
        <td align="left" valign=bottom><b><font color="#000000">  </font></b></td>
        <?php endif;?>
	</tr>
    
    @endforeach
</table>