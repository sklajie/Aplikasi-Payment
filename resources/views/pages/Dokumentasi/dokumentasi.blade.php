@extends('layouts.app')

@section('title', 'Dokumentasi')

@section('content')

<style>

.gradient-custom {
/* fallback for old browsers */
background: #f6d365;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right bottom, rgb(206, 206, 206), rgb(159, 159, 159));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right bottom, rgb(212, 212, 212), rgb(157, 157, 157))
}

</style>

<br><br>
<div class="main-panel">
    <div class="page-inner">
        
      
      <div class="list-content">
        <section class="ro-docs" id="memulai">
            <h3>Dokumentasi API Akun Starter</h3>
            <hr>
            <p>Dokumentasi ini menjelaskan cara mengakses layanan API RajaOngkir untuk akun <strong>Starter</strong>. Akun <strong>Starter</strong> merupakan akun gratis dengan fitur pengecekan ongkos kirim (ongkir) untuk kurir JNE, POS Indonesia, dan TIKI. Jika Anda membutuhkan fitur lain seperti lacak paket JNE, ongkos kirim internasional, dan ongkos kirim sampai level kecamatan, silakan <a href="https://rajaongkir.com/akun/upgrade"><strong>upgrade akun Anda</strong></a>.</p>
        </section>
        <section id="province-ringkasan">
            <h3>Province</h3>
            <hr>
            <h4>Ringkasan</h4>
            <p>Method "province" digunakan untuk mendapatkan daftar propinsi yang ada di Indonesia.</p>
        </section>
        <section id="province-request">
            <h4>Request</h4>
            <ul class="nav nav-tabs ro-doc-tabs">
                <li class="active"><a data-toggle="tab" href="#province-request-url">URL</a></li>
                <li class=""><a data-toggle="tab" href="#province-request-parameter">Parameter</a></li>
                <li class=""><a data-toggle="tab" href="#province-request-example">Contoh request</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="province-request-url">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Method</td>
                                <td>URL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>GET</td>
                                <td>https://api.rajaongkir.com/starter/province</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="province-request-parameter">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Method</td>
                                <td>Parameter</td>
                                <td>Wajib</td>
                                <td>Tipe</td>
                                <td>Keterangan</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>GET/HEAD</td>
                                <td>key</td>
                                <td>Ya</td>
                                <td>String</td>
                                <td>API Key</td>
                            </tr>
                            <tr>
                                <td>GET/HEAD</td>
                                <td>android-key</td>
                                <td>Tidak</td>
                                <td>String</td>
                                <td>Identitas aplikasi Android</td>
                            </tr>
                            <tr>
                                <td>GET/HEAD</td>
                                <td>ios-key</td>
                                <td>Tidak</td>
                                <td>String</td>
                                <td>Identitas aplikasi iOS</td>
                            </tr>
                            <tr>
                                <td>GET</td>
                                <td>id</td>
                                <td>Tidak</td>
                                <td>String</td>
                                <td>ID propinsi</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><strong>Catatan:</strong></p>
                    <ul>
                        <li>Jika ID propinsi kosong maka akan menampilkan semua propinsi di Indonesia.</li>
                        <li>Parameter "android-key" wajib disertakan jika Anda mengaktifkan perujuk untuk aplikasi Android.</li>
                        <li>Parameter "ios-key" wajib disertakan jika Anda mengaktifkan perujuk untuk aplikasi iOS.</li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="province-request-example">
                    <iframe src="{{route('request')}}" frameborder="0" scrolling="no" width="100%" height="500px" seamless=""></iframe>                    </div>
            </div>
        </section>
        <section id="province-response">
            <h4>Response</h4>
            <ul class="nav nav-tabs ro-doc-tabs">
                <li class=""><a data-toggle="tab" href="#province-success-response">Response sukses</a></li>
                <li class="active"><a data-toggle="tab" href="#province-error-response">Response gagal</a></li>
                <li class=""><a data-toggle="tab" href="#province-penjelasan-response">Penjelasan response</a></li>
            </ul>
            <div class="tab-content">
                <div id="province-success-response" class="tab-pane fade">
                    <script src="https://gist.github.com/hok00age/6e79b7f09544d3cc2e13.js"></script><link rel="stylesheet" href="https://github.githubassets.com/assets/gist-embed-cdd2b47f37c5.css"><div id="gist18960379" class="gist">
