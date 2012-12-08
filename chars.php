<?php

// let's start
$action = isset($_REQUEST['action']) && strlen($_REQUEST['action']) > 0 ? $_REQUEST['action'] : "list" ;
$formId = isset($_REQUEST['id']) && strlen($_REQUEST['id']) > 0 ? $_REQUEST['id'] : "";
$formId = mysql_real_escape_string($formId);
switch ($action) {
    case "list":
        $query = "SELECT * FROM chars";
        $result = mysql_query($query);
        $data = array();
        // fetch result
        while ($row = mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
        require_once 'templates/list.html';
        break;
    case "rec":
        $query = "SELECT * FROM chars WHERE id = '$formId' LIMIT 1";
        $result = mysql_query($query);
        $char = array();
        // fetch result
        while ($row = mysql_fetch_assoc($result)) {
            $char[] = $row;
        }
        $char = end($char);
        require_once 'templates/rec.html';
        break;
    case "Speichern":
        $aInsert = array(
            'img_src'   => "",
            'name'     => "",
            'gender'    => "",
            'race'      => "",
            'class'     => "",
            'hp'        => "",
            'mp'        => "",
            'stamina'   => "",
            'story'     => "",
            'gold'      => "",
            'inventar'  => ""
        );
        $filled = 0;
        // collect data
        foreach ($aInsert as $fieldName => $value) {
            if (isset($_REQUEST[$fieldName]) === true && strlen($_REQUEST[$fieldName]) > 0) {
                $aInsert[$fieldName] = mysql_real_escape_string($_REQUEST[$fieldName]);
                $filled++;
            }
        }
        $error = null;
        $char = $aInsert;
        if ($filled === 0) {
            $error = "Bitte füllen Sie mindestens ein Feld aus!";
        }
        // check for existence
        if (strlen($formId) > 0) {// update
            $query = "UPDATE chars SET ";
            $body = "";
            foreach ($aInsert as $fieldName => $value) {
                $body .= $fieldName . "='" . $value . "'";
                if ($fieldName !== 'inventar') {
                    $body .= ",";
                }
            }
            $query .= $body;
            $query .= " WHERE id='$formId'";
        } else {// insert
            $fieldNames = array();
            $fieldValues = array();
            foreach ($aInsert as $fieldName => $value) {
                $fieldNames[] = $fieldName;
                $fieldValues[] = "'" . $value . "'";
            }
            $query = "INSERT INTO chars (" . implode(",", $fieldNames) . ") VALUES (" . implode(",", $fieldValues) . ")";
        }
        if ($error === null) {
            // execute query
            mysql_query($query);
            if (strlen(mysql_error()) > 0) {
                die(mysql_error());
            }
            // redirect
            header("Location: index.php?menu=chars&action=list");
            exit();
        }
        require_once 'templates/rec.html';
        break;
    case "delete":
        if (strlen($formId) > 0) {
            $query = "DELETE FROM chars WHERE id ='$formId'";
            mysql_query($query);
            if (strlen(mysql_error()) > 0) {
                die(mysql_error());
            }
            // redirect
            header("Location: index.php?menu=chars&action=list");
            exit();
        }
        break;
    case "Abbrechen":
        header("Location: index.php?menu=chars&action=list");
        exit();
        break;
}