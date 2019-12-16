<?php
class	lg_rss
{
	var $file	=	"";
	
	var $rss_channel = array();
	var	$currently_writing = "";
	var $main = "";
	var	$item_counter = 0;

	public	function __construct($file_name)
	{
		$this->file = $file_name;
	}
	public	function set_url($file_name)
	{
		$this->file = $file_name;
	}
	public	function solve()
	{
		$this->rss_channel 	= array();
		$this->currently_writing	= "";
		$this->main	= "";
		$this->item_counter = 0;
		
		$xml_parser = xml_parser_create();
		xml_set_element_handler($xml_parser, array($this,"_startElement"), array($this,"_endElement") );
		xml_set_character_data_handler($xml_parser, array($this,"_characterData") );
		if (!($fp = fopen($this->file, "r"))) {
			die("Could not open XML input");
		}		
		while ($data = fread($fp, 4096)) {
			if (!xml_parse($xml_parser, $data, feof($fp))) {
				die(sprintf("XML error: %s at line %d",
						xml_error_string(xml_get_error_code($xml_parser)),
						xml_get_current_line_number($xml_parser)));
			}
		}
		xml_parser_free($xml_parser);
		
		return $this->rss_channel;
	}
	public	function __destruct()
	{
	}
	private function _startElement($parser, $name, $attrs) {

		   switch($name) {
			   case "RSS":
			   case "RDF:RDF":
			   case "ITEMS":
				   $this->currently_writing = "";
				   break;
			   case "CHANNEL":
				   $this->main = "CHANNEL";
				   break;
			   case "IMAGE":
				   $this->main = "IMAGE";
				   $this->rss_channel["IMAGE"] = array();
				   break;
			   case "ITEM":
				   $this->main = "ITEMS";
				   break;
			   default:
				   $this->currently_writing = $name;
				   break;
		   }
	}
	private function _endElement($parser, $name) {
		   $this->currently_writing = "";
		   if ($name == "ITEM")
		   {
			   $this->item_counter++;
		   }
	}
	private function _characterData($parser, $data) {

		if ($this->currently_writing != "") {
			switch($this->main) {
				case "CHANNEL":
					if (isset($this->rss_channel[$this->currently_writing])) {
						$this->rss_channel[$this->currently_writing] .= $data;
					} else {
						$this->rss_channel[$this->currently_writing] = $data;
					}
					break;
				case "IMAGE":
					if (isset($this->rss_channel[$this->main][$this->currently_writing])) {
						$this->rss_channel[$this->main][$this->currently_writing] .= $data;
					} else {
						$this->rss_channel[$this->main][$this->currently_writing] = $data;
					}
					break;
				case "ITEMS":
					if (isset($this->rss_channel[$this->main][$this->item_counter][$this->currently_writing]))
					{
						$this->rss_channel[$this->main][$this->item_counter][$this->currently_writing] .= $data;
					} else {
						$this->rss_channel[$this->main][$this->item_counter][$this->currently_writing] = $data;
					}
					break;
			}
		}
	}
}
?>