<div class="gist-file" translate="no">
  <div class="gist-data">
    <div class="js-gist-file-update-container js-task-list-container file-box">
<div id="file-province-success-json" class="file my-2">

<div itemprop="text" class="Box-body p-0 blob-wrapper data type-json  ">

    
<div class="js-check-bidi js-blob-code-container blob-code-content">

<template class="js-file-alert-template">
<div data-view-component="true" class="flash flash-warn flash-full d-flex flex-items-center">
<svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-alert">
<path d="M6.457 1.047c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0 1 14.082 15H1.918a1.75 1.75 0 0 1-1.543-2.575Zm1.763.707a.25.25 0 0 0-.44 0L1.698 13.132a.25.25 0 0 0 .22.368h12.164a.25.25 0 0 0 .22-.368Zm.53 3.996v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path>
</svg>
<span>
  This file contains bidirectional Unicode text that may be interpreted or compiled differently than what appears below. To review, open the file in an editor that reveals hidden Unicode characters.
  <a href="https://github.co/hiddenchars" target="_blank">Learn more about bidirectional Unicode characters</a>
</span>


<div data-view-component="true" class="flash-action">        <a href="" data-view-component="true" class="btn-sm btn">    Show hidden characters
</a>
</div>
</div></template>
<template class="js-line-alert-template">
<span aria-label="This line has hidden Unicode characters" data-view-component="true" class="line-alert tooltipped tooltipped-e">
<svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-alert">
<path d="M6.457 1.047c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0 1 14.082 15H1.918a1.75 1.75 0 0 1-1.543-2.575Zm1.763.707a.25.25 0 0 0-.44 0L1.698 13.132a.25.25 0 0 0 .22.368h12.164a.25.25 0 0 0 .22-.368Zm.53 3.996v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path>
</svg>
</span></template>

<table data-hpc="" class="highlight tab-size js-file-line-container js-code-nav-container js-tagsearch-file" data-tab-size="8" data-paste-markdown-skip="" data-tagsearch-lang="JSON" data-tagsearch-path="province-success.json">
    <tbody><tr>
      <td id="file-province-success-json-L1" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="1"></td>
      <td id="file-province-success-json-LC1" class="blob-code blob-code-inner js-file-line">{</td>
    </tr>
    <tr>
      <td id="file-province-success-json-L2" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="2"></td>
      <td id="file-province-success-json-LC2" class="blob-code blob-code-inner js-file-line">    <span class="pl-ent">"rajaongkir"</span>: {</td>
    </tr>
    <tr>
      <td id="file-province-success-json-L3" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="3"></td>
      <td id="file-province-success-json-LC3" class="blob-code blob-code-inner js-file-line">        <span class="pl-ent">"query"</span>: {</td>
    </tr>
    <tr>
      <td id="file-province-success-json-L4" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="4"></td>
      <td id="file-province-success-json-LC4" class="blob-code blob-code-inner js-file-line">            <span class="pl-ent">"id"</span>: <span class="pl-s"><span class="pl-pds">"</span>12<span class="pl-pds">"</span></span></td>
    </tr>
    <tr>
      <td id="file-province-success-json-L5" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="5"></td>
      <td id="file-province-success-json-LC5" class="blob-code blob-code-inner js-file-line">        },</td>
    </tr>
    <tr>
      <td id="file-province-success-json-L6" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="6"></td>
      <td id="file-province-success-json-LC6" class="blob-code blob-code-inner js-file-line">        <span class="pl-ent">"status"</span>: {</td>
    </tr>
    <tr>
      <td id="file-province-success-json-L7" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="7"></td>
      <td id="file-province-success-json-LC7" class="blob-code blob-code-inner js-file-line">            <span class="pl-ent">"code"</span>: <span class="pl-c1">200</span>,</td>
    </tr>
    <tr>
      <td id="file-province-success-json-L8" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="8"></td>
      <td id="file-province-success-json-LC8" class="blob-code blob-code-inner js-file-line">            <span class="pl-ent">"description"</span>: <span class="pl-s"><span class="pl-pds">"</span>OK<span class="pl-pds">"</span></span></td>
    </tr>
    <tr>
      <td id="file-province-success-json-L9" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="9"></td>
      <td id="file-province-success-json-LC9" class="blob-code blob-code-inner js-file-line">        },</td>
    </tr>
    <tr>
      <td id="file-province-success-json-L10" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="10"></td>
      <td id="file-province-success-json-LC10" class="blob-code blob-code-inner js-file-line">        <span class="pl-ent">"results"</span>: {</td>
    </tr>
    <tr>
      <td id="file-province-success-json-L11" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="11"></td>
      <td id="file-province-success-json-LC11" class="blob-code blob-code-inner js-file-line">           <span class="pl-ent">"province_id"</span>: <span class="pl-s"><span class="pl-pds">"</span>12<span class="pl-pds">"</span></span>,</td>
    </tr>
    <tr>
      <td id="file-province-success-json-L12" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="12"></td>
      <td id="file-province-success-json-LC12" class="blob-code blob-code-inner js-file-line">           <span class="pl-ent">"province"</span>: <span class="pl-s"><span class="pl-pds">"</span>Kalimantan Barat<span class="pl-pds">"</span></span></td>
    </tr>
    <tr>
      <td id="file-province-success-json-L13" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="13"></td>
      <td id="file-province-success-json-LC13" class="blob-code blob-code-inner js-file-line">        }</td>
    </tr>
    <tr>
      <td id="file-province-success-json-L14" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="14"></td>
      <td id="file-province-success-json-LC14" class="blob-code blob-code-inner js-file-line">    }</td>
    </tr>
    <tr>
      <td id="file-province-success-json-L15" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="15"></td>
      <td id="file-province-success-json-LC15" class="blob-code blob-code-inner js-file-line">}</td>
    </tr>
