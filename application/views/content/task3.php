<div id="content">
  <div class="content-nav">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <!-- Sidebar toggle button -->
          <button type="button" class="sidebar-toggle">
            <i class="fa fa-reorder"></i>
          </button>
          <span class="navbar-brand text-size-24" ><i class="fa fa-fw fa-home"></i> <b>NLP</b> - Stop Words </span>
        </div>
    </nav>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <span class="panel-title text-black">Apa itu Stop Words ?</span>
          </div>
          <div class="panel-body">
            <p>Stopword adalah kata umum (common word) yang tidak memberikan informasi penting (yang biasanya tidak diacuhkan atau dibuang, misalnya dalam proses pembuatan indeks).</p> 
          </div>
          <div class="panel-footer clearfix">
            <span class="panel-footer-text text-grey text-size-12"><i class="fa fa-info-circle"></i> Sumber : http://hikaruyuuki.lecture.ub.ac.id/kamus-kata-dasar-dan-stopword-list-bahasa-indonesia/</span>
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
          <div class="panel-body">
            <textarea id="result" style="width:100%;min-height:150px;" readonly></textarea>
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
        url     : "<?php echo base_url();?>process/task3",
        data    : "words="+words,
        datatype: "json",
        cache   : false,
        success : function(response) {
                    console.log(response);
                    var data = $.parseJSON(response);
                    $("#word_count").val(data.word_count);
                    $("#result").val(data.result);
        }
      });
    }
    $("#submit").click(proses);
</script>
