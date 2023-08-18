<?php

ini_set('display_errors', 1);

// ========= エスケープ関数
function H_chars($val)
{
    return htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
}

/**
 *   ========= MySql 操作クラス =========
 */
class Mysql_Go
{

    // ===　定数
    const dsn = 'mysql:dbname=tossy_db_01;host=localhost;port=3306';
    const user = 'root';
    const pass = '';


    // ========= インサート function
    function Insert_Data($table, $data)
    {

        try {

            // === PDO 接続
            $pdo = new PDO(self::dsn, self::user, self::pass);

            // データ挿入の準備
            $columns = array_keys($data);
            $set_columns = implode(', ', $columns); // カラム
            $placeholders = ':' . implode(', :', $columns); // プレースホルダー

            $stmt = $pdo->prepare("INSERT INTO $table ($set_columns) VALUES ($placeholders)");

            if (!$stmt) {
                die('プリペアドステートメント エラー: stmt');
            }

            // パラメターとバインド
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();

            echo "インサート完了";
        } catch (PDOException $e) {
            echo "insert エラー" . $e->getMessage();
        }

        $pdo = null;
    }


    // ========= select 
    function Get_Select_Member($table)
    {
        // 値格納用
        $get_member_date = array();

        try {

            $pdo = new PDO(self::dsn, self::user, self::pass);
            $stmt = $pdo->prepare("SELECT * FROM $table");

            if (!$stmt) {
                die('プリペアドステートメント エラー: stmt ');
            }

            $stmt->execute();
            $user_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($user_list as $data) {

                // 日付
                $day = strtotime((string)$data['day']);
                // メンバー
                $member = $data['member'];

                $get_member_date[date('Y-m-d', $day)] = $member;
            }

            ksort($get_member_date);
            return $get_member_date;
        } catch (PDOException $e) {
            echo "select エラー" . $e->getMessage();
        }
    }
}
