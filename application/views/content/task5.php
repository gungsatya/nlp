<div id="content">
  <div class="content-nav">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <!-- Sidebar toggle button -->
          <button type="button" class="sidebar-toggle">
            <i class="fa fa-reorder"></i>
          </button>
          <span class="navbar-brand text-size-24" ><i class="fa fa-fw fa-home"></i> <b>NLP</b> - Semua Fitur <small>(Summarization, Tokenisasi, Stop Words dan Stemming)</small> </span>
        </div>
    </nav>
  </div>
  <div class="container-fluid">
    <div class="row">
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
          <div class="panel-heading"><span class="panel-title text-black">Stemming</span></div>
          <div class="panel-body">
            <textarea id="result_stemming" style="width:100%;min-height:150px;" readonly></textarea>
          </div>
          <div class="panel-footer">
            <p class="panel-footer-text text-black"><i class="fa fa-info-circle"></i>Jumlah kata yang diproses pada Stemming : </p>
            <input id="stem_word_count" type="text" value="0" readonly/>
          </div>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="panel panel-widget">
          <div class="panel-heading"><span class="panel-title text-black">Stop Word</span></div>
          <div class="panel-body">
            <textarea id="result_stopword" style="width:100%;min-height:150px;" readonly></textarea>
          </div>
          <div class="panel-footer">
            <p class="panel-footer-text text-black"><i class="fa fa-info-circle"></i>Jumlah kata yang diproses pada Stop Word : </p>
            <input id="sw_word_count" type="text" value="0" readonly/>
          </div>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="panel panel-widget">
          <div class="panel-heading"><span class="panel-title text-black">Tokenisasi</span></div>
          <div class="panel-body table-responsive table-full">
            <table class="table table-striped table-hover" id="result" >
              <thead>
                <tr>
                  <th>Frekuensi</th>
                  <th>Kata</th>
                </tr>
              </thead>
              <tbody id="result_token">
              </tbody>
            </table>
          </div>
          <div class="panel-footer">
            <p class="panel-footer-text text-black"><i class="fa fa-info-circle"></i>Jumlah kata yang diproses pada Tokenisasi : </p>
            <input id="token_word_count" type="text" value="0" readonly/>
          </div>
        </div>
      </div>
       <div class="col-xs-12">
        <div class="panel panel-widget">
          <div class="panel-heading"><span class="panel-title text-black">Summarization</span></div>
          <div class="panel-body table-responsive table-full">
            <table class="table table-striped table-hover" id="result" >
              <thead>
                <tr>
                  <th class="col-xs-1">Paragraf</th>
                  <th class="col-xs-3">Bobot</th>
                  <th class="col-xs-8">Kesimpulan</th>
                </tr>
              </thead>
              <tbody id="result_summar">
              </tbody>
            </table>
          </div>
          <div class="panel-footer">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function proses(){
      $("#result_token > tr").remove();
      $("#result_summar > tr").remove();
      words = $('textarea#words').val();
      $.ajax({
        type    : "POST",
        url     : "<?php echo base_url();?>process/task5",
        data    : "words="+words,
        datatype: "json",
        cache   : false,
        success : function(response) {
                    console.log(response);
                    var data = $.parseJSON(response);
                    $("#result_stemming").val(data.stemming_result);
                    $("#stem_word_count").val(data.wc_stemming);
                    $("#result_stopword").val(data.stopword_result);
                    $("#sw_word_count").val(data.wc_stopword);
                    $("#token_word_count").val(data.wc_token);
                    $.each(data.token_result, function(key,value){
                      $('#result_token').append('<tr><td>'+ value.freq +'</td><td>'+ value.word +'</td></tr>')
                    });
                    $num = 0;
                    $.each(data.summary_result, function(key,value){
                      $('#result_summar').append('<tr><td>'+ value.paragraf +'</td><td id="w'+String($num)+'"></td><td>'+value.summary+'</td></tr>');
                      $.each(value.weight,function(key,value){
                        $('#w'+$num).append(''+key+' > '+value+'</br>')
                      });
                      $num +=1;
                    });
        }
      });
    }
    $("#submit").click(proses);
</script>
