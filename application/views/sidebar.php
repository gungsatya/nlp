<div id="sidebar">
  <div id="sidebar-wrapper">
    <!-- title in side Bar -->
    <div class="sidebar-title"><h2>Natural</h2><span>Language Processing</span></div>
    <!-- sidebar menu -->
    <ul class="sidebar-nav">
      <li class="sidebar-close">
        <a href="#"><i class="fa fa-fw fa-close"></i></a>
      </li>
      <li <?php if($act_page=='dashboard'){ echo "class='active'";} ?> >
        <a href="<?php echo base_url(); ?>"><i class="fa fa-fw fa-home"></i><span class="nav-label">Dashboard</span></a>
      </li>
      <li <?php if($act_page=='task1'){ echo "class='active'";} ?> >
        <a href="<?php echo base_url(); ?>pages/tokenization"><i class="fa fa-pencil"></i><span class="nav-label">Tokenisasi</span></a>
      </li>
      <li <?php if($act_page=='task2'){ echo "class='active'";} ?> >
        <a href="<?php echo base_url(); ?>pages/stemming"><i class="fa fa-pencil"></i><span class="nav-label">Stemming</span></a>
      </li>
      <li <?php if($act_page=='task3'){ echo "class='active'";} ?> >
        <a href="<?php echo base_url(); ?>pages/stopwords"><i class="fa fa-pencil"></i><span class="nav-label">Stop Words</span></a>
      </li>
      <li <?php if($act_page=='task4'){ echo "class='active'";} ?> >
        <a href="<?php echo base_url(); ?>pages/summarization"><i class="fa fa-pencil"></i><span class="nav-label">Summarization</span></a>
      </li>
      <li <?php if($act_page=='task5'){ echo "class='active'";} ?> >
        <a href="<?php echo base_url(); ?>pages/all"><i class="fa fa-file-text-o"></i><span class="nav-label">Semua Fitur</span></a>
      </li>
    </ul>
    <!-- sidebar footer -->
    <div class="sidebar-footer"></div>
  </div>
</div>
