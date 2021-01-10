<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "zlogininfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$zlogin_list = new czlogin_list();
$Page =& $zlogin_list;

// Page init
$zlogin_list->Page_Init();

// Page main
$zlogin_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($zlogin->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var zlogin_list = new ew_Page("zlogin_list");

// page properties
zlogin_list.PageID = "list"; // page ID
zlogin_list.FormID = "fzloginlist"; // form ID
var EW_PAGE_ID = zlogin_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
zlogin_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
zlogin_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
zlogin_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($zlogin->Export == "") || (EW_EXPORT_MASTER_RECORD && $zlogin->Export == "print")) { ?>
<?php } ?>
<?php $zlogin_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$zlogin_list->TotalRecs = $zlogin->SelectRecordCount();
	} else {
		if ($zlogin_list->Recordset = $zlogin_list->LoadRecordset())
			$zlogin_list->TotalRecs = $zlogin_list->Recordset->RecordCount();
	}
	$zlogin_list->StartRec = 1;
	if ($zlogin_list->DisplayRecs <= 0 || ($zlogin->Export <> "" && $zlogin->ExportAll)) // Display all records
		$zlogin_list->DisplayRecs = $zlogin_list->TotalRecs;
	if (!($zlogin->Export <> "" && $zlogin->ExportAll))
		$zlogin_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$zlogin_list->Recordset = $zlogin_list->LoadRecordset($zlogin_list->StartRec-1, $zlogin_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $zlogin->TableCaption() ?>
&nbsp;&nbsp;<?php $zlogin_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($zlogin->Export == "" && $zlogin->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(zlogin_list);" style="text-decoration: none;"><img id="zlogin_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="zlogin_list_SearchPanel">
<form name="fzloginlistsrch" id="fzloginlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="zlogin">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($zlogin->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $zlogin_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($zlogin->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($zlogin->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($zlogin->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php
$zlogin_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fzloginlist" id="fzloginlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="zlogin">
<div id="gmp_zlogin" class="ewGridMiddlePanel">
<?php if ($zlogin_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $zlogin->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$zlogin_list->RenderListOptions();

// Render list options (header, left)
$zlogin_list->ListOptions->Render("header", "left");
?>
<?php if ($zlogin->reg_id->Visible) { // reg_id ?>
	<?php if ($zlogin->SortUrl($zlogin->reg_id) == "") { ?>
		<td><?php echo $zlogin->reg_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $zlogin->SortUrl($zlogin->reg_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $zlogin->reg_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($zlogin->reg_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($zlogin->reg_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($zlogin->zemail->Visible) { // email ?>
	<?php if ($zlogin->SortUrl($zlogin->zemail) == "") { ?>
		<td><?php echo $zlogin->zemail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $zlogin->SortUrl($zlogin->zemail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $zlogin->zemail->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($zlogin->zemail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($zlogin->zemail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($zlogin->password->Visible) { // password ?>
	<?php if ($zlogin->SortUrl($zlogin->password) == "") { ?>
		<td><?php echo $zlogin->password->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $zlogin->SortUrl($zlogin->password) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $zlogin->password->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($zlogin->password->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($zlogin->password->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$zlogin_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($zlogin->ExportAll && $zlogin->Export <> "") {
	$zlogin_list->StopRec = $zlogin_list->TotalRecs;
} else {

	// Set the last record to display
	if ($zlogin_list->TotalRecs > $zlogin_list->StartRec + $zlogin_list->DisplayRecs - 1)
		$zlogin_list->StopRec = $zlogin_list->StartRec + $zlogin_list->DisplayRecs - 1;
	else
		$zlogin_list->StopRec = $zlogin_list->TotalRecs;
}
$zlogin_list->RecCnt = $zlogin_list->StartRec - 1;
if ($zlogin_list->Recordset && !$zlogin_list->Recordset->EOF) {
	$zlogin_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $zlogin_list->StartRec > 1)
		$zlogin_list->Recordset->Move($zlogin_list->StartRec - 1);
} elseif (!$zlogin->AllowAddDeleteRow && $zlogin_list->StopRec == 0) {
	$zlogin_list->StopRec = $zlogin->GridAddRowCount;
}

// Initialize aggregate
$zlogin->RowType = EW_ROWTYPE_AGGREGATEINIT;
$zlogin->ResetAttrs();
$zlogin_list->RenderRow();
$zlogin_list->RowCnt = 0;
while ($zlogin_list->RecCnt < $zlogin_list->StopRec) {
	$zlogin_list->RecCnt++;
	if (intval($zlogin_list->RecCnt) >= intval($zlogin_list->StartRec)) {
		$zlogin_list->RowCnt++;

		// Set up key count
		$zlogin_list->KeyCount = $zlogin_list->RowIndex;

		// Init row class and style
		$zlogin->ResetAttrs();
		$zlogin->CssClass = "";
		$zlogin->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($zlogin_list->RowIndex))
			$zlogin->RowAttrs = array_merge($zlogin->RowAttrs, array('data-rowindex'=>$zlogin_list->RowIndex, 'id'=>'r' . $zlogin_list->RowIndex . '_zlogin'));
		if ($zlogin->CurrentAction == "gridadd") {
			$zlogin_list->LoadDefaultValues(); // Load default values
		} else {
			$zlogin_list->LoadRowValues($zlogin_list->Recordset); // Load row values
		}
		$zlogin->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$zlogin_list->RenderRow();

		// Render list options
		$zlogin_list->RenderListOptions();
?>
	<tr<?php echo $zlogin->RowAttributes() ?>>
<?php

// Render list options (body, left)
$zlogin_list->ListOptions->Render("body", "left");
?>
	<?php if ($zlogin->reg_id->Visible) { // reg_id ?>
		<td<?php echo $zlogin->reg_id->CellAttributes() ?>>
<div<?php echo $zlogin->reg_id->ViewAttributes() ?>><?php echo $zlogin->reg_id->ListViewValue() ?></div>
<a name="<?php echo $zlogin_list->PageObjName . "_row_" . $zlogin_list->RowCnt ?>" id="<?php echo $zlogin_list->PageObjName . "_row_" . $zlogin_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($zlogin->zemail->Visible) { // email ?>
		<td<?php echo $zlogin->zemail->CellAttributes() ?>>
<div<?php echo $zlogin->zemail->ViewAttributes() ?>><?php echo $zlogin->zemail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($zlogin->password->Visible) { // password ?>
		<td<?php echo $zlogin->password->CellAttributes() ?>>
<div<?php echo $zlogin->password->ViewAttributes() ?>><?php echo $zlogin->password->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$zlogin_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($zlogin->CurrentAction <> "gridadd")
		$zlogin_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($zlogin_list->Recordset)
	$zlogin_list->Recordset->Close();
?>
<?php if ($zlogin->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($zlogin->CurrentAction <> "gridadd" && $zlogin->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($zlogin_list->Pager)) $zlogin_list->Pager = new cPrevNextPager($zlogin_list->StartRec, $zlogin_list->DisplayRecs, $zlogin_list->TotalRecs) ?>
<?php if ($zlogin_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($zlogin_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $zlogin_list->PageUrl() ?>start=<?php echo $zlogin_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($zlogin_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $zlogin_list->PageUrl() ?>start=<?php echo $zlogin_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $zlogin_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($zlogin_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $zlogin_list->PageUrl() ?>start=<?php echo $zlogin_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($zlogin_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $zlogin_list->PageUrl() ?>start=<?php echo $zlogin_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $zlogin_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $zlogin_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $zlogin_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $zlogin_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($zlogin_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $zlogin_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($zlogin->Export == "" && $zlogin->CurrentAction == "") { ?>
<?php } ?>
<?php
$zlogin_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($zlogin->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$zlogin_list->Page_Terminate();
?>
<?php

//
// Page class
//
class czlogin_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'login';

	// Page object name
	var $PageObjName = 'zlogin_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $zlogin;
		if ($zlogin->UseTokenInUrl) $PageUrl .= "t=" . $zlogin->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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
		global $objForm, $zlogin;
		if ($zlogin->UseTokenInUrl) {
			if ($objForm)
				return ($zlogin->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($zlogin->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function czlogin_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (zlogin)
		if (!isset($GLOBALS["zlogin"])) {
			$GLOBALS["zlogin"] = new czlogin();
			$GLOBALS["Table"] =& $GLOBALS["zlogin"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "zloginadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "zlogindelete.php";
		$this->MultiUpdateUrl = "zloginupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'login', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $zlogin;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$zlogin->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

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

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $zlogin;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($zlogin->Export <> "" ||
				$zlogin->CurrentAction == "gridadd" ||
				$zlogin->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$zlogin->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($zlogin->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $zlogin->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$zlogin->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$zlogin->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$zlogin->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $zlogin->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$zlogin->setSessionWhere($sFilter);
		$zlogin->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $zlogin;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $zlogin->zemail, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $zlogin->password, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", $lFldDataType));
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $zlogin;
		$sSearchStr = "";
		$sSearchKeyword = $zlogin->BasicSearchKeyword;
		$sSearchType = $zlogin->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$zlogin->setSessionBasicSearchKeyword($sSearchKeyword);
			$zlogin->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $zlogin;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$zlogin->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $zlogin;
		$zlogin->setSessionBasicSearchKeyword("");
		$zlogin->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $zlogin;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$zlogin->BasicSearchKeyword = $zlogin->getSessionBasicSearchKeyword();
			$zlogin->BasicSearchType = $zlogin->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $zlogin;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$zlogin->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$zlogin->CurrentOrderType = @$_GET["ordertype"];
			$zlogin->UpdateSort($zlogin->reg_id); // reg_id
			$zlogin->UpdateSort($zlogin->zemail); // email
			$zlogin->UpdateSort($zlogin->password); // password
			$zlogin->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $zlogin;
		$sOrderBy = $zlogin->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($zlogin->SqlOrderBy() <> "") {
				$sOrderBy = $zlogin->SqlOrderBy();
				$zlogin->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $zlogin;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$zlogin->setSessionOrderBy($sOrderBy);
				$zlogin->reg_id->setSort("");
				$zlogin->zemail->setSort("");
				$zlogin->password->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$zlogin->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $zlogin;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "copy"
		$item =& $this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $zlogin, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $zlogin;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $zlogin;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$zlogin->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$zlogin->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $zlogin->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$zlogin->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$zlogin->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$zlogin->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $zlogin;
		$zlogin->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$zlogin->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $zlogin;

		// Call Recordset Selecting event
		$zlogin->Recordset_Selecting($zlogin->CurrentFilter);

		// Load List page SQL
		$sSql = $zlogin->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$zlogin->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $zlogin;
		$sFilter = $zlogin->KeyFilter();

		// Call Row Selecting event
		$zlogin->Row_Selecting($sFilter);

		// Load SQL based on filter
		$zlogin->CurrentFilter = $sFilter;
		$sSql = $zlogin->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$zlogin->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $zlogin;
		if (!$rs || $rs->EOF) return;
		$zlogin->reg_id->setDbValue($rs->fields('reg_id'));
		$zlogin->zemail->setDbValue($rs->fields('email'));
		$zlogin->password->setDbValue($rs->fields('password'));
	}

	// Load old record
	function LoadOldRecord() {
		global $zlogin;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($zlogin->getKey("zemail")) <> "")
			$zlogin->zemail->CurrentValue = $zlogin->getKey("zemail"); // email
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$zlogin->CurrentFilter = $zlogin->KeyFilter();
			$sSql = $zlogin->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $zlogin;

		// Initialize URLs
		$this->ViewUrl = $zlogin->ViewUrl();
		$this->EditUrl = $zlogin->EditUrl();
		$this->InlineEditUrl = $zlogin->InlineEditUrl();
		$this->CopyUrl = $zlogin->CopyUrl();
		$this->InlineCopyUrl = $zlogin->InlineCopyUrl();
		$this->DeleteUrl = $zlogin->DeleteUrl();

		// Call Row_Rendering event
		$zlogin->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// email
		// password

		if ($zlogin->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$zlogin->reg_id->ViewValue = $zlogin->reg_id->CurrentValue;
			$zlogin->reg_id->ViewCustomAttributes = "";

			// email
			$zlogin->zemail->ViewValue = $zlogin->zemail->CurrentValue;
			$zlogin->zemail->ViewCustomAttributes = "";

			// password
			$zlogin->password->ViewValue = $zlogin->password->CurrentValue;
			$zlogin->password->ViewCustomAttributes = "";

			// reg_id
			$zlogin->reg_id->LinkCustomAttributes = "";
			$zlogin->reg_id->HrefValue = "";
			$zlogin->reg_id->TooltipValue = "";

			// email
			$zlogin->zemail->LinkCustomAttributes = "";
			$zlogin->zemail->HrefValue = "";
			$zlogin->zemail->TooltipValue = "";

			// password
			$zlogin->password->LinkCustomAttributes = "";
			$zlogin->password->HrefValue = "";
			$zlogin->password->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($zlogin->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$zlogin->Row_Rendered();
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