</tbody></table>
</div>


</div>

</div>
</div>

  </div>
  <div class="gist-meta">
    <a href="https://gist.github.com/hok00age/6e79b7f09544d3cc2e13/raw/ecc4185c65725e2831dca0627ccde8ce4f16d4f8/province-success.json" style="float:right">view raw</a>
    <a href="https://gist.github.com/hok00age/6e79b7f09544d3cc2e13#file-province-success-json">
      province-success.json
    </a>
    hosted with ❤ by <a href="https://github.com">GitHub</a>
  </div>
</div>
</div>

                </div>
                <div id="province-error-response" class="tab-pane fade active in">
                    <script src="https://gist.github.com/hok00age/407cb932a7da3f5d4ceb.js"></script><link rel="stylesheet" href="https://github.githubassets.com/assets/gist-embed-cdd2b47f37c5.css"><div id="gist18960982" class="gist">
<div class="gist-file" translate="no">
  <div class="gist-data">
    <div class="js-gist-file-update-container js-task-list-container file-box">
<div id="file-province-error-json" class="file my-2">

<div itemprop="text" class="Box-body p-0 blob-wrapper data type-json  ">

    
<div class="js-check-bidi js-blob-code-container blob-code-content">

<template class="js-file-alert-template">
<div data-view-component="true" class="flash flash-warn flash-full d-flex flex-items-center">
<svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-alert">
<path d="M6.457 1.047c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0 1 14.082 15H1.918a1.75 1.75 0 0 1-1.543-2.575Zm1.763.707a.25.25 0 0 0-.44 0L1.698 13.132a.25.25 0 0 0 .22.368h12.164a.25.25 0 0 0 .22-.368Zm.53 3.996v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path>
</svg>
<span>
  This file contains bidirectional Unicode text that may be interpreted or compiled differently than what appears below. To review, open the file in an editor that reveals hidden Unicode characters.
  <a href="https://github.co/hiddenchars" target="_blank">Learn more about bidirectional Unicode characters</a>
</span>


<div data-view-component="true" class="flash-action">        <a href="" data-view-component="true" class="btn-sm btn">    Show hidden characters
</a>
</div>
</div></template>
<template class="js-line-alert-template">
<span aria-label="This line has hidden Unicode characters" data-view-component="true" class="line-alert tooltipped tooltipped-e">
<svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-alert">
<path d="M6.457 1.047c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0 1 14.082 15H1.918a1.75 1.75 0 0 1-1.543-2.575Zm1.763.707a.25.25 0 0 0-.44 0L1.698 13.132a.25.25 0 0 0 .22.368h12.164a.25.25 0 0 0 .22-.368Zm.53 3.996v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path>
</svg>
</span></template>

