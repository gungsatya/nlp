<div id="content">
  <div class="content-nav">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <!-- Sidebar toggle button -->
          <button type="button" class="sidebar-toggle">
            <i class="fa fa-reorder"></i>
          </button>
          <span class="navbar-brand text-size-24" ><i class="fa fa-fw fa-home"></i> <b>NLP</b> - Tokenisasi <small>(Tanpa Stop Words dan Stemming)</small> </span>
        </div>
    </nav>
  </div>
  <div class="container-fluid">
    <div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <span class="panel-title text-black">Apa itu Tokenisasi ?</span>
          </div>
          <div class="panel-body">
            <p>Tokenisasi adalah proses untuk membagi teks yang dapat berupa kalimat, paragraf atau dokumen, menjadi token-token/bagian-bagian tertentu. Sebagai contoh, tokenisasi dari kalimat "Aku baru saja makan bakso pedas" menghasilkan enam token, yakni: "Aku", "baru", "saja", "makan", "bakso", "pedas". Biasanya, yang menjadi acuan pemisah antar token adalah spasi dan tanda baca. Tokenisasi seringkali dipakai dalam ilmu linguistik dan hasil tokenisasi berguna untuk analisis teks lebih lanjut.</p> 
          </div>
          <div class="panel-footer clearfix">
            <span class="panel-footer-text text-grey text-size-12"><i class="fa fa-info-circle"></i> Sumber : https://id.wikipedia.org/wiki/Tokenisasi</span>
          </div>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <span class="panel-title text-black">Paragraf yang akan diolah</span>
          </div>
          <div class="panel-body">
            <textarea id="words" style="width:100%;min-height:150px;"></textarea>
          </div>
          <div class="panel-footer clearfix">
            <button id="submit" class="btn btn-success pull-right">Proses</button>
          </div>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="panel panel-widget">
          <div class="panel-heading"><span class="panel-title text-black">Hasil</span></div>
          <div class="panel-body table-responsive table-full">
            <table class="table table-striped table-hover" id="result" >
              <thead>
                <tr>
                  <th>Frekuensi</th>
                  <th>Kata</th>
                </tr>
              </thead>
              <tbody id="wordresult">
              </tbody>
            </table>
          </div>
          <div class="panel-footer">
            <p class="panel-footer-text text-black"><i class="fa fa-info-circle"></i>Jumlah kata yang diproses : </p>
            <input id="word_count" type="text" value="0" readonly/>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function proses(){
      $("#wordresult > tr").remove();
      words = $('textarea#words').val();
      $.ajax({
        type    : "POST",
        url     : "<?php echo base_url();?>process/task1",
        data    : "words="+words,
        datatype: "json",
        cache   : false,
        success : function(response) {
                    console.log(response);
                    var data = $.parseJSON(response);
                    $("#word_count").val(data.word_count);
                    // i = 0;
                    $.each(data.result, function(key,value){
                      $('#wordresult').append('<tr><td>'+ value.freq +'</td><td>'+ value.word +'</td></tr>')
                    });
        }
      });
    }
    $("#submit").click(proses);
</script>
