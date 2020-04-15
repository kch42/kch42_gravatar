<?php

class kch42_gravatar extends RatatoeskrPlugin
{
	public function ste_tag_kch42_gravatar($ste, $params, $sub)
	{
		if(!isset($params["comment"]))
			throw new \ste\RuntimeError("ste:kch42_gravatar needs the comment parameter.");

		$ste_comment = $ste->get_var_by_name($params["comment"]);

		if(isset($ste_comment["__obj"]))
			$comment = $ste_comment["__obj"];
		else
			$comment = Comment::by_id($ste_comment["id"]);

		$mail_hash = md5(strtolower(trim($comment->author_mail)));

		$gravatar_args = array("default" => "identicon", "rating" => "g", "size" => "80");
		$query_fragments = array();
		foreach($gravatar_args as $key => &$value)
		{
			if(isset($params[$key]))
				$value = $params[$key];
			$value = htmlspecialchars(urlencode($value));
			$query_fragments[] = "$key=$value";
		}

		$styles = "width: {$gravatar_args["size"]}px; height: {$gravatar_args["size"]}px;" . (isset($params["style"]) ? " " . $params["style"] : "");

		$protocol = ((!empty($_SERVER["HTTPS"])) and ($_SERVER["HTTPS"] == "on")) ? "https" : "http";

		return "<img src=\"$protocol://www.gravatar.com/avatar/$mail_hash?" . implode("&", $query_fragments) . "\" style=\"" . htmlspecialchars($styles) . "\" alt=\"\" />";
	}

	public function init()
	{
		$this->ste->register_tag("kch42_gravatar", array($this, "ste_tag_kch42_gravatar"));
	}
}
