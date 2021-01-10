<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg12.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql12.php") ?>
<?php include_once "phpfn12.php" ?>
<?php include_once "userfn12.php" ?>
<?php
ew_Header(FALSE);
$file = new cfile;
$file->Page_Main();

//
// Page class for file viewer
//
class cfile {

	// Page ID
	var $PageID = "file";

	// Project ID
	var $ProjectID = "{9ACD0C53-10B4-423E-B4D2-BB7755A0F8CA}";

	// Page object name
	var $PageObjName = "file";

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		return ew_CurrentPage() . "?";
	}

	// Main
	// - Uncomment ** for database connectivity / Page_Loading / Page_Unloaded server event
	function Page_Main() {
		global $conn;
		$GLOBALS["Page"] = &$this;

		//**$conn = ew_Connect();
		// Get fn / table name parameters

		$key = EW_RANDOM_KEY . session_id();
		$fn = (@$_GET["fn"] <> "") ? ew_StripSlashes($_GET["fn"]) : "";
		if ($fn <> "" && EW_ENCRYPT_FILE_PATH)
			$fn = ew_Decrypt($fn, $key);
		$table = (@$_GET["t"] <> "") ? ew_StripSlashes($_GET["t"]) : "";
		if ($table <> "" && EW_ENCRYPT_FILE_PATH)
			$table = ew_Decrypt($table, $key);

		// Global Page Loading event (in userfn*.php)
		//**Page_Loading();
		// Get resize parameters

		$resize = (@$_GET["resize"] <> "");
		$width = (@$_GET["width"] <> "") ? $_GET["width"] : 0;
		$height = (@$_GET["height"] <> "") ? $_GET["height"] : 0;
		if (@$_GET["width"] == "" && @$_GET["height"] == "") {
			$width = EW_THUMBNAIL_DEFAULT_WIDTH;
			$height = EW_THUMBNAIL_DEFAULT_HEIGHT;
		}

		// Resize image from physical file
		if ($fn <> "") {
			$fn = str_replace("\0", "", $fn);
			$info = pathinfo($fn);
			$fn = ew_PathCombine(ew_AppRoot(), $info["dirname"], TRUE) . $info["basename"];
			if (file_exists($fn) || @fopen($fn, "rb") !== FALSE) { // Allow remote file
				if (ob_get_length())
					ob_end_clean();
				$ext = strtolower(@$info["extension"]);
				$ct = ew_ContentType("", $fn);
				if ($ct <> "")
					header("Content-type: " . $ct);
				header("Content-Disposition: attachment; filename=\"" . $info["basename"] . "\"");
				if (in_array($ext, explode(",", EW_IMAGE_ALLOWED_FILE_EXT))) {
					$size = @getimagesize($fn);
					if ($size)
						header("Content-type: {$size['mime']}");
					if ($width > 0 || $height > 0)
						echo ew_ResizeFileToBinary($fn, $width, $height);
					else
						echo file_get_contents($fn);
				} elseif (in_array($ext, explode(",", EW_DOWNLOAD_ALLOWED_FILE_EXT))) {
					echo file_get_contents($fn);
				}
			}
		}

		// Global Page Unloaded event (in userfn*.php)
		//**Page_Unloaded();
		 // Close connection
		//**ew_CloseConn();

	}
}
?>