<table data-hpc="" class="highlight tab-size js-file-line-container js-code-nav-container js-tagsearch-file" data-tab-size="8" data-paste-markdown-skip="" data-tagsearch-lang="JSON" data-tagsearch-path="province-error.json">
    <tbody><tr>
      <td id="file-province-error-json-L1" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="1"></td>
      <td id="file-province-error-json-LC1" class="blob-code blob-code-inner js-file-line">{</td>
    </tr>
    <tr>
      <td id="file-province-error-json-L2" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="2"></td>
      <td id="file-province-error-json-LC2" class="blob-code blob-code-inner js-file-line">    <span class="pl-ent">"rajaongkir"</span>: {</td>
    </tr>
    <tr>
      <td id="file-province-error-json-L3" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="3"></td>
      <td id="file-province-error-json-LC3" class="blob-code blob-code-inner js-file-line">        <span class="pl-ent">"status"</span>: {</td>
    </tr>
    <tr>
      <td id="file-province-error-json-L4" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="4"></td>
      <td id="file-province-error-json-LC4" class="blob-code blob-code-inner js-file-line">            <span class="pl-ent">"code"</span>: <span class="pl-c1">400</span>,</td>
    </tr>
    <tr>
      <td id="file-province-error-json-L5" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="5"></td>
      <td id="file-province-error-json-LC5" class="blob-code blob-code-inner js-file-line">            <span class="pl-ent">"description"</span>: <span class="pl-s"><span class="pl-pds">"</span>Invalid key.<span class="pl-pds">"</span></span></td>
    </tr>
    <tr>
      <td id="file-province-error-json-L6" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="6"></td>
      <td id="file-province-error-json-LC6" class="blob-code blob-code-inner js-file-line">        }</td>
    </tr>
    <tr>
      <td id="file-province-error-json-L7" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="7"></td>
      <td id="file-province-error-json-LC7" class="blob-code blob-code-inner js-file-line">    }</td>
    </tr>
    <tr>
      <td id="file-province-error-json-L8" class="blob-num js-line-number js-code-nav-line-number js-blob-rnum" data-line-number="8"></td>
      <td id="file-province-error-json-LC8" class="blob-code blob-code-inner js-file-line">}</td>
    </tr>
</tbody></table>
</div>


</div>

</div>
</div>

  </div>
  <div class="gist-meta">
    <a href="https://gist.github.com/hok00age/407cb932a7da3f5d4ceb/raw/c7da24d81eba821b7636607bd402a3938e9a9bd6/province-error.json" style="float:right">view raw</a>
    <a href="https://gist.github.com/hok00age/407cb932a7da3f5d4ceb#file-province-error-json">
      province-error.json
    </a>
    hosted with ❤ by <a href="https://github.com">GitHub</a>
  </div>
</div>
</div>

                </div>
                <div class="tab-pane fade" id="province-penjelasan-response">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Komponen</td>
                                <td>Tipe</td>
                                <td>Keterangan</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>id</td>
                                <td>String</td>
                                <td>ID propinsi</td>
                            </tr>
                            <tr>
                                <td>code</td>
                                <td>Int</td>
                                <td>Code status response</td>
                            </tr>
                            <tr>
                                <td>description</td>
                                <td>String</td>
                                <td>Penjelasan dari kode status</td>
                            </tr>
                            <tr>
                                <td>province_id</td>
                                <td>String</td>
                                <td>ID propinsi</td>
                            </tr>
                            <tr>
                                <td>province_name</td>
                                <td>String</td>
                                <td>Nama propinsi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

        <div class="alert alert-info">
            <p>Data ini hanya bisa dilihat oleh anda. Apabila anda perlu mengganti data anda karena alasan tertentu silahkan hubungi <a data-tjr-open-modal="contact-info-modal" href="#open-info-dialog-modal">kontak support</a></p>
        </div>
    </div>
</div>

@endsection