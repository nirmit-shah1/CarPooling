<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "postalinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$postal_list = new cpostal_list();
$Page =& $postal_list;

// Page init
$postal_list->Page_Init();

// Page main
$postal_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($postal->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var postal_list = new ew_Page("postal_list");

// page properties
postal_list.PageID = "list"; // page ID
postal_list.FormID = "fpostallist"; // form ID
var EW_PAGE_ID = postal_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
postal_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
postal_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
postal_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($postal->Export == "") || (EW_EXPORT_MASTER_RECORD && $postal->Export == "print")) { ?>
<?php } ?>
<?php $postal_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$postal_list->TotalRecs = $postal->SelectRecordCount();
	} else {
		if ($postal_list->Recordset = $postal_list->LoadRecordset())
			$postal_list->TotalRecs = $postal_list->Recordset->RecordCount();
	}
	$postal_list->StartRec = 1;
	if ($postal_list->DisplayRecs <= 0 || ($postal->Export <> "" && $postal->ExportAll)) // Display all records
		$postal_list->DisplayRecs = $postal_list->TotalRecs;
	if (!($postal->Export <> "" && $postal->ExportAll))
		$postal_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$postal_list->Recordset = $postal_list->LoadRecordset($postal_list->StartRec-1, $postal_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $postal->TableCaption() ?>
&nbsp;&nbsp;<?php $postal_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($postal->Export == "" && $postal->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(postal_list);" style="text-decoration: none;"><img id="postal_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="postal_list_SearchPanel">
<form name="fpostallistsrch" id="fpostallistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="postal">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($postal->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $postal_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($postal->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($postal->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($postal->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php
$postal_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fpostallist" id="fpostallist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="postal">
<div id="gmp_postal" class="ewGridMiddlePanel">
<?php if ($postal_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $postal->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$postal_list->RenderListOptions();

// Render list options (header, left)
$postal_list->ListOptions->Render("header", "left");
?>
<?php if ($postal->reg_id->Visible) { // reg_id ?>
	<?php if ($postal->SortUrl($postal->reg_id) == "") { ?>
		<td><?php echo $postal->reg_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $postal->SortUrl($postal->reg_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $postal->reg_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($postal->reg_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($postal->reg_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($postal->postalcode->Visible) { // postalcode ?>
	<?php if ($postal->SortUrl($postal->postalcode) == "") { ?>
		<td><?php echo $postal->postalcode->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $postal->SortUrl($postal->postalcode) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $postal->postalcode->FldCaption() ?></td><td style="width: 10px;"><?php if ($postal->postalcode->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($postal->postalcode->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($postal->state->Visible) { // state ?>
	<?php if ($postal->SortUrl($postal->state) == "") { ?>
		<td><?php echo $postal->state->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $postal->SortUrl($postal->state) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $postal->state->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($postal->state->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($postal->state->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($postal->city->Visible) { // city ?>
	<?php if ($postal->SortUrl($postal->city) == "") { ?>
		<td><?php echo $postal->city->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $postal->SortUrl($postal->city) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $postal->city->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($postal->city->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($postal->city->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$postal_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($postal->ExportAll && $postal->Export <> "") {
	$postal_list->StopRec = $postal_list->TotalRecs;
} else {

	// Set the last record to display
	if ($postal_list->TotalRecs > $postal_list->StartRec + $postal_list->DisplayRecs - 1)
		$postal_list->StopRec = $postal_list->StartRec + $postal_list->DisplayRecs - 1;
	else
		$postal_list->StopRec = $postal_list->TotalRecs;
}
$postal_list->RecCnt = $postal_list->StartRec - 1;
if ($postal_list->Recordset && !$postal_list->Recordset->EOF) {
	$postal_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $postal_list->StartRec > 1)
		$postal_list->Recordset->Move($postal_list->StartRec - 1);
} elseif (!$postal->AllowAddDeleteRow && $postal_list->StopRec == 0) {
	$postal_list->StopRec = $postal->GridAddRowCount;
}

// Initialize aggregate
$postal->RowType = EW_ROWTYPE_AGGREGATEINIT;
$postal->ResetAttrs();
$postal_list->RenderRow();
$postal_list->RowCnt = 0;
while ($postal_list->RecCnt < $postal_list->StopRec) {
	$postal_list->RecCnt++;
	if (intval($postal_list->RecCnt) >= intval($postal_list->StartRec)) {
		$postal_list->RowCnt++;

		// Set up key count
		$postal_list->KeyCount = $postal_list->RowIndex;

		// Init row class and style
		$postal->ResetAttrs();
		$postal->CssClass = "";
		$postal->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($postal_list->RowIndex))
			$postal->RowAttrs = array_merge($postal->RowAttrs, array('data-rowindex'=>$postal_list->RowIndex, 'id'=>'r' . $postal_list->RowIndex . '_postal'));
		if ($postal->CurrentAction == "gridadd") {
			$postal_list->LoadDefaultValues(); // Load default values
		} else {
			$postal_list->LoadRowValues($postal_list->Recordset); // Load row values
		}
		$postal->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$postal_list->RenderRow();

		// Render list options
		$postal_list->RenderListOptions();
?>
	<tr<?php echo $postal->RowAttributes() ?>>
<?php

// Render list options (body, left)
$postal_list->ListOptions->Render("body", "left");
?>
	<?php if ($postal->reg_id->Visible) { // reg_id ?>
		<td<?php echo $postal->reg_id->CellAttributes() ?>>
<div<?php echo $postal->reg_id->ViewAttributes() ?>><?php echo $postal->reg_id->ListViewValue() ?></div>
<a name="<?php echo $postal_list->PageObjName . "_row_" . $postal_list->RowCnt ?>" id="<?php echo $postal_list->PageObjName . "_row_" . $postal_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($postal->postalcode->Visible) { // postalcode ?>
		<td<?php echo $postal->postalcode->CellAttributes() ?>>
<div<?php echo $postal->postalcode->ViewAttributes() ?>><?php echo $postal->postalcode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($postal->state->Visible) { // state ?>
		<td<?php echo $postal->state->CellAttributes() ?>>
<div<?php echo $postal->state->ViewAttributes() ?>><?php echo $postal->state->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($postal->city->Visible) { // city ?>
		<td<?php echo $postal->city->CellAttributes() ?>>
<div<?php echo $postal->city->ViewAttributes() ?>><?php echo $postal->city->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$postal_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($postal->CurrentAction <> "gridadd")
		$postal_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($postal_list->Recordset)
	$postal_list->Recordset->Close();
?>
<?php if ($postal->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($postal->CurrentAction <> "gridadd" && $postal->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($postal_list->Pager)) $postal_list->Pager = new cPrevNextPager($postal_list->StartRec, $postal_list->DisplayRecs, $postal_list->TotalRecs) ?>
<?php if ($postal_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($postal_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $postal_list->PageUrl() ?>start=<?php echo $postal_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($postal_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $postal_list->PageUrl() ?>start=<?php echo $postal_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $postal_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($postal_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $postal_list->PageUrl() ?>start=<?php echo $postal_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($postal_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $postal_list->PageUrl() ?>start=<?php echo $postal_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $postal_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $postal_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $postal_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $postal_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($postal_list->SearchWhere == "0=101") { ?>
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
<a href="<?php echo $postal_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($postal->Export == "" && $postal->CurrentAction == "") { ?>
<?php } ?>
<?php
$postal_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($postal->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$postal_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpostal_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'postal';

	// Page object name
	var $PageObjName = 'postal_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $postal;
		if ($postal->UseTokenInUrl) $PageUrl .= "t=" . $postal->TableVar . "&"; // Add page token
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
		global $objForm, $postal;
		if ($postal->UseTokenInUrl) {
			if ($objForm)
				return ($postal->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($postal->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpostal_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (postal)
		if (!isset($GLOBALS["postal"])) {
			$GLOBALS["postal"] = new cpostal();
			$GLOBALS["Table"] =& $GLOBALS["postal"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "postaladd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "postaldelete.php";
		$this->MultiUpdateUrl = "postalupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'postal', TRUE);

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
		global $postal;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$postal->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $postal;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($postal->Export <> "" ||
				$postal->CurrentAction == "gridadd" ||
				$postal->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$postal->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($postal->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $postal->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$postal->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$postal->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$postal->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $postal->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$postal->setSessionWhere($sFilter);
		$postal->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $postal;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $postal->address1, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $postal->address2, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $postal->state, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $postal->city, $Keyword);
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
		global $Security, $postal;
		$sSearchStr = "";
		$sSearchKeyword = $postal->BasicSearchKeyword;
		$sSearchType = $postal->BasicSearchType;
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
			$postal->setSessionBasicSearchKeyword($sSearchKeyword);
			$postal->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $postal;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$postal->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $postal;
		$postal->setSessionBasicSearchKeyword("");
		$postal->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $postal;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$postal->BasicSearchKeyword = $postal->getSessionBasicSearchKeyword();
			$postal->BasicSearchType = $postal->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $postal;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$postal->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$postal->CurrentOrderType = @$_GET["ordertype"];
			$postal->UpdateSort($postal->reg_id); // reg_id
			$postal->UpdateSort($postal->postalcode); // postalcode
			$postal->UpdateSort($postal->state); // state
			$postal->UpdateSort($postal->city); // city
			$postal->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $postal;
		$sOrderBy = $postal->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($postal->SqlOrderBy() <> "") {
				$sOrderBy = $postal->SqlOrderBy();
				$postal->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $postal;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$postal->setSessionOrderBy($sOrderBy);
				$postal->reg_id->setSort("");
				$postal->postalcode->setSort("");
				$postal->state->setSort("");
				$postal->city->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$postal->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $postal;

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
		global $Security, $Language, $postal, $objForm;
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
		global $Security, $Language, $postal;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $postal;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$postal->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$postal->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $postal->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$postal->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$postal->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$postal->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $postal;
		$postal->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$postal->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $postal;

		// Call Recordset Selecting event
		$postal->Recordset_Selecting($postal->CurrentFilter);

		// Load List page SQL
		$sSql = $postal->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$postal->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $postal;
		$sFilter = $postal->KeyFilter();

		// Call Row Selecting event
		$postal->Row_Selecting($sFilter);

		// Load SQL based on filter
		$postal->CurrentFilter = $sFilter;
		$sSql = $postal->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$postal->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $postal;
		if (!$rs || $rs->EOF) return;
		$postal->reg_id->setDbValue($rs->fields('reg_id'));
		$postal->address1->setDbValue($rs->fields('address1'));
		$postal->address2->setDbValue($rs->fields('address2'));
		$postal->postalcode->setDbValue($rs->fields('postalcode'));
		$postal->state->setDbValue($rs->fields('state'));
		$postal->city->setDbValue($rs->fields('city'));
	}

	// Load old record
	function LoadOldRecord() {
		global $postal;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($postal->getKey("reg_id")) <> "")
			$postal->reg_id->CurrentValue = $postal->getKey("reg_id"); // reg_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$postal->CurrentFilter = $postal->KeyFilter();
			$sSql = $postal->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $postal;

		// Initialize URLs
		$this->ViewUrl = $postal->ViewUrl();
		$this->EditUrl = $postal->EditUrl();
		$this->InlineEditUrl = $postal->InlineEditUrl();
		$this->CopyUrl = $postal->CopyUrl();
		$this->InlineCopyUrl = $postal->InlineCopyUrl();
		$this->DeleteUrl = $postal->DeleteUrl();

		// Call Row_Rendering event
		$postal->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// address1
		// address2
		// postalcode
		// state
		// city

		if ($postal->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$postal->reg_id->ViewValue = $postal->reg_id->CurrentValue;
			$postal->reg_id->ViewCustomAttributes = "";

			// postalcode
			$postal->postalcode->ViewValue = $postal->postalcode->CurrentValue;
			$postal->postalcode->ViewCustomAttributes = "";

			// state
			$postal->state->ViewValue = $postal->state->CurrentValue;
			$postal->state->ViewCustomAttributes = "";

			// city
			$postal->city->ViewValue = $postal->city->CurrentValue;
			$postal->city->ViewCustomAttributes = "";

			// reg_id
			$postal->reg_id->LinkCustomAttributes = "";
			$postal->reg_id->HrefValue = "";
			$postal->reg_id->TooltipValue = "";

			// postalcode
			$postal->postalcode->LinkCustomAttributes = "";
			$postal->postalcode->HrefValue = "";
			$postal->postalcode->TooltipValue = "";

			// state
			$postal->state->LinkCustomAttributes = "";
			$postal->state->HrefValue = "";
			$postal->state->TooltipValue = "";

			// city
			$postal->city->LinkCustomAttributes = "";
			$postal->city->HrefValue = "";
			$postal->city->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($postal->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$postal->Row_Rendered();
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
