<?php
class connect {
    //定数の宣言
    const DB_NAME='dev56irtd0o0ir';
    const HOST='ec2-18-210-159-154.compute-1.amazonaws.com';
    const UTF='utf8';
    const USER='kxxmherqwvosxi';
    const PASS='404c65396d6896a618c71a47a34613533b4e0e210337245b365b995c7b28dd9f';
    //データベースに接続する関数
    function pdo(){
        /*phpのバージョンが5.3.6よりも古い場合はcharset=".self::UTFが必要無くなり、array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.SELF::UTF')が必要になり、5.3.6以上の場合は必要ないがcharset=".self::UTFは必要になる。*/
        $dsn="mysql:dbname=".self::DB_NAME.";host=".self::HOST.";charset=".self::UTF;
        $user=self::USER;
        $pass=self::PASS;
        try{
            $pdo=new PDO($dsn,$user,$pass);
        }catch(Exception $e){
            echo 'error' .$e->getMesseage;
            die();
        }
        //エラーを表示してくれる。
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        return $pdo;
    }
    //SELECT文のときに使用する関数。
    function select($sql){
        $hoge=$this->pdo();
        $stmt=$hoge->query($sql);
        $items=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    }
    //SELECT,INSERT,UPDATE,DELETE文の時に使用する関数。
    function plural($sql,$item){
        $hoge=$this->pdo();
        $stmt=$hoge->prepare($sql);
        $stmt->execute(array(':id'=>$item));//sql文のVALUES等の値が?の場合は$itemでもいい。
        return $stmt;
    }
}
?>