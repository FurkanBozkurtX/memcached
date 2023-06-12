<?php
class Memcached{

    private $memcache;

    public function __construct(){
      //Memcache Bağlantısı, Alttaki Memcache classı php_memcache.dll ile default olarak gelmekte.
      $this->memcache = new Memcache;
      $this->memcache->connect('localhost', 11211) or die ("Bağlantı Hatası!");

    }

    public function get_data($data)
    {

        //atanan datanın çekilidiği alan test amaçlı ajax/datatable.php de var
        return  $this->memcache->get($data);
    }

    public function set_data($key,$content,$bool,$time)
    {
        //data set bölümü key ile gette istenilen data adı ör:Products gibi content içerik array yada genellikle sorgular
        //bool alanı true false değerleri true gönderilirse html de minify yapar ben false kullanıyorum. time ise cachin ne kadar da bir
        //silineceği saniye cinsinden zaman
        return $this->memcache->set($key,$content, $bool, $time);
    }

    public function flush_park($time)
    {
      //ramdeki cache bölümlerinin hepsini temizler
       return $this->memcache->flush($time);
    }

    public function delete_key($key)
    {
        //ramdeki cache bölümlerinin istenilen key değerindekini temizler.
        return $this->memcache->delete($key);
    }


}


	 $memcache_datatable=new Memcached();
	 $datas="memcached";
	 $result=$memcache_datatable->get_data('Products');
	 if($result){
	   echo json_encode($result);
	 }
	 else{
	   $memcache_datatable->set_data('Products',$datas,false,1800);
	 }
?>
