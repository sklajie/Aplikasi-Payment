<!DOCTYPE html>
<html>
<!-- START HEAD -->
<head>
    
    <!-- CHARSET -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <!-- MOBILE FIRST -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    
    <!-- RESPONSIVE CSS -->
    <style type="text/css">
        @media only screen and (max-width: 550px){
            .responsive_at_550{
                width: 90% !important;
                max-width: 90% !important;
            }
        }
    </style>

</head>
<!-- END HEAD -->

<!-- START BODY -->
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    
    <!-- START EMAIL CONTENT -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">        
        <tbody>
            
            <tr>
                
                <td align="center" bgcolor="#1976D2">
                    
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tbody>
                            <tr>
                                <td width="100%" align="center">
                                    
                                    <!-- START SPACING -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td height="40">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- END SPACING -->
                                    
                                    <!-- START SPACING -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td height="40">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- END SPACING -->
                                    
                                    <!-- START CONTENT -->
                                    <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" style="padding-left:20px; padding-right:20px;" class="responsive_at_550">
                                        <tbody>
                                            <tr>
                                                <td align="center" bgcolor="#ffffff">
                                                    
                                                    <!-- START BORDER COLOR -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td width="100%" height="7" align="center" border="0" bgcolor="#03a9f4"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END BORDER COLOR -->
                                                    
                                                    <!-- START SPACING -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="30">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END SPACING -->
                                                    
                                                    <!-- START HEADING -->
                                                    <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <thead>
                                                            <h2>Pembayaran UKT</h2>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td width="100%" align="center">
                                                                    <img width="200" src="{{ asset('public/assets/img/logo_polindra.png') }}" alt="Keuangan Polindra" border="0" style="text-align: center;"/>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END HEADING -->
                                                    
                                                    <!-- START PARAGRAPH -->
                                                    <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td width="100%">
                                                                    <p style="font-family:'Ubuntu', sans-serif; font-size:14px; color:#202020; padding-left:20px; padding-right:20px; text-align:justify;">
                                                                        <p>Dear <b>{{ $nama }}</b>,</p>
                                                                        <p>NIM <b>{{ $nim }}</b>, pembayaran UKT <b>semester {{ $semester }}</b> sudah dapat dibayarkan.</p>
                                                                        <p>Berikut adalah detail pembayaran Anda:</p>
                                                                        <ul>
                                                                            <li><strong>Nomor Virtual Account (VA):</strong> {{ $va }}</li>
                                                                            <li><strong>Jumlah yang harus dibayarkan:</strong> {{ $amount }}</li>
                                                                            <li><strong>Tanggal Aktif:</strong> {{ $activeDate }}</li>
                                                                            <li><strong>Tanggal Nonaktif:</strong> {{ $inactiveDate }}</li>
                                                                        </ul>
                                                                        <p>Mohon lakukan pembayaran sebelum tanggal nonaktif untuk dapat melakukan pembayaran.</p>
                                                                        <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, silahkan menghubungi bidang akademik.</p>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END PARAGRAPH -->
                                                    
                                                    <!-- START SPACING -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="30">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END SPACING -->
                                                    
                                                    <!-- START SPACING -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="30">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END SPACING -->
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- END CONTENT -->
                                    
                                    <!-- START SPACING -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td height="40">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- END SPACING -->
                                    
                                    <!-- START FOOTER -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td width="100%" align="center" style="padding-left:15px; padding-right:15px;">
                                                    <p style="font-family:'Ubuntu Mono', monospace; color:#ffffff; font-size:12px;">Politeknik Negeri Indramayu &copy; 2023, All Rights Reserved</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- END FOOTER -->
                                    
                                    <!-- START SPACING -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td height="40">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- END SPACING -->
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </td>
                
            </tr>
            
        </tbody>        
    </table>
    <!-- END EMAIL CONTENT -->
    
</body>
<!-- END BODY -->
</html>