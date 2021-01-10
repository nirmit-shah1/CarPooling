<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "commentinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$comment_delete = new ccomment_delete();
$Page =& $comment_delete;

// Page init
$comment_delete->Page_Init();

// Page main
$comment_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var comment_delete = new ew_Page("comment_delete");

// page properties
comment_delete.PageID = "delete"; // page ID
comment_delete.FormID = "fcommentdelete"; // form ID
var EW_PAGE_ID = comment_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
comment_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
comment_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comment_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $comment_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($comment_delete->Recordset = $comment_delete->LoadRecordset())
	$comment_deleteTotalRecs = $comment_delete->Recordset->RecordCount(); // Get record count
if ($comment_deleteTotalRecs <= 0) { // No record found, exit
	if ($comment_delete->Recordset)
		$comment_delete->Recordset->Close();
	$comment_delete->Page_Terminate("commentlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $comment->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $comment->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$comment_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="comment">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($comment_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $comment->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $comment->reg_id->FldCaption() ?></td>
		<td valign="top"><?php echo $comment->cmid->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$comment_delete->RecCnt = 0;
$i = 0;
while (!$comment_delete->Recordset->EOF) {
	$comment_delete->RecCnt++;

	// Set row properties
	$comment->ResetAttrs();
	$comment->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$comment_delete->LoadRowValues($comment_delete->Recordset);

	// Render row
	$comment_delete->RenderRow();
?>
	<tr<?php echo $comment->RowAttributes() ?>>
		<td<?php echo $comment->reg_id->CellAttributes() ?>>
<div<?php echo $comment->reg_id->ViewAttributes() ?>><?php echo $comment->reg_id->ListViewValue() ?></div></td>
		<td<?php echo $comment->cmid->CellAttributes() ?>>
<div<?php echo $comment->cmid->ViewAttributes() ?>><?php echo $comment->cmid->ListViewValue() ?></div></td>
	</tr>
<?php
	$comment_delete->Recordset->MoveNext();
}
$comment_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$comment_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$comment_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccomment_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'comment';

	// Page object name
	var $PageObjName = 'comment_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $comment;
		if ($comment->UseTokenInUrl) $PageUrl .= "t=" . $comment->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $comment;
		if ($comment->UseTokenInUrl) {
			if ($objForm)
				return ($comment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($comment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccomment_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (comment)
		if (!isset($GLOBALS["comment"])) {
			$GLOBALS["comment"] = new ccomment();
			$GLOBALS["Table"] =& $GLOBALS["comment"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'comment', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $comment;

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $comment;

		// Load key parameters
		$this->RecKeys = $comment->GetRecordKeys(); // Load record keys
		$sFilter = $comment->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("commentlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in comment class, commentinfo.php

		$comment->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$comment->CurrentAction = $_POST["a_delete"];
		} else {
			$comment->CurrentAction = "I"; // Display record
		}
		switch ($comment->CurrentAction) {
			case "D": // Delete
				$comment->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($comment->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $comment;

		// Call Recordset Selecting event
		$comment->Recordset_Selecting($comment->CurrentFilter);

		// Load List page SQL
		$sSql = $comment->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$comment->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $comment;
		$sFilter = $comment->KeyFilter();

		// Call Row Selecting event
		$comment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$comment->CurrentFilter = $sFilter;
		$sSql = $comment->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$comment->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $comment;
		if (!$rs || $rs->EOF) return;
		$comment->reg_id->setDbValue($rs->fields('reg_id'));
		$comment->cmid->setDbValue($rs->fields('cmid'));
		$comment->commentofuser->setDbValue($rs->fields('commentofuser'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $comment;

		// Initialize URLs
		// Call Row_Rendering event

		$comment->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// cmid
		// commentofuser

		if ($comment->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$comment->reg_id->ViewValue = $comment->reg_id->CurrentValue;
			$comment->reg_id->ViewCustomAttributes = "";

			// cmid
			$comment->cmid->ViewValue = $comment->cmid->CurrentValue;
			$comment->cmid->ViewCustomAttributes = "";

			// reg_id
			$comment->reg_id->LinkCustomAttributes = "";
			$comment->reg_id->HrefValue = "";
			$comment->reg_id->TooltipValue = "";

			// cmid
			$comment->cmid->LinkCustomAttributes = "";
			$comment->cmid->HrefValue = "";
			$comment->cmid->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($comment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$comment->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $comment;
		$DeleteRows = TRUE;
		$sSql = $comment->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $comment->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['cmid'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($comment->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($comment->CancelMessage <> "") {
				$this->setFailureMessage($comment->CancelMessage);
				$comment->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$comment->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
