<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg12.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql12.php") ?>
<?php include_once "phpfn12.php" ?>
<?php include_once "userfn12.php" ?>
<?php
ew_Header(FALSE, 'utf-8');
$lookup = new cewlookup;
$lookup->Page_Main();

//
// Page class for lookup
//
class cewlookup {

	// Page ID
	var $PageID = "lookup";

	// Project ID
	var $ProjectID = "{9ACD0C53-10B4-423E-B4D2-BB7755A0F8CA}";

	// Page object name
	var $PageObjName = "lookup";

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		return ew_CurrentPage() . "?";
	}

	// Main
	function Page_Main() {
		global $conn;
		$GLOBALS["Page"] = &$this;
		$post = ew_StripSlashes($_POST);
		if (count($post) == 0)
			die("Missing post data.");

		//$sql = $qs->getValue("s");
		$sql = @$post["s"];
		$sql = ew_Decrypt($sql);
		if ($sql == "")
			die("Missing SQL.");
		$dbid = @$post["d"];
		$conn = ew_Connect($dbid);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();
		if (ob_get_length()) // Clear output
			ob_clean();
		if (strpos($sql, "{filter}") > 0) {
			$filters = "";
			$ar = preg_grep('/^f\d+$/', array_keys($post));
			foreach ($ar as $key) {

				// Get the filter values (for "IN")
				$filter = ew_Decrypt(@$post[$key]);
				if ($filter <> "") {
					$i = preg_replace('/^f/', '', $key);
					$value = @$post["v" . $i];
					if ($value == "") {
						if ($i > 0) // Empty parent field

							//continue; // Allow
							ew_AddFilter($filters, "1=0"); // Disallow
						continue;
					}
					$arValue = explode(",", $value);
					$fldtype = intval(@$post["t" . $i]);
					$flddatatype = ew_FieldDataType($fldtype);
					$bValidData = TRUE;
					for ($j = 0, $cnt = count($arValue); $j < $cnt; $j++) {
						if ($flddatatype == EW_DATATYPE_NUMBER && !is_numeric($arValue[$j])) {
							$bValidData = FALSE;
							break;
						} else {
							$arValue[$j] = ew_QuotedValue($arValue[$j], $flddatatype, $dbid);
						}
					}
					if ($bValidData)
						$filter = str_replace("{filter_value}", implode(",", $arValue), $filter);
					else
						$filter = "1=0";
					$fn = @$post["fn" . $i];
					if ($fn == "" || !function_exists($fn)) $fn = "ew_AddFilter";
					$fn($filters, $filter);
				}
			}
			$sql = str_replace("{filter}", ($filters <> "") ? $filters : "1=1", $sql);
		}

		// Get the query value (for "LIKE" or "=")
		$value = ew_AdjustSql(@$_GET["q"], $dbid); // Get the query value from querystring
		if ($value == "") $value = ew_AdjustSql(@$post["q"], $dbid); // Get the value from post
		if ($value <> "") {
			$sql = preg_replace('/LIKE \'(%)?\{query_value\}%\'/', ew_Like('\'$1{query_value}%\'', $dbid), $sql);
			$sql = str_replace("{query_value}", $value, $sql);
		}

		// Replace {query_value_n}
		preg_match_all('/\{query_value_(\d+)\}/', $sql, $out);
		$cnt = count($out[0]);
		for ($i = 0; $i < $cnt; $i++) {
			$j = $out[1][$i];
			$v = ew_AdjustSql(@$post["q" . $j], $dbid);
			$sql = str_replace("{query_value_" . $j . "}", $v, $sql);
		}
		$this->GetLookupValues($sql, $dbid);
		$result = ob_get_contents();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		if (ob_get_length()) // Clear output
			ob_clean();

		 // Close connection
		ew_CloseConn();

		// Output
		echo $result;
	}

	// Get lookup values
	function GetLookupValues($sql, $dbid) {
		$rsarr = array();
		$rowcnt = 0;
		if ($rs = Conn($dbid)->Execute($sql)) {
			$rowcnt = $rs->RecordCount();
			$fldcnt = $rs->FieldCount();
			$rsarr = $rs->GetRows();
			$rs->Close();
		}

		// Clean output buffer
		if (ob_get_length())
			ob_clean();

		// Format date
		$ardt = array();
		for ($j = 0; $j < $fldcnt; $j++)
			$ardt[$j] = @$_POST["df" . $j];

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if ($ardt[$j] != "" && intval($ardt[$j]) > 0) // Format date
						$str = ew_FormatDateTime($str, $ardt[$j]);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n", "\t"), array("\\r", "\\n", "\\t"), $str);
					} else {
						$str = str_replace(array("\r", "\n", "\t"), array(" ", " ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
		}
		echo ew_ArrayToJson($rsarr);
	}
}
?>
