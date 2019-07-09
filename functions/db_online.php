<?php

class dbo {

    public $sayac;
    private $baglanti;
    private $hataGoster = true;
    public $karekter_seti = 'utf8';

    public function __construct()
    {
        global $config;

        $this->baglanti = mysqli_connect('mysql995.umbler.com:41890', 'voeava', '102030voeava') or die('MYSQL ile bağlantı kurulamadı');
        if($this->baglanti):
            mysqli_select_db($this->baglanti,'voeava') or die('Database Error');
            $this->query('SET NAMES '.$this->karekter_seti);
        endif;
    }

    public function escapeArray($array)
    {
        array_walk_recursive($array, create_function('&$v', '$v = mysqli_real_escape_string($v);'));
        return $array;
    }

    public function to_bool($val)
    {
        return !!$val;
    }

    public function to_date($val)
    {
        return date('Y-m-d', $val);
    }

    public function to_time($val)
    {
        return date('H:i:s', $val);
    }

    public function to_datetime($val)
    {
        return date('Y-m-d H:i:s', $val);
    }


    public function query($sql)
    {
        $sql = mysqli_query($this->baglanti,$sql);
        if(!$sql && $this->hataGoster)
            echo ('<p>HATA : <strong>'.mysqli_error($this->baglanti).'</strong></p>'); // bakalım deniyelim

        return $sql;
    }

    public function insert($table, $veriler)
    {
        if(is_array($veriler)):
            $alanlar = array_keys($veriler);
            $alan = implode(',', $alanlar);
            $veri = '\''.implode("', '",array_map(array($this, 'escapeString'), $veriler)).'\'';
        else:
            $parametreler = func_get_args();
            $table = array_shift($parametreler);
            $alan = $veri = null;
            $toplamParametre = count($parametreler)-1;
            foreach($parametreler as $NO => $parametre):
                $bol = explode('=', $parametre, 2);
                if($toplamParametre == $NO):
                    $alan .= $bol[0];
                    $veri .= '\''.$this->escapeString($bol[1]).'\'';
                else:
                    $alan .= $bol[0].',';
                    $veri .= '\''.$this->escapeString($bol[1]).'\',';
                endif;
            endforeach;
        endif;

        $ekle = $this->query('INSERT INTO '.$table.' ('.$alan.') VALUES ('.$veri.')');
        if($ekle)
            return mysqli_insert_id($this->baglanti);
    }

    public function insert_multiple($table, $data) {

        $fields = "";
        $values = "";
        if (is_array($data)) {

            foreach ($data as $item) {
                $arr_keys = array_keys($item);

                if ($fields === "") {
                    $fields = implode(',', $arr_keys);
                }
                $values = $values . '(\''.implode("', '",array_map(array($this, 'escapeString'), $item)).'\'),';
            }
            $values = substr($values, 0, -1);
            $id = $this->query('INSERT INTO '.$table.' ('.$fields.') VALUES '. $values);
            if($id)
                return mysqli_insert_id($this->baglanti);
        }

    }

    public function table($sql)
    {
        $table = $this->query($sql);
        $sonuc = array();
        while($sonuclar = mysqli_fetch_object($table)):
            $sonuc[] = $sonuclar;
        endwhile;
        return $sonuc;
    }

    public function row($sql)
    {
        $satir = $this->query($sql);
        if($satir)
            return mysqli_fetch_object($satir);
    }

    public function field($sql)
    {
        $veri = $this->query($sql);
        if($veri):
            $sonuc = mysqli_fetch_array($veri,MYSQLI_NUM);
            return $sonuc[0];
        endif;
    }

    public function delete($table, $kosul = null)
    {
        if($kosul):
            if(is_array($kosul)):
                $kosullar = array();
                foreach($kosul as $alan => $veri)
                    $kosullar[] = $alan.'=\''.$veri.'\'';
            endif;
            return $this->query('DELETE FROM '.$table.' WHERE '.(is_array($kosul)?implode(' AND ',$kosullar):$kosul));
        else:
            return $this->query('TRUNCATE TABLE '.$table);
        endif;
    }

    public function update($table, $deger, $kosul)
    {
        if(is_array($deger)):
            $degerler = array();
            foreach($deger as $alan => $veri)
                $degerler[] = $alan."='".addslashes($veri)."'";
        endif;

        if(is_array($kosul)):
            $kosullar = array();
            foreach($kosul as $alan => $veri)
                $kosullar[] = $alan."='".addslashes($veri)."'";
        endif;

        return $this->query('UPDATE '.$table.' SET '.(is_array($deger) ? implode(',',$degerler):$deger).' WHERE '.(is_array($kosul)?implode(' AND ',$kosullar):$kosul));
    }

    public function escapeString($veri)
    {
        if(!get_magic_quotes_gpc())
            return mysqli_real_escape_string($this->baglanti, $veri);

        return $veri;
    }


}
?>