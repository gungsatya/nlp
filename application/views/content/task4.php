<div id="content">
  <div class="content-nav">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <!-- Sidebar toggle button -->
          <button type="button" class="sidebar-toggle">
            <i class="fa fa-reorder"></i>
          </button>
          <span class="navbar-brand text-size-24" ><i class="fa fa-fw fa-home"></i> <b>NLP</b> - Summarization </span>
        </div>
    </nav>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <span class="panel-title text-black">Apa itu Summarization ?</span>
          </div>
          <div class="panel-body">
            <p>Automated Text Summarization (ATS) atau sering disebut Text Summarization, adalah sebuah proses untuk menghasilkan ringkasan/ summary dari suatu artikel tapi tetap memiliki gambaran yang akurat dari isi suatu artikel dengan menggunakan komputer. Perancangan dan implementasi automated text summarization menggunakan hibridisasi algoritma exhaustive dan TF-IDF.</p> 
          </div>
          <div class="panel-footer clearfix">
            <span class="panel-footer-text text-grey text-size-12"><i class="fa fa-info-circle"></i> Sumber : https://www.researchgate.net/publication/39740924_Perancangan_dan_implementasi_automated_text_summarization_menggunakan_hibridisasi_algoritma_exhaustive_dan_TF-IDF</span>
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
                  <th class="col-xs-1">Paragraf</th>
                  <th class="col-xs-3">Bobot</th>
                  <th class="col-xs-8">Kesimpulan</th>
                </tr>
              </thead>
              <tbody id="wordresult">
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
      $("#wordresult > tr").remove();
      words = $('textarea#words').val();
      $.ajax({
        type    : "POST",
        url     : "<?php echo base_url();?>process/task4",
        data    : "words="+words,
        datatype: "json",
        cache   : false,
        success : function(response) {
                    console.log(response);
                    var data = $.parseJSON(response);
                    $num = 0;
                    $.each(data.result, function(key,value){
                      $('#wordresult').append('<tr><td>'+ value.paragraf +'</td><td id="w'+String($num)+'"></td><td>'+value.summary+'</td></tr>');
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
