<?php

class syrus_seo_form_helper {
	/**
	 * Converts a string into a camelCase string.
	 *
	 * @param string $field
	 * @param array $noStrip
	 *
	 * @return string
	 */
	public function camelCase($str) {
			$str = preg_replace('/[^a-z0-9]+/i', ' ', $str);
			$str = trim($str);
			$str = ucwords($str);
			$str = str_replace(" ", "", $str);
			$str = lcfirst($str);
			return $str;
	}

	/**
	 * Create a input form element with wrapper, label, etc
	 *
	 * @param string $field
	 * @param array $options
	 *
	 * @return string
	 */
	public function input($field, $options = array()) {
		$output = null;

		$label = $this->camelCase($field);
		if (!empty($options['label'])) {
			$label = $options['label'];
		}

		$label_class = 'post-attributes-label';
		if (!empty($options['label']['class'])) {
			$label_class = $options['label']['class'];
		}

		$value = null;
		if (!empty($options['value'])) {
			$value = $options['value'];
		}

		$output .= sprintf(
			'<div>'
			.'<p class="post-attributes-label-wrapper"><label for="%s" class="%s">%s</label></p>'
			.'<input id="%s" type="text" name="%s" size="60" value="%s">'
			.'</div>',
			$this->camelCase($field), $label_class,
			$label,
			$this->camelCase($field),
			$field,
			$value
		);

		return $output;
	}

	/**
	 * Create a textarea form element with wrapper, label, etc
	 *
	 * @param string $field
	 * @param array $options
	 *
	 * @return string
	 */
	public function textarea($field, $options = array()) {
		$output = null;

		$label = $this->camelCase($field);
		if (!empty($options['label'])) {
			$label = $options['label'];
		}

		$label_class = 'post-attributes-label';
		if (!empty($options['label']['class'])) {
			$label_class = $options['label']['class'];
		}

		$value = null;
		if (!empty($options['value'])) {
			$value = $options['value'];
		}

		$rows = 2;
		if (!empty($options['rows'])) {
			$rows = $options['rows'];
		}

		$cols = 127;
		if (!empty($options['cols'])) {
			$cols = $options['cols'];
		}

		$output .= sprintf(
			'<div>'
			.'<p class="post-attributes-label-wrapper"><label for="%s" class="%s">%s</label></p>'
			.'<textarea id="%s" name="%s" rows="%d" cols="%d" style="resize:none">%s</textarea>'
			.'</div>',
			$this->camelCase($field), $label_class,
			$label,
			$this->camelCase($field),
			$field,
			$rows,
			$cols,
			$value
		);

		return $output;
	}
}

?>
