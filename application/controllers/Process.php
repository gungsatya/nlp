<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function task1()
  {
    $words          = $this->input->post('words');
    $words          = trim(preg_replace('/[^A-Za-z0-9\-.,]/', ' ', $words));
    $words          = preg_replace('/\s+/', ' ', $words);
    $count          = 0;
    if(isset($words)&&!empty($words))
    {
      $words        = strtolower($words);
      $word_array   = explode(" ",$words);
      
      foreach ($word_array as $key => $value){
        if (preg_match("/(,\z|\.\z)/", $value)) 
        {
            $word_array[$key] = substr_replace($value, " ", -1);
        }

        if($word_array[$key]==" "||$word_array[$key]=="")
        {
            unset($word_array[$key]);
        }
      }
      $count        = count($word_array);
      $freq_array   = array_count_values($word_array);
      arsort($freq_array);

      $result       = array();
      foreach ($freq_array as $word => $freq)
      {
        array_push($result,array("word" => $word, "freq"=>$freq));
      }
      $json         = array("result"=>$result, "word_count"=>$count);
    }
    else {
      $json         = array("result"=>array(), "word_count"=>0);
    }
    echo json_encode($json, JSON_PRETTY_PRINT);
  }
  public function task2()
  {
    $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
    $stemmer        = $stemmerFactory->createStemmer();
    $words          = $this->input->post('words');
    $words          = trim(preg_replace('/[^A-Za-z0-9]/', ' ', $words));
    $result         = $stemmer->stem($words);
    $json           = array("result"=>$result, "word_count"=>str_word_count($result));
    echo json_encode($json, JSON_PRETTY_PRINT);
  }
  public function task3()
  {
    $removerFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
    $remover        = $removerFactory->createStopWordRemover();
    $words          = $this->input->post('words');
    $words          = trim(preg_replace('/[^A-Za-z0-9]/', ' ', $words));
    $result         = $remover->remove($words);
    $json           = array("result"=>$result, "word_count"=>str_word_count($result));
    echo json_encode($json, JSON_PRETTY_PRINT);
  }
  public function task4()
  {
    $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
    $removerFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
    $stemmer        = $stemmerFactory->createStemmer();
    $remover        = $removerFactory->createStopWordRemover();
    $words          = $this->input->post('words');
    $tmp_para       = explode("\n", $words );
    $paragrafs       = array();
    $result         = array();
    foreach ($tmp_para as $key1 => $value)
    {
      if(isset($tmp_para[$key1])&&!empty($tmp_para[$key1]))
      {
        array_push($paragrafs, $tmp_para[$key1]);
      }
    }
    foreach ($paragrafs as $key2 => $paragraf)
    {
      $queries      = $stemmer->stem($paragraf);
      $queries      = $remover->remove($queries);
      $query_arr    = explode(" ", $queries);
      $query_freq   = array_count_values($query_arr);
      $query        = array();
      foreach($query_freq as $key3 =>$value3 ){array_push($query,$key3);}

      $sentence_ori = preg_split('/(\?\s|\.\s|!\s)/',$paragraf);
      $D            = count($sentence_ori) - 1;
      $idf          = array();
      $sentence     = array();

      foreach($sentence_ori as $x => $doc)
      {
        $sentence[$x] = $stemmer->stem($doc);
        $sentence[$x] = $remover->remove($doc);
      }

      for($x=0; $x<count($query); $x++)
      {
        $qrs                  = "/".$query[$x]."\s/";
        $idf[$query[$x]]      = 0;
        $df[$query[$x]]       = 0;

        foreach($sentence as $doc)
        {
          if(preg_match($qrs,$doc))
          {
            $df[$query[$x]] = $df[$query[$x]] + 1;
          }
        }
        if($df[$query[$x]]>0)
        {
          $idf[$query[$x]]   = log($D/$df[$query[$x]]);
        }
        else
        {
          $idf[$query[$x]] = 0;
        }
      }
      unset($weight);
      foreach($sentence as $key4 => $doc)
      {
        $weight["doc-".$key4] = 0;
        $terms                = explode(" ", $doc);

        for($x=0; $x<count($query); $x++)
        {
          $f   = 0;
          foreach($terms as $term)
          {
           if($term == $query[$x]){$f += 1;} 
          }
          if($f>0)
          {
            $tf = 1 + log10($f);
          }
          else
          {
            $tf = 0;
          }
          $weight["doc-".$key4] = number_format($weight["doc-".$key4] + ($tf * $idf[$query[$x]]),2);
        }

      }
      arsort($weight);
      $w_desc = array();
      foreach($weight as $idx => $val){
        $idx = str_replace("doc-","",$idx);
        array_push($w_desc, $idx);
      }
      array_push($result, array(
            "paragraf"  => $key2 + 1,
            "weight"    => $weight,
            "summary"   => $sentence_ori[(int)$w_desc[0]] . ".<br><b>(Kalimat " . ($w_desc[0] + 1) ." / doc-".$w_desc[0].")</b>"
          )
      );
    }
    $json           = array("result"=>$result);
    echo json_encode($json, JSON_PRETTY_PRINT);
  }
  public function task5()
  {
    $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
    $removerFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
    $stemmer        = $stemmerFactory->createStemmer();
    $remover        = $removerFactory->createStopWordRemover();
    $words_ori      = $this->input->post('words');
    $tmp_para       = explode("\n", $words_ori );
    $paragrafs      = array();
    $summ_result    = array();
    $words          = trim(preg_replace('/[^A-Za-z0-9]/', ' ', $words_ori));

    $stemming_result  = $stemmer->stem($words);
    $stopword_result  = $remover->remove($stemming_result);

    $word_array   = explode(" ", $stopword_result);
      
    foreach ($word_array as $key => $value){
      if($word_array[$key]==" "||$word_array[$key]=="")
      {
          unset($word_array[$key]);
      }
    }

    $freq_array   = array_count_values($word_array);
    arsort($freq_array);

    $token_result       = array();
    foreach ($freq_array as $word => $freq)
    {
      array_push($token_result,array("word" => $word, "freq"=>$freq));
    }

    foreach ($tmp_para as $key1 => $value)
    {
      if(isset($tmp_para[$key1])&&!empty($tmp_para[$key1]))
      {
        array_push($paragrafs, $tmp_para[$key1]);
      }
    }
    foreach ($paragrafs as $key2 => $paragraf)
    {
      $queries      = $stemmer->stem($paragraf);
      $queries      = $remover->remove($queries);
      $query_arr    = explode(" ", $queries);
      $query_freq   = array_count_values($query_arr);
      $query        = array();
      foreach($query_freq as $key3 =>$value3 ){array_push($query,$key3);}

      $sentence_ori = preg_split('/(\?\s|\.\s|!\s)/',$paragraf);
      $D            = count($sentence_ori) - 1;
      $idf          = array();
      $sentence     = array();

      foreach($sentence_ori as $x => $doc)
      {
        $sentence[$x] = $stemmer->stem($doc);
        $sentence[$x] = $remover->remove($doc);
      }

      for($x=0; $x<3; $x++)//for($x=0; $x<count($query); $x++)
      {
        $qrs                  = "/".$query[$x]."\s/";
        $idf[$query[$x]]      = 0;
        $df[$query[$x]]       = 0;

        foreach($sentence as $doc)
        {
          if(preg_match($qrs,$doc))
          {
            $df[$query[$x]] = $df[$query[$x]] + 1;
          }
        }
        if($df[$query[$x]]>0)
        {
          $idf[$query[$x]]   = log($D/$df[$query[$x]]);
        }
        else
        {
          $idf[$query[$x]] = 0;
        }
      }
      // unset($weight);
      foreach($sentence as $key4 => $doc)
      {
        $weight["doc-".$key4] = 0;
        $terms                = explode(" ", $doc);

        for($x=0; $x<3; $x++)//for($x=0; $x<count($query); $x++)
        {
          $f   = 0;
          foreach($terms as $term)
          {
           if($term == $query[$x]){$f += 1;} 
          }
          if($f>0)
          {
            $tf = 1 + log10($f);
          }
          else
          {
            $tf = 0;
          }
          $weight["doc-".$key4] = number_format($weight["doc-".$key4] + ($tf * $idf[$query[$x]]),2);
        }

      }
      arsort($weight);
      $w_desc = array();
      foreach($weight as $idx => $val){
        $idx = str_replace("doc-","",$idx);
        array_push($w_desc, $idx);
      }
      array_push($summ_result, array(
            "paragraf"  => $key2 + 1,
            "weight"    => $weight,
            "summary"   => $sentence_ori[(int)$w_desc[0]] . ".<br><b>(Kalimat " . ($w_desc[0] + 1) ." / doc-".$w_desc[0].")</b>"
          )
      );
    }
    $json           = 
    array(
      "stemming_result" =>$stemming_result,
      "wc_stemming"     =>str_word_count($stemming_result),
      "stopword_result" =>$stopword_result,
      "wc_stopword"     =>str_word_count($stopword_result),
      "token_result"    =>$token_result,
      "wc_token"        =>count($token_result),
      "summary_result"  =>$summ_result
    );
    echo json_encode($json, JSON_PRETTY_PRINT);
  }
}
